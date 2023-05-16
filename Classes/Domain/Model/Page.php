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
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Annotation as Extbase;

/**
 * Maps on table 'pages'
 *
 * @package Greenfieldr\Golb\Domain\Model
 */
class Page extends AbstractEntity
{

    /**
     * Contains page abstract
     *
     * @var string $abstract
     */
    protected string $abstract;

    /**
     * Contains URL alias
     *
     * @var string $alias
     */
    protected string $alias;

    /**
     * Contains author email
     * Use golb:author.email view helper to switch between this field and
     * corresponding backend user based in plugin configuration
     *
     * @var string $authorEmail
     */
    protected string $authorEmail;

    /**
     * Contains author image
     *
     * @var FileReference
     */
    #[Lazy]
    protected FileReference $authorImage;

    /**
     * Contains author name
     * Use golb:author.name view helper to switch between this field and
     * corresponding backend user based in plugin configuration
     *
     * @var string $author
     */
    protected string $author;

    /**
     * Contains selected backend layout
     *
     * @var string $backendLayout
     */
    protected string $backendLayout;

    /**
     * Contains backend layout for sub level
     *
     * @var string $backendLayoutNextLevel
     */
    protected string $backendLayoutNextLevel;

    /**
     * Tags the cached page belongs to
     *
     * @var string $cacheTags
     */
    protected string $cacheTags;

    /**
     * Timestamp for cache timeout
     *
     * @var int $cacheTimeout
     */
    protected int $cacheTimeout;

    /**
     * Contains relations to selected categories for this page
     *
     * @var ?ObjectStorage<Category>
     */
    #[Lazy]
    protected ?ObjectStorage $categories;

    /**
     * Contains page id to show content from instead of the current page content itself
     *
     * @var int $contentFromPid
     */
    protected int $contentFromPid;

    /**
     * @var int
     */
    protected int $creationDate;

    /**
     * Create user identifier
     *
     * @var int $cruserId
     */
    protected int $cruserId;

    /**
     * Deleted flag
     *
     * @var bool $deleted
     */
    protected bool $deleted;

    /**
     * Meta description for this page
     *
     * @var string $description
     */
    protected string $description;

    /**
     * Page type
     *
     * @var int $doktype
     */
    protected int $doktype;

    /**
     * End time timestamp
     * Maps on field "endtime"
     *
     * @var int $endTime
     */
    protected int $endtime;

    /**
     * Flag to extend publish dates and access rights to subpages
     * Maps on field "extendToSubpages"
     *
     * @var bool $extendToSubPages ;
     */
    protected bool $extendToSubPages;

    /**
     * Frontend user groups
     *
     * @var string $feGroup
     */
    protected string $feGroup;

    /**
     * Hidden flag
     *
     * @var bool $hidden
     */
    protected bool $hidden;

    /**
     * Flag to hide page in navigation
     * Maps on field "nav_hide"
     *
     * @var bool $hiddenInNavigation
     */
    protected bool $navHide;

    /**
     * Keywords for this page
     *
     * @var string $keywords
     */
    protected string $keywords;

    /**
     * Last updated timestamp
     * Maps on field "lastUpdated" (Note: CamelCase instead of underscores)
     *
     * @var int $lastUpdated
     */
    protected int $lastUpdated;

    /**
     * Selected page layout
     *
     * @var int $layout
     */
    protected int $layout;

    /**
     * @var ObjectStorage<FileReference>
     */
    #[Lazy]
    protected ObjectStorage $media;

    /**
     * Contains page identifier from mount point if document type is set to mount point
     *
     * @var int $mountPid
     */
    protected int $mountPid;

    /**
     * Contains mount point overlay if needed
     *
     * @var int $mountPidOverlay
     */
    protected int $mountPidOl;

    /**
     * Contains navigation title
     *
     * @var string $navigationTitle
     */
    protected string $navTitle;

    /**
     * Timestamp how long the page is flagged as new
     * Maps on field "newUntil" (Note: CamelCase instead of underscores)
     *
     * @var int $newUntil
     */
    protected int $newUntil;

    /**
     * Flag indicates if the page should be cached
     *
     * @var bool $noCache
     */
    protected bool $noCache;

    /**
     * Flag to hide page from search results
     *
     * @var bool $noSearch
     */
    protected bool $noSearch;

    /**
     * Contains related pages
     *
     * @var ObjectStorage<Page>
     */
    #[Lazy]
    protected ObjectStorage $relatedPages;

    /**
     * Shortcut target for document type shortcut depending on shortcut mode
     *
     * @var int $shortcut
     */
    protected int $shortcut;

