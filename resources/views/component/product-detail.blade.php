{{-- @dd($data['data']['product']['data']) --}}

@php $product = $data['data']['product']['data']['product'];
     $variants = $data['data']['product']['data']['variants'];
     $inventory = $product['inventories'][0];
@endphp

{{-- {{dd($inventory)}} --}}

<!-- ##### Single Product Details Area Start ##### -->
<section class="single_product_details_area d-flex align-items-center" style="margin-top:85px;">

    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <div class="product_thumbnail_slides owl-carousel">
            <img src="https://shop.systha.com/getFile?path=product/thumbnail&file={{$product['thumbnail'] ? $product['thumbnail']['file_name']: ""}}"
                 alt="" >
            <img src="https://shop.systha.com/getFile?path=product/thumbnail&file={{$product['thumbnail'] ? $product['thumbnail']['file_name']: ""}}"
                  alt="" >

        </div>
    </div>
    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">
        <span>{{$product['brand']? $product['brand']['name'] : " "}}</span>
        <a href="#">
            <h2>{{$product['name']}}
                 @if ($inventory['available'] <=0) 
                        <div style="color: red">(out of stock)</div> 
                 @endif
            </h2>
         

        </a>
        <p class="product-price" id="inventoryPrice">$
            @php
            $total = array_reduce($product['inventories'], function ($carry, $curr) {
            return $carry + $curr['amount'];
            }, 0);
            $avg = $total / count($product['inventories']);
            // $inventory = $product['inventories'][0];
            @endphp

            {{number_format($avg,2)}} 
       </p>
        <p class="product-desc" style="max-height:200px; overflow-y: hidden">
            {!!strip_tags($product['short_desc'])!!}
        </p>
        <!-- Form -->


        <form class="cart-form clearfix" method="post">
            <div class="select-box d-flex mt-50 mb-30 mr-5  directionFlex" style="gap: 1rem;">               
                <select class="form-select form-select-sm select-box" id="invQty">
                    @for ($i = 1; $i < $inventory['available']; $i++) 
                        <option value="{{ $i }}" @if($i==1) selected @endif>Quantity : {{ $i }}                                            
                        </option>
                        @endfor
                </select>
                @foreach ($variants as $key =>$variant)
                    @if (strtolower($key) == 'color')
                        
                        <select name="{{$key}}" id="productColor" data-filter="{{ $key }}"
                            data-value="{{ $variant[0]['name'] }}">
                            @foreach ($variant as $item)
                                <option value="{{$item['name']}}">COLOR:{{$item['name']}}</option>
                            @endforeach
                    </select>
                    @else
                
                    <select name="{{ $key }}" class="form-select form-select-sm" id="productSize" class="mr-5"
                        data-filter="{{ $key }}" data-value="{{ $variant[0]['name'] }}"><br>
                        @foreach ($variant as $i => $filter)
                        <option value="{{ $filter['name'] }}">{{ ucWords($key) }}:{{ ucWords($filter['name']) }}</option>
                        @endforeach
                    </select>

                    @endif

                @endforeach
            </div>

            <!-- Cart & Favourite Box -->
            <div class="cart-fav-box d-flex align-items-center">
                <!-- Cart -->
                @if ($inventory['available'] > 0)
                    <button class="btn essence-btn add-to-cart" id="addToCartBtn"> Add to cart </button>
                @else
                    <button class="btn essence-btn add-to-cart" disabled style="cursor: not-allowed"> Out of Stock </button>
                @endif

                <div class="product-favourite ml-4">
                    <a href="#" class="favme fa fa-heart favourite" data-fid={{$product['id']}}></a>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    getInventory();
    $('[data-filter]').on('change', function(e) {
        e.preventDefault();
        $(this).attr('data-value', $(this).val());
        getInventory();
    });
    $('[data-filter]').on('click', function(e) {
        e.preventDefault();
        if ($(this).prop('tagName') !== 'SELECT') {
            $(this).siblings('[data-filter]').removeClass('selected')
            if(!$(this).hasClass('selected')){
                $(this).addClass('selected');
                getInventory();
           
            }
        }
    });
   
    async function getInventory() {
        let elements = $('[data-filter]');
        let arr = [];
        for (const el of elements) {
            let type = $(el).attr('data-filter');
            let val = null;
            let push = false;
            if ($(el).prop('tagName') !== 'SELECT') {
                if($(el).hasClass('selected')) {
                    val = $(el).attr('data-value');
                    push = true;
                }
            } else {
                val = $(el).attr('data-value');
                push = true;
            }
            if (push) {
                arr.push({
                    'name': type,
                    'value': val
                })
            }
        }
        const response = await fetch(`/get-inventory/{{ $product['id'] }}`, {
            method: "POST",
            body: JSON.stringify(arr),
            headers: {
                "Content-Type": "application/json; charset=UTF-8",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        });
        const data = await response.json();
        if (data.data) {
            $('#inventoryPrice').html(
                `
                <h4 class="mb-0">$${data.data.amount.toFixed(2)}</h4>`
            )
            $('#addToCartBtn').attr('data-id', data.data.id).attr('data-pid', data.data.product_id).html(`<i class="bx bxs-cart-add"></i>Add to Cart</a>`)
        } else {
            $('#inventoryPrice').html(
                `
                <h4 class="mb-0">Out of Stock</h4>`
            )
            $('#addToCartBtn').attr('data-id', 0).attr('data-pid', 0).html(`<i class="bx bxs-cart-add"></i>Out of stock</a>`);
        }
    }

    $('#addToCartBtn').off('click').on('click', function(e) {
        e.preventDefault();
        const inv_id = $(this).attr('data-id');
        const product_id = $(this).attr('data-pid')
        const qty = $('#invQty').val();
        if (inv_id != 0) {
            addToCart(inv_id, qty, product_id);

        }
    })

    const addToCart = async (inv_id, qty, product_id) => {
        const encode = JSON.stringify({
            'inventoryId': inv_id,
            'productId': product_id,
            'quantity': qty
        })
        const response = await fetch(`{{ request()->root() }}/add-to-cart/${encode}`);
        getCart();
    }

    $('.favourite').off('click').on('click',function(e){
        e.preventDefault();       
        
        const inv_id = $("#addToCartBtn").attr('data-id');     
        // const product_id = $(this).attr('data-fid');     
        supportAjax({
            url:`/favourite/${inv_id}`,
            method: "GET",
            data: {inv_id}
            
        },(response)=>{
                toastr.success('Favourite Added');
                window.location.reload();
        },(error)=>{
                toastr.error('Out of Stock');
        }); 
        
        
        
    })
    
</script>

<style>
   @media only screen and (max-width: 470px) {
     .directionFlex {
         flex-direction: column;
     }
   }
</style>