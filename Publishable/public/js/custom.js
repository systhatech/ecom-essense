$(document).ready(function () {
    $("#headerSearch")
        .off("keyup")
        .on("keyup", function (e) {
            if ($(this).val().length > 2 || $(this).val().length == 0) {
                e.preventDefault();
                e.stopPropagation();
                var data = $(this).val();

                // window.location.href='/search?term='+data;
                // OR
                // $.ajax({
                //     url:'/search?term='+data,
                //     method:'GET',
                //     success: function(data){
                //         window.location.href = "/search?term=" + data;
                //     }
                // });
                supportAjax(
                    {
                        url: "/search?term=" + data,
                        method: "GET",
                    },
                    (response) => {
                        window.location.href = "/search?term=" + data;
                    }
                );
            }
        });

    $("#btn--search")
        .off("click")
        .on("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            var data = $("#headerSearch").val();
            // window.location.href = "/search?term=" + data;
            supportAjax(
                {
                    url: "/search?term=" + data,
                    method: "GET",
                },
                (response) => {
                    window.location.href = "/search?term=" + data;
                }
            );
        });
});

function supportAjax({ url, method, data = null }, successParam, errorParam) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: url,
        method: method,
        data: data,
        beforeSend: function () {
            $("body").addClass("loading");
        },
        success: function (response) {
            successParam(response);
            $("body").removeClass("loading");
        },
        error: function (error) {
            errorParam(error);
            $("body").removeClass("loading");
        },
    });
}

