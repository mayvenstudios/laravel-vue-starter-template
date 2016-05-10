<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.common.header')
</head>

<body class="with-top-navbar">

<div id="wrapper">
    <header id="header">
        <div class="container">
            <nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ getHomeLink() }}">
                        <img src="{{ asset('images/brand.png') }}" alt="brand">
                    </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        @foreach(getMarketingHeaderNavigation() as $navigationItem)
                            @if(isset($navigationItem['children']))
                                <li class="{{ set_active_from_route_name( $navigationItem['route-name'] ) }} dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $navigationItem['text'] }} <span class="fa fa-angle-down"></span></a>
                                    <div class="dropdown-menu">
                                        <div class="container">
                                            <ul class="nav nav-pills">
                                                @foreach($navigationItem['children'] as $label => $route)
                                                    <li><a data-pjax href="{{ $route }}">{{ $label }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div><!--container-->
                                    </div><!--dropdown-menu-->
                                </li>
                            @else
                                <li class="{{ set_active_from_route_name( $navigationItem['route-name'] ) }}">
                                    <a data-pjax href="{{ route( $navigationItem['route-name'] ) }}">{{ $navigationItem['text'] }}</a>
                                </li>
                            @endif
                        @endforeach
                        <li>
                            <a href="{{ Auth::check() ? getHomeLink() : route('auth.login') }}" class="btn btn-success">
                                {{ Auth::check() ? 'My Account' : 'Log in' }}
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header><!-- /header -->

    <div id="pjax-container">

        {!! setBodyClassIfPjax(['inner']) !!}

        @yield('content')

    </div>

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="holder clearfix">
                        <strong class="logo"><a data-pjax href="/"><span class="sr-only">{{ config('app.company_name') }}</span></a></strong>
                        <span class="copyright">&copy; <strong>{{ date('Y') }}</strong></span>
                    </div>
                    <ul class="nav nav-pills add-nav">
                        {{--<li><a data-pjax href="{{ route('legal') }}">NDA</a></li>--}}
                        {{--<li><a data-pjax href="{{ route('legal') }}">Terms of Service</a></li>--}}
                        {{--<li><a data-pjax href="{{ route('legal') }}">Privacy Policy</a></li>--}}
                    </ul>
                </div>
            </div>
        </div><!-- container-->
    </footer><!-- /footer -->
</div><!-- /wrapper -->

@include('layouts.common.footer')

</body>
</html>