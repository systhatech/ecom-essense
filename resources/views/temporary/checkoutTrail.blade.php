<?php
 if($data['cart']){
     $cart=$data['cart'];

 }
$isClient = getLoggedInUser() ? true : false;
$client = getLoggedInUser();
?>

<div class="breadcrumb-area gray-bg">

    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active"> Checkout </li>
            </ul>
        </div>
    </div>
</div>

<div class="checkout-area pb-45 pt-65">
    <div id="loader-wrapper ">
        <div id="loader" class="d-none"></div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-lg-7">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div>
                            <div>
                                <h5><span>1.</span> Contact</h5>
                            </div>
                            <!-- <form id="orderGeneralForm" > -->
                            <form id="items">
                                @if($data['cart']!==null)
                                @foreach ($data['cart']['inventories'] as $inventory)
                                <input type="hidden" name="inv_ids[]" value="{{ $inventory['id'] }}">
                                <input type="hidden" name="qtys[]" value="{{ $inventory['reqQuantity'] }}">
                                @endforeach
                                @endif
                            </form>
                            <form id="personalInfoForm">
                                <div id="payment-1">
                                    <div class="panel-body panel panel-default">
                                        <div class="billing-information-wrapper">

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Email Address</label>
                                                        <input type="email" name="email"
                                                            value="{{$isClient?$client['email']:''}}" required>
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Phone Number</label>
                                                        <input type="text" name="phone_no"
                                                            value="{{$isClient?$client['phone_no']:''}}" required>
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>first Name</label>
                                                        <input type="text" name="fname"
                                                            value="{{$isClient?$client['fname']:''}}" required>
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>



                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" name="lname"
                                                            value="{{$isClient?$client['lname']:''}}" required>
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>
                                                @if(!$isClient)

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>password</label>
                                                        <input type="password" name="password" placeholder="Password"
                                                            required>
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>password</label>
                                                        <input type="password" name="password_confirmation"
                                                            placeholder="Password" required>
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>


                                                @endif


                                                <div class="billing-back-btn mt-2 mb-3">

                                                    <div class="billing-btn" id="personal-info">
                                                        <button>Continue</button>
                                                    </div>
                                                </div>



                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="" id="shipping-panel">
                            <div>
                                <h5><span>2.</span> shipping information</h5>
                            </div>
                            <form id="shipping-form">
                                <div id="payment-2" class="d-none">
                                    <div class="panel-body panel panel-default">
                                        <div class="shipping-information-wrapper">

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>shipping Address</label>
                                                        <input type="text" name="add1">
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>city</label>
                                                        <input type="text" name="city">
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>state/province</label>
                                                        <input type="text" name="state">
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>




                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>zip/Postal Code</label>
                                                        <input type="text" name="zip">
                                                        <div class="errorMessage"></div>
                                                    </div>
                                                </div>


                                                <div class="ship-wrapper">
                                                    <div class="single-ship">
                                                        <input type="checkbox" value="address" id="billing-checkbox">
                                                        <label>Use Billing Address</label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="billing-back-btn mt-2 mb-3">

                                                <div class="billing-btn" id="shipping-info">
                                                    <button>Continue</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="billing-panel">
                            <div>
                                <h5><span>3.</span> billing information</h5>
                            </div>
                            <div id="payment-3" class="d-none">
                                <div class="panel-body panel panel-default">
                                    <div class="billing-information-wrapper">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <label>First Name</label>
                                                    <input type="text">
                                                    <div class="errorMessage"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <label>Last Name</label>
                                                    <input type="text">
                                                    <div class="errorMessage"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <label>Billing Address</label>
                                                    <input type="text">
                                                    <div class="errorMessage"></div>
                                                </div>
                                            </div>



                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <label>city</label>
                                                    <input type="text">
                                                    <div class="errorMessage"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <label>State/Province</label>
                                                    <input type="text">
                                                    <div class="errorMessage"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="billing-info">
                                                    <label>Zip/Postal Code</label>
                                                    <input type="text">
                                                    <div class="errorMessage"></div>
                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="billing-back-btn mt-2 mb-3">
                                                        
                                    <div class="show-payment-panel billing-btn" >
                                        <button type="submit">Continue</button>
                                    </div>
                                </div> -->


                        <div>
                            <div>
                                <h5><span>4.</span> payment information</h5>
                            </div>
                            <form id="payment-info-form">
                                <div class="d-none" id="payment-5">
                                    <div class="panel-body panel panel-default">
                                        <div class="payment-info-wrapper">
                                            <div class="ship-wrapper">
                                                <div class="single-ship">
                                                    <input type="radio">
                                                    <label>Check / Money order </label>
                                                </div>
                                                <div class="single-ship">
                                                    <input type="radio" value="dadress">
                                                    <label>Credit Card (saved) </label>
                                                </div>
                                            </div>
                                            <div class="payment-info">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Name on Card </label>
                                                            <input type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-select">
                                                            <label>Credit Card Type</label>
                                                            <select>
                                                                <option>American Express</option>
                                                                <option>Visa</option>
                                                                <option>MasterCard</option>
                                                                <option>Discover</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Credit Card Number </label>
                                                            <input type="text" name="card_no">
                                                            <div class="errorMessage"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="expiration-date">
                                                    <label>Expiration Date </label>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-select">
                                                                <input type="text" name="expm">
                                                                <!-- <select name="expm" value="07"> -->
                                                                <!-- <option>Month</option>
                                                                            <option>January</option>
                                                                            <option>February</option>
                                                                            <option> March</option>
                                                                            <option>April</option>
                                                                            <option> May</option>
                                                                            <option>June</option>
                                                                            <option>July</option>
                                                                            <option>August</option>
                                                                            <option>September</option>
                                                                            <option> October</option>
                                                                            <option> November</option>
                                                                            <option> December</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-select">
                                                                <select name="expy">
                                                                    <option>Year</option>
                                                                    <option>2015</option>
                                                                    <option>2016</option>
                                                                    <option>2017</option>
                                                                    <option>2018</option>
                                                                    <option>2019</option>
                                                                    <option>2020</option>
                                                                    <option>2021</option>
                                                                    <option>2022</option>
                                                                    <option>2023</option>
                                                                    <option>2024</option>
                                                                    <option>2025</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Card Verification Number</label>
                                                            <input type="text" name="card_cvv">
                                                            <div class="errorMessage"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn checkout-btn">
                                                    <button type="submit">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- </form> -->

            <div class="col-lg-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title"> <span>5.</span> <a data-toggle="collapse" data-parent="#faq"
                                href="#payment-6">Order Review</a></h5>
                    </div>
                    <div id="payment-6" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="order-review-wrapper">
                                <div class="order-review">
                                    <?php
                                            $grandTotal=0;
                                            if($data['cart']){
                                                $size=sizeof($cart['inventories']);
                                            }
                                            else{
                                                $size=0;
                                            }
                                            
                                            
                                            ?>
                                    @if($size!==0)
                                    @foreach($cart['inventories'] as $cartProduct)
                                    @php
                                    $name=$cartProduct['name'];
                                    $quantity=$cartProduct['reqQuantity'];
                                    $price=$cartProduct['amount'];
                                    $subTotal= $price * $quantity;
                                    $grandTotal+=$subTotal;
                                    @endphp
                                    <div class="container mt-2" style="border-bottom: 1px solid #ebebeb;">

                                        <div class="row">
                                            <div class="col-lg-7">
                                                <h6>{{$name}}({{$quantity}})</h6>
                                            </div>
                                            <div class="col-lg-3">${{$price}}X{{$quantity}}</div>
                                            <div class="col-lg-2">${{number_format($subTotal,2)}}</div>
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="billing-back-btn">
                                        <span>
                                            Forgot an Item?
                                            <a href="#"> Edit Your Cart.</a>

                                        </span>

                                    </div>
                                    @else
                                    <div class="billing-back-btn">
                                        <span>
                                            No item in your Cart
                                            <a href="/menu/21"> go back to shopping.</a>

                                        </span>

                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row pt-2">
                            <div class="col-lg-9">
                                <h6>Subtotal</h6>
                            </div>
                            <div class="col-lg-3 ">
                                <h6 class="float-right">${{number_format($grandTotal,2)}}</h6>
                            </div>
                        </div>

                        <div class="container pt-1 pb-1 pr-0">
                            <div class="row">
                                <div class="col-lg-9">Shipping</div>
                                <div class="col-lg-3"><span class="float-right">$0.00</span></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9">Tax</div>
                                <div class="col-lg-3"><span class="float-right">$0.00</span> </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-9">Discount</div>
                                <div class="col-lg-3"><span class="float-right">$0.00</span> </div>
                            </div>
                        </div>

                        <div class="row pt-3 " style="border-top: 1px solid #ebebeb;">
                            <div class="col-lg-9">
                                <h5>You Pay</h5>
                            </div>
                            <div class="col-lg-3">
                                <h5 class="float-right">${{number_format($grandTotal,2)}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
            $("[name='email']").blur(function(){
                console.log(JSON.stringify($(this).val()))
                let email =$(this).val()
                
                if(email !== ''){
                    validateEmail(email)
                }
            })
            function validateEmail(email){
                callAjax(
                    {
                        url:'/check-email',
                        method:'post',
                        data:JSON.stringify([{name:'email',value:email}]),
                    },
                    function(response){
                        console.log(response)
                    },
                    function(xhr,status,error){
                        console.log(xhr)
                        throw(error)
                    }
                )
            }
            $('#personal-info').click(function(e){
                e.preventDefault()
                $('#loader').removeClass('d-none')
                const form = $('#personalInfoForm');
                const pidata = $('#personalInfoForm').serializeArray();
                console.log(pidata,form)
                validatePersonalInfo(pidata,form)
            });
                function validatePersonalInfo(pidata,form){
                    callAjax(
                        {
                        url:'/validate-order-general',
                        method:'post',
                        data:pidata
                    },
                    function(response){
                        $('#loader').addClass('d-none')
                        $('#payment-1').addClass('d-none')
                        $('#payment-2').removeClass('d-none')
                        $('#payment-3').removeClass('d-none')
                    },
                    function(xhr,status,error){
                        
                        $('#loader').addClass('d-none')
                        setTimeout(() => {
                            form.find('.errorMessage').empty()
                            for(const [key,message] of Object.entries(xhr.responseJSON.errors)){
                            $(`[name="${key}"]`).parent().children('.errorMessage').empty().append(message)
                        }
                        }, 600);
                    }
                )
                }

                $('#shipping-info').click(function(e){
                e.preventDefault()
                $('#loader').removeClass('d-none')
                const form = $('#shipping-form');
                const data = $('#shipping-form').serializeArray();
                console.log(data)
                validateShippingInfo(data)
            });

            function validateShippingInfo(data,form){
                    callAjax(
                        {
                        url:'/validate-shipping-info',
                        method:'post',
                        data:data
                    },
                    function(response){
                        $('#loader').addClass('d-none')
                        $('#payment-2').addClass('d-none')
                        $('#payment-5').removeClass('d-none')
                    },
                    function(xhr){
                        $('#loader').addClass('d-none')
                        setTimeout(() => {
                            form.find('.errorMessage').empty()
                            for(const [key,message] of Object.entries(xhr.responseJSON.errors)){
                            $(`[name="${key}"]`).parent().children('.errorMessage').empty().append(message)
                        }
                        }, 600);
                        
                        
                    }
                )
                }
            $('#billing-checkbox').click(function(){
           
           if($(this).is(':checked')){
               $('#billing-panel').hide()
           }
           else{
               $('#billing-panel').show() 
           }
       })
       $('.show-payment-panel').click(function(e){
               e.preventDefault();
               $('#payment-1, #payment-2, #payment-3').addClass('d-none');
              $('#payment-5').removeClass('d-none')
          
       
      })
      $('.billing-back').click(function(){
          
          $('#payment-1, #payment-2, #payment-3').removeClass('d-none');
         $('#payment-5').addClass('d-none')
     
  
 })
 $('.checkout-btn').click(function(e){
   e.preventDefault()
   $('#loader').removeClass('d-none')
   const form = $('#payment-info-form')
   const items=$('#items').serializeArray()
   const payment = $('#payment-info-form').serializeArray();
   const shipping=$('#shipping-form').serializeArray();
   const personalInfo=$('#personalInfoForm').serializeArray();
   const data = items.concat(personalInfo).concat(shipping).concat(payment)            
 console.log(data)
  paymentValidate(data,form)
})

function paymentValidate(data,form){
                    callAjax({
                        url:"/place-order",
                        method:'post',
                        data:data,
                    },
                    function(response){
                        $('#loader').addClass('d-none')
                    $('.checkout-area').empty().html(response)
                    },
                    function(xhr,status,err){
                        console.log(err)
                        $('#loader').addClass('d-none')
                        setTimeout(() => {
                            form.find('.errorMessage').empty()
                            for(const [key,message] of Object.entries(xhr.responseJSON.errors)){
                            $(`[name="${key}"]`).parent().children('.errorMessage').empty().append(message)
                        }
                        }, 600);
            }
        )
}

        })
      
</script>