<?php

namespace Systha\EssencesSite\Http\Controllers;

use Systha\EssencesSite\Services\CurlFetchService;
use Illuminate\Http\Request;
use Systha\EssencesSite\Traits\HandlesLoginSession;
use PhpParser\Node\Stmt\Return_;
use SebastianBergmann\Environment\Console;

class BaseController extends Controller
{
    use HandlesLoginSession;

    protected $service;
    protected $menu;

    public function __construct()
    {
        $this->service = new CurlFetchService();
        //reading through url and making array
        $host = request()->getHttpHost();
        if (strpos($host, 'www.') !== false) {
            $indexof = strpos($host, 'www.') + 4;
            $host = substr($host, $indexof, strlen($host) - 1);
        }
        $this->menu = $host;
        $this->menu = explode('/', request()->path());
       
    }
    // public function getComp()
    // {
                      
    //     $comp[''] = ['header', 'nav', 'top-cart', 'new-collection','home', 'global-sale', 'popular-product',  'brand-logo', 'footer'];
    //     $comp['home'] = ['header', 'nav', 'top-cart', 'new-collection', 'home', 'global-sale', 'popular-product','brand-logo', 'footer'];
    //     $comp['contact'] = ['header', 'nav', 'top-cart', 'contact', 'how-to-find', 'footer'];
    //     $comp['blog'] = ['header', 'nav', 'top-cart', 'blog-slider', 'blog-body', 'footer'];
    //     $comp['single-blog'] = ['header', 'nav', 'top-cart', 'blog-single', 'footer'];
    //     $comp['checkout'] = ['header', 'nav', 'top-cart', 'checkout', 'footer'];               
    //     $comp['shop'] = ['header', 'nav', 'top-cart', 'shop-slider', 'shop-side-bar', 'shop', 'footer'];
    //     $comp['search'] = ['header', 'nav', 'top-cart', 'search-slider', 'shop-side-bar', 'search', 'footer'];
    //     $comp['products'] = ['header','nav', 'top-cart','product-detail', 'footer'];
    //     $comp['menu'] = ['header','nav', 'top-cart','shop', 'footer'];
    //     $comp['cart'] = ['header', 'nav', 'cart', 'footer'];
    //     return $comp;
    // }

    public function index(Request $request)
    {
        // //reading from url and applying the required component
        // $comp = array();
        // $host = $this->menu;
        // $comp = $this->getComp();
        // $dataComp = isset($comp[$host[0]]) ? $comp[$host[0]] : '';
        // //end reading
        if (method_exists($this->service, 'index')) {
            // dd($this->service->productsByMenu($request,32));        
            $data = $this->service->index($request);
            $brandsData = $this->service->brands($request);    
            $products = $this->service->products($request);
            $data['data']['categories'] = $this->categories($request);
            return view('EssencesSite::index', ['data' =>$data, 'products' => $products, 'brandsData'=>$brandsData]);
            // } else if (method_exists($this->service, 'main')) {
            //     $data = $this->service->main($request);
            //     return view('index', ['data' => $data]);
            // } else {
            //     abort(404, 'main method not found on curl service');
        }
        abort(404);
    }
  
    

    /**
     * Get header menus for your template
     *
     * @param Request $request
     * @return array
     */
    public function headerMenus(Request $request)
    {
        if (method_exists($this->service, 'headerMenus')) {
            $data = $this->service->headerMenus($request);
            return $data;
        }
        return [];
    }
    
    public function products(Request $request)
    {
        if (method_exists($this->service, 'products')) {
            $data = $this->service->products($request);
            return response(['data' => $data]);
        }
        
    }
    
    public function productDetail(Request $request, int $id)
    {
        // $comp = array();
        // $host = $this->menu;
        // $comp = $this->getComp();
        // $dataComp = isset($comp[$host[0]]) ? $comp[$host[0]] : '';
    
        if (method_exists($this->service, __FUNCTION__)) {
            $data['data']['product'] = $this->service->{__FUNCTION__}($request, $id);
            $data['data']['header_menus'] = $this->headerMenus($request);
            $data['data']['footer_menus'] = $this->footerMenus($request);
            return view('EssencesSite::pages.product-detail', ['data' => $data]);
        }
        abort(404);
    }
    
