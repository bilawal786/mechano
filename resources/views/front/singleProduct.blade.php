@extends('layouts.front')

@section('content')
    <section class="section">
        <section class="service-detail sp-80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ $product->name }}</h4>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <img src="{{asset('user-uploads/product/1/'.$product->default_image)}}" style="width: 100%" alt="project">
                        <div class="content">
                            {!! $product->description !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 mb-60">
                        <div class="detail-info mb-5">
                            <ul>
                                <li>
                                    <span>
                                       Nom du Produit
                                    </span>
                                    <span>
                                        {{ $product->name }}
                                    </span>
                                </li>
                                <li>
                                    <span>
                                      Prix
                                    </span>
                                    <span>
                                        {{ currencyFormatter($product->price) }}
                                    </span>
                                </li>
                                <li>
                                    <span>
                                      Quantité
                                    </span>
                                    <span>
                                        {{$product->quantity}}
                                    </span>
                                </li>
                                <li>
                                    <span>
                                      Remise
                                    </span>
                                    <span>
                                        @switch($product->discount_type)
                                            @case('percent')
                                            {{ $product->discount.' %' }}
                                            @break
                                            @case('fixed')
                                            {{ currencyFormatter($product->discount) }}
                                            @break
                                        @endswitch
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

@endsection

@push('footer-script')
    <script>
        function increaseQuantity(ele) {
            var input = $(ele).parent().siblings('input');
            var currentValue = input.val();

            input.val(parseInt(currentValue) + 1);
        }

        function decreaseQuantity(ele) {
            var input = $(ele).parent().siblings('input');
            var currentValue = input.val();

            if (currentValue > 1) {
                input.val(parseInt(currentValue) - 1);
            }
        }

        $('input.qty').on('blur', function () {
            if ($(this).val() == '' || $(this).val() == 0) {
                $(this).val(1);
            }
        });

        function deleteProduct(ele) {
            let key = $('input.qty').data('id');

            var url = '{{ route('front.deleteFrontProduct', ':id') }}';
            url = url.replace(':id', key);

            $.easyAjax({
                url: url,
                type: 'POST',
                data: {_token: $("meta[name='csrf-token']").attr('content')},
                redirect: false,
                success: function (response) {
                    $('.cart-badge').text(response.productsCount);
                    $(ele).parents('.update').addClass('hide').siblings('.add').removeClass('hide')
                    $('input.qty').val(1);
                }
            })
        }

    </script>
@endpush