//cart
function getCart() {
    supportAjax(
        {
            url: "/get-cart",
            method: "GET",
            data: null,
        },
        (response) => {
            let total_count = 0;
            let total_amt = 0;

            let inventories = response.inventories ?? [];

            // const inventories = JSON.parse(
            //     response.responseText
            // ).inventories;

            if (inventories.length) {
                total_count = inventories.reduce((cur, inv) => {
                    return cur + parseInt(inv.reqQuantity);
                }, 0);
                total_amt = inventories.reduce((cur, inv) => {
                    return cur + parseInt(inv.reqQuantity) * inv.amount;
                }, 0);
            }
            $("#cartCount").html(`${total_count}`);
            $("#rightSideCartCount").html(`${total_count}`);

            const item_temp = inventories
                .map((inventory) => {
                    let variantItem = "";
                    $.each(inventory.variants, function (key, value) {
                        variantItem += `<p class="${key}">${key}: ${value}</p>`;
                    });
                    //for image
                    let path = "";
                    let fileName = "";
                    if (inventory.thumbnail) {
                        path = "product/inventory/thumbnail";
                        fileName = inventory.thumbnail.file_name;
                    } else if (inventory.image) {
                        path = "product/inventory/attachments";
                        filenName = inventory.image.file_name;
                    } else {
                        path = "product/thumbnail";
                        fileName = inventory.product.thumbnail?.file_name || "";
                    }
                    let image = `https://shop.systha.com/getFile?path=${path}&file=${fileName}`;
                    return `
                        <div class="single-cart-item">
                            <a href="#" class="product-image">
                                <img src="${image}" class="cart-thumb" alt="" style="min-height:250px;">
                                    <!-- Cart Item Desc -->
                                    <div class="cart-item-desc">
                                        <span class="product-remove" data-id="${
                                            inventory.id
                                        }"><i class="fa fa-close" aria-hidden="true"></i></span>
                                        
                                            <span class="badge">Mango</span>
                                            <h6>${inventory.product.name}</h6>
                                            ${variantItem}
                                            <p class="price">$${inventory[
                                                "selling_price"
                                            ].toFixed(2)} X ${
                        inventory.reqQuantity
                    }</p>
                                    
                                     </div>
                                </a>
                         </div>`;
                })
                .join("");

            $("#card-list-detail").html(item_temp);
            $(".cart-amount-summary").html(
                `  <h2>Summary</h2>
                    <ul class="summary-table">
                        <li><span>subtotal:</span> <span>$${total_amt.toFixed(
                            2
                        )}</span></li>
                        <li><span>delivery:</span> <span>Free</span></li>                       
                        <li><span>total:</span> <span>$${total_amt.toFixed(
                            2
                        )}</span></li>
                    </ul>
                    <div class="checkout-btn mt-100">
                       
                        <a href="/checkout" class="btn essence-btn">Review Cart</a>
                    </div>`
            );

            const checkoutDetail = inventories
                .map((inventory) => {
                    //for image
                    let path = "";
                    let fileName = "";
                    if (inventory.thumbnail) {
                        path = "product/inventory/thumbnail";
                        fileName = inventory.thumbnail.file_name;
                    } else if (inventory.image) {
                        path = "product/inventory/attachments";
                        filenName = inventory.image.file_name;
                    } else {
                        path = "product/thumbnail";
                        fileName = inventory.product.thumbnail?.file_name || "";
                    }
                    let image = `https://shop.systha.com/getFile?path=${path}&file=${fileName}`;
                    return `
                                      <li>
                                        <div class="respShopItem" style="width:100%;">
                                        <img src="${image}" class="cart-thumb" alt="" style="height:100%; width:50px">
                                            <div style="width: 45%;">
                                                    <span>                                            
                                            
                                                  ${
                                                    inventory.product.name
                                                }</span> 
                                            </div>
                                            <div>
                                                                                    <span>
                                                                                        Qty<input type="number" class="form-control rounded-0 changeQty" data-id="${
                                                                                            inventory[
                                                                                                "id"
                                                                                            ]
                                                                                        }" value="${
                        inventory.reqQuantity
                    }" min="1" max="${
                        inventory.available
                    }">                                   
                                                                                    </span>

                                            </div>
                                            <div>
                                                                                    <span>
                                                                                        <div>
                                                                                            $ ${inventory.selling_price.toFixed(
                                                                                                2
                                                                                            )} X ${
                        inventory.reqQuantity
                    }
                                                                                        </div>
                                                                                            $ ${(
                                                                                                inventory.reqQuantity *
                                                                                                inventory.selling_price
                                                                                            ).toFixed(
                                                                                                2
                                                                                            )}
                                                                                    </span>
                                            </div>

                                        </div>
                                    
                                        </li>
                        `;
                })
                .join("");

            $("#checkoutOrderDetail").html(checkoutDetail);
            $("#checoutOrderPriceDetail").html(`  
                        <li><span>Subtotal</span> <span>$${total_amt.toFixed(
                            2
                        )}</span></li>
                        <li><span>Shipping</span> <span>Free</span></li>
                        <li><span>Total</span> <span>$${total_amt.toFixed(
                            2
                        )}</span></li>`);

            const checkoutDetailList = inventories
                .map((inventory) => {
                    //for image
                    let path = "";
                    let fileName = "";
                    if (inventory.thumbnail) {
                        path = "product/inventory/thumbnail";
                        fileName = inventory.thumbnail.file_name;
                    } else if (inventory.image) {
                        path = "product/inventory/attachments";
                        filenName = inventory.image.file_name;
                    } else {
                        path = "product/thumbnail";
                        fileName = inventory.product.thumbnail?.file_name || "";
                    }
                    let image = `https://shop.systha.com/getFile?path=${path}&file=${fileName}`;
                    return ` <li>
                                <img src="${image}" class="cart-thumb" alt="" style="height:100%; width:36px">
                                    <span>${inventory.product.name}(${
                        inventory.reqQuantity
                    }) </span>
                                    <span><div> price X ${
                                        inventory.reqQuantity
                                    }</div>$ ${(
                        inventory.reqQuantity * inventory.selling_price
                    ).toFixed(2)}
                                    </span>
                                </li>
                        `;
                })
                .join("");

            $("#checkoutOrderPriceDetailList").html(checkoutDetailList);
        },
        (response) => {
            alert("error cart");
        }
    );

    // $.ajax({
    //     url: "/get-cart",
    //     method: "GET",
    //     data: null,

    //     success: function (response) {
    //         {
    //             let total_count = 0;
    //             let total_amt = 0;

    //             let inventories = response.inventories;

    //             // const inventories = JSON.parse(
    //             //     response.responseText
    //             // ).inventories;

    //             if (inventories.length) {
    //                 total_count = inventories.reduce((cur, inv) => {
    //                     return cur + parseInt(inv.reqQuantity);
    //                 }, 0);
    //                 total_amt = inventories.reduce((cur, inv) => {
    //                     return cur + parseInt(inv.reqQuantity) * inv.amount;
    //                 }, 0);
    //             }
    //             $("#cartCount").html(`${total_count}`);
    //             $("#rightSideCartCount").html(`${total_count}`);

    //             const item_temp = inventories
    //                 .map((inventory) => {
    //                     let variantItem = "";
    //                     $.each(inventory.variants, function (key, value) {
    //                         variantItem += `<p class="${key}">${key}: ${value}</p>`;
    //                     });
    //                     //for image
    //                     let path = "";
    //                     let fileName = "";
    //                     if (inventory.thumbnail) {
    //                         path = "product/inventory/thumbnail";
    //                         fileName = inventory.thumbnail.file_name;
    //                     } else if (inventory.image) {
    //                         path = "product/inventory/attachments";
    //                         filenName = inventory.image.file_name;
    //                     } else {
    //                         path = "product/thumbnail";
    //                         fileName =
    //                             inventory.product.thumbnail?.file_name || "";
    //                     }
    //                     let image = `https://shop.systha.com/getFile?path=${path}&file=${fileName}`;
    //                     return `
    //                     <div class="single-cart-item">
    //                         <a href="#" class="product-image">
    //                             <img src="${image}" class="cart-thumb" alt="" style="min-height:250px;">
    //                                 <!-- Cart Item Desc -->
    //                                 <div class="cart-item-desc">
    //                                     <span class="product-remove" data-id="${inventory.id}"><i class="fa fa-close" aria-hidden="true"></i></span>

    //                                         <span class="badge">Mango</span>
    //                                         <h6>${inventory.product.name}</h6>
    //                                         ${variantItem}
    //                                         <p class="price">$${inventory["selling_price"].toFixed(2)} X ${inventory.reqQuantity}</p>

    //                                  </div>
    //                             </a>
    //                      </div>`;
    //                 })
    //                 .join("");

    //             $("#card-list-detail").html(item_temp);
    //             $(".cart-amount-summary").html(
    //                 `  <h2>Summary</h2>
    //                 <ul class="summary-table">
    //                     <li><span>subtotal:</span> <span>$${total_amt.toFixed(
    //                         2
    //                     )}</span></li>
    //                     <li><span>delivery:</span> <span>Free</span></li>
    //                     <li><span>total:</span> <span>$${total_amt.toFixed(
    //                         2
    //                     )}</span></li>
    //                 </ul>
    //                 <div class="checkout-btn mt-100">

    //                     <a href="/checkout" class="btn essence-btn">Review Cart</a>
    //                 </div>`
    //             );

    //             const checkoutDetail = inventories
    //                 .map((inventory) => {
    //                     //for image
    //                     let path = "";
    //                     let fileName = "";
    //                     if (inventory.thumbnail) {
    //                         path = "product/inventory/thumbnail";
    //                         fileName = inventory.thumbnail.file_name;
    //                     } else if (inventory.image) {
    //                         path = "product/inventory/attachments";
    //                         filenName = inventory.image.file_name;
    //                     } else {
    //                         path = "product/thumbnail";
    //                         fileName =
    //                             inventory.product.thumbnail?.file_name || "";
    //                     }
    //                     let image = `https://shop.systha.com/getFile?path=${path}&file=${fileName}`;
    //                     return ` <img src="${image}" class="cart-thumb" alt="" style="height:100%; width:50px">
    //                         <li><span>${inventory.product.name} </span>
    //                         <span>Qty
    //                                     <input type="number" class="form-control rounded-0 changeQty" data-id="${
    //                                         inventory["id"]
    //                                     }" value="${
    //                         inventory.reqQuantity
    //                     }" min="1"
    //                                     max="${inventory.available}">

    //                         </span>
    //                         <span>
    //                             <div>
    //                                   $ ${inventory.selling_price.toFixed(
    //                                       2
    //                                   )} X ${inventory.reqQuantity}
    //                             </div>
    //                                  $ ${(
    //                                      inventory.reqQuantity *
    //                                      inventory.selling_price
    //                                  ).toFixed(2)}
    //                         </span></li>
    //                     `;
    //                 })
    //                 .join("");

    //             $("#checkoutOrderDetail").html(checkoutDetail);
    //             $("#checoutOrderPriceDetail").html(`
    //                     <li><span>Subtotal</span> <span>$${total_amt}</span></li>
    //                     <li><span>Shipping</span> <span>Free</span></li>
    //                     <li><span>Total</span> <span>$${total_amt}</span></li>`);

    //             const checkoutDetailList = inventories
    //                 .map((inventory) => {
    //                     //for image
    //                     let path = "";
    //                     let fileName = "";
    //                     if (inventory.thumbnail) {
    //                         path = "product/inventory/thumbnail";
    //                         fileName = inventory.thumbnail.file_name;
    //                     } else if (inventory.image) {
    //                         path = "product/inventory/attachments";
    //                         filenName = inventory.image.file_name;
    //                     } else {
    //                         path = "product/thumbnail";
    //                         fileName =
    //                             inventory.product.thumbnail?.file_name || "";
    //                     }
    //                     let image = `https://shop.systha.com/getFile?path=${path}&file=${fileName}`;
    //                     return ` <li>
    //                             <img src="${image}" class="cart-thumb" alt="" style="height:100%; width:36px">
    //                                 <span>${inventory.product.name}(${
    //                         inventory.reqQuantity
    //                     }) </span>
    //                                 <span><div> price X ${
    //                                     inventory.reqQuantity
    //                                 }</div>$ ${(
    //                         inventory.reqQuantity * inventory.selling_price
    //                     ).toFixed(2)}
    //                                 </span>
    //                             </li>
    //                     `;
    //                 })
    //                 .join("");

    //             $("#checkoutOrderPriceDetailList").html(checkoutDetailList);
    //         }
    //     },
    //     error: function (response) {

    //         alert('error cart');
    //     }
    // });
}

