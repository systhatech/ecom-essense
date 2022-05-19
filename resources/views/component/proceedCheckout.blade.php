<?php
$isClient = getLoggedInUser() ? true : false;
$client = getLoggedInUser();
$total = 0;
?>
@foreach ($data['cart']['inventories'] as $product)
    <?php $total += (int) $product['reqQuantity'] * $product['amount']; ?>
@endforeach
<style>
    .d-none {
        display: none;
    }

    @media only screen and (max-width: 1000px) {
        .responsivePC {
            flex: none;
            max-width: 100%;
        }
    }

</style>

    <div class="container" id="proceedCheckoutSuccess">
        <div class="row">
            <div class="col-12 col-md-7 responsivePC">
                <div class="order-details-confirmation">
                    <ul class="order-details-form mb-4">
                        <div class="checkout_details_area mt-50 clearfix">
                            <form id="PersonalForm">
                                @csrf
                                @if ($data['cart'])
                                    @foreach ($data['cart']['inventories'] as $inventory)
                                        <input type="hidden" name="inv_ids[]" value="{{ $inventory['id'] }}">
                                        <input type="hidden" name="qtys[]" value="{{ $inventory['reqQuantity'] }}">
                                    @endforeach
                                @endif
                                <div class="col-12 mb-3">
                                    <div class="cart-page-heading mb-30">
                                        <h5>CONTACT INFO
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <i class="fa fa-edit " id="editContactTab"></i>
                                        </h5>
                                    </div>
                                </div>

                                <div class="row" id="personalInfoForm">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name">First Name <span>*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="fname"
                                            value="{{ $isClient ? ($client['fname'] ? $client['fname'] : '') : '' }}"
                                            required>
                                        <div class="errorMessage"></div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name">Last Name <span>*</span></label>
                                        <input type="text" class="form-control" id="last_name" name="lname"
                                            value="{{ $isClient ? ($client['lname'] ? $client['lname'] : '') : '' }}"
                                            required>
                                        <div class="errorMessage"></div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="email_address">Email Address <span>*</span></label>
                                        <input type="email" class="form-control" id="email_address" name="email"
                                            value="{{ $isClient ? ($client['email'] ? $client['email'] : '') : '' }}"
                                            required>
                                        <div class="errorMessage"></div>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="phone_no">Phone No <span>*</span></label>
                                        <input type="number" class="form-control" id="phone_no" name="phone_no"
                                            min="0"
                                            value="{{ $isClient ? ($client['phone_no'] ? $client['phone_no'] : '') : '' }}"
                                            required>
                                        <div class="errorMessage"></div>
                                    </div>
                                    @if (!$isClient)
                                        <div class="col-12 mb-3 d-none passwordf">
                                            <label for="password">Password <span>*</span></label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                required>
                                            <div class="errorMessage"></div>
                                        </div>
                                        <div class="col-12 mb-3 d-none cpasswordf">
                                            <label for="password_confirmation">Confirm Password <span>*</span></label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" required>
                                            <div class="errorMessage"></div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row" style="margin: 15px 0 0 0; padding: 15px; ">
                                    <button class="btn essence-btn" id="continueToAddress">Continue to address</button>
                                </div>
                            </form>
                            <form id="shippingForm">
                                {{-- @csrf --}}
                                <div class="col-12 mb-3">
                                    <div class="cart-page-heading mb-30">
                                        <h5>CONTACT & SHIPPING INFO
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <i class="fa fa-edit" id="editShippingtTab"></i>
                                        </h5>
                                    </div>
                                </div>
                                <div class="row d-none" id="contactInfo">
                                    <div class="col-12 mb-3">
                                        <label for="street_address">Address <span>*</span></label>
                                        <input type="text" class="form-control mb-3" id="street_address" name="add1"
                                            value="{{ $isClient ? ($client['address'] ? $client['address']['city'] : '') : '' }}   ">
                                        <div class="errorMessage"></div>

                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="city">Town/City <span>*</span></label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            value="{{ $isClient ? ($client['address'] ? $client['address']['city'] : '') : '' }}">
                                        <div class="errorMessage"></div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="state">State/Province <span>*</span></label>
                                        <input type="text" class="form-control" id="state" name="state"
                                            value="{{ $isClient ? ($client['address'] ? $client['address']['state'] : '') : '' }}">
                                        <div class="errorMessage"></div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="postcode">Zip/Postal Code <span>*</span></label>
                                        <input type="text" class="form-control" id="postcode" name="zip"
                                            value="{{ $isClient ? ($client['address'] ? $client['address']['zip'] : '') : '' }}">
                                        <div class="errorMessage"></div>
                                    </div>

                                    <div class="row" style="margin: 15px 0 0 0; padding: 15px; ">
                                        <button class="btn essence-btn" id="continueToPayment">Continue to
                                            Payment</button>

                                    </div>
                                </div>
                            </form>
                            <form action="" id="paymentForm">
                                {{-- @csrf --}}
                                <div class="col-12 mb-3">
                                    <div class="cart-page-heading mb-30">
                                        <h5>PAYMENT INFO </h5>
                                    </div>
                                </div>
                                <div class="row d-none" id="paymentInfo">
                                    <div class="col-12 mb-3">
                                        <label for="postcode">Credit Card Number <span>*</span></label>
                                        <input type="text" class="form-control" name="card_no" id="card_no"
                                            placeholder="9999 9999 9999 9999">
                                        <div class="errorMessage"></div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="postcode">Expiration Month<span>*</span></label>
                                        <input type="text" class="form-control" name="expm" id ="expm">
                                        <div class="errorMessage"></div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="postcode">Expiration year<span>*</span></label>
                                        <input type="text" class="form-control" name="expy" id="expy">
                                        <div class="errorMessage"></div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="postcode">CVV<span>*</span></label>
                                        <input type="text" class="form-control" name="card_cvv" id="card_cvv">
                                        <div class="errorMessage"></div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button class="btn essence-btn" id="placeOrder">Place order</button>
                                        <label for="term and condition">By clicking Submit Order, you acknowledge you
                                            have read and agreed to our Terms of Use & Privacy Policy.</label>

                                    </div>
                                </div>

                            </form>
                        </div>

                    </ul>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-5 ml-lg-auto responsivePC">
                <div class="order-details-confirmation">
                    <a href="/checkout" class="btn essence-btn">Edit Cart</a>
                    <div style="box-shadow: 1px 1px 1px 1px #888888;">
                        <div style="margin: 20px">
                            <p id="dropList"> Item List<i class="fa fa-angle-down"></i></p>
                            <ul class="order-details-form mb-4" id="checkoutOrderPriceDetailList">

                            </ul>
                        </div>
                    </div>
                    <ul class="order-details-form mb-4" id="checoutOrderPriceDetail">

                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
