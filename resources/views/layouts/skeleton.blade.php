<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.common.header')

    </head>
        @yield('body','<body>')

        <div class="container">
            @yield('content')
        </div>

        @include('layouts.common.footer')

        </body>
</html>