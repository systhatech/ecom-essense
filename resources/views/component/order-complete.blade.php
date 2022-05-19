
{{-- <section class="py-4">
    <div class="container">
        <div class="card py-3 mt-sm-3">
            <div class="card-body text-center">
                <h1 class="h4 pb-3">ORDER PLACED</h1>
                <h6>Order#. <span class="fw-medium">{{ $data['order']['order_no'] }}.</span></h6>
                <h2 class="h4 pb-3">Thank you for your order!</h2>
                <p class="fs-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>
                <p class="fs-sm mb-2">Make sure you make note of your order number, which is <span class="fw-medium">{{ $data['order']['order_no'] }}.</span>
                        
                </p>
                <p class="fs-sm">You will be receiving an email shortly with confirmation of your order. You can
                        now:
                </p><a class="btn btn-light rounded-0 mt-3 me-3" href="/">Go back shopping</a><a
                    class="btn btn-white rounded-0 mt-3" href="javascript:;"><i class='bx bx-map'></i>Track order</a>
            </div>
        </div>
    </div>
</section> --}}

{{-- @dd($data['order']['items']) --}}
{{-- <section class="py-4">
    <div class="container">
        <div class="card py-3 mt-sm-3">
            <div class="card-body text-center">
                <h1 class="h4 pb-3">ORDER PLACED</h1>
                <h6>Order#. 
                    <span class="fw-medium">
                    {{ $data['order']['order_no'] }}.</span></h6>
                <h2 class="h4 pb-3">Thank you for your order!</h2>
                <p class="fs-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>
                <p class="fs-sm mb-2">Make sure you make note of your order number, which is
                    <span class="fw-medium">
                        {{$data['order']['order_no'] }}.
                    </span>

                </p>
                <p class="fs-sm">You will be receiving an email shortly with confirmation of your order.
                </p>
                <p class="fs-sm mb-2">Here's your order Summery. An email is sent to your email address with following
                    details:</p>
                <div class="top_catagory_area section-padding-80 clearfix">
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Single Catagory -->
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="single_catagory_area " style="background-color: rgb(225 227 229)">
                                    <h2 class="h4 pb-3">Personal Infromation</h2>
                                    <p>{{$data['client']['fullName']}}</p>
                                    <p>{{$data['client']['email']}}</p>
                                    <p>{{$data['client']['phone_no']}}</p>
                                </div>
                            </div>
                            <!-- Single Catagory -->
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="single_catagory_area " style="background-color: rgb(225 227 229)">
                                    <h2 class="h4 pb-3">Shoping Info</h2>
                                    <p>{{$data['shipping_address']['city']}}</p>
                                    <p>{{$data['shipping_address']['state']}}</p>
                                </div>
                            </div>
                            <!-- Single Catagory -->
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="single_catagory_area " style="background-color: rgb(225 227 229)">
                                    <h2 class="h4 pb-3">Billing Address</h2>
                                    <p>{{$data['billing_address']['city']}}</p>
                                    <p>{{$data['billing_address']['state']}}</p>
                                    <p>{{$data['billing_address']['add1']}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <a class="btn btn-light rounded-0 mt-3 me-3" href="/">Go back shopping</a><a
                    class="btn btn-white rounded-0 mt-3" href="javascript:;"><i class='bx bx-map'></i>Track order</a>
            </div>
        </div>
    </div>
</section> --}}

<section class="py-4">
    <div class="container">
        <div class="card py-3 mt-sm-3">
            <div class="card-body text-center">
                <h1 class="h4 pb-3">ORDER PLACED</h1>
                 <h6>Order#. <span class="fw-medium">{{ $data['order']['order_no'] }}.</span></h6> 
                <h2 class="h4 pb-3">Thank you for your order!</h2>
                <p class="fs-sm mb-2">Your order has been placed and will be processed as soon as possible.</p>               
                <p class="fs-sm">You will be receiving an email shortly with confirmation of your order.</p>
                <p class="fs-sm mb-2">Here's your order Summery. An email is sent to your email address with following
                    details:</p>
                <div class="top_catagory_area section-padding-30 clearfix">
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Single Catagory -->
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="single_catagory_area "
                                    style="padding-top: 20px ;background-color: rgb(225 227 229)">
                                    <h2 class="h4 pb-3">Personal Infromation</h2>
                                   
                                     <p>{{$data['client']['fullName']}}</p>
                                    <p>{{$data['client']['email']}}</p>
                                    <p>{{$data['client']['phone_no']}}</p> 
                                </div>
                            </div>
                            <!-- Single Catagory -->
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="single_catagory_area "
                                    style="padding-top: 20px ;background-color: rgb(225 227 229)">
                                    <h2 class="h4 pb-3">Shipping Info</h2>
                                     <p>{{$data['shipping_address']['city']}}</p>
                                    <p>{{$data['shipping_address']['state']}}</p>
                                   
                                </div>
                            </div>
                            <!-- Single Catagory -->
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="single_catagory_area "
                                    style="padding-top: 20px ;background-color: rgb(225 227 229); ">
                                    <h2 class="h4 pb-3">Billing Address</h2>
                                    <p>{{$data['billing_address']['city']}}</p>
                                    <p>{{$data['billing_address']['state']}}</p>
                                    <p>{{$data['billing_address']['add1']}}</p>
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top_catagory_area clearfix" style="padding-top :20px; ">
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Single Catagory -->
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="single_catagory_area responsiveH"
                                    style="padding-top: 20px;background-color: rgb(225 227 229)">
                                    <h2 class="h4 pb-3">Products</h2>
                                    {{-- content --}}
                                    <div class="col-12 ">
                                        <div class="order-details-confirmation" style="padding: 10px;">
                                            <ul class="order-details-form mb-4">
                                                @foreach ($data['order']['items'] as $item)
                                                                                             
                                                <li>
                                                    <img src="https://shop.systha.com/getFile?path=${path}&file={{$item['inventory']['product']['thumbnail']['file_name']}}" class="cart-thumb" alt="" style="height:100%; width:36px">
                                                    <span>{{$item['inventory']['product']['name']}}({{$item['quantity']}}) </span>
                                                    <span><div> {{number_format($item['item_price'],2)}} X {{$item['quantity']}}</div>
                                                    @php
                                                        $price = $item['item_price'];
                                                        $quantity = $item['quantity'];
                                                        $total = $price * $quantity;
                                                    @endphp
                                                    {{number_format($total,2)}}
                                                    </span>
                                                 </li>
                                                @endforeach
                                    
                                            </ul>    
                                        </div>
                                    </div>
                                    {{-- content --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="top_catagory_area clearfix" style="padding-top :20px; ">
                    <div class="container">
                        <div class="row justify-content-center">
                            <!-- Single Catagory -->
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="single_catagory_area " style="padding-top: 20px;background-color: rgb(225 227 229)">
                            
                                    <div class="col-12 ">
                                        <div class="order-details-confirmation" style="padding: 10px;">
                                            <ul class="order-details-form mb-4">
                                                <li>
                                                    <div style="float: left;width: 50%;text-align:left !important; padding-left:40px">
                                                        <p>sub_total</p>
                                                    </div>
                                                    <div style="float: right;width: 50%;text-align:left !important; padding-left:40px">
                                                        <p style="float: right; padding-right: 20px ">${{number_format($data['order']['total_amount'],2)}}</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div style="float: left;width: 50%;text-align:left !important; padding-left:40px">
                                                        <h6>Total</h6>
                                                    </div>
                                                    <div style="float: right;width: 50%;text-align:left !important; padding-left:40px">
                                                        <h6 style="float: right; padding-right: 20px ">${{number_format($data['order']['total_amount'],2)}}</h6>
                                                    </div>
                                                </li>
                                            </ul>
                            
                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>

                <a class="btn btn-light rounded-0 mt-3 me-3" href="/">Go back shopping</a>
                <a class="btn btn-light rounded-0 mt-3" href="javascript:;"><i class='bx bx-map'></i>Track order</a>
            </div>
        </div>
    </div>
</section>

<script>
    clearCookie();
    function clearCookie() {
       $.ajax({
            url:'/clear-cart',
            success:function() {
                getCart();
            }, 
            error :function(e){
                console.log(e);
            },
        })
    }
</script>
<style>
    @media only screen and (max-width: 1000px) {
        .single_catagory_area {
            height: 270px;
        }

        .responsiveH {
            min-height: 350px;
        }
    }
</style>