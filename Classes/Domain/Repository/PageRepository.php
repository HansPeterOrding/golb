<?php

namespace Greenfieldr\Golb\Domain\Repository;

/*
 * This file is part of TYPO3 CMS-based extension "golb".
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 3
 * of the License, or any later version.
 */

use Greenfieldr\Golb\Constants;
use Greenfieldr\Golb\Domain\Model\Category;
use Greenfieldr\Golb\Domain\Model\Dto\PostsDemand;
use Greenfieldr\Golb\Domain\Model\Page;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * The repository for pages
 */
class PageRepository extends Repository
{

    public function initializeObject()
    {
        $this->defaultQuerySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $this->defaultQuerySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($this->defaultQuerySettings);
    }

    /**
     * Property to collect posts
     *
     * @var array $posts
     */
    protected array $posts = [];

    /**
     * Property to collect categories
     *
     * @var array $categories
     */
    protected array $categories = [];

    /**
     * Finds latest blog posts recursively
     *
     * @param array $rootPages
     * @param PostsDemand $demand
     * @return array
     */
    public function findPosts(array $rootPages, PostsDemand $demand): array
    {
        $pages = $this->findSubPagesByPageIds($rootPages);

        $query = $this->createQuery();
        $this->posts = $query->matching(
            $query->logicalAnd(
                $query->in('uid', $pages),
                $query->equals('doktype', Constants::BLOG_POST_DOKTYPE)
            )
        )->execute()->toArray();

        /**
         * if sorting is provided as an argument the array is sorted based on the type of sorting
         */
        if ($demand->hasOrder()) {
            /**
             * @TODO: Respect order direction from demand object
             */
            switch ($demand->getOrder()) {
                case "date":
                    usort($this->posts, function ($a, $b) {
                        /** @var Page $a */
                        /** @var Page $b */
                        //If publish date is set use this else create date
                        if ($a->getPublishDate()) {
                            $a = $a->getPublishDate();
                        } else {
                            $a = $a->getCreationDate();
                        }

                        if ($b->getPublishDate()) {
                            $b = $b->getPublishDate();
                        } else {
                            $b = $b->getCreationDate();
                        }

                        if($a == $b)
                            return 0;

                        return ($a < $b) ? -1 : 1;
                    });
                    break;
                case "author":
                    usort($this->posts, function ($a, $b) {
                        /* if no author value is present (''), it will be set as 'zz' to appear latest in array with objects */
                        $al = ($a->getAuthorName() == '') ? 'zz' : substr(strtolower($a->getAuthorName()), 0, 2);
                        $bl = ($a->getAuthorName() == '') ? 'zz' : substr(strtolower($b->getAuthorName()), 0, 2);
                        if ($al == $bl) {
                            return 0;
                        }

                        return ($al < $bl) ? -1 : 1;
                    });
                    break;
            }
        }

        /**
         * @ToDo: Refactoring needed.
         */
        if ($demand->hasCategories()) {
            $this->categories = [];
            $categoryIds = [];
            /** @var Category $category */
            $this->traverseCategories($demand->getCategories());

            foreach ($this->categories as $category) {
                $categoryIds[] = $category->getUid();
            }

            $posts = $this->posts;

            $this->posts = [];
            foreach ($posts as $post) {
                /**    @var Page $post */
                foreach ($post->getCategories() as $cat) {
                    /** @var Category $cat */
                    if (in_array($cat->getUid(), $categoryIds)) {
                        $this->posts[] = $post;
                    }
                }
            }
        }

        foreach ($this->posts as $key => $post) {
            if (in_array($post->getUid(), $demand->getExcluded())) {
                    unset($this->posts[$key]);
            } else if ($demand->isArchived() && !$post->isArchived()) {
                unset($this->posts[$key]);
            } else if ($demand->isNonArchived() && $post->isArchived()) {
                unset($this->posts[$key]);
            } else if ($demand->hasTags()) {
                $includeInResult = false;
                foreach ($post->getTags() as $tag) {
                    if(in_array($tag->getUid(), $demand->getTags())) {
                        $includeInResult = true;
                        break;
                    }
                }

                if(!$includeInResult) {
                    unset($this->posts[$key]);
                }
            }
        }

        return array_slice(
            $this->posts,
            $demand->getOffset(),
            ($demand->getLimit() > 0 ? $demand->getLimit() : null)
        );
    }

