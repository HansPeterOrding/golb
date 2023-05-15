<?php

namespace Greenfieldr\Golb\Domain\Model;

/*
 * This file is part of TYPO3 CMS-based extension "golb".
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 3
 * of the License, or any later version.
 */
use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Maps on table 'sys_category'
 *
 * @package Greenfieldr\Golb\Domain\Model
 */
class Category extends AbstractEntity
{
    /**
     * @var string
     */
    #[Extbase\Validate(['validator' => 'NotEmpty'])]
    protected string $title = '';

    /**
     * @var string
     */
    protected string $description = '';

    /**
     * @var ?Category
     */
    #[Lazy]
    protected ?Category $parent;

    /**
     * List of sub categories
     *
     * @var ?ObjectStorage<Category>
     */
    #[Lazy]
    protected ?ObjectStorage $subCategories;

    /**
     * Gets the title.
     *
     * @return string the title, might be empty
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title.
     *
     * @param string $title the title to set, may be empty
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Gets the description.
     *
     * @return string the description, might be empty
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description.
     *
     * @param string $description the description to set, may be empty
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Gets the parent category.
     *
     * @return ?Category the parent category
     */
    public function getParent(): ?Category
    {
        if ($this->parent instanceof LazyLoadingProxy) {
            $this->parent->_loadRealInstance();
        }
        return $this->parent;
    }

    /**
     * Sets the parent category.
     *
     * @param Category $parent the parent category
     */
    public function setParent(Category $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Adds a category
     *
     * @param Category $category
     * @return void
     */
    public function addSubCategory(Category $category)
    {
        $this->subCategories->attach($category);
    }

    /**
     * Removes a category
     *
     * @param Category $category
     * @return void
     */
    public function removeSubCategory(Category $category)
    {
        $this->subCategories->detach($category);
    }

    /**
     * Returns categories
     *
     * @return ?ObjectStorage
     */
    public function getSubCategories(): ?ObjectStorage
    {
        return $this->subCategories;
    }

    /**
     * Sets categories
     *
     * @param ObjectStorage $categories
     * @return void
     */
    public function setSubCategories(ObjectStorage $categories)
    {
        $this->subCategories = $categories;
    }
}