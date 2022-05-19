<?php

 namespace Systha\EssencesSite\Services;

 use Illuminate\http\Request;
 use Systha\EssencesSite\Traits\HandlesCurlRequest;
 

 class CurlFetchService{
     use HandlesCurlRequest;
     protected $base_url;
     
     public function __construct()
     {
    //   $protocol = request()->secure() ? 'https://' : 'http://';
    //   $this->base_url = $protocol . 'localhost:8000';  
         $this->base_url = 'https://shop.systha.com';
     }
     public function index(Request $request)
     {
         $url = "{$this->base_url}/cms/api/v1/template";
         $method = "GET";
         $data =[];
         return $this->handle($url, $method,$data);
        }
        
        public function menuPage(Request $request, int $id)
        {
         $url = "{$this->base_url}/cms/api/v1/menu/{$id}";
         $method = "GET";
         $data =[];
         return $this->handle($url, $method,$data);
     }
        
        public function products(Request $request)
        {
         $url = "{$this->base_url}/cms/api/v1/products/all";
         $method = "GET";
         $data =[];
         return $this->handle($url, $method,$data);
     }
    
    //  public function getFile(Request $request)
    //  {
    //      $url = "http://localhost:8000/gerFile?path={$request->path}&file ={$request->file}";
    //      $method = "GET";
    //      $data = $request->all();
    //      return $this->handle($url,$method,$data);
    //  }

     public function headerMenus(Request $request)
     {
        $url = "{$this->base_url}/cms/api/v1/header-menus";
        $method = "GET";
        $data = [];
        return $this->handle($url,$method,$data);
    }

    public function footerMenus(Request $request)
    {
       $url = "{$this->base_url}/cms/api/v1/footer-menus";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }

    public function categoryProducts(Request $request, int $id)
    {
        $url = "{$this->base_url}/cms/api/v1/product-by-category/{$id}";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }
    public function getAllProducts(Request $request, int $id)
    {
        $url = "{$this->base_url}/cms/api/v1/products/{$id}";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }

    public function OfferVew(Request $request, int $id)
    {
        $url = "{$this->base_url}/cms/api/v1/offer/{$id}";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }

    public function featuredProducts(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/featured-Products";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }

    public function productDetail(Request $request, int $id)
    {
        $url = "{$this->base_url}/cms/api/v1/product/{$id}";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }

    public function getInventory(Request $request, int $id)
    {
        $url = "{$this->base_url}/cms/api/v1/get-inventory/{$id}";
        $method = "POST";
        $data = $request->all();
        return $this->handle($url, $method, $data);
    }

    public function getInventoryById(int $id)
    {
        $url = "{$this->base_url}/cms/api/v1/get-inventory-by-id/{$id}";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }
    public function addInvHold(int $id, int $qty)
    {
        $url = "{$this->base_url}/cms/api/v1/add-inv-hold/{$id}?qty={$qty}";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }
    public function deductInvHold(int $id, int $qty)
    {
        $url = "{$this->base_url}/cms/api/v1/deduct-inv-hold/{$id}?qty={$qty}";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }
    public function getAuthenticatedClient()
    {
        $url = "{$this->base_url}/cms/api/v1/check-login";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }

    public function placeOrder(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/order/store";
        $method = "POST";
        $data = $request->all();
        return $this->handle($url, $method, $data);
    }

    public function login(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/login";
        $method = "POST";
        $data = $request->all();
        return $this->handle($url, $method, $data);
    }

    public function register(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/register";
        $method = "POST";
        $data = $request->all();
        return $this->handle($url, $method, $data);
    }

    public function getLoggedInUser(int $id)
    {
        $url = "{$this->base_url}/cms/api/v1/retrieve-client/{$id}";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }   


    public function getOrder(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/dashboard/all-orders?client=31";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }
    
    public function checkEmail(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/check-email";
        $method = "POST";
        $data = $request->all();
        return $this->handle($url, $method, $data);
    }


    public function search(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/search";
        $method = "POST";
        $data = $request->all();
        return $this->handle($url, $method, $data);
    }

    public function offerView(Request $request, int $id)
    {
        $url = "{$this->base_url}/cms/api/v1/offer/{$id}";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }
    public function popularProducts(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/popular-products";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }
    public function paginatedProducts(Request $request)
    {
        $req = json_decode(array_key_first($request->all()), true);
        $url = "{$this->base_url}/cms/api/v1/products/all";
        $method = "GET";
        $data = [$req];
        return $this->handle($url, $method, $data);
    }
    public function brands(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/brands";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }
    public function subscribe(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/subscribe";
        $method = "POST";
        $data = $request->all();
        return $this->handle($url, $method, $data);
    }
    public function categories(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/categories";
        $method = "GET";
        $data = [];
        return $this->handle($url, $method, $data);
    }
    public function productsByMenu(Request $request, $id)
    {
        $url = "{$this->base_url}/cms/api/v1/products-by-menu/{$id}";
        $method = "GET";
        $data = $request->all();
        return $this->handle($url, $method, $data);
    }
    public function blogs(Request $request)
    {
        $url = "{$this->base_url}/cms/api/v1/blogs";
        $method = "GET";
        $data =[];
        return $this->handle($url, $method, $data);
    }
    public function singleBlogs(Request $request, $id)
    {
        $url = "{$this->base_url}/cms/api/v1/blogs/{$id}";
        $method = "GET";
        $data =[];
        return $this->handle($url, $method, $data);
    }
}
