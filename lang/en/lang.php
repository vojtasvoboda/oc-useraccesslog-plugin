<?php

return [
    'plugin' => [
        'name' => 'User access log',
        'description' => 'Access log of front-end users'
    ],
    'reportwidgets' => [
        'statistics' => [
            'label' => 'Access log statistics',
            'title' => 'Widget title',
            'title_default' => 'Access statistics',
            'title_validation' => 'Title is required',
        ],
        'chartline' => [
            'label' => 'Access log statistics in time',
            'title' => 'Widget title',
            'title_default' => 'Access statistics in time each user',
            'title_validation' => 'Title is required',
            'days_title' => 'Number of days to display data for',
        ],
        'chartlineaggregated' => [
            'label' => 'Access log statistics in time aggregated',
            'title' => 'Widget title',
            'title_default' => 'Access statistics in time',
            'title_validation' => 'Title is required',
            'days_title' => 'Number of days to display data for',
        ],
        'registrations' => [
            'label' => 'User registrations',
            'title' => 'Widget title',
            'title_default' => 'New registrations',
            'title_validation' => 'Title is required',
            'days_title' => 'Number of days to display data for',
        ],
    ],
];