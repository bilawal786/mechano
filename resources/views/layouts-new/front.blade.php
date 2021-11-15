<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ ucfirst($settings->company_name)}}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- SEO -->
    <meta name='description' content='{{ $frontThemeSettings->seo_description}}' />
    <meta name='keywords' content='{{$frontThemeSettings->seo_keywords}}' />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{$frontThemeSettings->favicon_url}}" type="image/x-icon" />
    <!-- Blade CSS -->
    @stack('styles')
    <!-- Template CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('front/css/main.css') }}">
    <!-- Bootstrap Icons CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('front/vendor/Bootstrap/css/bootstrap-icons.css') }}">
    <!-- Icons8 CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('front/vendor/css/line-awesome.min.css') }}">
    <!-- Select2 CSS -->
    <link type="text/css" rel="stylesheet" media="all" href="{{ asset('front/vendor/css/select2.min.css') }}">
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ asset('front/vendor/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendor/css/owl.theme.default.min.css') }}">

    <link type="text/css" rel="stylesheet" href="{{ asset('front-assets/css/helper.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: {{ $frontThemeSettings->primary_color }};
            --dark-primary-color: {{ $frontThemeSettings->primary_color }};
        }

        {!! $frontThemeSettings->custom_css !!}

        /* Add css here... */
    </style>

</head>


<body>

    @include('sections-new.header')

    @yield('content')

    @include('sections-new.footer')

    <!-- BANNER LOCATION MODAL START -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-5 p-md-5 p-3">
                    <h3 class="mb-3">@lang('front.pickCity')</h3>
                    <p class="f-14 text-muted">@lang('front.pickCityNote')</p>
                    <div class="location-places mt-3 mt-lg-5 mt-md-5">
                        @foreach ($locations as $location)
                        <a href="javascript:;" class="search-tags" data-id="{{ $location->id }}" data-bs-dismiss="modal">{{ $location->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BANNER LOCATION MODAL END -->


    <!-- JavaScript Bundle with Popper -->
    <script src="{{ asset('front/vendor/Bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Jquery -->
    <script src="{{ asset('front/vendor/js/jquery.min.js') }}"></script>
    <!-- Select2 JS -->
    <script src="{{ asset('front/vendor/js/select2.min.js') }}"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('front/vendor/js/owl.carousel.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('front/js/main.js') }}"></script>
    <!-- Helper JS -->
    <script src="{{ asset('front-assets/js/helper.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('front/js/sweetalert.min.js') }}"></script>

    <script>
        $(window).on('load', function () {
            // Show Location modal
            if (localStorage.getItem('location') == null) {
                $('#staticBackdrop').modal('show');
            }else{
                // set current location near searh box
                let locationId = localStorage.getItem('location');
                var url = '{{ route('front.location-name') }}?locId='+locationId;
                $.get(url, function(response){
                    $('.current-location').html(response.location_name);
                    $('.current-location').html(response.location_name);
                });
            }

        });

        loadData(1);

        function loadData(page) {
            let loc = localStorage.getItem('location');
            $.easyAjax({
                url: '{{ route('front.index') }}',
                type: 'GET',
                data: {location: loc},
                container: '.section',
                blockUI: false,
                success:function(response){
                    
                    $('#all_categories').html(response.view);

                    if(response.deal_count === 0)
                    {
                        $('#deals_section').hide()
                    } else{
                        $('#all_deals').html(response.html); $('#deals_section').show();
                    }
                }
            })
        }

        // Location selection from modal
        $('body').on('click', '.search-tags', function () {
            let locationId = $(this).data('id');

            // set current location near searh box
            var url = '{{ route('front.location-name') }}?locId='+locationId;
            $.get(url, function(response){
                $('.current-location').html(response.location_name);
                localStorage.setItem('location', locationId);
                
                let currentUrl = $(location).attr("href");
                let cartUrl = "{{route('front.index')}}/";

                if (currentUrl !== cartUrl) {
                    window.location.reload();
                }else{
                    loadData();
                }
            });
        });

        // get started
        $("#getStarted").on("click", function() {
            $("html").animate({ scrollTop: 0},1000);
        });

        $(function() {
            toastr.options = {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": true
            };
        });

    </script>

    @stack('footer-script')

</body>
</html>
