<?php

namespace Greenfieldr\Golb\Domain\Model;

/*
 * This file is part of TYPO3 CMS-based extension "golb".
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 3
 * of the License, or any later version.
 */

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Tag
 *
 * @package Greenfieldr\Golb\Domain\Model
 */
class Tag extends AbstractEntity
{

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Greenfieldr\Golb\Domain\Model\Page>
     */
    protected $pages;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->setPages(new ObjectStorage());
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }
    /**
     * @return ObjectStorage
     */
    public function getPages(): ?ObjectStorage
    {
        return $this->pages;
    }

    /**
     * @param ObjectStorage $pages
     */
    public function setPages(ObjectStorage $pages): void
    {
        $this->pages = $pages;
    }

    /**
     * @param Page $page
     */
    public function addPage(Page $page): void
    {
        $this->pages->attach($page);
    }

    /**
     * @param Page $page
     */
    public function removePage(Page $page): void
    {
        $this->removePage($page);
    }
}
