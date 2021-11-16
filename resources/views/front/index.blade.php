@extends('layouts.frontn')

@section('content')
<!--=====================================-->
<!--=        Banner Area Start         =-->
<!--=====================================-->
<section class="banner banner-style-2">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-content" data-sal="slide-up" data-sal-duration="1000" data-sal-delay="100">
                    <h1 class="title">Votre mécano à domicile à Strasbourg</h1>
                    <a href="#video" class="axil-btn btn-fill-white btn-large">Vidéo monsieur mécano</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="list-unstyled shape-group-18">
        <li class="shape shape-1" data-sal="slide-left" data-sal-duration="1000" data-sal-delay="100"><img src="assets-new/media/20945487.png" alt="Shape"></li>
        <li class="shape shape-2" data-sal="slide-right" data-sal-duration="1000" data-sal-delay="100"><img src="assets-new/media/banner/banner-shape-2.png" alt="Shape"></li>
        <li class="shape shape-3" data-sal="zoom-in" data-sal-duration="500" data-sal-delay="600"><img src="assets-new/media/others/bubble-16.png" alt="Shape"></li>
        <li class="shape shape-4" data-sal="zoom-in" data-sal-duration="500" data-sal-delay="600"><img src="assets-new/media/others/bubble-15.png" alt="Shape"></li>
        <li class="shape shape-5" data-sal="zoom-in" data-sal-duration="500" data-sal-delay="600"><img src="assets-new/media/others/bubble-14.png" alt="Shape"></li>
        <li class="shape shape-6" data-sal="zoom-in" data-sal-duration="500" data-sal-delay="600"><img src="assets-new/media/others/bubble-16.png" alt="Shape"></li>
        <li class="shape shape-7" data-sal="slide-down" data-sal-duration="500" data-sal-delay="600"><img src="assets-new/media/others/bubble-26.png" alt="Shape"></li>
    </ul>
