<style>
    @media only screen and (max-width: 990px) {
        
        .responsiveWish>div>ul>li>div{         
            display: flex;
            flex-direction: column;
            align-items: flex-start;     
        }
        .responsiveWish>div>ul>li>div button{
           width: 100px;
        }
      
    }
    @media only screen and (max-width:769px){
        .buttonContent{
            width: 100%; 
            display: grid;
            grid-template-columns: repeat(1,1fr);
            margin-top: 5px;
        }
        .buttonContent button {
            margin-bottom:5px; 
        }
       
    }
    @media only screen and (max-width:400px){
        /* .buttonContent{
            flex-basis: 100%;
        }
        .imageContent {
            flex-basis: 30%;
        }
        .nameContent {
            flex-basis: 70%;
        } */
       
    }
</style>
<div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg); margin-top:75px;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2>Wish List</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Checkout Area Start ##### -->
<div class="checkout_area section-padding-80 ">
    <div class="container">
        <div class="row ">
            <div class="col-12 col-md-12 responsiveWish">
                <div class="order-details-confirmation">
                    <ul class="order-details-form mb-4" id="wishlist_item">
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    getCart(); 
    getWish();
</script>
