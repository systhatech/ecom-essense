<?php

namespace Systha\EssencesSite\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class PagesController extends Controller
{
    protected $menu;
    public function __construct()
    {
        $host = request()->getHttpHost();

        if (strpos($host, 'www.') !== false) {
            $indexof = strpos($host, 'www.') + 4;
            $host = substr($host, $indexof, strlen($host) - 1);
        }
        $this->menu = $host;
        $this->menu = explode('/', request()->path());
    }
    public function home(){
        $comp = array();
        $host = $this->menu;
        $comp = $this->getComp();     
        $data = isset($comp[$host[0]]) ? $comp[$host[0]] : '';
       
        return view('component.index',compact('data'));

    }
    public function getComp(){
        $comp[''] = ['header','nav', 'top-cart', 'home', 'global-sale', 'popular-product', 'shop-by-category', 'brand-logo', 'footer'];
        $comp['home'] = ['header', 'nav', 'top-cart', 'home', 'global-sale', 'popular-product', 'shop-by-category', 'brand-logo', 'footer'];
        $comp['contact'] = ['header', 'nav', 'top-cart', 'contact', 'how-to-find', 'footer'];
        $comp['blog'] = ['header', 'nav', 'top-cart', 'blog-slider', 'blog-body', 'footer'];
        $comp['single-blog'] = ['header', 'nav', 'top-cart', 'blog-single', 'footer'];
        $comp['checkout'] = ['header', 'nav', 'top-cart', 'checkout', 'footer'];
        $comp['single-product-details'] = ['header', 'nav', 'top-cart', 'single-product-details', 'footer'];
        $comp['shop'] = ['header', 'nav', 'top-cart', 'shop-slider', 'shop-side-bar', 'shop', 'footer'];
        $comp['search'] = ['header', 'nav', 'top-cart', 'search-slider', 'shop-side-bar', 'search', 'footer'];

        $comp['cart'] = ['header', 'nav', 'cart', 'footer'];
        return $comp;
    }

}   
