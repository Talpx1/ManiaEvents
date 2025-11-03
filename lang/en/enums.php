<?php

declare(strict_types=1);

return [
    'event_statuses' => [
        'draft' => [
            'label' => 'Draft',
            'description' => 'The event is not yet visible on the platform.',
        ],
        'planned' => [
            'label' => 'Planned',
            'description' => 'The event is visible on the platform and is planned for a future date.',
        ],
        'started' => [
            'label' => 'Started',
            'description' => 'The event is visible on the platform and is currently running.',
        ],
        'ended' => [
            'label' => 'Ended',
            'description' => 'The event is visible on the platform but it\'s closed for subscriptions and leaderboards are locked.',
        ],
        'archived' => [
            'label' => 'Archived',
            'description' => 'The event is marked as non-relevant and not visible on the platform.',
        ],
    ],
];
