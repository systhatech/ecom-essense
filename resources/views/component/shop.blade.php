{{-- @dd($data) --}}
<div class="col-12 col-md-8 col-lg-9">
    <div class="shop_grid_product_area">
        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-flex align-items-center justify-content-between">
                    <!-- Total Products -->
                    <div class="total-products">
                        <p>
                          <span id="productCount"></span> products found</p>
                    </div>
                    <!-- Sorting -->
                    {{-- <div class="product-sorting d-flex">
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
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="row" id="productContainer">
        </div>    
         {{-- <div class="sub-menu">
            <div class="col-6">
                <h6>Sub Menu</h6>
            </div>

            @forelse($data['data']['sub_menus'] as $item)
                @if ($item['sub_menus'])
                    @foreach ($item['sub_menus'] as $subItem)
                        {{ $subItem }}
                    @endforeach
                @else
                    {{ $item['id'] }}
                @endif
            @empty
                {{ $item['id'] }}
            @endforelse
            </section>
        </div> --}}
    </div>
    <!-- Pagination -->
    <nav aria-label="navigation" >
        <ul class="pagination mt-50 mb-70" id="productsPaginator">
            
        </ul>
    </nav>

</div>
</div>
</div>
@if (isset($data['data']) && strtolower($data['data']['menu_name']) == 'shop')
    <script>
        getProducts();   
        
        function paginateProducts (url) {
            supportAjax({
                url: url,
                },
                (response)=>{
                    getProductTemplete(response)
                    
                });
        }
        function getProducts() {
            supportAjax({
                    url: '/products',
                    method: 'get',
                    datatype: 'application/json'
                }, (response) => {
                    getProductTemplete(response)
                },
    
            );
        }
        //function to get products
            function getProductTemplete(response){
               
            $('#productCount').html(response.data.data.length);
            if (response.data.data.length) {

            const {meta, data : metaProduct} = response.data;
        
            const products = (response.data.data).map(product => {
            const price = product.inventories.reduce((acc, curr) => {
            return acc + curr.amount;
            }, 0);
            const avg = price / (product.inventories.length);
            return `
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="single-product-wrapper">
                    <div class="product-img">
                        <a href="/products/${product.id}" target="_blank">
                            <img src="https://shop.systha.com/getFile?path=product/thumbnail&file=${product.thumbnail?.file_name || ''}"
                                alt="">
                            <img class="hover-img"
                                src="https://shop.systha.com/getFile?path=product/thumbnail&file=${product.thumbnail?.file_name || ''}"
                                alt="">
            
                        </a>
                    </div>
                    <div class="product-description">
                        <span>${product.brand?.name || '-'}</span>
                        <a href="/products/${product.id}" target="_blank">
                            <h6>${product.name}</h6>
                        </a>
                        <p class="product-price">$${avg.toFixed(2)}</p>
                        <div class="hover-content">
                            <!-- Add to Cart -->
                            <div class="add-to-cart-btn">
                                <a href="/products/${product.id}" target="_blank" class="btn essence-btn">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
            }).join('');
            $('#productContainer').html(products);
                    
                    let pages = "";
                    for(let index=1; index <= meta.pages; index++){                        
                        if(index!= meta.page){                        
                            pages+=`
                                 <li class="page-item goto-page " data-page="${index}" data-current="${meta.page}" data-max="${meta.pages}" data-count="${meta.perpage}">
                                    <a class="page-link ">${index}</a></li>
                                `
                                // <li class="page-item d-none d-sm-block"><a class="page-link goto-page" data-page="${index}" data-current="${meta.page}" data-max="${meta.pages}" data-count="${meta.perpage}">${index}</a>
                                // </li>
                        }
                        else {
                            pages+=` 
                            <li class="page-item active goto-page" data-page="${index}" data-current="${meta.page}" data-max="${meta.pages} " data-count="${meta.perpage}" ><a class="page-link ">${index == meta.page ? index: index}</a></li>
                            `
                            // <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link goto-page"
                            //         data-page="${index}" data-current="${meta.page}" data-max="${meta.pages}"
                            //         data-count="${meta.perpage}">${index}<span class="visually-hidden">${index == meta.page ? index :
                            //             index}</span></span>
                            // </li>;
                        }
                    }

                        let product_paginator = `
                            <li class="page-item previous-page" data-page="${meta.page}" data-current="${meta.page}" data-max="${meta.pages}" data-count="${meta.perpage}"><a class="page-link " href="#"><i class="fa fa-angle-left"></i></a></li>
                            ${pages}
                            <li class="page-item next-page" data-page="${meta.page}" data-current="${meta.page}" data-max="${meta.pages}" data-count="${meta.perpage}"><a class="page-link " href="#"><i class="fa fa-angle-right"></i></a></li>
                        `;
                    $("#productsPaginator").html(product_paginator);

            
            }
        }
        //
        $(document).off('click','.goto-page').on('click', '.goto-page', function(e) {
                e.preventDefault();
                const toPage = $(this).attr('data-page');
                const maxPages = $(this).attr('data-max');
                const perPage = $(this).attr('data-count');
                const total = $(this).attr('data-total');

                let metaReq = JSON.stringify({
                    meta: {
                        page: toPage,
                        perpage: perPage,
                        pages : maxPages,
                        sort: "",
                        field: ""
                    }
                })
               
                supportAjax({
                    url:`/paginated-products?${metaReq}`
                        }, 
                        (resp) => {
                            console.log(resp);
                            getProductTemplete(resp);
                        }, 
                        (err) => {
                            console.log(err);
                });
        })
        $(document).off('click','.next-page').on('click', '.next-page', function(e) {
            e.preventDefault();

            let toPage = $(this).attr('data-page');
            
            const maxPages = $(this).attr('data-max');
            const perPage = $(this).attr('data-count');
            const total = $(this).attr('data-total');
            if(toPage >=maxPages){
                return;
            }
            ++toPage;           
            let metaReq = JSON.stringify({
                meta: {
                page: toPage,
                perpage: perPage,
                pages : maxPages,
                sort: "",
                field: ""
                }
            })
            
            supportAjax({
                url:`/paginated-products?${metaReq}`
                },
                (resp) => {
                    console.log(resp);
                    getProductTemplete(resp);
                },
                (err) => {
                    console.log(err);
            });
        })
        $(document).off('click','.previous-page').on('click', '.previous-page', function(e) {
            e.preventDefault();

            let toPage = $(this).attr('data-page');
            
            const maxPages = $(this).attr('data-max');
            const perPage = $(this).attr('data-count');
            const total = $(this).attr('data-total');
            if(toPage <=1 ){
                return;
            }
            --toPage;           
            let metaReq = JSON.stringify({
                meta: {
                page: toPage,
                perpage: perPage,
                pages : maxPages,
                sort: "",
                field: ""
                }
            })
            
            supportAjax({
                url:`/paginated-products?${metaReq}`
                },
                (resp) => {
                    console.log(resp);
                    getProductTemplete(resp);
                },
                (err) => {
                    console.log(err);
            });
        })

    </script>
@else
    <script>
        const fetchCategoryProducts = async () => {
            let url = "";
            @if (isset($data['data']) && $data['data']['category_id'])           
                 url+="/category/products/{{ $data['data']['category_id'] }}";
            @else            
                url+="/get-menu-products/{{ isset($data['data']) ? $data['data']['id'] : 23 }}";
            @endif
            const response = await fetch(url);
            const data = await response.json();
          
            categoryProductTemplator(data);

        }    
        fetchCategoryProducts();    
        const categoryProductTemplator = ({
           data // destructured => here data = data.data
        }) => {
            if (typeof data[0] != 'string') {                
                // console.log(data, typeof data , typeof data[0]);
                const {
                    products: 
                    {
                        meta,
                        products
                    },
                    category
                } = data;
                // console.log(data, meta, products);
                let productCount= products.length;
               
                $('#productCount').html(productCount);
             
                const productList = products.map(product => {
                    const price = product.inventories.reduce((acc, curr) => {
                        return acc + curr.amount;
                    }, 0);
                    const avg = price / (product.inventories.length);
                    return `
                    
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-wrapper">
                            <div class="product-img">
                                <a href="/products/${product.id}" target="_blank">
                                    <img src="https://shop.systha.com/getFile?path=product/thumbnail&file=${product.thumbnail?.file_name || ''}"
                                        alt="">
                                    <img class="hover-img"
                                        src="https://shop.systha.com/getFile?path=product/thumbnail&file=${product.thumbnail?.file_name || ''}"
                                        alt="">
                    
                                </a>
                            </div>
                            <div class="product-description">
                                <span>${product.brand?.name || '-'}</span>
                                <a href="/products/${product.id}" target="_blank">
                                    <h6>${product.name}</h6>
                                </a>
                                <p class="product-price">$${avg.toFixed(2)}</p>
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="/products/${product.id}" target="_blank" class="btn essence-btn">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
                }).join('');
                $('#productContainer').html(productList);
            } else {
                let productCount = 0;
                $('#productCount').html(productCount);
                $('#productContainer').html(`<span style="margin:0 auto; font-size: 16px; padding: 15px;">No products found!</span>`);
                
            }
        }

    </script>
@endif

<style>
    .active a {
        color: white !important;
    }
</style>