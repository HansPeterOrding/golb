<?php
declare(strict_types = 1);

return [
    \Greenfieldr\Golb\Domain\Model\Page::class => [
        'tableName' => 'pages',
        'properties' => [
            'creationDate' => [
                'fieldName' => 'crdate'
            ],
            'authorImage' => [
                'fieldName' => 'tx_golb_author_image'
            ],
            'relatedPages' => [
                'fieldName' => 'tx_golb_related'
            ],
            'contentElements' => [
                'fieldName' => 'tx_golb_content_elements'
            ],
            'subpages' => [
                'fieldName' => 'tx_golb_subpages'
            ],
            'publishDate' => [
                'fieldName' => 'tx_golb_publish_date'
            ],
            'tags' => [
                'fieldName' => 'tx_golb_tags'
            ],
            'archived' => [
                'fieldName' => 'tx_golb_archived'
            ],
            'topPost' => [
                'fieldName' => 'tx_golb_top_post'
            ],
            'postType' => [
                'fieldName' => 'tx_feeuroletter_post_type'
            ],
            'currentFocusTopic' => [
                'fieldName' => 'tx_feeuroletter_current_focus_topic'
            ]
        ],
    ],
    \Greenfieldr\Golb\Domain\Model\ContentElement::class => [
        'tableName' => 'tt_content',
    ],
    \Greenfieldr\Golb\Domain\Model\Category::class => [
        'tableName' => 'sys_category',
    ]
];
