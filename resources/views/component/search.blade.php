            <div class="col-12 col-md-8 col-lg-9">
                <div class="shop_grid_product_area">
                    <div class="row">
                        <div class="col-12">
                            <div class="product-topbar d-flex align-items-center justify-content-between">
                                <!-- Total Products -->
                                <div class="total-products">
                                    <p><span>{{count($searchData['data'])}}</span> products found</p>
                                </div>
                               
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        {{-- @dd($searchData) --}}
                        @php
                            unset($searchData['data']['header_menus']);
                            unset($searchData['data']['footer-menus']);
                        @endphp
                        {{-- @dd($searchData) --}}
                        @if ($searchData == null)
                                <h6> No product found</h6>
                        @else 
                        @foreach ($searchData['data'] as $product)
                        <!-- Single Product -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    {{-- <a href="/single-product-details/product-id"><img src="/img/product-img/product-1.jpg" alt=""></a> --}}
                                    <!-- Hover Thumb -->
                        
                                    <a href="/products/{{$product['id']}}"><img
                                            src="https://shop.systha.com/getFile?path=product/thumbnail&file={{isset($product['thumbnail']) ? $product['thumbnail']['file_name'] : ''}}"
                                            alt=""></a>
                                    <a href="/products/{{$product['id']}}" target="_blank"><img class="hover-img"
                                            src="https://shop.systha.com/getFile?path=product/thumbnail&file={{isset($product['thumbnail']) ? $product['thumbnail']['file_name'] : ''}}"
                                            alt=""></a>
                        
                                    <!-- Product Badge -->
                                    {{-- <div class="product-badge offer-badge">
                                        <span>-30%</span>
                                    </div>
                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div> --}}
                                </div>
                        
                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>{{$product['brand']['name']?? '-'}}</span>
                                    <a href="/products/{{$product['id']}}" target="_blank">
                                        <h6>{{$product['name']}}</h6>
                                    </a>
                                    <p class="product-price">${{number_format($product['inventories']['0']['amount'] , 2)}}</p>
                        
                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Add to Cart -->
                                        <div class="add-to-cart-btn">
                                            <a href="/products/{{$product['id']}}" class="btn essence-btn" target="_blank">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                 
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</section>