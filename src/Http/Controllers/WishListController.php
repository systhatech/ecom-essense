<?php

namespace Systha\EssencesSite\Http\Controllers;

use Systha\EssencesSite\Services\CurlFetchService;
use Systha\EssencesSite\Traits\HandleCartCookie;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Http\Request;


class WishListController extends Controller
{
    use HandleCartCookie;
    protected $service;
    public function __construct(){
        $this->service = new CurlFetchService();
    }
    public function addFavourite(Request $request, int $id)
    {
        $inventory = $this->service->getInventoryById($request->inv_id);
        // dd($inventory);
        $updateFavourite = [[
            "inventory_id" => $inventory['id']
        ]];

        if (isset($_COOKIE['wishlist'])) {
            $wish = $this->updateWishlist($inventory['id'] , 'wishlist');
            $addFavourite = $this->setCookie($request, 'wishlist', json_encode($wish));

            return response($this->getCookie(request(), 'wishlist'))->cookie($addFavourite);
        } else {
            $fav = $this->setCookie($request, 'wishlist', json_encode($updateFavourite));
            return response($this->getCookie(request(), 'wishlist'))->cookie($fav);
        }
        
    }
    public function updateFavourite(Request $request, $wishDetails)
    {
        $wishDetails = json_decode($wishDetails,true);
        $updatewish = [[
            "inventory_id" => $wishDetails['id']
        ]];
        
        if (isset($_COOKIE['wishlist'])) {
            $cart = $this->updateWishlist($wishDetails['id'], 'wishlist');
            $addCart = $this->setCookie($request, 'wishlist', json_encode($cart));
            return response($this->getCookie(request(), 'wishlist'))->cookie($addCart);
        } else {
            $cart = $this->setCookie($request, 'wishlist', json_encode($updatewish));
            return response($this->getCookie(request(), 'wishlist'))->cookie($cart);
        }
    }

    public function wishDetails(Request $request)
    {
        if(isset($_COOKIE['wishlist'])){
            $cookies = json_decode($this->getCookie($request, 'wishlist'),true);
            $inventoriesId = [];
            $inventories = [];
            foreach($cookies as $cookie){
                array_push($inventoriesId, $cookie['inventory_id']);
            }
            foreach($inventoriesId as $key =>$id){
                $inventory = $this->service->getInventoryById($id);
                if(isset($inventory['available'])){
                    array_push($inventories, $inventory);
                }else{
                    array_push($unavailable, ['message' => ($inventory['product']['name'] ?? '') . ' is out of stock.<br> So it is removed from your cart.']);
                }
            }

            return ['inventories' => $inventories];
        }

    }

    public function removeWish($invId)
    {
        $inv = $this->service->getInventoryById($invId);
        $wishlist = $this->removeFromWishlist($inv['id'], 'wishlist');
        $addFavourite = $this->setCookie(request(), 'wishlist', json_encode($wishlist));
        return response($this->getCookie(request(), 'wishlist'))->cookie($addFavourite);
    }

    public function getWish(Request $request)
    {   
        $inventories = $this->wishDetails($request);
        return response($inventories);
    }
}
