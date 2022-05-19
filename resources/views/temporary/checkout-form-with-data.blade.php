<style type="text/css">
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 0 !important;
        height: 44px !important;
        padding: 8px !important;
    }

    .editTabsPersonal,
    .editTabsBilling,
    .editTabsShippingOptions {
        text-align: right;
        color: #547f06;
    }

    .errorMessage {
        font-size: 12px;
        color: #b12704;
    }

    .custom-shipping-opt-label {
        padding: 20px;
        width: 100%;
        background: #e6e6e6;
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    .checkout-content p {
        float: left;
        width: 100%;
        margin-bottom: 5px;
    }

    .payment-method-container ul li {
        color: #AAAAAA;
        display: block;
        position: relative;
        /* float: left; */
        width: 100%;
        height: 65px;
        /* border-bottom: 1px solid #fff; */
    }

    .payment-method-container input[type=radio]:checked~label {
        color: #f28e20;
    }

    .payment-method-container ul li label {
        display: block;
        position: relative;
        font-weight: 300;
        font-size: 1.35em;
        padding: 35px 25px 25px 80px;
        margin: 10px auto;
        height: 30px;
        z-index: 9;
        cursor: pointer;
        -webkit-transition: all 0.25s linear;
    }

    .payment-method-container ul li input[type=radio] {
        position: absolute;
        visibility: hidden;
    }

    .payment-method-container input[type=radio]:checked~.check {
        border: 5px solid #f28e20;
    }

    .payment-method-container ul li .check {
        display: block;
        position: absolute;
        border: 5px solid #AAAAAA;
        border-radius: 100%;
        height: 26px;
        width: 26px;
        top: 30px;
        left: 20px;
        z-index: 5;
        transition: border .25s linear;
        -webkit-transition: border .25s linear;
    }

    .payment-method-container input[type=radio]:checked~.check::before {
        background: #f28e20;
    }

    .payment-method-container ul li .check::before {
        display: block;
        position: absolute;
        content: '';
        border-radius: 100%;
        height: 10px;
        width: 10px;
        top: 3px;
        left: 3px;
        margin: auto;
        transition: background 0.25s linear;
        -webkit-transition: background 0.25s linear;
    }

    .payment-method-container ul li label {
        display: block;
        position: relative;
        font-weight: 300;
        font-size: 1.35em;
        padding: 25px 25px 25px 80px;
        margin: 10px auto;
        height: 30px;
        z-index: 9;
        cursor: pointer;
        -webkit-transition: all 0.25s linear;
    }

    div#section-payment-shipping {
        background: #fff;
        margin-top: -20px;
        margin-bottom: 20px;
        margin-right: 15px;
        border: 1px solid #dddddd;
        border-top: unset;
    }

    .form-control[disabled],
    .form-control[readonly]~.float-label.custom_float_left {
        top: 15px;
    }

    input#route::-webkit-input-placeholder {
        color: transparent;
    }

    .address-info li {
        line-height: 1.8;
    }

    @media screen and (max-width:980px) {
        input[name="card_num"] {
            margin-right: 60px;
        }

        input[name="exp_date"],
        input[name="card_cvv"] {
            margin-right: 60px;
        }
    }

    @media screen and (max-width:411px) {
        .col-md-4.col-sm-4.float-div~div {
            display: none !important;
        }
    }

</style>

<?php
$isClient = getLoggedInUser() ? true : false;
$client = getLoggedInUser();
$total = 0;
$tax = 0;
$taxtype = '';
$grandTotal = 0;
if (isset($vendor) && !is_null($vendor->salesTax)) {
    $tax = $vendor->salesTax->value;
    $taxtype = $vendor->salesTax->type;
}
?>
{{-- {{dd($data)}} --}}
@foreach ($data['cart']['inventories'] as $product)
    <?php $total += (int) $product['reqQuantity'] * $product['amount']; ?>
    @if ($taxtype == 'percentage')
        <?php $grandTotal = $total + ($tax / $total) * 100; ?>
    @else
        <?php $grandTotal = $total + $tax; ?>
    @endif
@endforeach
@if (isset($coupon))
    @if ($coupon->type == 'flat')
        <?php $grandTotal = $grandTotal - $coupon->value; ?>
    @else
        <?php $grandTotal = $grandTotal - ($coupon->value / 100) * $grandTotal; ?>
    @endif
@endif
<form id="itemsForm">
    @foreach ($data['cart']['inventories'] as $inventory)
        <input type="hidden" name="invs[]" value="{{ $inventory['id'] }}">
    @endforeach
