@php
    $url = request()->segment(count(request()->segments()));
    $settings = DB::table('site_settings')->where('smallname' , env('APP_NAME'))->first();
@endphp
<style type="text/css">
.main-menu .has-submenu ul.submenu {
    display: none; /* Initially hide the submenu */
    position: absolute;
    left: 0;
    top: 100%;
    background: #fff;
/*    padding: 10px;*/
    list-style: none;
    z-index: 999;
    width: 100%;
}

.main-menu .has-submenu:hover ul.submenu {
    width: 254px;
    display: block; /* Show submenu on hover */
}

.main-menu .submenu li {
    margin: 0;
    padding: 0;
}

.main-menu .submenu li a {
    padding: 5px 10px;
    display: block;
    color: #333;
}
</style>
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="tp-preloader-content">
                <div class="tp-preloader-logo">
                    <div class="tp-preloader-circle">
                        <svg width="190" height="190" viewBox="0 0 380 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle stroke="#D9D9D9" cx="190" cy="190" r="180" stroke-width="6"
                                stroke-linecap="round">
                            </circle>
                            <circle stroke="red" cx="190" cy="190" r="180" stroke-width="6"
                                stroke-linecap="round"></circle>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::check() && Auth::user()->type == 'admin')
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center;">
        <strong>Admin Alert:</strong> You are logged in as an admin.
    </div>
@endif
@if($settings->top_navbar == 1)
<div class="top-navbar">
    <div class="scrolling-text-container">
        <div class="scrolling-text">
            @foreach(DB::table('topbar_links')->get() as $r)
            <a href="{{ $r->link }}" class="scrolling-link">{{ $r->tittle }}</a>
            @endforeach
        </div>
    </div>
</div>
@endif
<div class="back-to-top-wrapper">
    <button id="back_to_top" type="button" class="back-to-top-btn">
        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </button> 
