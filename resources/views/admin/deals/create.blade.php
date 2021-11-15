@extends('layouts.master')

@push('head-css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/all.css') }}">

<style>
    .collapse.in{
        display: block;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #999;
    }
    .select2-dropdown .select2-search__field:focus, .select2-search--inline .select2-search__field:focus {
        border: 0px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        margin: 0 13px;
    }
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #cfd1da;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__clear {
        cursor: pointer;
        float: right;
        font-weight: bold;
        margin-top: 8px;
        margin-right: 15px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button
    {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number]
    {
        -moz-appearance: textfield;
    }

</style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Ajouter une offre</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('offer.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titre </label>
                                    <input type="text" class="form-control" name="title" value="{{$offers->title}}" id="title"  autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image </label>
                                    <input type="file" class="form-control" name="image"  autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remise % </label>
                                    <input type="number" class="form-control" name="discount" value="{{$offers->discount}}"  autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date de fin </label>
                                    <input type="datetime-local" class="form-control" name="endtime" value="{{$offers->endtime}}"  autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-light-round">
                                    <i class="fa fa-check"></i> Sauvegarder
                                </button>
                            </div>
                        </div>
                </form>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('footer-js')
<script src="{{ asset('assets/plugins/iCheck/icheck.min.js') }}"></script>

    <script>

        $('.dropify').dropify({
            messages: {
                default: '@lang("app.dragDrop")',
                replace: '@lang("app.dragDropReplace")',
                remove: '@lang("app.remove")',
                error: '@lang('app.largeFile')'
            }
        });

        $('#open_time').datetimepicker({
            format: '{{ $time_picker_format }}',
            locale: '{{ $settings->locale }}',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
                previous: "fa fa-angle-double-left",
                next: "fa fa-angle-double-right",
            },
            useCurrent: false,
        }).on('dp.change', function(e) {
            $('#deal_startTime').val(convert(e.date));
        });

        $('#close_time').datetimepicker({
            format: '{{ $time_picker_format }}',
            locale: '{{ $settings->locale }}',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
                previous: "fa fa-angle-double-left",
                next: "fa fa-angle-double-right",
            },
            useCurrent: false,
        }).on('dp.change', function(e) {
            $('#deal_endTime').val(convert(e.date));
        });


        $(function () {
            $('#description').summernote({
                dialogsInBody: true,
                height: 300,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ["view", ["fullscreen"]]
                ]
            });
        });

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
        });

        $('.checkAmount').keyup(function () {
            var original_amount = $('#original_amount').val();
            var discount_amount = $('#discount_amount').val();
            if(original_amount!='' && discount_amount!='' && Number(discount_amount) > Number(original_amount)){
                $('#discount_amount').focus();
                $('#discount_amount').val('');
            }
        });

        $(function() {
            moment.locale('{{ $settings->locale }}');
            $('input[name="applied_between_dates"]').daterangepicker({
                timePicker: true,
                minDate: moment().startOf('hour'),
                autoUpdateInput: false,
            });
        });


        $('input[name="applied_between_dates"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('{{ $date_picker_format }} {{$time_picker_format}}') + '--' + picker.endDate.format('{{ $date_picker_format }} {{$time_picker_format}}'));
            $('#deal_startDate').val(picker.startDate.format('YYYY-MM-DD')+' '+convert(picker.startDate));
            $('#deal_endDate').val(picker.endDate.format('YYYY-MM-DD')+' '+convert(picker.endDate));
        });

        $('#services').change(function(){
            var services = $(this).val();
            if($('#choice').val()=='location'){
                if($('#services').val() == ''){
                $('#result_div').html('');
                // $('.Deal-form').hide();
                $('.Deal-form').addClass('d-none');
                }
                return false;
            }
            $.ajax({
                url: "{{route('admin.deals.selectLocation')}}",
                type: "POST",
                container: '#createForm',
                data:$('#createForm').serialize(),
                success:function(data){
                    $('#locations').html(data.selected_location);
                    $('#locations').val(data.selected_location);
                }
            })
        });

        $('#locations').change(function(){
            var locations = $(this).val();
            if($('#choice').val()=='service'){
                return false;
            }
            $.ajax({
                url: "{{route('admin.deals.selectServices')}}",
                container: '#createForm',
                type: "POST",
                data: $('#createForm').serialize(),
                success:function(data){
                    $('#services').html(data.selected_service);
                    $('#services').val(data.selected_service);
                }
            })
        });

        $(document).on('change', '#services', function(){
         if($('#services').val() == ''){
         $('#result_div').html('');
        //  $('.Deal-form').hide();
            $('.Deal-form').addClass('d-none');
        }
        });

        $('#reset-btn').click(function(){
            $.ajax({
                url: "{{route('admin.deals.resetSelection')}}",
                type: "GET",
                success:function(data){
                    $('#locations').html(data.all_locations_array);
                    $('#services').html(data.all_services_array);
                    $('#result_div').html('');
                    $('#discount_amount').val(0);
                    // $('.Deal-form').hide();
                    $('.Deal-form').addClass('d-none');
                }
            })
        });

        $('#make_deal').click(function()
        {
            var locations = $('#locations').val();
            var services = $('#services').val();
            var choice = $('#choice').val();
            if(services.length==0){
                toastr.error('@lang("messages.deal.selectOneService")');
                return false;
            }
            else if(!locations || locations.length == 0){
                toastr.error('@lang("messages.deal.selectOneLocation")');
                return false;
            }
            $.ajax({
                url: "{{route('admin.deals.makeDeal')}}",
                type: "POST",
                container: '#createForm',
                data:$('#createForm').serialize(),
                success:function(data){
                    $('#result_div').html(data.view);
                    $('.Deal-form').show();
                }
            });
        });

        $('#choice').change(function(){
            var location_div = $('#location_div').html(), service_div = $('#service_div').html(), choice = $(this).val();
            if(choice=='service'){
                $("#location_div").before($("#service_div"));
            }
            else if(choice=='location'){
                $("#service_div").before($("#location_div"));
            }
            $('#reset-btn').click();
        });

        $(document).on('click', '.quantity-minus', function () {
            let serviceId = $(this).data('service-id');
            let qty = $('.deal-service-'+serviceId).val();
            qty = parseInt(qty)-1;
            if(qty < 1){
                return false;
                // qty = 1;
            }
            $('.deal-service-'+serviceId).val(qty);
            updateCartQuantity(serviceId, qty);
        });

        $(document).on('click', '.quantity-plus', function () {
            let serviceId = $(this).data('service-id');
            let qty = $('.deal-service-'+serviceId).val();
            qty = parseInt(qty)+1;
            $('.deal-service-'+serviceId).val(qty);
            updateCartQuantity(serviceId, qty);
        });

        $(document).on('keyup', '.deal_discount', function () {
            let discount = $(this).val();
            if(discount=='' && discount>=0){
                $(this).val(0);
            }
            calculateTotal();
        });

        $(document).on('change', '#discount_type', function () {
            let discount_type = $('#discount_type').val();
            if(discount_type=='percentage'){
                $('#discount').prop("readonly", false);
            }
            else{
                $('#discount').prop("readonly", true);
                $('#discount').val(0);
            }
            $('.deal_discount').val(0);
            calculateTotal();
        });

        $(document).on('keyup', '#discount', function () {
            let percent_discount = $(this).val();
            if(percent_discount>100){
                $(this).val(0);
            }
            calculateTotal();
        });

        function deleteRow(id, name)
        {
            $("#row"+id).remove();
            $("#services option[value='"+name+"']").detach();
            calculateTotal();
        }

        function updateCartQuantity(serviceId, qty) {
            let servicePrice = $('.deal-price-'+serviceId).val();
            let subTotal = (parseFloat(servicePrice) * parseInt(qty));
            $('.deal-subtotal-'+serviceId).html(currency_format(subTotal.toFixed(2)));
            $('.deal-subtotal-val-'+serviceId).val(subTotal.toFixed(2));
            calculateTotal();
        }

        function calculateTotal()
        {
            let dealSubTotal = 0;
            let discount = 0;
            let dealTotal = 0;
            let total_discount=0;
            let discountPercentage = 0;
            let discount_type = $('#discount_type').val();

            if($('#discount').val()!='' || $('#discount').val()>0){
                discountPercentage = $('#discount').val();
            }

            $("input[name='deal_discount[]']").each(function(index){
                let discount_price = $(this).val();
                let sub_total_price = $("input[name='deal-subtotal-val[]']").eq(index).val();

                if(discount_type=='percentage'){
                    $(this).prop("readonly", true);
                    discount_price = sub_total_price * (discountPercentage/100);
                    $(this).val(discount_price.toFixed(2));
                }
                else{
                    $(this).prop("readonly", false);
                    if(discount_price>0){ /* for NAN validation */
                        if(parseFloat(discount_price)>sub_total_price){
                            dealTotal=0;
                            $(this).val(0);
                            discount_price = 0;
                        }
                    }
                }
                total_discount = parseFloat(total_discount) + parseFloat(discount_price);
            });

            $("input[name='deal_unit_price[]']").each(function(index)
            {
                let servicePrice = $(this).val();
                let qty = $("input[name='deal_quantity[]']").eq(index).val();
                let sub_discount = $("input[name='deal_discount[]']").eq(index).val();
                let sub_total = parseFloat(servicePrice) * parseInt(qty);
                discount = parseFloat(sub_total) - parseFloat(sub_discount);

                if(parseFloat(sub_discount)>sub_total){
                    discount = sub_total;
                }
                if(sub_discount>0){
                    $("td[name='deal-total[]']").eq(index).html(currency_format(discount.toFixed(2)));
                }
                else{
                    $("td[name='deal-total[]']").eq(index).html(currency_format(sub_total.toFixed(2)));
                }
                dealSubTotal = (dealSubTotal + sub_total);
            });

            let deal_total_price=0;
            if(total_discount<dealSubTotal){
                deal_total_price = dealSubTotal-total_discount;
            }

            $("#deal-sub-total").html(currency_format(dealSubTotal.toFixed(2)));
            $("#deal-discount-total").html(currency_format(total_discount.toFixed(2)));
            $("#deal-total-price").html(currency_format(deal_total_price.toFixed(2)));
            $('#discount_amount').val(deal_total_price.toFixed(2));
            $('#original_amt').val(dealSubTotal.toFixed(2));
        }

        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
            return true;
        }

        function createSlug(value) {
            value = value.replace(/\s\s+/g, ' ');
            let slug = value.split(' ').join('-').toLowerCase();
            slug = slug.replace(/[&\/\\#,+()$~%!@#$^&*().'":*?<>{}]/g, '');
            slug = slug.replace(/--+/g, '-');
            $('#slug').val(slug);
        }

        $('#title').keyup(function(e) {
            createSlug($(this).val());
        });

        $('#slug').keyup(function(e) {
            createSlug($(this).val());
        });

        $('#save-form').click(function () {

            $.easyAjax({
                url: '{{route('admin.deals.store')}}',
                container: '#createForm',
                type: "POST",
                redirect: true,
                file:true,
                data:$('#createForm').serialize(),

            })
        });

        function convert(str)
        {
            var date = new Date(str);
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            hours = ("0" + hours).slice(-2);
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }
    </script>

@endpush
@include("partials.currency_format")
