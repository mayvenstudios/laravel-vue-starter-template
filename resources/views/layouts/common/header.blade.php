@if(isProduction())
    <link rel="stylesheet" media="all" href="{{ elixir('css/app.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" media="screen">
@endif

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta id="token" name="csrf-token" content="{{ csrf_token() }}"/>

@yield('meta')

@yield('title','<title>Laravel Vue Boilerplate</title>')

{{--@if (!Request::is('blog') && !Request::is('blog/*'))--}}
    {{--<script src="//d2wy8f7a9ursnm.cloudfront.net/bugsnag-2.min.js" data-apikey="15fde40c387140df4200a97e9dbf3f31"></script>--}}
{{--@endif--}}

<script type="text/javascript">
    AObj = {!! getAppUserObject() !!}
</script>

@yield('additional_js')

<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

@if(isProduction())

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-63852413-1', 'auto');
        ga('send', 'pageview');

        @if(Auth::check())
        ga('set', '&uid', '{{ Auth::user()->email }}'); // Set the user ID using signed-in user_id.
        @endif

        @yield('content_grouping')
    </script>

    <script type="text/javascript">
        var _dcq = _dcq || [];
        var _dcs = _dcs || {};
        _dcs.account = '6023788';

        (function() {
            var dc = document.createElement('script');
            dc.type = 'text/javascript'; dc.async = true;
            dc.src = '//tag.getdrip.com/6023788.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(dc, s);
        })();
    </script>
@endif