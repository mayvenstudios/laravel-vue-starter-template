<script charset="utf-8" src="//ucarecdn.com/widget/2.5.5/uploadcare/uploadcare.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>


@if(isProduction())
    <script src="{{ elixir('js/vendor.js') }}"></script>
    <script src="{{ elixir('js/app.js') }}"></script>
@else
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endif

<script type="text/javascript">
    (function() {
        window._pa = window._pa || {};
        // _pa.orderId = "myOrderId"; // OPTIONAL: attach unique conversion identifier to conversions
        // _pa.revenue = "19.99"; // OPTIONAL: attach dynamic purchase values to conversions
        // _pa.productId = "myProductId"; // OPTIONAL: Include product ID for use with dynamic ads
        var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;
        pa.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + "//tag.marinsm.com/serve/55750e6d5e02be6a8800003a.js";
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(pa, s);
    })();
</script>


@if (Session::has('flash_message'))
    <script>
        @foreach (Session::get('flash_message') as $message)
            swal({title: '{{ ucfirst($message['status']) }}', text: '{{ $message['message'] }}', type: '{{ $message['status'] }}' });
        @endforeach
    </script>
@endif

<div id="app-spinner"><span></span></div>