<script>
    getCart();
    $("#dropList").on("click", function() {
        $("#checkoutOrderPriceDetailList").toggle();
    })
    //email validation in api
    var client = false;
    $("[name='email']").on("blur", function() {
            let email = $(this).val();
            if(email !== null){
                validateEmailInApi(email);
            }
    })
        function validateEmailInApi(email)
        {
            let dataSt = JSON.stringify([{name:'email',value:email}]) ; 
            $.ajax({
                url:'/check-email',
                method:'POST',
                contentType: 'application/json',                
                data: dataSt,
                success: function(response){
                    console.log(response);
                    if(response.status===202){
                        $("[name='email']").parent().children('.errorMessage').empty();                       
                            client = true
                            $('.passwordf').removeClass('d-none')    
                            $('.cpasswordf').removeClass('d-none')    
                    }
                },
                error: function(err){
                // if(xhr.responseJSON.status===422){
                //   $("[name='email']").parent().children('.errorMessage').empty().append(xhr.responseJSON.message)
                // }
                }
            });
        }
    //end validataion 
    $("#placeOrder").off('click').on("click", function(e) {
        e.preventDefault();
        function stripeResponseHandler(status, response){
            if (response.error) {
                toastr.error(response.error.message);
                return;
            }
            var stripeToken = response['id'];
            console.log(stripeToken);
            const form = $('#orderGeneralForm');
            let data = $('#PersonalForm').serializeArray();
            let addressFormdata = $('#shippingForm').serializeArray();
            let paymentFormdata = $('#paymentForm').serializeArray();
            let newData = data.concat(addressFormdata).concat(paymentFormdata);
            newData.push({
                name: 'stripeToken',
                value: stripeToken
            });
            console.log(newData);
            return;
    
            supportAjax({
                    url: '/place-order',
                    method: "POST",
                    data: newData,
                }, (respn) => {
                    console.log(respn);
                    $("#proceedCheckoutSuccess").empty().html(respn);
                },
                ({
                    status,
                    responseJSON
                }) => {
                    if (status === 422) {
                        form.find("input[name], textarea[name]").css("border-color", "#ddd");
    
                        $(`input[name]`).siblings(".errorMessage").empty();
                        if (!responseJSON.errors) return;
                        const messages = [];
                        for (const [key, message] of Object.entries(responseJSON.errors)) {
                            $('#paymentForm').find(`input[name="${key}"]`).css("border-color", "#f44336");
                            $('#paymentForm').find(`textarea[name="${key}"]`).css("border-color", "#f44336");
                            messages.push(message);
                            $(`[name="${key}"]`).parent().children(".errorMessage").empty().append(message);
                        }
                    }
                }
            );
        }
        var stripe_api_key_publish =
        'pk_test_51JO2P9DzF9grme2187tUaANfi1wGc1NSS1zNIiKi50GlMeUP7bwikHM1OvjcF1bYffajbfg6U9JPVNpAKFkoQBrO005X5Q9Hvo';
        Stripe.setPublishableKey(stripe_api_key_publish);
        Stripe.createToken({
            number: $('#card_no').val(),
            cvc: ($('#card_cvv').val()).replace("_", ""),
            exp_month: $('#expm').val(),
            exp_year:$('#expy').val(),
        }, stripeResponseHandler);
    })


    $('#continueToAddress').on('click', function(e) {
        e.preventDefault();
        // e.stopImmediatePropagation();
        let personalInfo = $('#PersonalForm').serializeArray();
        supportAjax({
            url: '/order/validate/personal',
            method: "POST",
            data: personalInfo
        }, (resp) => {
            $('#personalInfoForm').addClass('d-none');
            $('#continueToAddress').addClass('d-none');
            $('#contactInfo').removeClass('d-none');
        }, ({
            status,
            responseJSON
        }) => {
            if (status === 422) {
                $('#PersonalForm').find("input[name], textarea[name]").css("border-color", "#ddd");

                $(`input[name]`).siblings(".errorMessage").empty();
                if (!responseJSON.errors) return;
                const messages = [];
                for (const [key, message] of Object.entries(responseJSON.errors)) {
                    $('#PersonalForm').find(`input[name="${key}"]`).css("border-color", "#f44336");
                    $('#PersonalForm').find(`textarea[name="${key}"]`).css("border-color", "#f44336");
                    messages.push(message);
                    $(`[name="${key}"]`).parent().children(".errorMessage").empty().append(message);
                }
            }
        })
    })
    $('#continueToPayment').on('click', function(e) {
        e.preventDefault();
        let shippingForm = $('#shippingForm').serializeArray();
        supportAjax({
            url: '/order/validate/contact',
            method: 'POST',
            data: shippingForm
        }, (resp) => {
            $('#personalInfoForm').addClass('d-none');
            $('#contactInfo').addClass('d-none');
            $('#paymentInfo').removeClass('d-none');
        }, ({
            status,
            responseJSON
        }) => {
            if (status === 422) {
                $('#shippingForm').find("input[name], textarea[name]").css("border-color", "#ddd");

                $(`input[name]`).siblings(".errorMessage").empty();
                if (!responseJSON.errors) return;
                const messages = [];
                for (const [key, message] of Object.entries(responseJSON.errors)) {
                    $('#shippingForm').find(`input[name="${key}"]`).css("border-color", "#f44336");
                    $('#shippingForm').find(`textarea[name="${key}"]`).css("border-color", "#f44336");
                    messages.push(message);
                    $(`[name="${key}"]`).parent().children(".errorMessage").empty().append(message);
                }
            }
        });


    })

    $('#editContactTab').on('click', function(e) {
        e.preventDefault();
        $('#personalInfoForm').removeClass('d-none');
        $('#continueToAddress').removeClass('d-none');
        $('#contactInfo').addClass('d-none');
        $('#paymentInfo').addClass('d-none');

    })
    $('#editShippingtTab').on('click', function(e) {
        e.preventDefault();
        $('#personalInfoForm').addClass('d-none');
        $('#contactInfo').removeClass('d-none');
        $('#paymentInfo').addClass('d-none');

    })

    function stripeResponseHandler(status, response) {
        if (response.error) {           
            toastr.error(response.error.message);
        }        
        var stripeToken = response['id'];
        var userEmail = $('#email_address').serializeArray();
        // let offer_discount = $('#hiddenForm').serializeArray();
        let data = $('#paymentInfo').serializeArray();
        data.push({
            name: 'stripeToken',
            value: stripeToken
        });
        let url =
            '/order/store-order?view_location=pages.checkout.order_detail&email_template=mail.order_invoice_mail';
        // let url = '/order-payment-card';
        let validation = true;

        if (validation) {
            supportAjax({
                url: url,
                method: 'post',
                data: data
            }, function(response) {
                
                supportAjax({
                    url: '/shop/clear-cart',
                }, (r) => {
                    supportAjax({
                        url: 'clear-coupon'
                    });
                })
                setTimeout(() => {
                    $(document).find('#productContainer').html(
                        response);
                    $('.cartLoaderImg').css("display", "none");
                }, 1000);
            }, function(err) {
               
                alert('stripe error');
                if (err.status == "500") {
                    // self.parent().prev().html("Incorrect payments details.");
                    // $('.cartLoaderImg').css("display", "none");
                    return;
                }
                $(document).find(`#payment-form select*[name]`).css("border",
                    "1px solid #e8e8e8");
                $(document).find(`#payment-form input*[name]`).css("border",
                    "1px solid #e8e8e8");
                // self.parent().prev().css("display", "block");
                // self.parent().prev().text("");
                let message = "";
                $.each(err.responseJSON.errors, function(key, value) {
                    $(document).find(
                            `#payment-form select[name="${key}"]`)
                        .css(
                            "border", "1px solid #b12704");
                    $(document).find(
                            `#payment-form input[name="${key}"]`)
                        .css(
                            "border", "1px solid #b12704");
                    message += value + ".<br>";
                });
                // self.parent().prev().html(message);
            }, function() {
                $('body').addClass('loading');
            });
        } else {
            $('.cartLoaderImg').css("display", "none");
        }
    }
    // var stripe_api_key_publish = $('#strip--publish--key').val();
   
</script>
