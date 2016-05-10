<!DOCTYPE html>
<html lang="en">
<head>

    @include('layouts.common.header')

</head>

<body class="with-top-navbar">

<div id="pjax-big-container">


    @if (Auth::check())
        @include('layouts.common.nav-auth')
    @else
        @include('layouts.common.nav-guest')
    @endif

    <div class="container p-t-md" id="pjax-container">

        @yield('content')

    </div><!--container-->
</div><!--pjax-big-container-->

@include('layouts.common.footer')
</body>
</html>