<div class="modal-header">
    <h4 class="modal-title">@lang('app.pay')</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="form-body">
        <div class="row">
            <div class="col-md-12 ">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2 h5">@lang('app.total'):</div>
                        <div class="col-md-8 h5" id="payment-modal-total">{{$amount}}</div>
                    </div>
                </div>
                <div class="form-group">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" checked type="radio" name="payment_gateway"
                            id="pay-cash" value="cash">
                        <label class="form-check-label"
                            for="pay-cash">@lang('modules.booking.payViaCash')</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="payment_gateway" id="pay-card"
                            value="card">
                        <label class="form-check-label"
                            for="pay-card">@lang('modules.booking.payViaCard')</label>
                    </div>

                </div>


                <div id="cash-mode">
                    <div class="form-group">
                        <label for="">@lang('modules.booking.cashGivenByCustomer')</label>
                        <input oninput="limitDecimalPlaces(event)" onkeypress="return isNumberKey(event)"
                            type="number" min="0" step=".01" class="form-control form-control-lg"
                            id="cash-given">
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">@lang('modules.booking.cashRemaining')</label>
                            <div class="col-md-12 h5" id="cash-remaining">-</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('modules.booking.cashToReturn')</label>
                            <div class="col-md-12 h5" id="cash-return">-</div>
                        </div>
                    </div>
            </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
        @lang('app.cancel')</button>
    <button type="button" id="submit-cart" class="btn btn-success"><i class="fa fa-check"></i>
        @lang('app.submit')</button>
</div>


<script>
     $('#payment-modal').on('shown.bs.modal', function () {
            $('#cash-given').val(globalCartTotal);
            $('#cash-return').html(currency_format(0.00));
            $('#cash-remaining').html(currency_format(0.00));
            $('#cash-given').select();
        });

        $('#cash-given').focus(function () {
            $(this).select();
        })

        $("input[name='payment_gateway']").click(function () {
            let paymentMode = $(this).val();

            if(paymentMode === 'cash'){
                $('#cash-mode').show();
            }
            else {
                $('#cash-mode').hide();
            }
        });

        function limitDecimalPlaces(e)
        {
            let count = 2; /* digits after decimal */
            if (e.target.value.indexOf('.') == -1) { return; }
            if ((e.target.value.length - e.target.value.indexOf('.')) > count) {
                e.target.value = parseFloat(e.target.value).toFixed(count);
            }
        }

        $('#cash-given').keyup(function () {
            let cashGiven = $(this).val();

            if(cashGiven === ''){
                cashGiven = 0;
            }

            let total = $('#cart-total-input').val();
            let cashReturn = (parseFloat(total) - parseFloat(cashGiven)).toFixed(2);
            let cashRemaining = (parseFloat(total) - parseFloat(cashGiven)).toFixed(2);

            if(cashRemaining < 0 || cashGiven >= parseFloat(total)){
                cashRemaining = parseFloat(0).toFixed(2);
            }

            if(cashReturn < 0){
                cashReturn = Math.abs(cashReturn);
            }
            else{
                cashReturn = parseFloat(0).toFixed(2);
            }

            $('#cash-return').html(currency_format(cashReturn));
            $('#cash-remaining').html(currency_format(cashRemaining));

        });

        $('#submit-cart').click(function () {
            let url = '{{route('admin.pos.store')}}';
            let bookingTime = $('#posTime').val();
            $.easyAjax({
                url: url,
                container: '#pos-form',
                type: "POST",
                data: $('#pos-form').serialize()+'&payment_gateway='+$('input[name="payment_gateway"]:checked').val()+'&pos_date='+pos_date+'&pos_time='+bookingTime,
                redirect: true
            })
        });
</script>
