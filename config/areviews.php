<?php

return [
    'fields'    =>  [
        'mobile'    =>  [
            'display'   => true,
            'required'   => true,
        ],
        'email'    =>  [
            'display'   => true,
            'required'   => true,
        ],
        'title'    =>  [
            'display'   => true,
            'required'   => true,
        ],
    ],
    'reviews'   =>  [
        'list'  =>  [
            'columns'   =>  'col-lg-4 col-md-6',
            'card'  =>  [
                'icons' =>  true,
            ]
        ],
    ],
    'status' => [
        'default' => true,
        'show_only' => 'active', # possible values: active, inactive, all
    ],
    'form' => [
        'display'   => true,
    ]
];
