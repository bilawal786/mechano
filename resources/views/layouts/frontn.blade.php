<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name='description' content='{{ $frontThemeSettings->seo_description}}' />
    <meta name='keywords' content='{{$frontThemeSettings->seo_keywords}}' />

    <title>{{ ucfirst($settings->company_name)}}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{$frontThemeSettings->favicon_url}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets-new/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/css/vendor/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/css/vendor/sal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-new/css/vendor/magnific-popup.css') }}">
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets-new/css/app.css') }}">
    @stack('styles')

    <style>
        :root {
            --primary-color: {{ $frontThemeSettings->primary_color }};
            --dark-primary-color: {{ $frontThemeSettings->primary_color }};
        }

        {!! $frontThemeSettings->custom_css !!}

        .header_location_modal {
            padding: 0px !important;
        }
        .locationPlaces .search-tags {
            padding: 11px 18px;
            text-align: center;
            font-size: 13px;
            color: #666;
            border: 1px solid #E0E0E0;
            border-radius: 30px;
            font-weight: 600;
            line-height: 1;
            display: inline-block;
            margin-right: 12px;
            margin-bottom: 18px;
            -webkit-transition: .3s;
            transition: .3s;
            cursor: pointer;
        }

        .locationPlaces .search-tags:hover {
            background-color: #00C1CF;
            border: 1px solid #00C1CF;
            color: #fff !important;
            -webkit-transition: .3s;
            transition: .3s;
        }
    </style>
</head>


<body class="sticky-header">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->
    <a href="#main-wrapper" id="backto-top" class="back-to-top">
        <i class="far fa-angle-double-up"></i>
    </a>

    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->

    <div class="my_switcher d-none d-lg-block">
        <ul>
            <li title="Light Mode">
                <a href="javascript:void(0)" class="setColor light" data-theme="light">
                    <i class="fal fa-lightbulb-on"></i>
                </a>
            </li>
            <li title="Dark Mode">
                <a href="javascript:void(0)" class="setColor dark" data-theme="dark">
                    <i class="fas fa-moon"></i>
                </a>
            </li>
        </ul>
    </div>

    <div id="main-wrapper" class="main-wrapper">

    @include('sections.header')

    @yield('content')

    @include('sections.footer')
    </div>

    <!-- Jquery Js -->
    <script src="{{ asset('assets-new/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/counterup.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/sal.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/js.cookie.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/jquery.style.switcher.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/tilt.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/green-audio-player.min.js') }}"></script>
    <script src="{{ asset('assets-new/js/vendor/jquery.nav.js') }}"></script>

    <!-- Site Scripts -->
    <script src="{{ asset('assets-new/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/front-scripts.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('front/js/sweetalert.min.js') }}"></script>
    <script>
        $(function() {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": true
            };
        });

        function makeSingular(time, type) {
            singular = '';
            plural = '';

            if (time == 1) {
                switch (type) {
                    case 'minutes':
                        singular = "@lang('app.minute')";
                        break;
                    case 'hours':
                        singular = "@lang('app.hour')";
                        break;
                    case 'days':
                        singular = "@lang('app.day')";
                        break;
                    default:
                        break;
                }
                return singular;
            }
            else {
                switch (type) {
                    case 'minutes':
                        plural = "@lang('app.minutes')";
                        break;
                    case 'hours':
                        plural = "@lang('app.hours')";
                        break;
                    case 'days':
                        plural = "@lang('app.days')";
                        break;
                    default:
                        break;
                }
                return plural;
            }
        }

        function goToPage(method, pageUrl, data = null) {
            var options = {
                url: pageUrl,
                type: method,
                // container: 'section.section'
                success: function (response) {
                    if (response.status !== 'fail') {
                        window.location.href = pageUrl
                    }
                }
            };

            if (data) {
                options.data = data
            }

            $.easyAjax(options)
        }

        var LightenColor = function(color, percent) {
            var num = parseInt(color.replace('#',''),16),
                amt = Math.round(2.55 * percent),
                R = (num >> 16) + amt,
                B = (num >> 8 & 0x00FF) + amt,
                G = (num & 0x0000FF) + amt;

            return (0x1000000 + (R<255?R<1?0:R:255)*0x10000 + (B<255?B<1?0:B:255)*0x100 + (G<255?G<1?0:G:255)).toString(16).slice(1);
        };

        var DarkenColor = function(color, percent) {
            var num = parseInt(color.replace('#',''),16),
                amt = Math.round(2.55 * percent),
                R = (num >> 16) - amt,
                B = (num >> 8 & 0x00FF) - amt,
                G = (num & 0x0000FF) - amt;

            return (0x1000000 + (R<255?R<1?0:R:255)*0x10000 + (B<255?B<1?0:B:255)*0x100 + (G<255?G<1?0:G:255)).toString(16).slice(1);
        };

        var primaryColor = getComputedStyle(document.documentElement)
            .getPropertyValue('--primary-color');

        document.documentElement.style.setProperty('--dark-primary-color', '#'+DarkenColor(primaryColor, 15));

    </script>
    @stack('footer-script')

</body>
</html>