</section>
<!--=====================================-->
<!--=       Service  Area Start        =-->
<!--=====================================-->
<section class="section section-padding">
    <div class="container">
        <div class="section-heading heading-left">
            <span class="subtitle">{{$content->h1}}</span>
            <h2 class="title">{{$content->h2}}</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="100">
                <div class="services-grid service-style-2">
                    <div class="thumbnail">
                        <h3 class="sl-number">1</h3>
                    </div>
                    <div class="content">
                        <h5 class="title"> {{$content->h3}}</h5>
                        <p>{{$content->h4}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="200">
                <div class="services-grid service-style-2">
                    <div class="thumbnail">
                        <h3 class="sl-number">2</h3>
                    </div>
                    <div class="content">
                        <h5 class="title"> {{$content->h5}}</h5>
                        <p>{{$content->h6}}</p><br>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="300">
                <div class="services-grid service-style-2">
                    <div class="thumbnail">
                        <h3 class="sl-number">3</h3>
                    </div>
                    <div class="content">
                        <h5 class="title"> {{$content->h7}}</h5>
                        <p>{{$content->h8}}</p><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=       Work Process Area Start     =-->
<!--=====================================-->
<section class="section section-padding bg-color-light pb--70">
    <div class="container">
        <div class="section-heading mb--90">
            <h2 class="title">{{$content->h9}}</h2>
        </div>
        <div class="process-work" data-sal="slide-right" data-sal-duration="1000" data-sal-delay="100">
            <div class="thumbnail paralax-image">
                <img src="assets-new/media/technician-change-oil-in-the-car-engine-2021-08-26-16-26-20-utc-min.jpg" alt="Thumbnail">
            </div>
            <div class="content">
                <h3 class="title">{{$content->h10}}</h3>
                <p>{{$content->h11}}</p>
            </div>
        </div>
        <div class="process-work content-reverse" data-sal="slide-left" data-sal-duration="1000" data-sal-delay="100">
            <div class="thumbnail paralax-image">
                <img src="assets-new/media/cropped-view-of-mechanic-adjusting-assembled-disc-2021-08-30-19-16-11-utc-min.jpg" alt="Thumbnail">
            </div>
            <div class="content">
                <h3 class="title">{{$content->h12}}</h3>
                <p>{{$content->h13}}</p>
            </div>
        </div>
        <div class="process-work" data-sal="slide-right" data-sal-duration="1000" data-sal-delay="100">
            <div class="thumbnail paralax-image">
                <img src="assets-new/media/car-suspension-shock-absorber-and-coil-spring-rep-2021-08-31-07-45-45-utc-min.jpg" alt="Thumbnail">
            </div>
            <div class="content">
                <h3 class="title">{{$content->h14}}</h3>
                <p>{{$content->h15}}</p>
            </div>
        </div>
        <div class="process-work content-reverse" data-sal="slide-left" data-sal-duration="1000" data-sal-delay="100">
            <div class="thumbnail paralax-image">
                <img src="assets-new/media/industrial-landfill-for-the-processing-of-waste-ti-2021-09-02-00-27-36-utc-min.jpg" alt="Thumbnail">
            </div>
            <div class="content">
                <h3 class="title">{{$content->h16}}</h3>
                <p>{{$content->h17}}</p>
            </div>
        </div>
    </div>
    <ul class="shape-group-17 list-unstyled">
        <li class="shape shape-1"><img src="assets-new/media/others/bubble-24.png" alt="Bubble"></li>
        <li class="shape shape-2"><img src="assets-new/media/others/bubble-23.png" alt="Bubble"></li>
        <li class="shape shape-3"><img src="assets-new/media/others/line-4.png" alt="Line"></li>
        <li class="shape shape-4"><img src="assets-new/media/others/line-5.png" alt="Line"></li>
        <li class="shape shape-5"><img src="assets-new/media/others/line-4.png" alt="Line"></li>
        <li class="shape shape-6"><img src="assets-new/media/others/line-5.png" alt="Line"></li>
    </ul>
</section>
<!--=====================================-->
<!--=     Call To Action Area Start     =-->
<!--=====================================-->
<section class="section project-column-4">
            <div class="container">
                  <div id="all_services"></div>
            </div>
            <ul class="shape-group-7 list-unstyled">
                <li class="shape shape-1"></li>
                <li class="shape shape-2"><img src="assets-new/media/others/bubble-2.png" alt="Line"></li>
                <li class="shape shape-3"><img src="assets-new/media/others/bubble-1.png" alt="Line"></li>
            </ul>
</section>
<section class="section project-column-4">
            <div class="container">
                <div id="all_services"><div class="section-heading heading-left">
                        <h2 class="title">Des produits</h2>
                    </div>
                    <div  class="row">
                        @foreach($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 service-category-1" style="">
                            <div class="project-grid">
                                <div class="thumbnail">
                                    <a href="">
                                        <img src="{{asset('user-uploads/product/1/'.$product->default_image)}}" alt="project">
                                    </a>
                                </div>
                                <div class="content">
                                    <h5 class="title"><a href="{{route('single.product', ['id' => $product->id])}}">{{$product->name}}</a></h5>
                                    <span class="subtitle">Prix: {{$product->price}}€</span>
                                    <div class="dropdown add-items">
                                        <a id="service1" href="javascript:;" class="btn-custom btn-blue add-to-cart" data-type="product" data-unique-id="{{$product->id}}" data-id="{{$product->id}}" data-price="{{$product->price}}" data-name="{{$product->name}}" aria-expanded="false">
                                            Ajouter au panier
                                            <span class="fa fa-plus"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <ul class="shape-group-7 list-unstyled">
                <li class="shape shape-1"></li>
                <li class="shape shape-2"><img src="assets-new/media/others/bubble-2.png" alt="Line"></li>
                <li class="shape shape-3"><img src="assets-new/media/others/bubble-1.png" alt="Line"></li>
            </ul>
</section>
<!--=====================================-->
<!--=       Service  Area Start        =-->
<!--=====================================-->
<section class="section section-padding pb--70">
    <div class="container">
        <div class="section-heading heading-left">
            <span class="subtitle">{{$content->h18}}</span>
            <h2 class="title">{{$content->h19}}</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="100">
                <div class="services-grid service-style-2">
                    <div class="thumbnail">
                        <h3 class="sl-number">1</h3>
                    </div>
                    <div class="content">
                        <h5 class="title">{{$content->h20}}</h5>
                        <p>{{$content->h21}}</p><br><br><br><br>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="200">
                <div class="services-grid service-style-2">
                    <div class="thumbnail">
                        <h3 class="sl-number">2</h3>
                    </div>
                    <div class="content">
                        <h5 class="title"> {{$content->h22}}</h5>
                        <p>{{$content->h23}}</p><br>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="300">
                <div class="services-grid service-style-2">
                    <div class="thumbnail">
                        <h3 class="sl-number">3</h3>
                    </div>
                    <div class="content">
                        <h5 class="title">{{$content->h24}}</h5>
                        <p>{{$content->h25}}</p><br><br>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="300">
                <div class="services-grid service-style-2">
                    <div class="thumbnail">
                        <h3 class="sl-number">4</h3>
                    </div>
                    <div class="content">
                        <h5 class="title">{{$content->h26}}</h5>
                        <p>{{$content->h27}}</p><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-padding pb--70" id="video">
    <div class="container">
        <div class="section-heading heading-left">
            <span class="subtitle"></span>
            <h2 class="title">Vidéo</h2>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12" data-sal="slide-up" data-sal-duration="800" data-sal-delay="100">
                <div class="services-grid service-style-2">
                    <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{$content->h28}}">
                    </iframe>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-padding pb--70" id="offers" >
    <div class="container" style="background-color: blue; color: white !important; border-radius: 50px; padding: 0px 50px">
        <div class="section-heading heading-left">
            <span class="subtitle"></span>
            <h2 class="title" style="color: white">Nos Offres</h2>
        </div>
        <div class="row pb-20">
            <div class="col-md-4">
                <img class="w100 pb-20" src="{{$offers->image}}" alt="">
            </div>
            <div class="col-md-8" style="text-align: center">
                <h3 style="color: white">{{$offers->title}}</h3><br>
                <h3 style="color: white">-{{$offers->discount}}%</h3><br>
                    <div class="countdown-wrap pb-20">
                        <p style="text-align: center;
  font-size: 60px;
  margin-top: 0px;" id="demotime"></p>
                    </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('footer-script')
    <script>
        // Set the date we're counting down to

        var countDownDate = new Date("{{$offers->endtime->format('M d, Y H:m')}}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demotime").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demotime").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
    <script>

        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                // loop:true,
                margin:20,
                dots:true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    480: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1024: {
                        items: 4
                    }
                }
            });
        });

        $(function() {

            var locaion = '';
            var category = '0';

            // change services as per catergory selected
            $('body').on('click', '.categories-list', (function() {
                let id = $(this).data('category-id');
                category = id;

                if(localStorage.getItem('location')) {
                    locaion = localStorage.getItem('location');
                }

                var url = '{{ route('front.index') }}?location='+locaion+'&category='+category;
                $.get(url, function(response){
                    $('#all_services').html(response.view);
                    $('#all_deals').html(response.html);

                    if(response.deal_count === 0)
                    {
                        $('#deals_section').hide()
                    } else{
                        $('#all_deals').html(response.html); $('#deals_section').show();
                    }
                });

                $('html, body').animate({
                    scrollTop: $(".listings").offset().top
                }, 1000);

            }));

            // Apply pagination for services
            $('body').on('click', '#pagination a', function(e)
            {
                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];

                if(localStorage.getItem('location')) {
                    locaion = localStorage.getItem('location');
                }

                var url = '{{ route('front.index') }}?page='+page+'&location='+locaion+'&category='+category;
                $.get(url, function(response){

                    $('#all_services').html(response.view);
                    $('#all_deals').html(response.html);

                    if(response.deal_count === 0)
                    {
                        $('#deals_section').hide()
                    } else{
                        $('#all_deals').html(response.html); $('#deals_section').show();
                    }

                });
            });

            function loadData(page) {

                if(localStorage.getItem('location')) {
                    locaion = localStorage.getItem('location');
                }

                var url = '{{ route('front.index') }}?page='+page+'&location='+locaion+'&category='+category;
                $.get(url, function(response){
                    $('#all_services').html(response.view);
                    $('#all_deals').html(response.html);

                    if(response.deal_count === 0)
                    {
                        $('#deals_section').hide()
                    } else{
                        $('#all_deals').html(response.html); $('#deals_section').show();
                    }

                });
            }

            // Apply pagination for services
            $('body').on('click', '#pagination a', function(e){

                e.preventDefault();
                var page = $(this).attr('href').split('page=')[1];

                loadData(page)
            });

            loadData(1)

        })

    </script>
@endpush
