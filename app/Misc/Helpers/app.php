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
        [
            'text' => 'Page 1',
            'route-name' => 'marketing.welcome',
        ],
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

    $user = Auth::user();

    if ($user->isAdmin()) {
        route('admin.dashboard');
    }

    return route('customer.dashboard');
}

function isAdmin()
{
    return Auth::check() && Auth::user()->isAdmin();
}