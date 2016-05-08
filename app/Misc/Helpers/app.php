<?php
/**
 * Particular app related helpers: dictionaries, db shortcuts, role checks
 */

/**
 * @return array
 */
function getMarketingHeaderNavigation()
{
    return [
//        [
//            'text' => 'Developer Daily',
//            'route-name' => 'blog',
//        ],
//        [
//            'text' => 'Our Methods',
//            'route-name' => 'methods'
//        ],
//        [
//            'text' => 'Work',
//            'route-name' => 'our-code'
//        ],
        [
            'text' => 'Services',
            'route-name' => 'services',
            'children' => [
                'Service 1' => route('service', ['slug' => 'service1']),
                'Service 2' => route('service', ['slug' => 'service2']),
            ]
        ]
    ];
}

/**
 * @return string
 */
function getHomeLink()
{
    if (!Auth::check()) {
        return '/';
    }

    return '/';
}

function isAdmin()
{
    return Auth::check() && Auth::user()->isAdmin();
}