<?php
defined('TYPO3') or die();

$boot = function ($packageKey) {
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\DataHandling\PageDoktypeRegistry::class)->add(\Greenfieldr\Golb\Constants::BLOG_POST_DOKTYPE, [
        'type' => 'web',
        'allowedTables' => '*',
    ]);
};

$boot('golb');
unset($boot);