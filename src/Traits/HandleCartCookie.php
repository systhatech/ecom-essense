<?php

namespace Systha\EssencesSite\Traits;

use Systha\EssencesSite\Services\CurlFetchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

trait HandleCartCookie
{
    protected $service;
    public function __construct()
    {
        $this->service = new CurlFetchService();
    }

    public function setCookie(Request $request, $name, $value)
    {
        $minutes = 525600;
        return cookie($name, $value, $minutes, '/');
    }

    public function resetCookie()
    {
        $cookie = $this->getCookie(request(), 'cart');
        $this->setCookie(request(), 'cart', $cookie);
    }

    public function getCookie(Request $request, $name)
    {
        return $request->cookie($name);
    }

    public function clearCookie($cookie)
    {
        return Cookie::queue(Cookie::forget($cookie));
    }

    public function removeFromCookie(int $id, $cookie)
    {
        $inventory = $this->service->getInventoryById($id);
        $cookieJSON = $this->getCookie(request(), $cookie);
        if (!$cookieJSON) {
            throw new \Exception("Cookie $cookie doesn't exist!");
        }
        $cookieData = json_decode($cookieJSON, true);
        foreach ($cookieData as $key => $value) {
            if ($value['inventory_id'] == $inventory['id']) {
                if (!is_null($inventory['inv_hold']) || ($inventory['inv_hold'] !== 0)) {
                    $this->service->deductInvHold($inventory['id'], $value['quantity']);
                }
            }
        }
        $updatedCart = array_filter($cookieData, function ($cookieArray) use ($inventory) {
            return (int) $cookieArray['inventory_id'] !== $inventory['id'];
        });
        return $updatedCart;
    }

    public function updateCookie(int $inventory, int $quantity, $cookie, $replace = false)
    {
        $inv = $this->service->getInventoryById($inventory);
        $cookieJSON = $this->getCookie(request(), $cookie);
        if (!$cookieJSON) {
            throw new \Exception("Cookie $cookie doesn't exists!");
        }
        $cookieData = json_decode($cookieJSON, true);
        foreach ($cookieData as $key => $value) {
            if ($value['inventory_id'] == $inventory) {
                if (!is_null($inv['inv_hold'] || $inv['inv_hold'] !== 0)) {
                    if ($quantity < $value['quantity']) {
                        $this->service->deductInvHold($inv['id'], $value['quantity']);
                    }
                    if ($quantity > $value['quantity']) {
                        $this->service->addInvHold($inv['id'], $value['quantity']);
                    }
                }
            }
        }
        $updatedCart = array_map(function ($cookieArray) use ($inventory, $quantity, $replace) {
            if ((int) $cookieArray['inventory_id'] === $inventory) {
                if ($replace) {
                    $cookieArray['quantity'] = $quantity;
                } else {
                    $cookieArray['quantity'] += $quantity;
                }
            }
            return $cookieArray;
        }, $cookieData);
        if (!collect($updatedCart)->pluck('inventory_id')->contains($inventory)) {
            array_push($updatedCart, ["inventory_id" => $inventory, "quantity" => $quantity]);
        }
        return $updatedCart;
    }
    public function updateWishlist($id, $cookie)
    {
        $inv = $this->service->getInventoryById($id);
        $cookieJSON = $this->getCookie(request(), $cookie);
        if (!$cookieJSON) {
            throw new \Exception("Cookie $cookie doesn't exists!");
        }
        $cookieData = json_decode($cookieJSON, true);
        if (!collect($cookieData)->pluck('inventory_id')->contains($id)) {
            array_push($cookieData, ["inventory_id" => $id]);
        }
        return $cookieData;

    }
    public function removeFromWishlist(int $id, $cookie)
    {
        $inventory = $this->service->getInventoryById($id);
        $cookieJSON = $this->getCookie(request(), $cookie);
        if (!$cookieJSON) {
            throw new \Exception("Cookie $cookie doesn't exist!");
        }
        $cookieData = json_decode($cookieJSON, true);
        
        $updatedCart = array_filter($cookieData, function ($cookieArray) use ($inventory) {
            return (int) $cookieArray['inventory_id'] !== $inventory['id'];
        });
        return $updatedCart;
    }
}