</div>
<div class="offcanvas__area offcanvas__radius">
    <div class="offcanvas__wrapper">
        <div class="offcanvas__close">
            <button class="offcanvas__close-btn offcanvas-close-btn">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <div class="offcanvas__content">
            <div class="offcanvas__top mb-70 d-flex justify-content-between align-items-center">
                <div class="offcanvas__logo logo">
                    <a href="{{ url('') }}">
                        <img src="{{ url('public/images') }}/{{ $settings->header_logo }}" alt="{{ $settings->site_name }}">
                    </a>
                </div>
            </div>
            <div class="offcanvas__category pb-40">
                <div class="tp-category-mobile-menu">
                </div>
            </div>
            <div class="tp-main-menu-mobile fix d-none d-lg-none mb-40">
                <div class="mr-3">
                    <div class="tp-header-category tp-category-menu tp-header-category-toggle d-block d-lg-none">
                        <button class="tp-category-menu-btn tp-category-menu-toggle">
                            <span>
                                <i class="fa-light fa-bars fa-2x"></i>
                            </span>
                        </button>
                        <nav class="tp-category-menu-content">

                            <ul>
                                <li>
                                    <a href="{{ url('phone-plans') }}">Phone Plans</a>
                                    <ul>
                                        <li><a href="{{ url('') }}/phone-plans/plan1">Plan 1</a></li>
                                        <li><a href="{{ url('') }}/phone-plans/plan2">Plan 2</a></li>
                                        <li><a href="{{ url('') }}/phone-plans/plan3">Plan 3</a></li>
                                    </ul>
                                </li>
                                @foreach(DB::table('sitelinks')->where('headerlink', 1)->orderBy('order')->get() as $r)
                                    @if($r->url != 'phone-plans')
                                        <li><a href="{{ url('') }}/{{ $r->url }}">{{ $r->name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="offcanvas__contact align-items-center">
                <div class="tp-header-action-item topcontact">
                    <h4 class="text-black mb-0"><i class="fa-light fa-phone-volume"></i>{{ $settings->site_phonenumber }}</h4>
                    <p class="m-0 text-black">Get help from a human Call Or Text</p>
                </div>
            </div>
        </div>
        <div class="offcanvas__bottom">
            <div class="offcanvas__footer d-flex align-items-center justify-content-between">
            </div>
        </div>
    </div>
</div>
<div class="body-overlay"></div>
<div id="tp-bottom-menu-sticky" class="tp-mobile-menu d-lg-none">
    <div class="container">
        <div class="row row-cols-4">
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <a href="{{ url('') }}" class="tp-mobile-item-btn activevv">
                        <i class="flaticon-store"></i>
                        <span>Home</span>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <button class="tp-mobile-item-btn tp-search-open-btn">
                        <i class="flaticon-search-1"></i>
                        <span>Search</span>
                    </button>
                </div>
            </div>
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <a href="{{ url('login') }}" class="tp-mobile-item-btn">
                        <i class="flaticon-user"></i>
                        <span>Account</span>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="tp-mobile-item text-center">
                    <button class="tp-mobile-item-btn tp-offcanvas-open-btn">
                        <i class="flaticon-menu-1"></i>
                        <span>Menu</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="tp-search-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="tp-search-form">
                    <div class="tp-search-close text-center mb-20">
                        <button class="tp-search-close-btn tp-search-close-btn"></button>
                    </div>
                    <form action="#">
                        <div class="tp-search-input mb-10">
                            <input type="text" placeholder="Search">
                            <button type="submit"><i class="flaticon-search-1"></i></button>
                        </div>
                        <div class="oper_user_mobile">
                            <ul>
                                <li> <a href="{{ url('videos') }}">Video</a></li>
                                <li> <a href="{{ url('blogs') }}">Blog</a></li>
                            </ul>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<header>
    <div class="tp-header-area p-relative z-index-11 bg-white tp-header-sticky" id="header-sticky">
        <div class="tp-header-main">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2 col-md-12">
                        <div class="logo">
                            <a href="{{ url('') }}">
                                <img src="{{ url('public/images') }}/{{ $settings->header_logo }}" alt="{{ $settings->site_name }}">
                            </a>
                        </div>
                        <div class="mr-3">
                            <div class="caedrf mobilehj d-block d-lg-none">
                                <a href="#" class="carticon position-relative dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-light fa-bag-shopping"></i>
                                    <span  class="cart-count">0</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <div class="carty_d d-flex justify-content-between">
                                        <div class="cart_heading">
                                            <h3>Cart (0)</h3>
                                        </div>
                                        <div class="show_al_btn">
                                            <h3><a href="{{ url('cart') }}">Show All</a></h3>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="ps-3 pt-2">Your Cart is Empty...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-4 d-none d-lg-block">
                        <div class="tp-header-search">
                            <div class="tp-header-search-wrapper d-flex align-items-center">
                                <div class="tp-header-search-box">
                                    <input type="text" id="search-input" placeholder="What are you looking for?">
                                    <div id="search-results" class="search-results d-none">
                                        
                                    </div>
                                </div>
                                <div class="tp-header-search-btn">
                                    <button type="submit">
                                        <i class="fa-regular fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-5 col-md-8 d-none d-lg-block">
                        <div class="tp-header-main-right d-flex align-items-center justify-content-end">
                            <div class="tp-header-action d-flex align-items-center">
                                <div class="tp-header-action-item tp-header-category-toggle">
                                    <div class="cart-wrapper">
                                        <a href="#" id="cartIcon" class="carticon position-relative">
                                            <i class="fa-light fa-bag-shopping"></i>
                                            <span class="cart-count">0</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="tp-header-action-item user-menu">
                                    @if(Auth::check())

                                    <div class="user-menu-dropdown">
                                        <a href="javascript:void(0)" class="user-menu-toggle">
                                            <img class="user-avatar" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="User Avatar">
                                        </a>
                                        <div class="user-menu-dropdown-content">
                                            @if(Auth::user()->type == 'admin')
                                            <a href="{{ url('admin/orders/create-order') }}" class="user-menu-item">Enter Order</a>
                                            <a href="{{ url('admin/dashboard') }}" class="user-menu-item">Admin Dashboard</a>
                                            <a href="{{ url('admin/website/settings') }}" class="user-menu-item">Settings</a>
                                            @else
                                            <a href="{{ url('user/dashboard') }}" class="user-menu-item">My Account</a>
                                            <a href="{{ url('user/dashboard') }}" class="user-menu-item">My Orders</a>
                                            @endif
                                            <a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="user-menu-item">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    @else
                                    <a href="{{ url('login') }}" class="login-icon"><i class="fa-light fa-user"></i></a>
                                    @endif
                                </div>
                                <div class="tp-header-action-item topcontact ms-4">
                                    <h4 class="text-black mb-0"><i class="fa-light fa-phone-volume"></i> {{ $settings->site_phonenumber }}
                                    </h4>
                                    @if(!Auth::check())
                                    <p class="m-0 text-black">Get help from a human Call Or Text</p>
                                    @endif
                                </div>
                                <div class="tp-header-action-item d-lg-none">
                                    <button type="button" class="tp-header-action-btn tp-offcanvas-open-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16"
                                            viewBox="0 0 30 16">
                                            <rect x="10" width="20" height="2" fill="currentColor" />
                                            <rect x="5" y="7" width="25" height="2"
                                                fill="currentColor" />
                                            <rect x="10" y="14" width="20" height="2"
                                                fill="currentColor" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tp-header-bottom tp-header-bottom-border d-none d-lg-block" id="header-sticky">
            <div class="container-fluid">
                <div class="tp-mega-menu-wrapper p-relative">
                    <div>
                        <div class="main-menu menu-style-1">
                            <nav class="tp-main-menu-content">
                                <ul class="rtb">
                                    @php
                                        $phonePlans = DB::table('plans') ->select('plan_type_text') ->groupBy('plan_type_text') ->get();
                                    @endphp
                                    @foreach(DB::table('sitelinks')->where('headerlink', 1)->orderBy('order')->get() as $r)
                                        @if($r->url == 'phone-plans')
                                            <li class="has-submenu">
                                                <a href="{{ url('phone-plans') }}">Phone Plans</a>
                                                <ul class="submenu">
                                                    @foreach($phonePlans as $ph)
                                                    @if($ph->plan_type_text)
                                                    <li><a href="{{ url('plan-detail') }}/{{ $ph->plan_type_text }}">{{ $ph->plan_type_text }}</a></li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @else
                                            <li><a href="{{ url('') }}/{{ $r->url }}">{{ $r->name }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>