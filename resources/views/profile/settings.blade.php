@extends('layouts.settings')

@section('tab_settings')
    <?php
    $tabs = [];

    $tabs['sections']['settings'] = [
            'name' => 'Settings',
            'tabs' => []
    ];

    $tabs['sections']['settings']['tabs'][] = [
            'name' => 'General',
            'icon' => 'fa-user',
            'id' => 'general',
            'view' => 'profile.tabs.general'
    ];


    $tabs['sections']['settings']['tabs'][] = [
            'name' => 'Security',
            'icon' => 'fa-lock',
            'id' => 'security',
            'view' => 'profile.tabs.security'
    ];

    ?>
@endsection