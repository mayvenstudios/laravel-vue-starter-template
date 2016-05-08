<nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ getHomeLink() }}">
                <img src="{{ asset('images/brand.png') }}" alt="brand">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

                @if(isRouteNameSpace('mastermind') && isMastermind())
                    @include('layouts.partials.mastermind-menu')
                @endif

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right m-r-0">

                @include('layouts.common.dropdown')

            </ul>
        </div>
    </div>
</nav>