{{-- @dd($data['data']['products']) --}}
<div class="col-12 col-md-8 col-lg-9">
    <div class="shop_grid_product_area">
        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-flex align-items-center justify-content-between">
                    <!-- Total Products -->
                    <div class="total-products">
                        @php
                            $len =$data['data']['products']                            
                        @endphp    
                        <p><span id="productCount">{{count($len)}}
                        </span> products found</p>
                    </div>
                    <!-- Sorting -->
                    <div class="product-sorting d-flex">
                        <p>Sort by:</p>
                        <form action="#" method="get">
                            <select name="select" id="sortByselect">
                                <option value="value">Highest Rated</option>
                                <option value="value">Newest</option>
                                <option value="value">Price: $$ - $</option>
                                <option value="value">Price: $ - $$</option>
                            </select>
                            <input type="submit" class="d-none" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($data['data']['products'] as $key => $offer)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-wrapper">
                            <div class="product-img">
                                <a href="/products/{{$offer['id']}}" target="_blank">
                                    <img src="https://shop.systha.com/getFile?path=product/thumbnail&file={{$offer['thumbnail'] ? $offer['thumbnail']['file_name']: ""}}"
                                        alt="">
                                    <img class="hover-img"
                                        src="https://shop.systha.com/getFile?path=product/thumbnail&file={{$offer['thumbnail'] ? $offer['thumbnail']['file_name']: ""}}"
                                        alt="">
                                        <div class="product-badge offer-badge">
                                            <span>-{{$offer['offers']['0']['offer_value']}}%</span>
                                        </div>
                    
                                </a>
                            </div>
                            <div class="product-description">
                                <span>{{$offer['brand'] ?? '-'}} </span>
                                <a href="/products/{{$offer['id']}}" target="_blank">
                                    <h6>{{$offer['name']}}</h6>
                                </a>
                                @php
                                    $offerDiscount = $offer['offers']['0']['offer_value'];
                                    $oldPrice =   $offer['inventories']['0']['amount'] ;  
                                    $discountedPrice = $oldPrice - (($oldPrice * $offerDiscount) / 100 );
                                @endphp
                                <p class="product-price"><span class="old-price">${{number_format($oldPrice , 2)}}</span>${{number_format($discountedPrice , 2)}}</p>
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="/products/{{$offer['id']}}" target="_blank" class="btn essence-btn">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                </div>
    </div>
</div>
</section>