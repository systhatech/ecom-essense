<?php

namespace Systha\EssencesSite\Http\Controllers;

use Illuminate\Http\Request;
use Systha\EssencesSite\Traits\HandleCartCookie;
use Systha\EssencesSite\Services\CurlFetchService;
use Systha\EssencesSite\Helpers\ArrayHelper;

class CartController extends Controller
{
    use HandleCartCookie;
    // public function addToCart(Request $request, string $str)
    // {
    //     dd($request->all(), $str);
    // }
    protected $service;
    public function __construct()
    {
        $this->service = new CurlFetchService();
    }

    public function addToCart(Request $request, $cartDetails)
    {
        $cartDetails = json_decode($cartDetails, true);
        $inventory = $this->service->getInventoryById($cartDetails['inventoryId']);
        // dd('inventory', $inventory);
        if ($inventory['available'] < $cartDetails['quantity']) {
            return response(['message' => 'Quantity not available!'], 422);
        }
        if ($cartDetails['quantity'] == 0) {
            return response(['message' => 'Quantity is too low to add to cart!'], 422);
        }
        $updateCart = [
                [
                "inventory_id" => $inventory['id'],
                "quantity" => $cartDetails['quantity'],
                ]
            ];
        // $inventory['inv_hold'] += $cartDetails['quantity'];
        $ninv = $this->service->addInvHold($inventory['id'], $cartDetails['quantity']);
        // $inventory->update();
        if (isset($_COOKIE['cart'])) {
            $cart = $this->updateCookie($inventory['id'], $cartDetails['quantity'], 'cart');
            $addCart = $this->setCookie($request, 'cart', json_encode($cart));

            return response($this->getCookie(request(), 'cart'))->cookie($addCart);
        } else {
            $cart = $this->setCookie($request, 'cart', json_encode($updateCart));
            return response($this->getCookie(request(), 'cart'))->cookie($cart);
        }
    }

    public function getCart(Request $request)
    {
        $inventories = $this->cartDetails($request);
        return response($inventories,200);
    }

    public function cartDetails(Request $request)
    {
        if (isset($_COOKIE['cart'])) {
            $cookies = json_decode($this->getCookie($request, 'cart'), true);
            
            $inventoriesId = [];
            $reqQuantity = [];
            $inventories = [];
            $unavailable = [];
            foreach ($cookies as $cookie) {
                array_push($inventoriesId, $cookie['inventory_id']);
                array_push($reqQuantity, $cookie['quantity']);
            }
            foreach ($inventoriesId as $key => $id) {
                $inventory = $this->service->getInventoryById($id);
                if (isset($inventory['available']) && $inventory['available'] >= (int) $reqQuantity[$key]) {
                    array_push($inventories, $inventory);
                } else {
                    unset($reqQuantity[$key]);
                    array_push($unavailable, ['message' => ($inventory['product']['name'] ?? '') . ' is out of stock.<br> So it is removed from your cart.']);
                }
            }
            foreach ($inventories as $key => $inventory) {      
                     
                $inventories[$key]['reqQuantity'] = $reqQuantity[$key];
                $inventories[$key]['image'] = $inventory['product']['thumbnail'];
            }
            return ['inventories' => $inventories, 'unavailable' => $unavailable];
        }
    }
    public function removeCart($invId)
    {
        $inv = $this->service->getInventoryById($invId);
        $cart = $this->removeFromCookie($inv['id'], 'cart');
        $addCart = $this->setCookie(request(), 'cart', json_encode($cart));
        return response($this->getCookie(request(), 'cart'))->cookie($addCart);
    }

    public function clearCart()
    {
        $this->clearCookie('cart');
        return response(['message' => 'Cart cleared'], 200);
    }

    public function updateCart(Request $request, $cartDetails)
    {
        $cartDetails = json_decode($cartDetails, true);
        $updateCart = [[
            "inventory_id" => $cartDetails['id'],
            "quantity" => $cartDetails['quantity'],
        ]];
        $replace = false;
        if ($cartDetails['replace']) {
            $replace = true;
        }
        $inventory = $this->service->getInventoryById($cartDetails['id']);
        if ($inventory['available'] < $cartDetails['quantity']) {
            return response(['message' => 'Quantity not available!'], 422);
        }
        if (isset($_COOKIE['cart'])) {
            $cart = $this->updateCookie($cartDetails['id'], $cartDetails['quantity'], 'cart', $replace);
            $addCart = $this->setCookie($request, 'cart', json_encode($cart));
            return response($this->getCookie(request(), 'cart'))->cookie($addCart);
        } else {
            $cart = $this->setCookie($request, 'cart', json_encode($updateCart));
            return response($this->getCookie(request(), 'cart'))->cookie($cart);
        }
    }
  
}