    /**
     * Shortcut mode if document type shortcut is selected
     *
     * @var int $shortcutMode
     */
    protected int $shortcutMode;

    /**
     * Is site root flag
     *
     * @var bool $siteRoot
     */
    protected bool $isSiteroot;

    /**
     * Sorting field
     *
     * @var int $sorting
     */
    protected int $sorting;

    /**
     * Start time timestamp
     *
     * @var int $startTime
     */
    protected int $starttime;

    /**
     * List of subpages
     *
     * @var ObjectStorage<Page>
     */
    #[Lazy]
    protected ObjectStorage $subpages;

    /**
     * Page subtitle
     *
     * @var string $subtitle
     */
    protected string $subtitle;

    /**
     * Contains anchor link target for links to this page
     *
     * @var string $target
     */
    protected string $target;

    /**
     * Contains timestamp
     *
     * @var int $tstamp
     */
    protected int $tstamp;

    /**
     * Page title
     *
     * @var string $title
     */
    protected string $title;

    /**
     * URL e.g. for document type external
     *
     * @var string $url
     */
    protected string $url;

    /**
     * Selected URL scheme
     *
     * @var int $urlScheme
     */
    protected int $urlScheme;

    /**
     * URL type
     *
     * @var int $urlType
     */
    protected int $urltype;

    /**
     * Contains number of views
     *
     * @var int $viewCount
     */
    protected int $viewCount;

    /**
     * @var int $publishDate
     */
    protected int $publishDate;

    /**
     * List of content elements
     *
     * @var ObjectStorage<ContentElement>
     */
    #[Lazy]
    protected ObjectStorage $contentElements;

    /**
     * Contains tags for this page
     *
     * @var ObjectStorage<Tag>
     */
    #[Lazy]
    protected ObjectStorage $tags;

    /**
     * @var bool
     */
    protected bool $archived;

    /**
     * The constructor
     */
    public function __construct()
    {
        $this->categories = new ObjectStorage();
        $this->relatedPages = new ObjectStorage();
        $this->subpages = new ObjectStorage();
        $this->contentElements = new ObjectStorage();
        $this->media = new ObjectStorage();
        $this->tags = new ObjectStorage();
    }

    /**
     * Returns author name
     *
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->author;
    }

    /**
     * Sets author name
     *
     * @param string $authorName
     * @return void
     */
    public function setAuthorName(string $authorName)
    {
        $this->author = $authorName;
    }

    /**
     * Adds a category
     *
     * @param Category $category
     * @return void
     */
    public function addCategory(Category $category)
    {
        $this->categories->attach($category);
    }

    /**
     * Removes a category
     *
     * @param Category $category
     * @return void
     */
    public function removeCategory(Category $category)
    {
        $this->categories->detach($category);
    }

    /**
     * @return ObjectStorage
     */
    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    /**
     * @param ObjectStorage $categories
     */
    public function setCategories(ObjectStorage $categories)
    {
        $this->categories = $categories;
    }


    /**
     * Returns create date timestamp
     *
     * @return int
     */
    public function getCreationDate(): int
    {
        return $this->creationDate;
    }

