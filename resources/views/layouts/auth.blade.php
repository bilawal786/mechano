<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="keywords" content="">

        <title>{{ $pageTitle . ' | ' . $settings->company_name }}</title>

        <!-- SEO -->
        <meta name='description' content='{{ $frontThemeSettings->seo_description}}' />
        <meta name='keywords' content='{{$frontThemeSettings->seo_keywords}}' />

        <link rel="icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon" />
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

        <style>
            :root {
                --primary-color: {{ $frontThemeSettings->primary_color }};
                --dark-primary-color: {{ $frontThemeSettings->primary_color }};
            }

            {!! $frontThemeSettings->custom_css !!}
            .logo-login .logo-box {
                background-color: #fff;
            }
        </style>
    </head>
    <body class="login-body-wrapper">
        <div class="login-page">
            <div class="login-box">
                <div class="logo-login text-center">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    </body>
</html>