$(document)
    .off("click", ".product-remove")
    .on("click", ".product-remove", function () {
        let inventoryId = $(this).attr("data-id");
        // $.ajax({
        //     url: `/remove-from-cart/${inventoryId}`,
        //     method: 'GET',
        //     success:function(){
        //            getCart();
        //     }
        // });

        supportAjax(
            {
                url: `/remove-from-cart/${inventoryId}`,
                method: "GET",
            },
            () => {
                getCart();
            }
        );
    });

$(document)
    .off("blur", ".changeQty")
    .on("blur", ".changeQty", function (e) {
        e.preventDefault();

        let quantity = $(this).val();
        console.log(quantity);

        let id = $(this).attr("data-id");
        let replace = "yes";
        let encode = JSON.stringify({
            id,
            quantity,
            replace,
        });
        // $.ajax({
        //     url: `/update-to-cart/${encode}`,
        //     success: function () {
        //         window.location.reload();
        //     },
        //     error: function (e) {
        //         console.log(e);
        //     },
        // });
        supportAjax(
            {
                url: `/update-to-cart/${encode}`,
            },
            () => {
                window.location.reload();
            },
            (e) => {
                console.log(e);
            }
        );
    });

function getWish() {
    supportAjax(
        {
            url: "/get-wish",
            method: "GET",
            data: null,
        },
        (response) => {
            let inventories = response.inventories ?? [];
            let total_count = inventories.length;
            if (total_count) {
                $("#wishCount").html(`${total_count}`);
                const wish_item = inventories
                    .map((inventory) => {
                        let path = "";
                        let fileName = "";
                        if (inventory.thumbnail) {
                            path = "product/inventory/thumbnail";
                            fileName = inventory.thumbnail.file_name;
                        } else if (inventory.image) {
                            path = "product/inventory/attachments";
                            filenName = inventory.image.file_name;
                        } else {
                            path = "product/thumbnail";
                            fileName =
                                inventory.product.thumbnail?.file_name || "";
                        }
                        let image = `https://shop.systha.com/getFile?path=${path}&file=${fileName}`;

                        return `                    
                            <li class="wishlistLiItems">
                                    <div class="imageContent">
                                        <img src="${image}" class="cart-thumb" alt="" style="height:100%; width:56px">
                                    </div>
                                    <div class="nameContent"><a href="/products/${inventory.product_id}" target="_blank">${inventory.product.name}</a></div>
                                    <div>
                                        <div class='buttonContent'>
                                                <button class="btn essence-btn add-to-cart" id="addToCartBtn2" data-id="${inventory.id}"
                                                    data-pid="${inventory.product_id}"> Add to cart </button>         
                                                <button class="btn essence-btn remove-wish" data-id = "${inventory.id}" style="background-color:#dc3545;">Remove </button>
                                        
                                        </div>
                                    </div>    
                            </li>
        
                        `;
                    })
                    .join("");

                $("#wishlist_item").html(wish_item);
            } else {
                $("#wishlist_item").html("No Wish Items");
            }
        }
    );

    $(document)
        .off("click", ".remove-wish")
        .on("click", ".remove-wish", function () {
            let inventoryId = $(this).attr("data-id");
            supportAjax(
                {
                    url: `/remove-wish/${inventoryId}`,
                    method: "GET",
                },
                () => {
                    toastr.success("Wish Removed");
                    location.reload();
                    getWish();
                }
            );
        });
    $(document)
        .off("click", "#addToCartBtn2")
        .on("click", "#addToCartBtn2", function (e) {
            e.preventDefault();
            const inv_id = $(this).attr("data-id");
            const product_id = $(this).attr("data-pid");

            const qty = 1;
            if (inv_id != 0) {
                addToCart2(inv_id, qty, product_id);
                supportAjax(
                    {
                        url: `/remove-wish/${inv_id}`,
                        method: "GET",
                    },
                    () => {
                        location.reload();
                        getWish();
                    }
                );
            }
        });

    const addToCart2 = async (inv_id, qty, product_id) => {
        const encode = JSON.stringify({
            inventoryId: inv_id,
            productId: product_id,
            quantity: qty,
        });
        const response = await fetch(`/add-to-cart/${encode}`);
        getCart();
    };
}