</form>
<div class="col-md-7 col-lg-6 col-sm-10 margin-top-25 no-padding" style="margin-left: 0;" id="checkout--form--final">
    {{-- Personal Info --}}
    <div class="personal cart-tabs active" style="margin-bottom: 20px;">
        <div class="cart-payment-head clearfix">
            <div class="number-circle">
                <span>1</span>
            </div>
            <div class="shopping-email">
                <div class="">
                    <h2>Personal Info</h2>
                </div>
            </div>
            <div class="
                    editTabsPersonal">
                <i class="fa fa-edit"></i>
            </div>
        </div>
        <div class="cart-tab-content" id="section-payment-personal" style="position: relative;">
            <div class="customLoader">
                <img src="{{ asset('hgs/eloader.gif') }}" alt="loader">
            </div>
            <form id="personalInfoForm" style="width: 90%;margin:0 auto;" class="original">

                <div class="row no-padding" style="margin: 0;">
                    <div class="col-md-6 col-sm-6 col-xs-12 float-div form-group">
                        <input type="text" name="fname" id="fname" class="form-control"
                            value="{{ $isClient ? $client['fname'] : '' }}" required>
                        <div class="float-label custom_float_left">First Name</div>
                        <div class="errorMessage"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 float-div">
                        <input type="text" class="form-control" id="lname" name="lname"
                            value="{{ $isClient ? $client['lname'] : '' }}" required>
                        <div class="float-label custom_float_left">Last Name</div>
                        <div class="errorMessage"></div>
                    </div>
                </div>
                <div class="row no-padding" style="margin: 0;">
                    <div class="col-md-6 col-sm-6 col-xs-12 float-div form-group">
                        <input type="tel" name="phone_no" id="phone_no" data-mask="(999) 999-9999" maxlength="10"
                            class="form-control" value="{{ $isClient ? $client['phone_no'] : '' }}" required>
                        <div class="float-label custom_float_left">Phone No:</div>
                        <div class="errorMessage"></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 float-div">
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $isClient ? $client['email'] : '' }}" required>
                        <div class="float-label custom_float_left">Email</div>
                        <div class="errorMessage"></div>
                    </div>
                </div>
                @if (!$isClient)
                    <div class="row no-padding pasword-section-wrapper" style="margin: 0;">
                        <div class="col-md-6 col-sm-12 col-xs-12 float-div form-group margin-top-15">
                            <input type="password" class="form-control" id="userPassword" name="password" required>
                            <div class="float-label custom_float_left">Password</div>
                            <div class="errorMessage"></div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 float-div form-group margin-top-15">
                            <input type="password" class="form-control" id="password-confirmation"
                                name="password_confirmation" required>
                            <div class="float-label custom_float_left">Confirm Password</div>x
                            <div class="errorMessage"></div>
                        </div>
                    </div>
                @endif


                <div class="row" style="margin: 15px 0 0 0; padding: 15px; ">

                    <button class="btn btn_continue" id="guestPersonal">Continue to address</button>
                </div>
            </form>
        </div>
    </div>
    <div class="shipping cart-tabs status-incomplete"
        style="margin-bottom: 20px;display: flex;justify-content: space-between; border-bottom:unset;">
        <div class="cart-payment-head clearfix">
            <div class="number-circle">
                <span>2</span>
            </div>
            <div class="shopping-email">
                <div class="">
                    <h2>Shipping Address</h2>
                </div>
            </div>
        </div>
        <div class="editTabsShipping">
            <i class="fa fa-edit"></i>
        </div>
    </div>
    <div class=" cart-tab-content d-none" id="section-payment-shipping" style="position: relative;">
        <div class="customLoader">
            <img src="{{ asset('hgs/eloader.gif') }}" alt="loader">
        </div>
        <form action="" id="shippingForm" class="original">
            @if (isset($coupon))
                <input type="hidden" name="coupon" value="{{ $coupon->id }}">
            @endif

            <div class="row no-padding" style="margin: 0;">
                <div class="col-md-12 col-sm-12 col-xs-12 float-div form-group margin-top-15">
                    <input type="text" class="form-control" name="add1" id="route"
                        value="{{ $isClient ? ($client['address'] ? $client['address']['add1'] : '') : '' }}"
                        required>
                    <div class="float-label custom_float_left">Address 1</div>
                </div>
            </div>
            <div class="row no-padding" style="margin: 0;">
                <div class="col-md-12 col-sm-12 col-xs-12 float-div form-group margin-top-15">
                    <input type="text" class="form-control" name="apt" id="street_number"
                        value="{{ $isClient ? ($client['address'] ? $client['address']['add2'] : '') : '' }}">
                    <div class="float-label custom_float_left">Address 2</div>
                </div>
            </div>
            <div class="row no-padding" style="margin: 0;">
                <div class="col-md-12 col-sm-12 col-xs-12 float-div form-group margin-top-15">
                    <input type="text" class="form-control" id="locality" name="city"
                        value="{{ $isClient ? ($client['address'] ? $client['address']['city'] : '') : '' }}"
                        required>
                    <div class="float-label custom_float_left">City</div>
                </div>
            </div>

            <div class="row no-padding" style="margin: 0;">
                <div class="col-md-6 col-sm-6 col-xs-12 float-div form-group margin-top-15">

                    <input class="form-control" name="zip" id="postal_code"
                        value="{{ $isClient ? ($client['address'] ? $client['address']['zip'] : '') : '' }}">
                    <div class="float-label custom_float_left">Zip Code</div>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12 float-div form-group margin-top-15">
                    <input class="form-control" name="state" id="administrative_area_level_1"
                        value="{{ $isClient ? ($client['address'] ? $client['address']['state'] : '') : '' }}">
                    <div class="float-label custom_float_left">State</div>
                </div>
            </div>
            <div class="row" style="margin: 15px 0 0 0; padding: 15px; ">
                <button class="btn btn_continue" id="guestShipping">Continue</button>
            </div>
        </form>

    </div>
    {{-- Billing --}}
    <div class="billing cart-tabs status-incomplete" style="margin-bottom: 20px">
        <div class="cart-payment-head clearfix">
            <div class="number-circle">
                <span>3</span>
            </div>
            <div class="shopping-email">
                <div class="">
                    <h2>Billing</h2>
                </div>
            </div>
            <div class="editTabsBilling">
                <i class="fa fa-edit"></i>
            </div>
        </div>
        <div class="cart-tab-content d-none" id="section-payment-billing" style="position: relative;">
            <div class="customLoader">
                <img src="{{ asset('hgs/eloader.gif') }}" alt="loader">
            </div>
            <form action="" id="billingForm" class="original">
                <div class="row mo-padding" style="margin:0">
                    <div class="col-12 form-group " style="padding-left: 17px;margin-top:15px;">
                        <input class="form-concrol" type="checkbox" name="same_billing" id="sameAsShipping"
                            style="margin-right: 5px;">
                        <label class="control-label" for="same_billing">Same as shipping
                            address?</label>
                    </div>
                </div>
                <div class="row no-padding" style="margin: 0;">
                    <div class="col-md-12 col-sm-12 col-xs-12 float-div form-group margin-top-15">
                        <input type="text" class="form-control" id="search_input" name="bill_add1">
                        <div class="float-label custom_float_left">Address 1</div>
                    </div>
                </div>
                <div class="row no-padding" style="margin: 0;">
                    <div class="col-md-12 col-sm-12 col-xs-12 float-div form-group margin-top-15">
                        <input type="text" class="form-control" name="bill_apt">
                        <div class="float-label custom_float_left">Address 2</div>
                    </div>
                </div>
                <div class="row no-padding" style="margin: 0;">
                    <div class="col-md-12 col-sm-12 col-xs-12 float-div form-group margin-top-15">
                        <input type="text" class="form-control" id="bill_city_name" name="bill_city">
                        <div class="float-label custom_float_left">City</div>
                    </div>
                </div>

                <div class="row no-padding" style="margin: 0;">
                    <div class="col-md-6 col-sm-6 col-xs-12 float-div form-group margin-top-15">
                        <input class="form-control" name="bill_zip">
                        <div class="float-label custom_float_left">Zip Code</div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 float-div form-group margin-top-15">
                        <input class="form-control" name="bill_state">
                        <div class="float-label custom_float_left">State</div>
                    </div>
                </div>
                <div class="row" style="margin: 15px 0 0 0; padding: 15px; ">
                    <button class="btn btn_continue" id="guestBilling">Continue</button>
                </div>
            </form>

        </div>
    </div>


    {{-- Payment --}}
    {{-- @if ($vendor) --}}
    {{-- @if ($vendor->defaultPaymentCredential)
    <input type="hidden" id="strip--publish--key" value="{{ $vendor->defaultPaymentCredential->val1 }}">
    @else
    <input type="hidden" id="strip--publish--key" value="{{ getDefault('stripe_api_key') }}">
    @endif
    @else
    <input type="hidden" id="strip--publish--key" value="{{ getDefault('stripe_api_key') }}">
    @endif --}}
    <div class="cart-tabs payment status-incomplete" style="margin-bottom: 20px">
        <div class="cart-payment-head clearfix">
            <div class="number-circle">
                <span>4</span>
            </div>
            <div class="shopping-email">
                <h2>Payment</h2>
            </div>
            <div class="editTabs d-none"><i class="fa fa-edit"></i>edit</div>
        </div>
        <div class="cart-tab-content d-none" id="section-payment-method">
            {{-- <input type="hidden" id="totalWeight" value="{{$totalWeight}}"> --}}


            <div class="payment-method-container" style="clear: both; display:flex;">
                <ul>
                    <li style="display:none;">
                        <input type="radio" id="c-option" name="selector" checked="checked">
                        <label for="c-option">Credit Card</label>
                        <div class="check">
                            <div class="inside"></div>
                        </div>
                    </li>

                    <div id="payment-credit-card-option">
                        <form action="" class="" id="payment-form">
                            <div class="row" style="clear: both;">
                                <div class="col-12">
                                    <div class="row no-padding" style="margin: 0; display:flex;">
                                        <div class="col-md-4 col-sm-4 float-div">
                                            <input type="text" class="form-control" name="pay" id="total_amount"
                                                value="{{ number_format($grandTotal, 2) }}" readonly>
                                            <div class="float-label" style="top: 30%">Pay ($)</div>
                                            @foreach ($data['cart']['inventories'] as $inventory)
                                                <input type="hidden" name="inventory[]"
                                                    value="{{ $inventory['id'] }}">
                                                <input type="hidden" name="qty[]"
                                                    value="{{ $inventory['reqQuantity'] }}">
                                            @endforeach
                                            <input type="hidden" name="check_payment" value="2">
                                            <input type="hidden" name="gateway" value="stripe">
                                        </div>
                                        <div class="col-md-8 col-sm-8" style="margin-top: 15px;">
                                            <img src="https://e.himalayangiftshop.com/hgs/credit-card.png"
                                                style="width: 50px; float: left;">
                                            <img src="https://e.himalayangiftshop.com/hgs/master-card.png"
                                                style="width: 50px; float: left; margin-left: 10px;">
                                            <div style="clear: both;"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12" style="margin: 0 30px;margin-top: 20px;">
                                            <div class="d-flex">
                                                <input placeholder="Credit Card Number" name="card_num"
                                                    class="card-num form-control" required
                                                    style="margin-bottom: 15px;padding: 20px;">
                                            </div>
                                            <div class="d-flex">
                                                <input placeholder="MM/YY" class="datt form-control" name="exp_date"
                                                    style="padding: 20px;margin-right:20px;" required>
                                                <input placeholder="Security Code" required
                                                    class="card-cvv form-control" name="card_cvv"
                                                    style="padding: 20px;">
                                            </div>
                                        </div>
                                        <input type="text" name="check_payment" value="2" hidden>
                                        <input type="text" name="gateway" value="stripe" hidden>
                                    </div>
                                    <div class="row" style="margin: 15px;">
                                        <button class="btn btn_continue" id="paymentDone">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- <li>
                        <input type="radio" id="p-option" name="selector">
                        <label for="p-option">
                            <div id="paypal-button-container" class="" style=" width:150px;">
                            </div>
                        </label>
                        <div class="check"></div>
                    </li> --}}
                    <div id="payment-paypal-option" class="hidden">
                        <div id="paypal-button-container" class=""
                            style=" margin-top:20px;margin-left: 80px; width:100px;">
                        </div>
                    </div>




                </ul>
            </div>

        </div>
    </div>
