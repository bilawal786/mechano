<!--=====================================-->
<!--=        Header Area Start       	=-->
<!--=====================================-->
<?php
$content = \App\Content::find(1);

?>
<div class="topnav" id="myDIV">
    <a class="active" href="#home">{{$content->h29}} </a>
    <a onclick="myFunction()" style="float: right" class="active" > X</a>
</div>
<header class="header axil-header header-style-2">
    <div id="axil-sticky-placeholder"></div>
    <div class="axil-mainmenu">
        <div class="container-fluid">
            <div class="header-navbar">
                <div class="header-logo">
                    <a href="/"><img class="light-version-logo" src="{{ $frontThemeSettings->logo_url }}" alt="logo" style="width: 120px;"></a>
                    @if(Route::currentRouteName() == 'front.index')
                    <a href="/"><img class="dark-version-logo" src="assets-new/media/logo-light.png" alt="logo" style="width: 120px;"></a>
                        @endif
                </div>
                <div class="header-main-nav">
                    <!-- Start Mainmanu Nav -->
                    <nav class="mainmenu-nav" id="mobilemenu-popup">
                        <div class="d-block d-lg-none">
                            <div class="mobile-nav-header">
                                <div class="mobile-nav-logo">
                                    <a href="/">
                                        <img class="light-mode" src="assets-new/media/logo.png" alt="Site Logo" style="width: 100px;">
                                        <img class="dark-mode" src="assets-new/media/logo-light.png" alt="Site Logo" style="width: 100px;">
                                    </a>
                                </div>
                                <button class="mobile-menu-close" data-bs-dismiss="offcanvas"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <ul class="mainmenu" >
                            <li><a href="{{route('front.index')}}">Accueil</a></li>
                            @auth
                            <li><a href="{{route('admin.dashboard')}}">Ma voiture !</a></li>
                            @endauth
                            <li><a href="{{route('front.index')}}#services-sec">Nos Services !</a></li>
                            <li><a href="{{route('front.index')}}#offers-sec">Nos Offres !</a></li>
{{--                            <li><a href="{{route('front.index')}}#services-sec">Prendre rdv !</a></li>--}}
                            <li><a href="{{url('contact')}}">Devis</a></li>
                        </ul>
                    </nav>
                    <!-- End Mainmanu Nav -->
                </div>
                <div class="header-action">
                    <ul class="list-unstyled">
                      <li class="sidemenu-btn d-lg-block d-none">
                        @if($user)
                        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-user mr-2"></i> {{ $user->name }}</span>
                        </a>
                        @else
                        <a href="{{ route('login') }}">
                            <i class="fa fa-user mr-2"> </i> Connexion
                        </a>
                        @endif
                      </li>
                      <li class="sidemenu-btn d-lg-block d-none">
                        <a href="{{ route('front.cartPage') }}">
                            <i class="fa fa-shopping-bag"></i>
                            <span class="cart-badge"> {{ $productsCount }}</span>
                        </a>
                      </li>
                        <li class="mobile-menu-btn sidemenu-btn d-lg-none d-block">
                            <button class="btn-wrap btn-dark" data-bs-toggle="offcanvas" data-bs-target="#mobilemenu-popup">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </li>
                        <!--<li class="my_switcher d-block d-lg-none">
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
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