    /**
     * Get footer menus for your template
     *
     * @param Request $request
     * @return array
     */
    public function footerMenus(Request $request)
    {
        if (method_exists($this->service, 'footerMenus')) {
            return $this->service->footerMenus($request);
        }
        return [];
    }

    /**
     * Return view page according to your menu id
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Support\Facades\View
     */
    public function menuPage(Request $request, int $id)
    {
        if (method_exists($this->service, 'menuPage')) {
            $data = $this->service->menuPage($request, $id);
            $products = $this->service->products($request);
            $brandsData = $this->service->brands($request);
            // dd($data);
            if(isset($data['data'])):            
            $data['data']['header_menus'] = $this->headerMenus($request);
            $data['data']['footer_menus'] = $this->footerMenus($request);
            $data['data']['brands'] = $this->service->brands($request);
            endif;
            return view('EssencesSite::index', ['data' => $data, 'products'=>$products]);
        }
        abort(404);
    }
    // public function menuPage(Request $request, int $id)
    // {
    //     if (method_exists($this->service, 'menuPage')) {
    //         $data = $this->service->menuPage($request, $id);
    //         $products = $this->service->products($request);
    //         // dd($data);
    //         if (isset($data['data'])) :
    //             $data['data']['header_menus'] = $this->headerMenus($request);
    //             $data['data']['footer_menus'] = $this->footerMenus($request);
    //         endif;
    //         return view('index', ['data' => $data, 'products' => $products]);
    //     }
    //     abort(404);
    // }


    /**
     * Get all products in a menu/category
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    
    public function categoryProducts(Request $request, int $id)
    {        
        if (method_exists($this->service, 'categoryProducts')) {
            $data = $this->service->categoryProducts($request, $id);
          
            return response(['data' => $data['data']], 200);
        }
        return response(['message' => "Service doesnot contain feature to fetch category products"], 500);
    }
        
    public function getAllProducts(Request $request, int $id)    {
        
        if (method_exists($this->service, 'getAllProducts')) {
            $data = $this->service->getAllProducts($request, $id);           
            if(isset($data['data'])){                
                return response(['data' => $data['data']], 200);
            } 
            return response(['data' => ['data not available currently']], 200);
        }
        return response(['message' => "Service doesnot contain feature to fetch category products"], 500);
    }        
    /**
     * Offer view page
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Support\Facades\View
     */
    // public function offerView(Request $request, int $id)
    // {
    //     if (method_exists($this->service, 'offerView')) {
    //         $data = $this->service->offerView($request, $id);
    //         $data['data']['header_menus'] = $this->headerMenus($request);
    //         $data['data']['footer_menus'] = $this->footerMenus($request);
    //         return view('pages.offer-view', ['data' => $data]);
    //     }
    //     abort(404);
    // }

    /**
     * featured products
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function featuredProducts(Request $request)
    {
        if (method_exists($this->service, 'featuredProducts')) {
            $data = $this->service->featuredProducts($request);
            return response(['data' => $data], 201);
        }
        return response(['message' => "Products not found"], 201);
    }

    /**
     * Product details
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Support\Facades\View
     */

    /**
     * Get inventory from selections
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function getInventory(Request $request, int $id)
    {
        if (method_exists($this->service, 'getInventory')) {
            $data = $this->service->getInventory($request, $id);
            return response(['data' => $data], 200);
        }
        return response(['message' => 'Inventory not found!']);
    }

    /**
     * cart page
     *
     * @param Request $request
     * @return \Illuminate\Support\Facades\View
     */
    // public function cart(Request $request)
    // {
    //     $data['cart'] = (new CartController())->getCart($request)->getOriginalContent();
    //     $data['data']['header_menus'] = $this->headerMenus($request);
    //     $data['data']['footer_menus'] = $this->footerMenus($request);
    //     return view("pages.cart", ['data' => $data]);
    // }

