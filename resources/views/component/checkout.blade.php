<style>
    @media only screen and (max-width: 1000px) {
            .responsivePC {
            flex: none;
            max-width: 100%;           
        }
    }
    .d-none1 {
    display: none;
    }

    .respShopItem{
        
        display: flex;        
        justify-content: space-between;
       
    }

</style>
<?php
$isClient = getLoggedInUser() ? true : false;
$client = getLoggedInUser();
$total = 0;
?>
@foreach ($data['cart']['inventories'] as $product)
<?php $total += (int) $product['reqQuantity'] * $product['amount']; ?>
@endforeach
<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg); margin-top:75px;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2>Checkout</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="checkout_area section-padding-80 " id="checkoutContainer">
    <div class="container">
        <div class="row ">        

            <div class="col-12 col-md-7 responsivePC" >
                <div class="order-details-confirmation">
                    <div class="cart-page-heading">
                        <h5>Shop Item</h5>
                    </div>
                    <ul class="order-details-form mb-4" id="checkoutOrderDetail">  
                     </ul>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-5 ml-lg-auto responsivePC">
                <div class="order-details-confirmation">
                    <ul class="order-details-form mb-4"             id="checoutOrderPriceDetail">                     
                    </ul>
                    <a href="#" class="btn essence-btn" id="checkoutButton">Check Out</a>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
    getCart(); 
    getWish();
    $("#checkoutButton").on('click',function(){
        supportAjax({
            url: '/checkout/proceed',
        }, (resp) => {
            $('#checkoutContainer').empty().html(resp)
        }, (err) => {
            console.log(err);
        })
    })
</script>



{{-- checkout old --}}