@push('footer-script')
<script>
    var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };

        $(function ()
        {
            $('.select2').select2();

            if (localStorage.getItem('location') == null)
            {
                let locations_html = '';
                $.easyAjax({
                    url: '{{ route('front.get-all-locations') }}',
                    type: 'GET',
                    success: function (response)
                    {
                        if (response.locations.length > 0) {
                            response.locations.forEach(location => {
                                    locations_html += `<a class="search-tags" data-location-id="${location.id}">${location.name}</a>`
                            });
                        }
                        $('.locationPlaces').html(locations_html);
                        $('#myModal').modal('show');
                    }
                });
            }

            $('body').on('click', '.search-tags', function () {
                let locationId = $(this).data('location-id');

                $('#location.select2').val(locationId);
                localStorage.setItem('location', locationId);

                location.reload();
                // $('#modal').modal('toggle');
            });

            if (localStorage.getItem('location')) {
                $('#location').val(localStorage.getItem('location')).trigger('change');
            }

            $('#location.select2').on('change', function()
            {
                localStorage.setItem('location', $(this).val());

                if (localStorage.getItem('location') !== '' && location.protocol+'//'+location.hostname+location.pathname == '{{ route('front.searchServices') }}') {
                    $('#searchForm').submit();
                }

                if (localStorage.getItem('location') !== '' && location.href == '{{ route('front.index').'/' }}')
                {
                    loadReleventData(1);
                }
            });

            let searchParams = new URLSearchParams(window.location.search);
            if (searchParams.has('search_term')) {
                $('#search_term').val(searchParams.get('search_term'));
            }

            setActiveClassToLanguage();
        });

        function loadReleventData(page) {

            if(localStorage.getItem('location')) {
                locaion = localStorage.getItem('location');
            }

            var category = '0';
            var url = '{{ route('front.index') }}?page='+page+'&location='+locaion+'&category='+category;

            $.get(url, function(response){

                $('#all_services').html(response.view);

                if(response.deal_count === 0)
                {
                    $('#deals_section').hide()
                } else{
                    $('#all_deals').html(response.html); $('#deals_section').show();
                }

                $('html, body').animate({
                    scrollTop: $(".categories").offset().top
                }, 1000);

            });
        }

        function logoutUser(e) {
            e.preventDefault();
            $('#logoutForm').submit();
        }

        function setActiveClassToLanguage() {
            // language switcher
            if ('{{ \Cookie::has('appointo_language_code') }}') {
                $('.language-drop .dropdown-item').filter(function () {
                    return $(this).data('lang-code') === '{{ \Cookie::get('appointo_language_code') }}'
                }).addClass('active');
            }
            else {
                $('.language-drop .dropdown-item').filter(function () {
                    return $(this).data('lang-code') === '{{ $settings->locale }}'
                }).addClass('active');
            }
        }

        $('#searchForm').on('submit', function (e) {
            var searchTerm = $('#search_term').val();

            if (searchTerm.length == 0) {
                return false;
            }

            $("<input />").attr("type", "hidden")
                .attr("name", "location")
                .attr("value", localStorage.getItem('location'))
                .appendTo("#searchForm");
        });

        $('.language-drop .dropdown-item').click(function () {
            let code = $(this).data('lang-code');

            let url = '{{ route('front.changeLanguage', ':code') }}';
            url = url.replace(':code', code);

            if (!$(this).hasClass('active')) {
                $.easyAjax({
                    url: url,
                    type: 'POST',
                    container: 'body',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            location.reload();
                            setActiveClassToLanguage();
                        }
                    }
                })
            }
        });

        // add items to cart
        $('body').on('click', '.add-to-cart', '.grab-deal', function ()
        {
            let type = $(this).data('type');
            let unique_id = $(this).data('unique-id');
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            let token = $("meta[name='csrf-token']").attr('content');

            if(type == 'deal')
            {
                var max_order = $(this).data('max-order');
            }

            var data = {id, type, price, name, unique_id, max_order, _token: $("meta[name='csrf-token']").attr('content')};

            $.easyAjax({
                url: '{{ route('front.addOrUpdateProduct') }}',
                type: 'POST',
                data: data,
                blockUI: false,
                disableButton: true,
                defaultTimeout: '1000',
                success: function (response) {
                    if(response.result=='fail' || response.result=='typeerror')
                    {
                        swal({
                            title: "@lang('front.buttons.clearCart')?",
                            text: response.message,
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete)
                            {
                                var url = '{{ route('front.deleteProduct', ':id') }}';
                                url = url.replace(':id', 'all');

                                $.easyAjax({
                                    url: url,
                                    type: 'POST',
                                    data: {_token: $("meta[name='csrf-token']").attr('content')},
                                    redirect: false,
                                    blockUI: false,
                                    disableButton: true,
                                    success: function (response) {
                                        if (response.status == 'success') {
                                            $.easyAjax({
                                                url: '{{ route('front.addOrUpdateProduct') }}',
                                                type: 'POST',
                                                data: data,
                                                blockUI: false,
                                                success: function (response) {
                                                    $('.cart-badge').text(response.productsCount);
                                                }
                                            })
                                        }
                                    }
                                })
                            }
                        });
                    }
                    $('.cart-badge').text(response.productsCount);
                }
            })
        });

</script>
<script>
    function myFunction() {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
@endpush
