<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.common.header')
</head>

<body class="with-top-navbar">

<div>

    @include('layouts.common.nav-auth')

    <div class="container p-t-md" id="pjax-container">

        @yield('tab_settings')

        <div class="container settings-page" data-controller="profile/settings">
            <div class="row">
                <!-- Tabs -->
                <div class="col-md-4">

                    @foreach($tabs['sections'] as $section)
                        <div class="panel panel-default panel-flush">
                            <div class="panel-heading">
                                {{ $section['name'] }}
                            </div>

                            <div class="panel-body">
                                <div class="spark-settings-tabs">
                                    <ul class="nav spark-settings-tabs-stacked" role="tablist">

                                        @foreach($section['tabs'] as $count => $tab)
                                            <li role="presentation" class="{{ $count == 0 && reset($tabs['sections']) == $section ? 'active' : null }}">
                                                <a href="#{{ $tab['id'] }}" aria-controls="{{ $tab['id'] }}" role="tab" data-toggle="tab" aria-expanded="true">
                                                    <i class="fa fa-btn fa-fw {{ $tab['icon'] }}"></i>&nbsp;{{ $tab['name'] }}
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Tab Panes -->
                <div class="col-md-8">
                    <div class="tab-content">
                        @foreach($tabs['sections'] as $section)

                            @foreach($section['tabs'] as $count => $tab)

                                @include($tab['view'], ['tab_id' => $tab['id'] ])

                            @endforeach

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div><!--container-->
</div>

@include('layouts.common.footer')
</body>
</html>