    /**
     * @param array $rootPages
     * @param array $tags
     * @param array $excludeList
     * @param int $limit
     * @return array
     */
    public function findByTags(array $rootPages, array $tags, array $excludeList = [], int $limit = 3): array
    {
        $pages = $this->findSubPagesByPageIds($rootPages);

        $query = $this->createQuery();
        $this->posts = $query->matching(
            $query->logicalAnd(
                $query->in('uid', $pages),
                $query->equals('doktype', Constants::BLOG_POST_DOKTYPE)
            )
        )->execute()->toArray();

        $posts = [];
        /** @var Page $post */
        foreach ($this->posts as $post) {
            if(
                $post->getTags()->count() === 0 ||
                in_array($post->getUid(), $excludeList)
            ) {
                continue;
            }
            foreach ($post->getTags() as $tag) {
                if(in_array($tag->getTitle(), $tags)) {
                    $amount = (array_key_exists($post->getUid(), $posts)) ?
                        $posts[$post->getUid()]['amount'] + 1 : 1;

                    $posts[$post->getUid()] = [
                        'amount' => $amount,
                        'post' => $post
                    ];
                }
            }
        }

        usort($posts, function($a, $b) {
            return $b['amount'] <=> $a['amount'];
        });

        $this->posts = $posts;
        return array_slice($this->posts, 0, ($limit > 0 ? $limit : null));
    }

    /**
     * @param array $rootPages
     * @return array
     */
    public function findSubPagesByPageIds(array $rootPages): array
    {
        $pages = [];

        foreach ($rootPages as $rootPage) {
            array_push($pages, ...$this->aggregateAllPageIdentifiers($rootPage));
        }

        $language = ($this->defaultQuerySettings) ?
            $this->defaultQuerySettings->getLanguageAspect()->getId() :
            GeneralUtility::makeInstance(Typo3QuerySettings::class)->getLanguageAspect()->getId();

        if($language > 0) {
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
            $queryBuilder->select('uid')
                ->from('pages')
                ->where(
                    $queryBuilder->expr()->eq('sys_language_uid', $language),
                    $queryBuilder->expr()->in('l10n_parent', $pages)
                );

            $pages = $queryBuilder->executeQuery()->fetchFirstColumn();
        }

        return array_unique($pages);
    }

    /**
     * Recursively fetch all descendants of a given page
     * Adapted from QueryGenerator::getTreeList in TYPO3 version 11
     *
     * @param int $id Uid of the page
     * @param array $pageIdentifiers List of PageUids
     * @return array
     */
    public function aggregateAllPageIdentifiers(int $id, array &$pageIdentifiers = []): array
    {
        if ($id < 0) {
            $id = abs($id);
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $queryBuilder->select('uid')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($id, Connection::PARAM_INT)),
                $queryBuilder->expr()->eq('sys_language_uid', 0)
            );
        $statement = $queryBuilder->execute();
        while ($row = $statement->fetchAssociative()) {
            $pageIdentifiers[] = $row['uid'];
            $this->aggregateAllPageIdentifiers($row['uid'], $pageIdentifiers);
        }

        return $pageIdentifiers;
    }

    /**
     * Adds categories to $this->categories
     *
     * @param array $categories
     * @return void
     */
    protected function traverseCategories(array $categories)
    {
        /** @var Category $category */
        foreach ($categories as $category) {
            if ($category->getSubCategories() > 0) {
                self::traverseCategories($category->getSubCategories()->toArray());
            }
            $this->categories[] = $category;
        }
    }
}