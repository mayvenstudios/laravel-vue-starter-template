@extends('layouts/skeleton')

@section('content')
    <div class="container-fluid container-fill-height">

        <div class="container-content-middle container">
            <form role="form" action="{{ url('/password/email') }}" method="POST" class="m-x-auto text-center app-login-form">

                <a href="{{ route('marketing.welcome') }}" class="app-brand m-b-lg">
                    <img src="{{ asset('images/brand.png') }}" alt="brand">
                </a>

                @if (count($errors->default) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->default->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group">
                    <input type="email" placeholder="Your Email Address" class="form-control" name="email" value="{{ old('email') }}">
                </div>

                <div class="m-b-lg">
                    <button type="submit" class="btn btn-warning btn-block">Send Password Reset Link</button>

                    <hr />

                    <div class="text-center">
                        <a href="{{ url('/login') }}" class="btn btn-default text-muted btn-sm">I remembered my password</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
