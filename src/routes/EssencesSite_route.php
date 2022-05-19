<?php 
 /**
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2020
 * SYSTHA TECH LLC. ALL RIGHT RESERVED
 * -----------------------------------------------------------
 * SALES@SYSTHATECH.COM 
 * 512 903 2202
 * WWW.SYSTHATECH.COM
 * -----------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;
use Systha\EssencesSite\Http\Controllers\BaseController;
use Systha\EssencesSite\Http\Controllers\CartController;
use Systha\EssencesSite\Http\Controllers\WListController;
use Systha\EssencesSite\Http\Controllers\ValidateController;

Route::prefix('/')->group(function () {
    Route::get('/', [BaseController::class, 'index']);
    Route::get('/home', [BaseController::class, 'index']);
    Route::get('/menu/{id}', [BaseController::class, 'menuPage']);
    
    // Route::get('/footer/{id}', [BaseController::class, 'footerPage']);
    
    Route::get('/products', [BaseController::class, 'products']);
    Route::get('/products/{id}', [BaseController::class, 'ProductDetail']);
    Route::post('/get-inventory/{id}', [BaseController::class, 'getInventory']);
    Route::post('/place-order', [BaseController::class, 'placeOrder']);
    Route::get('/checkout', [BaseController::class, 'checkout']);
    Route::get('/checkout/proceed', [BaseController::class, 'proceedCheckout']);
    
    Route::get('/category/products/{id}', [BaseController::class, 'categoryProducts']);
    Route::get('/get-menu-products/{id}', [BaseController::class, 'getAllProducts']);
    
    Route::get('/register', [BaseController::class, 'registerPage']);
    Route::post('/register', [BaseController::class, 'register']);
    
    Route::get('/login', [BaseController::class, 'loginPage']);
    Route::post('/login', [BaseController::class, 'login']);
    
    Route::get("/logout", [BaseController::class, 'logoutUser']);
    Route::get('/contact', [BaseController::class, 'contact']);
    
    Route::post('/check-email', [BaseController::class, 'checkEmail']);
    
    Route::get('/add-to-cart/{cardDetails}', [CartController::class, 'addToCart']);
    Route::get('/get-cart', [CartController::class, 'getCart']);
    Route::get('/remove-from-cart/{invId}', [CartController::class, 'removeCart']);
    Route::get('/clear-cart', [CartController::class, 'clearCart']);
    
    Route::get('/update-to-cart/{str}', [CartController::class, 'updateCart']);
    
    Route::post('/order/validate/personal', [ValidateController::class, 'validateOrderPersonal']);
    Route::post('/order/validate/contact', [ValidateController::class, 'validateOrderContact']);
    
    Route::get('/search', [BaseController::class, 'search']);
    
    Route::get('/offers/{id}',[BaseController::class, 'offerView']);
    Route::get('/popular-products',[BaseController::class, 'popularProducts']);
    
    
    Route::get('/paginated-products',[BaseController::class, 'paginatedProducts']);
    
    Route::post('/subscribe',[BaseController::class, 'subscribe']);
    
    Route::get('/favourite/{id}',[WishListController::class, 'addFavourite']);
    Route::get('/get-wish',[WishListController::class, 'getWish']);
    Route::get('/remove-wish/{invId}',[WishListController::class, 'removeWish']);
    
    
    Route::get('/wish',[BaseController::class, 'wishPage']);
    
    Route::get('/blog',[BaseController::class, 'blogPage']);
    Route::get('/blog/{id}',[BaseController::class, 'blogPageSingle']);
    Route::get('/category/{id}',[BaseController::class, 'homeCategoryPage']);
    
    
    //temporary test routes
    Route::get('/orderPlaced', [BaseController::class, 'orderPlacedPage']);
    Route::get('/getOrder', [BaseController::class, 'getOrder']);

});