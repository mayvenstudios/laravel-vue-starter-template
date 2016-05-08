<nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
    <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ route('marketing.welcome') }}">
                <img src="{{ asset('images/brand.png') }}" alt="brand">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-main">

            <ul class="nav navbar-nav hidden-xs">
                <li class="{{ set_active_from_route_name('user.register') }}"><a href="{{ route('user.register') }}">Create Account</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right m-r-0">
                <li><a href="/login">Login</a></li>
            </ul>

        </div>
    </div>
</nav>
