<?php
return [
    'teacher' => [
        'type' => 1,
        'ruleName' => 'userGroup',
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'teacher',
        ],
    ],
];
