    <?php
    // $loggedInUser = getLoggedInUser();
    ?> 
     <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="/home"><img src="{{asset('EssencesSite/img/core-img/logo.png')}}" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                
                    <div class="classynav">
                        <ul>
                            @if(isset($data['data']))
                                @if (is_array($data['data']['header_menus']))   
                                    @foreach ($data['data']['header_menus'] as $key =>$menu)                                            
                                        <li><a @if(strtolower($menu['menu_name'])!=='home') href="/menu/{{$menu['id']}}" @else href="/" @endif>
                                                {{$menu['menu_name']}}</a>
                                            @if ($menu['sub_menus'])
                                                <div class="megamenu">
                                                    @foreach ($menu['sub_menus'] as $sub_menu)
                                                        @if (isset($sub_menu['sub_menus']) && count($sub_menu['sub_menus']))
                                                            <ul class="single-mega cn-col-4">
                                                                <li class="title">{{$sub_menu['menu_name']}}</li>
                                                                @foreach ($sub_menu['sub_menus'] as $child_menu)
                                                                    <li><a href="/menu/{{$child_menu['id']}}">{{$child_menu['menu_name']}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <ul class="single-mega cn-col-4">
                                                                <li class="title">
                                                                    <a href="/menu/{{$sub_menu['id']}}">{{$sub_menu['menu_name']}}</a>
                                                                </li>
                                                            </ul>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                {{-- <ul class="dropdown">
                                                    <li>
                                                        @foreach ($menu['sub_menus'] as $i => $sub_menu)
                                                        @if($sub_menu['sub_menus'])
                                                        <a href="/menu/{{$sub_menu['id']}}">{{$sub_menu['menu_name']}}</a>
                                                        @else
                                                        <a href="/menu/{{$sub_menu['id']}}">{{$sub_menu['menu_name']}}</a>
                                                        @endif 
                                                        @endforeach
                                                    </li>                                                
                                                </ul> --}}
                                            @endif                                        
                                        </li>
                                    @endforeach
                                @endif
                            @endif
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>  
            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area">
                    <form>
                        <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                        <button id="btn--search"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                <!-- Favourite Area -->
                <div class="favourite-area" >
                    <a href="/wish"><img src="{{asset('EssencesSite/img/core-img/heart.svg')}}" alt="">
                        
                        <span id="wishCount"></span>
                    </a>
                </div>
                <!-- User Login Info -->
                <div class="user-login-info">   
                           
                </div>
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="{{asset('EssencesSite/img/core-img/bag.svg')}}" alt=""> <span id="cartCount"></span></a>
                </div>
            </div>
    
        </div>
    </header>
 <script>
    $('#logoutUser').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        supportAjax({
            url: '/logout'
        }, (resp) => {
            window.location.reload();
        }, (err) => {
            console.log(error);
        })
    })
</script>
