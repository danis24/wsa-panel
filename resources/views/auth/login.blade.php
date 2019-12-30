<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LaraBot') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.7.95/css/materialdesignicons.min.css"
        rel="stylesheet">
    <link href="{{ asset('css/themes/vendor.bundle.base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themes/vendor.bundle.addons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themes/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left">
                            <div class="brand-logo">
                                <img src="/images/logo-mini.svg" alt="logo" style="width: 20%;">
                            </div>
                            <h4>Welcome back!</h4>
                            <h6 class="font-weight-light">Happy Trading :)</h6>
                            <form class="pt-3" action="{{ route('login') }}" method="post" novalidate>
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="email">@lang('E-Mail Address')</label>
                                    <input type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email"
                                        value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        @lang('Password')
                                    </label>
                                    <input type="password"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="password" id="password" placeholder="Password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">@lang('Sign
                                        in')</button>
                                    <div class="text-center mt-4 font-weight-light">
                                        Don't have an account? <a href="/register" class="text-primary">Create</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row"
                        style="background: url(/images/logo.png);background-size: cover;">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">larabot24 © 2019
                            All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/themes/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('js/themes/vendor.bundle.addons.js') }}"></script>
        <script src="{{ asset('js/themes/off-canvas.js') }}"></script>
        <script src="{{ asset('js/themes/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('js/themes/template.js') }}"></script>
        <script src="{{ asset('js/themes/settings.js') }}"></script>
        <script src="{{ asset('js/themes/todolist.js') }}"></script>
        <script src="{{ asset('js/themes/dashboard.js') }}"></script>
</body>

</html>