    /**
     * Sets create date
     *
     * @param int $creationDate
     * @return void
     */
    public function setCreationDate(int $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * Returns create user identifier
     *
     * @return int
     */
    public function getCreateUserId(): int
    {
        return $this->cruserId;
    }

    /**
     * Sets create user identifier
     *
     * @param int $createUserId
     * @return void
     */
    public function setCreateUserId(int $createUserId)
    {
        $this->cruserId = $createUserId;
    }

    /**
     * Returns deleted flag
     *
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Returns document type
     *
     * @return int
     */
    public function getDocumentType(): int
    {
        return $this->doktype;
    }

    /**
     * Sets document type
     *
     * @param int $documentType
     * @return void
     */
    public function setDocumentType(int $documentType)
    {
        $this->doktype = $documentType;
    }

    /**
     * Returns end time
     *
     * @return int
     */
    public function getEndTime(): int
    {
        return $this->endtime;
    }

    /**
     * Sets end time
     *
     * @param int $endTime
     * @return void
     */
    public function setEndTime(int $endTime)
    {
        $this->endtime = $endTime;
    }

    /**
     * Returns true if page is hidden
     *
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Returns true if page should be hidden in navigation
     *
     * @return bool
     */
    public function isHiddenInNavigation(): bool
    {
        return $this->navHide;
    }

    /**
     * Sets flag to hide page in navigation
     *
     * @param bool $hiddenInNavigation
     * @return void
     */
    public function setHiddenInNavigation(bool $hiddenInNavigation)
    {
        $this->navHide = $hiddenInNavigation;
    }

    /**
     * Returns overlay for mount point page identifier
     *
     * @return int
     */
    public function getMountPidOverlay(): int
    {
        return $this->mountPidOl;
    }

    /**
     * Sets page identifier for mount point overlay
     *
     * @param int $mountPidOverlay
     * @return void
     */
    public function setMountPidOverlay(int $mountPidOverlay)
    {
        $this->mountPidOl = $mountPidOverlay;
    }

    /**
     * Returns navigation title
     * Returns page title if navigation title is empty
     *
     * @return string
     */
    public function getNavigationTitle(): string
    {
        return $this->navTitle;
    }

    /**
     * Sets navigation title
     *
     * @param string $navigationTitle
     * @return void
     */
    public function setNavigationTitle(string $navigationTitle)
    {
        $this->navTitle = $navigationTitle;
    }

    /**
     * Adds a related page
     *
     * @param Page $relatedPage
     * @return void
     */
    public function addRelatedPage(Page $relatedPage)
    {
        $this->relatedPages->attach($relatedPage);
    }

    /**
     * Removes a related page
     *
     * @param Page $relatedPage
     * @return void
     */
    public function removeRelatedPage(Page $relatedPage)
    {
        $this->relatedPages->detach($relatedPage);
    }

    /**
     * Returns true if page is the site root
     *
     * @return bool
     */
    public function isSiteRoot(): bool
    {
        return (bool)$this->isSiteroot;
    }

    /**
     * Sets flag for site root
     *
     * @param bool $siteRoot
     * @return void
     */
    public function setSiteRoot(bool $siteRoot)
    {
        $this->isSiteroot = $siteRoot;
    }

    /**
     * Returns start time timestamp for publishing
     *
     * @return int
     */
    public function getStartTime(): int
    {
        return $this->starttime;
    }

    /**
     * Sets timestamp for start time
     *
     * @param int $startTime
     * @return void
     */
    public function setStartTime(int $startTime)
    {
        $this->starttime = $startTime;
    }

    /**
     * Adds a subpage
     *
     * @param Page $subpage
     * @return void
     */
    public function addSubpage(Page $subpage)
    {
        $this->subpages->attach($subpage);
    }

    /**
     * Removes a subpage
     *
     * @param Page $subpage
     * @return void
     */
    public function removeSubpage(Page $subpage)
    {
        $this->subpages->detach($subpage);
    }

    /**
     * @return ObjectStorage
     */
    public function getSubpages(): ObjectStorage
    {
        return $this->subpages;
    }

    /**
     * @param ObjectStorage $subpages
     */
    public function setSubpages(ObjectStorage $subpages)
    {
        $this->subpages = $subpages;
    }

    /**
     * Returns timestamp of last system update of the page
     *
     * @return int
     */
    public function getModificationDate(): int
    {
        return $this->tstamp;
    }

    /**
     * Sets timestamp of last system update
     *
     * @param int $timestamp
     * @return void
     */
    public function setModificationDate(int $timestamp)
    {
        $this->tstamp = $timestamp;
    }

    /**
     * Returns URL type
     *
     * @return int
     */
    public function getUrlType(): int
    {
        return $this->urltype;
    }

    /**
     * Sets URL type
     *
     * @param int $urlType
     * @return void
     */
    public function setUrlType(int $urlType)
    {
        $this->urltype = $urlType;
    }

    /**
     * Increases view count by given amount
     *
     * @param int $amount
     * @return void
     */
    public function increaseViewCount(int $amount = 1)
    {
        $this->viewCount = $this->viewCount + $amount;
    }

    /**
     * Adds a content element
     *
     * @param ContentElement $contentElement
     * @return void
     */
    public function addContentElement(ContentElement $contentElement)
    {
        $this->contentElements->attach($contentElement);
    }

    /**
     * Removes a content element
     *
     * @param ContentElement $contentElement
     * @return void
     */
    public function removeContentElement(ContentElement $contentElement)
    {
        $this->contentElements->detach($contentElement);
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
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAbstract(): string
    {
        return $this->abstract;
    }

    /**
     * @param string $abstract
     */
    public function setAbstract(string $abstract): void
    {
        $this->abstract = $abstract;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getAuthorEmail(): string
    {
        return $this->authorEmail;
    }

    /**
     * @param string $authorEmail
     */
    public function setAuthorEmail(string $authorEmail): void
    {
        $this->authorEmail = $authorEmail;
    }

    /**
     * @return FileReference
     */
    public function getAuthorImage(): FileReference
    {
        return $this->authorImage;
    }

    /**
     * @param FileReference $authorImage
     */
    public function setAuthorImage(FileReference $authorImage): void
    {
        $this->authorImage = $authorImage;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
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
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getKeywords(): string
    {
        return $this->keywords;
    }

    /**
     * @param string $keywords
     */
    public function setKeywords(string $keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * @return int
     */
    public function getLastUpdated(): int
    {
        return $this->lastUpdated;
    }

    /**
     * @param int $lastUpdated
     */
    public function setLastUpdated(int $lastUpdated): void
    {
        $this->lastUpdated = $lastUpdated;
    }

    /**
     * @return int
     */
    public function getLayout(): int
    {
        return $this->layout;
    }

    /**
     * @param int $layout
     */
    public function setLayout(int $layout): void
    {
        $this->layout = $layout;
    }

    /**
     * @return ObjectStorage
     */
    public function getMedia(): ObjectStorage
    {
        return $this->media;
    }

    /**
     * @param ObjectStorage $media
     */
    public function setMedia(ObjectStorage $media): void
    {
        $this->media = $media;
    }

    /**
     * @return string
     */
    public function getNavTitle(): string
    {
        return $this->navTitle;
    }

    /**
     * @param string $navTitle
     */
    public function setNavTitle(string $navTitle): void
    {
        $this->navTitle = $navTitle;
    }

    /**
     * @return int
     */
    public function getNewUntil(): int
    {
        return $this->newUntil;
    }

    /**
     * @param int $newUntil
     */
    public function setNewUntil(int $newUntil)
    {
        $this->newUntil = $newUntil;
    }

    /**
     * @return ObjectStorage
     */
    public function getRelatedPages(): ObjectStorage
    {
        return $this->relatedPages;
    }

    /**
     * @param ObjectStorage $relatedPages
     */
    public function setRelatedPages(ObjectStorage $relatedPages): void
    {
        $this->relatedPages = $relatedPages;
    }

    /**
     * @return int
     */
    public function getSorting(): int
    {
        return $this->sorting;
    }

    /**
     * @param int $sorting
     */
    public function setSorting(int $sorting)
    {
        $this->sorting = $sorting;
    }

    /**
     * @return string
     */
    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle(string $subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget(string $target)
    {
        $this->target = $target;
    }

    /**
     * @return int
     */
    public function getTstamp(): int
    {
        return $this->tstamp;
    }

    /**
     * @param int $tstamp
     */
    public function setTstamp(int $tstamp)
    {
        $this->tstamp = $tstamp;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid)
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getDoktype(): int
    {
        return $this->doktype;
    }

    /**
     * @param int $doktype
     */
    public function setDoktype(int $doktype)
    {
        $this->doktype = $doktype;
    }

    /**
     * @return int
     */
    public function getUrlScheme(): int
    {
        return $this->urlScheme;
    }

    /**
     * @param int $urlScheme
     */
    public function setUrlScheme(int $urlScheme)
    {
        $this->urlScheme = $urlScheme;
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return $this->viewCount;
    }

    /**
     * @param int $viewCount
     */
    public function setViewCount(int $viewCount)
    {
        $this->viewCount = $viewCount;
    }

    /**
     * @return ObjectStorage
     */
    public function getContentElements(): ObjectStorage
    {
        return $this->contentElements;
    }

    /**
     * @param ObjectStorage $contentElements
     */
    public function setContentElements(ObjectStorage $contentElements)
    {
        $this->contentElements = $contentElements;
    }

    /**
     * @return int
     */
    public function getPublishDate(): int
    {
        return $this->publishDate;
    }

    /**
     * @param int $publishDate
     */
    public function setPublishDate(int $publishDate)
    {
        $this->publishDate = $publishDate;
    }

    /**
     * Adds a tag
     *
     * @param Tag $tag
     * @return void
     */
    public function addTag(Tag $tag)
    {
        $this->tags->attach($tag);
    }

    /**
     * Removes a tag
     *
     * @param Tag $tag
     * @return void
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->detach($tag);
    }

    /**
     * @return ObjectStorage
     */
    public function getTags(): ObjectStorage
    {
        return $this->tags;
    }

    /**
     * @param ObjectStorage $tags
     */
    public function setTags(ObjectStorage $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived === true;
    }

    /**
     * @param bool $archived
     */
    public function setArchived(bool $archived): void
    {
        $this->archived = $archived;
    }

}