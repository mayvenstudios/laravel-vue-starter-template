@extends('layouts/skeleton')

@section('content')
    <div class="container-fluid container-fill-height">

        <div class="container-content-middle container">

            <form role="form" action="#" method="POST" class="m-x-auto text-center app-login-form">

                <a href="{{ route('marketing.welcome') }}" class="app-brand m-b-lg">
                    <img src="{{ asset('images/brand.png') }}" alt="brand">
                </a>

                @if (isset($errors) && count($errors->default) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->default->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <input type="email" placeholder="Your Email Address" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                <div class="form-group m-b-md">
                    <input type="password" placeholder="Password" class="form-control" name="password">
                </div>
                <input type="hidden" value="1" name="remember">
                <div class="m-b-lg">
                    <button type="submit" class="btn btn-primary btn-block">Log In</button>

                    <hr />

                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('/register') }}" class="btn btn-success btn-sm">Create Account</a>
                        <a href="{{ url('/password/email') }}" class="btn btn-default text-muted btn-sm">Forgot password</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection