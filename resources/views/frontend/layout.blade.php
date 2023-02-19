<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}} ">
        <!-- Flat Icon CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/fonts/flaticon.css')}} ">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.min.css')}} ">
        <!-- Box Icon CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/boxicons.min.css')}} ">
        <!-- Mean Menu CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.css')}} ">
        <!-- Revolution CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/settings.css')}} ">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/layers.css')}} ">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/navigation.css')}} ">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css')}} ">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css')}} ">
        <!-- Modal Video CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/modal-video.min.css')}} ">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}} ">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}} ">
        <!-- font awesome cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- toastr -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

        <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png')}}">

        <title>@yield('page_title')</title>
    </head>
    <body>
        <style>
            .changeLang .list li{
                display: inline block !important;
            }
            .lang-part .nice-select{
                display:none !important;
            }
            .lang-part select{
                display:block !important;
            }
        </style>
        <!-- Preloader -->
        <div class="loader">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="pre-load">
                        <div class="inner one"></div>
                        <div class="inner two"></div>
                        <div class="inner three"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Preloader -->

        <!-- Header -->
        <div class="header-area">
            <div class="container-fluid">
                <div class="row align-items-center">

                    <!-- <div class="col-sm-6 col-lg-7">
                        <div class="left">
                            <ul>
                                <li>
                                    <i class="flaticon-delivery-truck"></i>
                                    <span>Free Next Day Delivery*</span>
                                </li>
                                <li>
                                    <i class="flaticon-quality"></i>
                                    <span>Best Price Guarantee</span>
                                </li>
                                <li>
                                    <i class="flaticon-call-center"></i>
                                    <span>24/7 Customer Support</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-5">
                        <div class="right">
                            <div class="inner">
                                <select>
                                    <option>$ USD</option>
                                    <option>EUR</option>
                                    <option>GBP</option>
                                    <option>CAD</option>
                                </select>
                            </div>
                            <div class="inner">
                                <form>
                                    <select>
                                        <option>English</option>
                                        <option>العربيّة</option>
                                        <option>Deutsch</option>
                                        <option>Português</option>
                                        <option>简体中文</option>
                                    </select>
                                </form>
                            </div>
                            <div class="inner">
                                <div class="call">
                                    <i class="flaticon-phone-call"></i>
                                    <a href="tel:9905324980">990-532-4980</a>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- Nav Top -->
        <div class="nav-top-area">
            <div class="container-fluid">
                <div class="row align-items-center">

                    <div class="col-lg-2">
                        <div class="left">
                            <a href="{{ url('/') }}">
                                <img src="{{ url('frontend/images/logo.png') }}" alt="Logo">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <!-- <div class="middle">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search Your Keywords">
                                    <button type="submit" class="btn">
                                        <i class='bx bx-search'></i>
                                    </button>
                                </div>
                            </form>
                        </div> -->
                    </div>
                   
                    <div class="col-lg-5">
                        <div class="right">
                            <ul>
                                <li>
                                    <button type="button" class="btn wishlist" data-bs-toggle="modal" data-bs-target="#exampleModalWishlist" data-bs-whatever="@mdo">
                                        <i class='bx bx-heart'></i>
                                    </button>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="showCartDetailInCartIcon(); cartCount();">
                                    <button type="button" class="btn wishlist cart-popup-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                        <i class='bx bxs-cart'></i>
                                        <span id="cart-count">1</span>
                                    </button>
                                    </a>
                                </li>
                                <li>
                                    @if(Auth::guard('member')->user())
                                    <a class="join" href="{{ url('/logout') }}">
                                        <i class="flaticon-round-account-button-with-user-inside"></i>
                                        {{ GoogleTranslate::trans('Logout', app()->getLocale()) }}
                                    </a>
                                    @else
                                    <a class="join" href="{{ url('/login') }}">
                                        <i class="flaticon-round-account-button-with-user-inside"></i>
                                        {{ GoogleTranslate::trans('Login', app()->getLocale()) }}
                                    </a>
                                    @endif
                                </li>
                                <li>
                                    <a class="join" href="{{ url('/register') }}">
                                        <i class="flaticon-round-account-button-with-user-inside"></i>
                                        {{ GoogleTranslate::trans('Register', app()->getLocale()) }}
                                    </a>
                                </li>
                                <li class="lang-part">
                                    <select id="changeLang" name="lang" class="join">
                                        <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>
                                        <option value="es" {{ session()->get('locale') == 'es' ? 'selected' : '' }}>Spanish</option>
                                        <option value="zh-cn" {{ session()->get('locale') == 'zh-cn' ? 'selected' : '' }}>Chinese</option>
                                    </select>
                                </li>
                                <!-- <li>
                                    <a style="color: black;" class="" href="{{ url('/cart') }}">
                                        <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                                    </a>
                                </li> -->
                                
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Nav Top -->
        
        <!-- Navbar -->
        <div class="navbar-area sticky-top"> 
            <!-- Menu For Mobile Device -->
            <div class="mobile-nav">
                <a href="index.html" class="logo">
                    <img src="assets/images/logo.png" alt="Logo">
                </a>
            </div>

            <!-- Menu For Desktop Device -->
            <div class="main-nav">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-md navbar-light">

                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="{{ url('/') }}" class="nav-link dropdown-toggle active">{{ GoogleTranslate::trans('Home', app()->getLocale()) }}</a>
                                </li>
                                @if(Auth::guard('member')->user())
                                @foreach(\App\Models\Category::where('is_deleted', 0)->where('parent_id', null)->orderBy('cat_sku', 'ASC')->get() as $category)
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">{{ $category->category_name }} <i class='bx bx-chevron-down'></i></a>
                                    <ul class="dropdown-menu" style="display:flex;">
                                        @php
                                            $subCat = \App\Models\Category::where('is_deleted', 0)->where('parent_id', $category->id)->orderBy('cat_sku', 'ASC')->get();
                                        @endphp

                                        @if(count($subCat) > 0)
                                        <div class="nasted-nav-list mt-3">
                                        <li class="nav-item"><a href="{{ url('/category/'.$category->id) }}" class="nav-link dropdown-toggle">All</a></li>
                                            @foreach($subCat as $key=>$sub_category)
                                                @if($key <= 4)
                                                <li class="nav-item"><a href="{{ url('/category/'.$sub_category->id) }}" class="nav-link dropdown-toggle">{{ $sub_category->category_name }}</a></li>
                                                
                                                @endif
                                            @endforeach
                                        </div>
                                        @endif
                                        @if(count($subCat) > 5)
                                        <div class="nasted-nav-list mt-3">
                                            @foreach($subCat as $key=>$sub_category)
                                                @if($key >= 5 && $key <=10)
                                                    <li class="nav-item"><a href="{{ url('/category/'.$sub_category->id) }}" class="nav-link dropdown-toggle">{{ $sub_category->category_name }}</a></li>
                                                
                                                @endif
                                            @endforeach
                                        </div>
                                        @endif

                                        @if(count($subCat) > 10)
                                        <div class="nasted-nav-list mt-3">
                                            @foreach($subCat as $key=>$sub_category)
                                                @if($key >= 11 && $key <=15)
                                                    <li class="nav-item"><a href="{{ url('/category/'.$sub_category->id) }}" class="nav-link dropdown-toggle">{{ $sub_category->category_name }}</a></li>
                                                
                                                @endif
                                            @endforeach
                                        </div>
                                        @endif
                                    </ul>
                                </li>
                                @endforeach
                                @else
                                @foreach(\App\Models\Category::where('is_deleted', 0)->where('parent_id', null)->where('category_authorize', 'all')->orderBy('cat_sku', 'ASC')->get() as $category)
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">{{ $category->category_name }} <i class='bx bx-chevron-down'></i></a>
                                    <ul class="dropdown-menu" style="display:flex;">
                                        @php
                                            $subCat = \App\Models\Category::where('is_deleted', 0)->where('parent_id', $category->id)->where('category_authorize', 'all')->orderBy('cat_sku', 'ASC')->get();
                                        @endphp
                                        @if(count($subCat) > 0)
                                        <div class="nasted-nav-list mt-3">
                                        <li class="nav-item"><a href="{{ url('/category/'.$category->id) }}" class="nav-link dropdown-toggle">All</a></li>
                                            @foreach($subCat as $key=>$sub_category)
                                                @if($key <= 4)
                                                <li class="nav-item"><a href="{{ url('/category/'.$sub_category->id) }}" class="nav-link dropdown-toggle">{{ $sub_category->category_name }}</a></li>
                                                
                                                @endif
                                            @endforeach
                                        </div>
                                        @endif
                                        @if(count($subCat) > 5)
                                        <div class="nasted-nav-list mt-3">
                                            @foreach($subCat as $key=>$sub_category)
                                                @if($key >= 5 && $key <=10)
                                                    <li class="nav-item"><a href="{{ url('/category/'.$sub_category->id) }}" class="nav-link dropdown-toggle">{{ $sub_category->category_name }}</a></li>
                                                
                                                @endif
                                            @endforeach
                                        </div>
                                        @endif

                                        @if(count($subCat) > 10)
                                        <div class="nasted-nav-list mt-3">
                                            @foreach($subCat as $key=>$sub_category)
                                                @if($key >= 11 && $key <=15)
                                                    <li class="nav-item"><a href="{{ url('/category/'.$sub_category->id) }}" class="nav-link dropdown-toggle">{{ $sub_category->category_name }}</a></li>
                                                
                                                @endif
                                            @endforeach
                                        </div>
                                        @endif
                                    </ul>
                                </li>
                                @endforeach
                                @endif
                                <li class="nav-item">
                                    <a href="{{ url('/shop') }}" class="nav-link dropdown-toggle">{{ GoogleTranslate::trans('Shop', app()->getLocale()) }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">{{ GoogleTranslate::trans('About Us', app()->getLocale()) }}<i class='bx bx-chevron-down'></i></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{ url('/about-us') }}" class="nav-link dropdown-toggle">{{ GoogleTranslate::trans('About Us', app()->getLocale()) }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/certificates') }}" class="nav-link dropdown-toggle">{{ GoogleTranslate::trans('Certificates', app()->getLocale()) }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/faq') }}" class="nav-link dropdown-toggle">{{ GoogleTranslate::trans('Inquiry/Request a quote', app()->getLocale()) }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/privacy-policy') }}" class="nav-link dropdown-toggle">{{ GoogleTranslate::trans('Privacy Policy', app()->getLocale()) }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/contact-us') }}" class="nav-link dropdown-toggle">{{ GoogleTranslate::trans('Contact Us', app()->getLocale()) }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/site-map') }}" class="nav-link dropdown-toggle">{{ GoogleTranslate::trans('Site Map', app()->getLocale()) }}</a>
                                </li>
                            </ul>
                            <!-- <div class="side-nav">
                                <h4>Get <span>50%</span> Discount On Black Friday Offer <a href="products-on-sale.html">View Products On Sale</a></h4>
                            </div> -->

                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Navbar -->

        @yield('content')

        <!-- Footer -->
        <footer class="footer-area pt-100 pb-70">
            <div class="footer-shape">
                <img src="{{ asset('frontend/images/footer-right-shape.png') }}" alt="Shape">
                <img src="{{ asset('frontend/images/shape5.png') }}" alt="Shape">
            </div>
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-logo">
                                <a class="logo" href="#">
                                    <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo">
                                </a>
                                <ul>
                                    <li>
                                        <p>
                                        {{ GoogleTranslate::trans('We, Company Products Co., Ltd.', app()->getLocale()) }} <br>
                                            {{ GoogleTranslate::trans('established in 2004, are a company', app()->getLocale()) }} <br>
                                            {{ GoogleTranslate::trans('engaged in Paper and Biodegradable', app()->getLocale()) }} <br>
                                            {{ GoogleTranslate::trans('products for daily home use', app()->getLocale()) }} <br>
                                            {{ GoogleTranslate::trans('and catering industry use.', app()->getLocale()) }}
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-services">
                                <h3>{{ GoogleTranslate::trans('INTERNAL LINKS', app()->getLocale()) }}</h3>
                                <ul>
                                    <li>
                                        <a href="{{ url('/about-us') }}">{{ GoogleTranslate::trans('About Us', app()->getLocale()) }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/faq') }}">{{ GoogleTranslate::trans('FAQ', app()->getLocale()) }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/site-map') }}">{{ GoogleTranslate::trans('SiteMap', app()->getLocale()) }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/privacy-policy') }}">{{ GoogleTranslate::trans('Privacy Policy', app()->getLocale()) }}</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" onclick="addToMyFavorite('{{ URL::current() }}')">{{ GoogleTranslate::trans('Add to My Favorite', app()->getLocale()) }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/contact-us') }}">{{ GoogleTranslate::trans('Contact Us', app()->getLocale()) }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-links">
                                <h3>{{ GoogleTranslate::trans('PRODUCTS', app()->getLocale()) }}</h3>
                                <div class="row">
                                    <div class="col-6 col-sm-8 col-lg-8">
                                        <ul>
                                        @foreach(\App\Models\Product::where('is_deleted', 0)->inRandomOrder()->limit(6)->get(['id', 'name']) as $val)
                                            <li>
                                                <a href="{{ url('/single-product/'.$val->id) }}">{{ $val->name }}</a>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-services">
                                <h3>{{ GoogleTranslate::trans('SOME USEFUL LINKS', app()->getLocale()) }}</h3>
                                <ul>
                                    <li>
                                        <p>
                                            {{ GoogleTranslate::trans('Encyclopedia Britannica', app()->getLocale()) }} <br>
                                            {{ GoogleTranslate::trans('- First published in 1768', app()->getLocale()) }} <br>
                                            <a href="https://www.britannica.com">(www.britannica.com)</a>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            {{ GoogleTranslate::trans('International Committee of the Red Cross', app()->getLocale()) }}<br>
                                            {{ GoogleTranslate::trans('- Founded in 1768', app()->getLocale()) }} <br>
                                            <a href="https://www.icrc.org/">(www.ICRC.org)</a>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            {{ GoogleTranslate::trans('SGS-Test & Certification', app()->getLocale()) }}<br>
                                            <a href="https://www.sgs.com">(www.sgs.com)</a>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            {{ GoogleTranslate::trans('INTERTEK - Test & Certification', app()->getLocale()) }}<br>
                                            <a href="https://www.intertek.com/">(www.intertek.com)</a>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
        <!-- End Footer -->

        <!-- Copyright -->
        <div class="copyright-area">
            <div class="container">
                <div class="copyright-item">
                    <p>{{ GoogleTranslate::trans('Copyright @2023 All Rights Reserved', app()->getLocale()) }}</p>
                </div>
            </div>
        </div>
        <!-- End Copyright -->

        <!-- Cart Popup -->
        <div class="modal fade modal-right popup-modal" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="cart-body">
                    <div class="modal-header">
                        <h2>{{ GoogleTranslate::trans('Shopping Cart', app()->getLocale()) }} <span id="cart-count-number">0</span></h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="cart-table">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td>
                                            <h3></h3>
                                        </td>
                                        <td>
                                           
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn common-btn">
                        {{ GoogleTranslate::trans('Proceed To Checkout', app()->getLocale()) }}
                            <img src="assets/images/shape1.png" alt="Shape">
                            <img src="assets/images/shape2.png" alt="Shape">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Cart Popup -->

        <!-- Wishlist Popup -->
        <div class="modal fade modal-right popup-modal wishlist-modal" id="exampleModalWishlist" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>{{ GoogleTranslate::trans('Favorite Link', app()->getLocale()) }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="cart-table">
                            <ul>
                            @foreach(\App\Models\FavoriteLink::get() as $favlink)
                                <li style="display: flex !important; justify-content: space-between !important;">
                                    <a href="{{ url($favlink->link) }}" style="color:#434E6E;">{{ $favlink->link }}</a>
                                    <a href="javascript:void(0)" style="color:#434E6E;" onclick="deleteFavoriteLink('{{ $favlink->id }}')"><i class="fas fa-trash-alt"></i></a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Wishlist Popup -->

        <!-- Subscribe Modal -->
        <!-- <div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">            
                    <div class="subscribe-shape">
                        <img src="assets/images/subscribe-shape1.png" alt="Shape">
                        <img src="assets/images/subscribe-shape2.png" alt="Shape">
                        <img src="assets/images/subscribe-shape3.png" alt="Shape">
                    </div>
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-lg-6">
                                <div class="subscribe-img">
                                    <img src="assets/images/subscribe-main1.png" alt="Subscribe">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="subscribe-content">
                                    <h2>Subscribe Our Newsletter</h2>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidun</p>
                                    <form class="newsletter-form" data-toggle="validator">
                                        <input type="email" class="form-control" placeholder="Enter Your Email" name="EMAIL" required autocomplete="off">
                    
                                        <button class="btn common-btn" type="submit">
                                            Subscribe
                                            <img src="assets/images/shape1.png" alt="Shape">
                                            <img src="assets/images/shape2.png" alt="Shape">
                                        </button>
                                        <div id="validator-newsletter" class="form-result"></div>
                                        <div class="inner-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                                                <label class="form-check-label" for="flexCheckDefault5">
                                                    I accept all <a href="terms-conditions.html">Terms & Conditions*</a>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault6">
                                                <label class="form-check-label" for="flexCheckDefault6">
                                                    Don't show this message again
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End Subscribe Modal -->

        <!-- Go Top -->
        <div class="go-top">
            <i class='bx bxs-up-arrow-circle'></i>
            <i class='bx bxs-up-arrow-circle'></i>
        </div>
        <!-- End Go Top -->


        <!-- Essential JS -->
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <!-- Form Validator JS -->
        <script src="{{ asset('frontend/js/form-validator.min.js') }}"></script>
        <!-- Contact JS -->
        <script src="{{ asset('frontend/js/contact-form-script.js') }}"></script>
        <!-- Ajax Chip JS -->
        <script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }} "></script>
        <!-- Nice Select JS -->
        <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }} "></script>
        <!-- Mean Menu JS -->
        <script src="{{ asset('frontend/js/jquery.meanmenu.js') }} "></script>
        <!-- Revolution JS -->
		<script src="{{ asset('frontend/js/jquery.themepunch.tools.min.js') }} "></script>
		<script src="{{ asset('frontend/js/jquery.themepunch.revolution.min.js') }} "></script>
		<!-- The following part can be removed on Server for On Demand Loading) -->	
		<script src="{{ asset('frontend/js/extensions/revolution.extension.actions.min.js') }} "></script>
		<script src="{{ asset('frontend/js/extensions/revolution.extension.carousel.min.js') }} "></script>
		<script src="{{ asset('frontend/js/extensions/revolution.extension.kenburn.min.js') }} "></script>
		<script src="{{ asset('frontend/js/extensions/revolution.extension.layeranimation.min.js') }} "></script>
		<script src="{{ asset('frontend/js/extensions/revolution.extension.migration.min.js') }} "></script>
		<script src="{{ asset('frontend/js/extensions/revolution.extension.navigation.min.js') }} "></script>
		<script src="{{ asset('frontend/js/extensions/revolution.extension.parallax.min.js') }} "></script>
		<script src="{{ asset('frontend/js/extensions/revolution.extension.slideanims.min.js') }} "></script>
        <script src="{{ asset('frontend/js/extensions/revolution.extension.video.min.js') }} "></script>
        <!-- Mixitup JS -->
        <script src="{{ asset('frontend/js/jquery.mixitup.min.js') }} "></script>
        <!-- Owl Carousel JS -->
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }} "></script>
        <!-- Modal Video JS -->
        <script src="{{ asset('frontend/js/jquery-modal-video.min.js') }} "></script>
        <!-- Thumb Slider JS -->
        <script src="{{ asset('frontend/js/thumb-slide.js') }} "></script>
        <!-- Custom JS -->
        <script src="{{ asset('frontend/js/custom.js') }} "></script>

        <!-- toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
        <script type="text/javascript">
    
            var url = "{{ url('/lang/change') }}";
            
            $("#changeLang").change(function(){
                window.location.href = url + "?lang="+ $(this).val();
            });
            
        </script>

        {!! Toastr::message() !!}
        @yield('js')
        
    </body>
</html>