</div>
{{-- @include('fitgod::pages.checkout.orderdetail') --}}

<script>
    var zip = null;
    var state = null;
    var data = {};

    $(".card-num").inputmask("9999 9999 9999 9999");
    $(".card-cvv").inputmask("9999");
    $(".datt").inputmask("99/99");

    document.getElementById('phone_no').addEventListener('blur', function(e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{3})(\d{3})(\d{4})/);
        if (e.target.value != '') {
            e.target.value = '(' + x[1] + ') ' + x[2] + '-' + x[3];
        }
    });


    $('#p-option').off('click').on('click', function() {
        $('#payment-paypal-option').removeClass('hidden');
        $('#payment-credit-card-option').addClass('hidden');
    });
    $('#c-option').off('click').on('click', function() {
        $('#payment-credit-card-option').removeClass('hidden');
        $('#payment-paypal-option').addClass('hidden');
    });

    function validateEmail(email) {
        var re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    $('#card_number').on('keyup', function(e) {
        let card_number = $(this).val();
        if (card_number.length > 0) {
            let abc = card_number.match(/\d+/g).join([])
            const card_no = abc.split("");
            $(this).val(card_no.join(""));
        }
    });
    $('#card_number').on('blur', function(e) {
        if ($(this).val().length > 0) {
            let mask = $(this).val().split("");
            mask.splice(4, 0, "-");
            mask.splice(9, 0, "-");
            mask.splice(13, 0, "-");
            $(this).val(mask.join(""));
        }
    });



    $(document).ready(function() {
        // function shippingCharges() {
        //     var personal = $('#personalInfoForm').serializeArray();
        //     var shipping = $('#shippingForm').serializeArray();
        //     var items = $('#itemsForm').serializeArray();
        //     var data = shipping.concat(personal, items);
        //     supportAjax({
        //         url: `cart/calculate/shipping-cost`,
        //         method: 'POST',
        //         data: data
        //     }, (response) => {
        //         let ex_total = $('#total_amount').val();
        //         console.log(ex_total, Number(response.price));
        //         let new_total = (Number(ex_total) + Number(response.price)).toFixed(2);
        //         console.log(new_total);
        //         $('#total_amount').val(new_total);
        //         $('#cartTotal').html(`$${new_total}`);
        //         $('#cartTotal').attr('data-total', new_total);
        //         $('#shipping-pay').html(`$${Number(response.price).toFixed(2)}`);
        //     }, ({
        //         status,
        //         responseJSON
        //     }) => {
        //         console.log(status, responseJSON);
        //     })
        // }
        $('#emailDone').on('click', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            if (!validateEmail($('input[name = "email"]').val())) {
                $('input[name = "email"]').css("border", "1px solid #b12704");
            } else {
                $(this).parent().parent().removeClass('status-incomplete');
                $(this).parent().parent().addClass('status-complete');
                $(this).parent().parent().removeClass('active');
                $(this).parent().parent().next().addClass('active');
                $(this).parent().parent().next().removeClass('status-incomplete');

                supportAjax({
                    url: 'user/defaultAddress'
                }, function(response) {
                    if (typeof response != "undefined") {
                        for (let key in response) {
                            $('#shippingForm').find(`input[name = "${key}"]`).val(response[
                                key]);
                            $('#shippingForm').find(
                                    `select[name="${key}"] option[value="${response[key]}"]`)
                                .attr('selected', 'selected').siblings('option').removeAttr(
                                    'selected');
                        }
                    }
                });
            }

        });

        $('#shippingDone').on('click', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var shipping = $('#shippingForm').serializeArray();
            let validation = true;
            let self = $(this);

            $.each(shipping, function(i, value) {
                if (shipping[i].name !== 'addr2') {

                    console.log(shipping[i], shipping[i].value);
                    if (shipping[i].value == '') {
                        let currentName = shipping[i].name;
                        $(`input[name = ${currentName}]`).css("border", "1px solid #b12704");
                        validation = false;
                        self.parent().prev().css("display", "block");
                    } else {
                        let cur_name = shipping[i].name;
                        $(`input[name = ${cur_name}]`).css("border", "1px solid #e8e8e8");
                    }
                }
            });
            if (validation) {
                supportAjax({
                    url: '/validateShipping',
                    data: shipping,
                    method: "post"
                }, function(response) {
                    self.parent().prev().css("display", "none");
                    $.each(shipping, function(i, value) {
                        let currentName = shipping[i].name;
                        $(`input[name = ${currentName}]`).css("border",
                            "1px solid #e8e8e8");

                    });
                    $('.shipping').removeClass('status-incomplete');
                    $('.shipping').addClass('status-complete');
                    $('.shipping').removeClass('active');
                    $('.shipping').next().addClass('active');
                    $('.shipping').next().removeClass('status-incomplete');
                    shippingCharges();

                }, function(err) {
                    $.each(err.responseJSON.errors, function(i, val) {
                        $(document).find(`input[name = ${i}]`).css("border",
                            "1px solid #b12704");
                        self.parent().prev().css("display", "block");
                        self.parent().prev().text(val);
                    });
                });

            }
        });

        $('#guestPersonal').on('click', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            alert("test");
            return;
            var personalinfo = $('#personalInfoForm').serializeArray();
            var validation = true;
            var self = $(this);
            $.each(personalinfo, function(i, value) {
                if (personalinfo[i].name != 'lname' || personalinfo[i].name !=
                    'client_phone_no') {
                    if (personalinfo[i].value == '') {
                        let currentName = personalinfo[i].name;
                        $(`input[name=${currentName}]`).css("border", "1px solid #b12704");
                        validation = false;
                        // self.parent().prev().css("display", "none");
                    } else {
                        let cur_name = personalinfo[i].name;
                        $(`input[name = ${cur_name}]`).css("border", "1px solid #e8e8e8");
                    }
                }
            })
            if ($(document).find('.pasword-section-wrapper').hasClass('d-none')) {
                validation = true;
            }
            if (validation) {

                supportAjax({
                    url: `cart/validate/personalinfo`,
                    method: "POST",
                    data: personalinfo
                }, (resp) => {
                    console.log(resp);
                    $('.cartLoaderImg').css("display", "none");
                    $('.personal').removeClass('status-incomplete');
                    $('.personal').addClass('status-complete');
                    $('.personal').next().addClass('active');
                    $('#section-payment-shipping').removeClass('d-none')
                    let append = `
                                        <form action="" id="personalFromNew" >
                                            <input type="hidden" class="form-control" name="fname" value="${resp.fname}">
                                            <input type="hidden" class="form-control" name="lname" value="${resp.lname}">
                                            <input type="hidden" class="form-control" name="email" value="${resp.email}">
                                            <input type="hidden" class="form-control" name="client_phone_no" value="${resp.phone_no}">
                                            <div style="padding: 10px 45px;height:100px;">
                                                <p class="shipping_address_detail">${resp.fname} ${resp.lname}</p>
                                                <p class="shipping_address_detail">${resp.email}</p>
                                                <p class="shipping_address_detail">${resp.phone_no}</p>
                                            </div>
                                        </form>
                                    `;
                    setTimeout(() => {
                        $('#personalInfoForm').addClass('hidden');
                        $('#section-payment-personal').append(append);

                    }, 200);
                }, ({
                    status,
                    responseJSON
                }) => {
                    if (status == 422) {
                        $('#personalInfoForm').find("input[name], textarea[name]").css(
                            "border-color", "#ccc");
                        $(`input[name]`).siblings(".errorMessage").empty();
                        if (!responseJSON.errors) return;
                        const messages = [];
                        for (const [key, message] of Object.entries(responseJSON.errors)) {
                            $('#personalInfoForm').find(`input[name="${key}"]`).css(
                                "border-color", "#f44336");
                            $('#personalInfoForm').find(`textarea[name="${key}"]`).css(
                                "border-color", "#f44336");
                            messages.push(message);
                            $(`input[name="${key}"]`).siblings(".errorMessage").empty().append(
                                message);
                            $(`textarea[name="${key}"]`).siblings(".errorMessage").empty()
                                .append(message);
                        }
                    }
                })
            }

        })

        // $('#guestShipping').on('click', function(e) {
        //     $('.cartLoaderImg').css("display", "block");
        //     e.preventDefault();
        //     e.stopImmediatePropagation();
        //     var shipping = $('#shippingForm').serializeArray();
        //     let validation = true;
        //     let self = $(this);

        //     $.each(shipping, function(i, value) {
        //         if (shipping[i].name !== 'add2') {
        //             if (shipping[i].value == '') {
        //                 let currentName = shipping[i].name;
        //                 $(`input[name = ${currentName}]`).css("border", "1px solid #b12704");
        //                 validation = false;
        //                 $('.cartLoaderImg').css("display", "none");
        //             } else {
        //                 $('.cartLoaderImg').css("display", "none");
        //                 let cur_name = shipping[i].name;
        //                 // console.log(cur_name);
        //                 $(`input[name = ${cur_name}]`).css("border", "1px solid #e8e8e8");
        //             }
        //         }
        //     });
        //     let response = shipping;
        //     if (validation) {
        //         supportAjax({
        //             url: 'cart/checkout/guest-checkout',
        //             data: shipping,
        //             method: "post"
        //         }, function(response) {
        //             $('.cartLoaderImg').css("display", "none");
        //             // console.log(response);
        //             self.parent().prev().css("display", "none");
        //             $.each(shipping, function(i, value) {
        //                 let currentName = shipping[i].name;
        //                 $(`input[name = ${currentName}]`).css("border",
        //                     "1px solid #e8e8e8");

        //             });
        //             $('.shipping').removeClass('status-incomplete');
        //             $('.shipping').addClass('status-complete');
        //             $('.shipping').next().addClass('active');
        //             $('#section-payment-billing').removeClass('d-none');
        //             let append = `
        //                                 <form action="" id="shippingFormNew" >
        //                                     <input type="hidden" class="form-control" name="add1" value="${response.add1??''}" required>
        //                                     <input type="hidden" class="form-control" name="add2" value="${response.add2??''}" required>
        //                                     <input type="hidden" class="form-control" name="city" value="${response.city??''}" required>
        //                                     <input type="hidden" class="form-control" name="zip" value="${response.state??''}" required>
        //                                     <input type="hidden" class="form-control" name="state" value="${response.zip??''}" required>
        //                                     <div style="padding: 10px 45px;height:70px;">
        //                                         <p class="shipping_address_detail">${response.add1??''}, ${response.add2??''}</p>
        //                                         <p class="shipping_address_detail">${response.city??''}, ${response.state??''} ${response.zip??''}</p>
        //                                     </div>
        //                                 </form>
        //                             `;

        //             $('#shippingForm').addClass('hidden');
        //             $('#section-payment-shipping').append(append);
        //             setTimeout(() => {
        //                 shippingCharges();
        //             }, 200);
        //         }, function(err) {
        //             $('.cartLoaderImg').css("display", "none");
        //             $.each(err.responseJSON.errors, function(i, val) {
        //                 $(document).find(`input[name = ${i}]`).css("border",
        //                     "1px solid #b12704");
        //                 self.parent().prev().css("display", "block");
        //                 self.parent().prev().text(val);
        //             });
        //         });

        //     }
        // });

        $('#guestShippingOptions').on('click', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var billing = $('#shippingOptionForm').serializeArray();
            var personal = $('#personalInfoForm').serializeArray();
            var shipping = $('#shippingForm').serializeArray();
            var data = billing.concat(personal, shipping);
            console.log(data);
            supportAjax({
                url: `cart/calculate/shipping-cost`,
                method: 'POST',
                data: data
            }, (response) => {
                console.log(response);
                $('.shipping-options').removeClass('status-incomplete');
                $('.shipping-options').addClass('status-complete');
                $('.shipping-options').next().addClass('active');
                $('#shippingOptionForm').addClass('hidden');
                let ex_total = $('#total_amount').val();
                let new_total = (Number(ex_total) + Number(resp.price)).toFixed(2);
                $('#total_amount').val(new_total);
                $('#cartTotal').val(new_total);
                $('#shipping-pay').html(`$${Number(resp.price).toFixed(2)}`);
            }, ({
                status,
                responseJSON
            }) => {
                console.log(status, responseJSON);
            })
        })

        $('#sameAsShipping').on('change', function(e) {
            let checked = $(this).is(':checked');
            if (checked) {
                $('input[name="bill_add1"]').val($('input[name="add1"]').val()).attr('readonly',
                    'true');
                $('input[name="bill_apt"]').val($('input[name="add2"]').val()).attr('readonly',
                    'true');
                $('input[name="bill_city"]').val($('input[name="city"]').val()).attr('readonly',
                    'true');
                $('input[name="bill_state"]').val($('input[name="state"]').val()).attr('readonly',
                    'true');
                $('input[name="bill_zip"]').val($('input[name="zip"]').val()).attr('readonly',
                    'true');
            } else {
                $('#billingForm').trigger('reset');
                $('#billingForm input').removeAttr('readonly');

            }
        });

        // $('#guestBilling').on('click', function(e) {
        //     $('.cartLoaderImg').css("display", "block");
        //     e.preventDefault();
        //     e.stopImmediatePropagation();
        //     var billing = $('#billingForm').serializeArray();
        //     let validation = true;
        //     let self = $(this);

        //     $.each(billing, function(i, value) {
        //         if (billing[i].name !== 'bill_apt') {
        //             if (billing[i].value == '') {
        //                 let currentName = billing[i].name;
        //                 $(`input[name = ${currentName}]`).css("border", "1px solid #b12704");
        //                 validation = false;
        //                 $('.cartLoaderImg').css("display", "none");
        //                 // self.parent().prev().css("display", "none");
        //             } else {
        //                 $('.cartLoaderImg').css("display", "none");
        //                 let cur_name = billing[i].name;
        //                 // console.log(cur_name);
        //                 $(`input[name = ${cur_name}]`).css("border", "1px solid #e8e8e8");
        //             }
        //         }
        //     });
        //     let response = billing;
        //     if (validation) {
        //         supportAjax({
        //             url: 'cart/checkout/guest-checkout',
        //             data: billing,
        //             method: "post"
        //         }, function(response) {
        //             console.log(response);
        //             $('.cartLoaderImg').css("display", "none");
        //             // console.log(response);
        //             self.parent().prev().css("display", "none");
        //             $.each(billing, function(i, value) {
        //                 let currentName = billing[i].name;
        //                 $(`input[name = ${currentName}]`).css("border",
        //                     "1px solid #e8e8e8");

        //             });
        //             $('#section-payment-method').removeClass('d-none')
        //             $('.billing').removeClass('status-incomplete');
        //             $('.billing').addClass('status-complete');
        //             $('#section-payment-billing').removeClass('d-none');
        //             // $('.billing').removeClass('active');
        //             $('.billing').next().addClass('active');
        //             // $('.billing').next().removeClass('status-incomplete');
        //             // <input type="hidden" class="form-control" name="email" value="${response.email??''}" required>
        //             // <input type="hidden" name="fname" class="form-control" value="${response.fname??''}" required>
        //             // <input type="hidden" class="form-control" name="lname" value="${response.lname??''}" required>
        //             let append = `
        //                                 <form action="" id="billingFormNew" >
        //                                     <input type="hidden" class="form-control" name="bill_add1" value="${response.bill_add1??''}" required>
        //                                     <input type="hidden" class="form-control" name="bill_apt" value="${response.bill_apt??''}" required>
        //                                     <input type="hidden" class="form-control" name="bill_city" value="${response.bill_city??''}" required>
        //                                     <input type="hidden" class="form-control" name="bill_zip" value="${response.bill_state??''}" required>
        //                                     <input type="hidden" class="form-control" name="bill_state" value="${response.bill_zip??''}" required>
        //                                     <div style="padding: 10px 45px;height:70px;">
        //                                         <p class="shipping_address_detail">${response.bill_add1??''}, ${response.bill_add2??''}</p>
        //                                         <p class="shipping_address_detail">${response.bill_city??''}, ${response.bill_state??''} ${response.bill_zip??''}</p>
        //                                     </div>
        //                                 </form>
        //                             `;

        //             $('#billingForm').addClass('hidden');
        //             $('#section-payment-billing').append(append);

        //         }, function(err) {
        //             $('.cartLoaderImg').css("display", "none");
        //             $.each(err.responseJSON.errors, function(i, val) {
        //                 $(document).find(`input[name = ${i}]`).css("border",
        //                     "1px solid #b12704");
        //                 self.parent().prev().css("display", "block");
        //                 self.parent().prev().text(val);
        //             });
        //         });

        //     }
        // })

        // $('#paymentDone').off('click').on('click', function(e) {
        //     e.preventDefault();
        //     e.stopImmediatePropagation();

        //     let paymentdone = $('#payment-form');
        //     paymentdone.validate({
        //         errorPlacement: function(error, element) {},
        //     });

        //     if (paymentdone.valid()) {
        //         let self = $(this);
        //         var personal = $('#personalInfoForm').serializeArray();
        //         var shipping = $('#shippingForm').serializeArray();
        //         var payData = $('#payment-form').serializeArray();
        //         var billing = $('#billingForm').serializeArray();
        //         var shipoptions = $('#shippingOptionForm').serializeArray();

        //         function stripeResponseHandler(status, response) {
        //             if (response.error) {
        //                 loadLoader(false);
        //                 toastr.error(response.error.message);
        //             }
        //             loadLoader(true);
        //             var stripeToken = response['id'];
        //             var userEmail = $('#userEmail').serializeArray();
        //             let offer_discount = $('#hiddenForm').serializeArray();
        //             let data = $('#checkout--form--final :input').serializeArray();
        //             data.push({
        //                 name: 'stripeToken',
        //                 value: stripeToken
        //             });
        //             let url =
        //                 '/order/store-order?view_location=pages.checkout.order_detail&email_template=mail.order_invoice_mail';
        //             // let url = '/order-payment-card';
        //             let validation = true;

        //             if (validation) {
        //                 supportAjax({
        //                     url: url,
        //                     method: 'post',
        //                     data: data
        //                 }, function(response) {
        //                     loadLoader(false);
        //                     supportAjax({
        //                         url: '/shop/clear-cart',
        //                     }, (r) => {
        //                         supportAjax({
        //                             url: 'clear-coupon'
        //                         });
        //                     })
        //                     setTimeout(() => {
        //                         $(document).find('#productContainer').html(
        //                             response);
        //                         $('.cartLoaderImg').css("display", "none");
        //                     }, 1000);
        //                 }, function(err) {
        //                     loadLoader(false);
        //                     if (err.status == "500") {
        //                         self.parent().prev().html("Incorrect payments details.");
        //                         $('.cartLoaderImg').css("display", "none");
        //                         return;
        //                     }
        //                     $(document).find(`#payment-form select*[name]`).css("border",
        //                         "1px solid #e8e8e8");
        //                     $(document).find(`#payment-form input*[name]`).css("border",
        //                         "1px solid #e8e8e8");
        //                     // self.parent().prev().css("display", "block");
        //                     // self.parent().prev().text("");
        //                     let message = "";
        //                     $.each(err.responseJSON.errors, function(key, value) {
        //                         $(document).find(
        //                                 `#payment-form select[name="${key}"]`)
        //                             .css(
        //                                 "border", "1px solid #b12704");
        //                         $(document).find(
        //                                 `#payment-form input[name="${key}"]`)
        //                             .css(
        //                                 "border", "1px solid #b12704");
        //                         message += value + ".<br>";
        //                     });
        //                     // self.parent().prev().html(message);
        //                 }, function() {
        //                     $('body').addClass('loading');
        //                 });
        //             } else {
        //                 $('.cartLoaderImg').css("display", "none");
        //             }
        //         }
        //         var stripe_api_key_publish = $('#strip--publish--key').val();
        //         let expiry = $('.datt').val();
        //         expiry = expiry.split("/")
        //         Stripe.setPublishableKey(stripe_api_key_publish);
        //         Stripe.createToken({
        //             number: $('.card-num').val(),
        //             cvc: ($('.card-cvv').val()).replace("_", ""),
        //             exp_month: expiry[0],
        //             exp_year: expiry[1]
        //         }, stripeResponseHandler);

        //     } else {
        //         loadLoader(false);
        //     }
        // });

        $('.editTabsShipping').on('click', function(e) {
            $('.active').find('form.original').addClass('hidden')
            // $(this).parent().parent().parent().find('.active').addClass('status-incomplete');
            // $(this).parent().parent().siblings().removeClass('active');
            // $(this).parent().parent().addClass('active');
            $('#shippingForm').removeClass('hidden');
            $('#shippingFormNew').remove();
        });
        $('.editTabsShippingOptions').on('click', function(e) {
            $('.active').find('form.original').addClass('hidden')
            // $(this).parent().parent().parent().find('.active').addClass('status-incomplete');
            // $(this).parent().parent().siblings().removeClass('active');
            // $(this).parent().parent().addClass('active');
            $('#shippingOptionForm').removeClass('hidden');
            // $('#shippingFormNew').remove();
        });
        $('.editTabsBilling').on('click', function(e) {
            $('.active').find('form.original').addClass('hidden')
            // $(this).parent().parent().parent().find('.active').addClass('status-incomplete');
            // $(this).parent().parent().siblings().removeClass('active');
            // $(this).parent().parent().addClass('active');
            $('#billingForm').removeClass('hidden');
            $('#billingFormNew').remove();
        });
        $('.editTabsPersonal').on('click', function(e) {
            $('.active').find('form.original').addClass('hidden')
            // $(this).parent().parent().parent().find('.active').addClass('status-incomplete');
            // $(this).parent().parent().siblings().removeClass('active');
            // $(this).parent().parent().addClass('active');
            $('#personalInfoForm').removeClass('hidden');
            $('#personalFromNew').remove();
        });
        /*

        $('#reviewPurchase').on('click', function (e){
            $('.reviewTab').removeClass('status-incomplete');
            $('.reviewTab').addClass('status-complete');
            $('.reviewTab').removeClass('active');
            $('.reviewTab').next().addClass('active');
            $('.reviewTab').next().removeClass('status-incomplete');
        });
        */

    });

    window.addEventListener('popstate', function(e) {
        window.location.href = location.pathname;
    });

    $('#moreAddr').off('click').on('click', function(e) {
        $('#all_shipping_addr').css({
            "display": "block"
        });
        supportAjax({
            url: 'fetch/all_shipping_addr'
        }, function(response) {
            let html = `
                                <thead>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                `;
            $.each(response, function(i, value) {
                html += `
                                    <tr data-toggle="tooltip" title="${value.fname} ${value.lname}">
                                    <td>${value.addr1}</td>
                                    <td>${value.city}</td>
                                    <td>${value.state}</td>
                                    <td>${value.zip}</td>
                                    <td>${value.country}</td>
                                    <td><button class="btn btn-warning btn-xs useAddr" data-address-id="${value.id}">USE</button></td>
                                    </tr>
                                </tbody>`;
            });

            $(document).find('.shipping-table').html(html);
            $("[data-toggle='tooltip']").tooltip({
                placement: 'right'
            });
        });

        $(document).off('click', '.useAddr').on('click', '.useAddr', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let addr_id = $(this).attr('data-address-id');
            supportAjax({
                url: 'user/useAddress/' + addr_id
            }, function(response) {
                if (typeof response != "undefined") {
                    for (let key in response) {
                        $('#shippingForm').find(`input[name = "${key}"]`).val(response[key]);
                        $('#shippingForm').find(
                            `select[name="${key}"] option[value="${response[key]}"]`).attr(
                            'selected', 'selected').siblings('option').removeAttr(
                            'selected');
                    }
                }
            });

        });
    });

    $('#email').off('focusout').on('focusout', function(e) {
        e.preventDefault();
        let email = $(this).val();
        supportAjax({
            url: `/fitgod/frontend/checkemail?email=${email}`
        }, function(resp) {
            $(document).find('.pasword-section-wrapper').addClass('d-flex');
            $(document).find('.pasword-section-wrapper').removeClass('d-none');

        }, function({
            status,
            responseJSON
        }) {
            if (status === 422) {
                $(document).find('.pasword-section-wrapper').removeClass('d-flex');
                $(document).find('.pasword-section-wrapper').addClass('d-none');
                $('#email').css('border-color', '#ddd');
                if (!responseJSON.errors) return;
                const messages = [];
                for (const [key, message] of Object.entries(responseJSON.errors)) {
                    $('#client-email').css('border-color', 'red');
                    messages.push(message);
                    $(`input[name="${key}"]`).siblings(".errorMessage").empty();
                    $(`input[name="${key}"]`).siblings(".errorMessage").append(message);
                }
            } else if (status === 500) {
                $(document).find('.pasword-section-wrapper').removeClass('d-flex');
                $(document).find('.pasword-section-wrapper').addClass('d-none');
            } else {
                $(document).find('.pasword-section-wrapper').addClass('d-flex');
                $(document).find('.pasword-section-wrapper').removeClass('d-none');
            }

        })
    });
</script>