    /**
     * Checkout page
     *
     * @param Request $request
     * @return \Illuminate\Support\Facades\View
     */
    public function checkout(Request $request)
    {
        $data['cart'] = (new CartController())->getCart($request)->getOriginalContent();
        $data['data']['header_menus'] = $this->headerMenus($request);
        $data['data']['footer_menus'] = $this->footerMenus($request);
        return view("EssencesSite::pages.checkout", ['data' => $data]);
    }
    
    public function proceedCheckout(Request $request){
        $data['cart'] = (new CartController())->getCart($request)->getOriginalContent();
        $data['data']['header_menus'] = $this->headerMenus($request);
        $data['data']['footer_menus'] = $this->footerMenus($request);
        return view("EssencesSite::component.proceedCheckout", ['data' => $data]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            
            'card_no' => 'required | min:12',
            'card_cvv' => 'required',
            'expy' => 'required',
            'expm' => 'required'
            
        ], [
            'required' => 'This field is required',
            'email' => 'Must be a valid email',
            'min' => 'Must be valid',
            'confirmed' => 'Confirmation does not match'
        ]);
        if (method_exists($this->service, 'placeOrder')) {
            $data = $this->service->placeOrder($request);
            // dd($data);
            return view('EssencesSite::component.order-complete', ['data' => $data]);
        }
    }
    /**
     * Fetch and return resource files [primarily images] from api
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    // public function getFile(Request $request)
    // {
    //     if (method_exists($this->service, 'getFile')) {
    //         return response($this->service->getFile($request), 201, ["Content-Type" => "image/png"]);
    //     }
    //     return response(['message' => 'Image could not be downloaded!']);
    // }
    public function registerPage(Request $request)
    {
        $data = [];
        $data['data']['header_menus'] = $this->headerMenus($request);
        $data['data']['footer_menus'] = $this->footerMenus($request);
        return view('EssencesSite::pages.sign-up', ['data' => $data]);
    }
    public function register(Request $request)
    {
        if (method_exists($this->service, 'register')) {
            $data = $this->service->register($request);
            
            if (isset($data['errors']) && count($data['errors'])) {
                return response(['errors' => $data['errors']],  422);
            }
        }
    }
    public function loginPage(Request $request)
    {
        $data = [];
        $data['data']['header_menus'] = $this->headerMenus($request);
        $data['data']['footer_menus'] = $this->footerMenus($request);
        return view('EssencesSite::pages.sign-in', ['data' => $data]);
    }
    public function login(Request $request)
    {
        if (method_exists($this->service, 'login')) {
            $data = $this->service->login($request);
            if (isset($data['errors']) && count($data['errors'])) {
                
                if (isset($data['errors']['user'])) {
                    return response(['errors'=>['email' => "The email provided is incorrect!"]], 422);
                }
                if (isset($data['errors']['password'])) {
                    return response(['errors'=>['password' => "The password is incorrect!"]], 422);
                }
            }
            if(is_array($data)){
                $this->setLoggedInUser($data);
            }
           
            return $data;
        }
    }
    public function logoutUser()
    {
        $this->logoutUserSession();
    }

    public function contact(Request $request)
    {
        if (method_exists($this->service, 'index')) {
            $data = $this->service->index($request);

            return view('EssencesSite::pages.contact', ['data' => $data]);
            // } else if (method_exists($this->service, 'main')) {
            //     $data = $this->service->main($request);
            //     return view('index', ['data' => $data]);
            // } else {
            //     abort(404, 'main method not found on curl service');
        }
        abort(404);
    }

    public function orderPlacedPage(Request $request)
    {
        if (method_exists($this->service, 'placeOrder')) {
            $data = $this->service->placeOrder($request);           
            return view('EssencesSite::temporary.orderPlacedCopy', ['data' => $data]);
        }
    }
    
    public function getOrder(Request $request)
    {
        if (method_exists($this->service, 'getOrder')) {
            $data = $this->service->getOrder($request);
            return $data;
        }
    }

    public function checkEmail(Request $request)
    {
        if(method_exists($this->service, 'checkEmail')){
            $data = $this->service->checkEmail($request);    
            if(is_array($data)){
                if($data['status']===0 && $data['create']===0 ){
                    return response(['create'=>$data['create'],'message'=> $data['message'],'status' => 422], 422);
                }
                if($data['status'] === 1 && $data['create'] ===0){
                    return response(['create'=>$data['create'],'message'=> 'user already exists','status'=> 201],201);
                }
                if($data['status'] === 1 && $data['create'] ===1){
                    return response(['create'=>$data['create'],'message'=> 'user doesnot exits','status'=> 202],202);
                }            
            }
        }
    }



    public function search(Request $request)
    {
        if(method_exists($this->service, 'search')) {
            $searchData = $this->service->search($request);
            // dd($searchData);
            $data = [];
            $data['data'] = [];
            $data['data']['header_menus'] = $this->headerMenus($request);
            $data['data']['footer_menus'] = $this->footerMenus($request);
            $data['data']['brands'] = $this->service->brands($request);
            // if (isset($searchData['data'])) :
            //     $searchData['data']['header_menus'] = $this->headerMenus($request);
            //     $searchData['data']['footer_menus'] = $this->footerMenus($request);
            // endif;
            // dd($data);
            return view('EssencesSite::pages.search',['searchData'=>$searchData,'data'=>$data, 'searchTerm'=>$request->term]);            
            // return response(['searchData' => $data]);
        }
        abort(404);
    }

    public function offerView(Request $request , int $id)       
    {
        if(method_exists($this->service, 'offerView')){
            $data = $this -> service -> offerView($request,$id);
            $data['data']['header_menus'] = $this->headerMenus($request);
            $data['data']['footer_menus'] = $this->footerMenus($request);
            $data['data']['brands'] = $this->service->brands($request); 
            return view('EssencesSite::pages.offer-view',['data'=> $data]);
        }
    }

    public function popularProducts(Request $request)
    {
        if(method_exists($this->service, 'popularProducts')){
            $data = $this->service->popularProducts($request);
            return $data;
        }
    }
    public function paginatedProducts(Request $request)
    {
        $req = json_decode(array_key_first($request->all()),true);
       
        if(method_exists($this->service, 'paginatedProducts')){
            $data = $this-> service->paginatedProducts($request);
            // dd($data);
            return response(['data'=>$data]);
        }
        abort(404);
    }
    public function subscribe(Request $request)
    { 
        $request->validate([
            'sub_email'=>'required|email',
        ],['sub_email.required'=>'Email is required for subscription.',
            'sub_email.email'=> 'Please provide valid email. ']);
        if(method_exists($this->service,'subscribe')){
            $data = $this->service->subscribe($request);   
            return response(['message' => 'Subscribed to newsletter!']);
        }
    }
    public function wishPage(Request $request)
    {
        $data = [];
        $data['data']['header_menus'] = $this->headerMenus($request);
        $data['data']['footer_menus'] = $this->footerMenus($request);
        return view('EssencesSite::pages.wish', ['data' => $data]);
    }
  
    public function categories(Request $request)
    {
        if (method_exists($this->service, 'categories')) {
            $data = $this->service->categories($request);
            return $data;
        }
        return [];
    }
    public function homeCategoryPage(Request $request, $id)
    {
        
        $data = $this->service->categoryProducts($request, $id);
        // dd($data);
        $data['data']['header_menus'] = $this->headerMenus($request);
        $data['data']['footer_menus'] = $this->footerMenus($request);       
        $data['data']['brands'] = $this->service->brands($request);              
        return view('EssencesSite::pages.homeCategory', ['data' => $data]);
    }
  
    public function blogPage(Request $request)
    {
        if (method_exists($this->service, 'blogs')) {
            $data = $this->service->blogs($request);           
            return $data;
        }
    }
    public function blogPageSingle(Request $request, $id)
    {
        if (method_exists($this->service, 'blogs')) {
            $data = $this->service->blogs($request);
            $data['data']['header_menus'] = $this->headerMenus($request);
            $data['data']['footer_menus'] = $this->footerMenus($request);     
            return view('EssencesSite::pages.blog' ,['data'=>$data]);
        }
    }
}
