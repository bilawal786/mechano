<div class="section-heading heading-left">
    <span class="subtitle">Faite votre choix</span>
    <h2 class="title">Nos Services</h2>
</div>
<div id="services" class="row">
    @forelse ($services as $service)
    <div class="col-xl-3 col-lg-4 col-md-6 service-category-{{ $service->category_id }}" style="">
        <div class="project-grid">
            <div class="thumbnail">
                <a href="{{ $service->service_detail_url }}">
                    <img src="{{ $service->service_image_url }}" alt="project">
                </a>
            </div>
            <div class="content">
                <h5 class="title"><a href="{{ $service->service_detail_url }}">{{ ucwords($service->name) }}</a></h5>
                <span class="subtitle">{{ ucwords($service->category->name) }} {{ currencyFormatter($service->discounted_price) }}</span>
                <div class="dropdown add-items">
                    <a id="service{{ $service->id }}"
                        href="javascript:;"
                        class="btn-custom btn-blue add-to-cart"
                        data-type="service"
                        data-unique-id="{{ $service->id }}"
                        data-id="{{ $service->id }}"
                        data-price="{{$service->discounted_price}}"
                        data-name="{{ ucwords($service->name) }}"
                        aria-expanded="false">
                        Ajouter au panier
                        <span class="fa fa-plus"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
        <div id="services" class="col-md-12 d-block">
            <div class="col-12 text-center mb-5">
                <h3 class="no-services">
                    <i class="fa fa-exclamation-triangle"></i> @lang('app.noServicesFound').
                </h3>
            </div>
        </div>
    @endforelse

</div>

{{--@if ($services->count() > 0)--}}
{{--  <div class="more-project-btn">--}}
{{--      <a href="javascript:;" onclick="goToPage('GET', '{{ route('front.bookingPage') }}')" class="axil-btn btn-fill-primary">Prendre votre rendez-vous--}}
{{--      <i class="fa fa-angle-right ml-1"></i></a>--}}
{{--    </div>--}}
{{--@endif--}}
