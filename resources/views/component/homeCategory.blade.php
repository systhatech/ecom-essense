<div class="col-12 col-md-8 col-lg-9">
    <div class="shop_grid_product_area">
        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-flex align-items-center justify-content-between">
                    <!-- Total Products -->
                    <div class="total-products">
                        <p><span> 
                            @php
                                $countProduct = count($data['products']);
                            @endphp
                            {{$countProduct}}
                            </span> products found</p>
                    </div>                   
                </div>
            </div>
        </div>
        <div class="row" id="homeCategoryProduct">
            @foreach ($data['products'] as $key => $product)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-wrapper">
                            <div class="product-img">
                                <a href="/products/{{$product['id']}}" target="_blank">
                                    <img src="{{config('app.server_url')}}/getFile?path=product/thumbnail&file={{$product['thumbnail']['file_name']}}"
                                        alt="">
                                    <img class="hover-img"
                                        src="{{config('app.server_url')}}/getFile?path=product/thumbnail&file={{$product['thumbnail']['file_name']}}"
                                        alt="">
                    
                                </a>
                            </div>
                            <div class="product-description">
                                <span>{{$product['brand']['name']??'-'}}</span>
                                <a href="/products/{{$product['id']}}" target="_blank">
                                    <h6>{{$product['name']}}</h6>
                                </a>
                                <p class="product-price">${{number_format($product['inventories']['0']['amount'],2)}}</p>
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="/products/{{$product['id']}}" target="_blank" class="btn essence-btn">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            @endforeach
            
        </div>       
    </div>    
</div>
</div>
</div>
    {{-- @dd($data['products']) --}}


