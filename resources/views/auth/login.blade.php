<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LaraBot') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main class="py-4">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-6">
                            <img
                                src="https://tabler.github.io/tabler/demo/brand/tabler.svg"
                                class="h-6"
                                alt="Logo Tabler">
                        </div>
                        <form class="card" action="{{ route('login') }}" method="post" novalidate>
                            @csrf
                            <div class="card-body p-6">
                                <div class="card-title">@lang('Login to your account')</div>

                                <div class="form-group">
                                    <label class="form-label" for="email">@lang('E-Mail Address')</label>
                                    <input
                                        type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email"
                                        id="email"
                                        aria-describedby="emailHelp"
                                        placeholder="Enter email"
                                        value="{{ old('email') }}"
                                        required
                                        autofocus>
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
                                    <input
                                        type="password"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="password"
                                        id="password"
                                        placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">@lang('Sign in')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>