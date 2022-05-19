

<section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
        </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
               <div class="popular-products-slides owl-carousel" id="popular-products-all" >     
                </div>
            </div>
        </div>
    </div>
       
    </section>
  
    <script> 
    getPopularProducts();
        function getPopularProducts(){
            supportAjax({
                url: '/popular-products',
                method: 'GET',                
            },
            (response)=>{
                let popularProducts = response.data ?? [];
               
                const pProducts = popularProducts.map((popularProduct)=>{
                        const price = popularProduct.inventories.reduce((acc, curr) => {
                        return acc + curr.amount;
                        }, 0);
                        const avg = price / (popularProduct.inventories.length);
                    return `
                                     <div class="single-product-wrapper">
                        <div class="product-img">
                            <img src="https://shop.systha.com/getFile?path=product/thumbnail&file=${popularProduct.thumbnail?.file_name || ''}" alt="">
                            <!-- Hover Thumb -->
                            <img class="hover-img" src="https://shop.systha.com/getFile?path=product/thumbnail&file=${popularProduct.thumbnail?.file_name || ''}" alt="">
                            
                        </div>
                      
                        <div class="product-description">
                            <span>${popularProduct.brand?.name ?? "-"}</span>
                            <a href="/products/${popularProduct.id}">
                                <h6>${popularProduct.name}</h6>
                            </a>
                            <p class="product-price">$${avg.toFixed(2)}</p>                   
                          
                            <div class="hover-content">
                                <!-- Add to Cart -->
                                <div class="add-to-cart-btn">
                                    <a href="/products/${popularProduct.id}" class="btn essence-btn" target="_blank">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
            
                                      
                    `;
                }).join('');
                $('#popular-products-all').html(pProducts);
                var $owl = $('.popular-products-slides');
                $owl.trigger('destroy.owl.carousel');
                $owl.find('.owl-stage-outer').children().unwrap();
                $owl.removeClass("owl-center owl-loaded owl-text-select-on");
                $owl.html(pProducts);
                $owl.owlCarousel({
                    items: 8,
                    margin: 30,
                    loop: true,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    smartSpeed: 1000,
                    responsive: {
                        0: {
                            items: 1
                        },
                        576: {
                            items: 2
                        },
                        768: {
                            items: 3
                        },
                        992: {
                            items: 4
                        }
                    }
                });
                
                // setTimeout(() => {
                //     $('.popular-products-slides').owlCarousel({
                //     items: 8,
                //     margin: 30,
                //     loop: true,
                //     nav: false,
                //     dots: false,
                //     autoplay: true,
                //     autoplayTimeout: 5000,
                //     smartSpeed: 1000,
                //     responsive: {
                //     0: {
                //         items: 1
                //     },
                //     576: {
                //     items: 2
                //     },
                //     768: {
                //     items: 3
                //     },
                //     992: {
                //     items: 4
                //     }
                //     }
                //     });
                    
                // }, 500);
               
            },(response)=>{
                    console.log(response);
            });
        }
    </script>