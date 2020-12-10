<!DOCTYPE html>
<!-- saved from url=(0044) -->
<html class="no-js" lang="eng">
    <?php include_once "./head.php"; ?>
    <body>

        <!-- Preloader -->
        <div class="preloader" style="display: none;">
            <div class="load-list">
                <div class="load"></div>
                <div class="load load2"></div>
            </div>
        </div>
        <!-- End Preloader -->

        <!-- Top Bar -->
        <?php include_once "./nav.php"; ?>
        <!-- End Top Bar -->

        <!-- Logo Area -->
        <section class="logo-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="index.php"><img src="./images/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-md-5 padding-fix">
                        <?php  include "./search.php"; ?>
                    </div>
                    <div class="col-md-4">
                        <div class="carts-area d-flex">
                            <div class="call-box d-flex">
                                <div class="call-ico">
                                    <img src="./index_files/call.png" alt="">
                                </div>
                                <div class="call-content">
                                    <span>Call Us</span>
                                    <p>+1 (111) 426 6573</p>
                                </div>
                            </div>
                            <div class="cart-box ml-auto text-center">
                                <a href="" class="cart-btn">
                                    <img src="./index_files/cart.png" alt="cart">
                                    <span>2</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Logo Area -->

        <!-- Cart Body -->
   <!--      <div class="cart-body">
            <div class="close-btn">
                <button class="close-cart"><img src="./index_files/close.png" alt="">Close</button>
            </div>
            <div class="crt-bd-box">
                <div class="cart-heading text-center">
                    <h5>Shopping Cart</h5>
                </div>
                <div class="cart-content">
                    <div class="content-item d-flex justify-content-between">
                        <div class="cart-img">
                            <a href=""><img src="./index_files/cart1.png" alt=""></a>
                        </div>
                        <div class="cart-disc">
                            <p><a href="">SMART LED TV</a></p>
                            <span>1 x $199.00</span>
                        </div>
                        <div class="delete-btn">
                            <a href=""><i class="fa fa-trash-o"></i></a>
                        </div>
                    </div>
                    <div class="content-item d-flex justify-content-between">
                        <div class="cart-img">
                            <a href=""><img src="./index_files/cart2.png" alt=""></a>
                        </div>
                        <div class="cart-disc">
                            <p><a href="">SMART LED TV</a></p>
                            <span>1 x $199.00</span>
                        </div>
                        <div class="delete-btn">
                            <a href=""><i class="fa fa-trash-o"></i></a>
                        </div>
                    </div>
                </div>
                <div class="cart-btm">
                    <p class="text-right">Sub Total: <span>$398.00</span></p>
                    <a href="#">Checkout</a>
                </div>
            </div>
        </div>
        <div class="cart-overlay"></div> -->
        <!-- End Cart Body -->

        <!-- Sticky Menu -->
    <!--     <section class="sticky-menu sticky">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <div class="sticky-logo">
                            <a href="index.html"><img src="./index_files/logo.png" alt="" class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7">
                        <div class="main-menu">
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item"><a>HOME <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown list-unstyled">
                                        <li><a href="index.html">Home Style 1</a></li>
                                        <li><a href="02-home-two.html">Home Style 2</a></li>
                                    </ul>
                                </li>
                                <li class="list-inline-item mega-menu"><a>MEGA MENU <i class="fa fa-angle-down"></i></a>
                                    <div class="mega-box">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="clt-area">
                                                    <h6>Clothing</h6>
                                                    <div class="link-box">
                                                        <a href="">- Western Clothing</a>
                                                        <a href="">- Traditional Clothing</a>
                                                        <a href="">- Winter Clothing</a>
                                                        <a href="">- Summer Clothing</a>
                                                        <a href="">- Inner Wear</a>
                                                        <a href="">- Night Wear</a>
                                                        <a href="">- Mens Clothing</a>
                                                        <a href="">- Womens Clothing</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="sm-phn">
                                                    <h6>Smartphones</h6>
                                                    <div class="dept-box">
                                                        <a href="">- Samsung</a>
                                                        <a href="">- Huawei</a>
                                                        <a href="">- One Plus</a>
                                                        <a href="">- Xiaomi</a>
                                                        <a href="">- Iphone</a>
                                                        <a href="">- Blackberry</a>
                                                        <a href="">- Nokia</a>
                                                        <a href="">- Oppo</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="lt-news">
                                                    <h6>Latest News</h6>
                                                    <div class="news-box d-flex">
                                                        <div class="news-img">
                                                            <img src="./index_files/mega-img-1.jpg" alt="">
                                                        </div>
                                                        <div class="news-con">
                                                            <p>Lorem ipsum dolor sit...</p>
                                                            <span>Feb 10, 2020</span>
                                                        </div>
                                                    </div>
                                                    <div class="news-box d-flex">
                                                        <div class="news-img">
                                                            <img src="./index_files/mega-img-2.jpg" alt="">
                                                        </div>
                                                        <div class="news-con">
                                                            <p>Lorem ipsum dolor sit...</p>
                                                            <span>Feb 12, 2020</span>
                                                        </div>
                                                    </div>
                                                    <div class="news-box d-flex">
                                                        <div class="news-img">
                                                            <img src="./index_files/mega-img-3.jpg" alt="">
                                                        </div>
                                                        <div class="news-con">
                                                            <p>Lorem ipsum dolor sit...</p>
                                                            <span>Feb 21, 2020</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="m-slider owl-carousel owl-loaded owl-drag">
                                                    
                                                    
                                                <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-714px, 0px, 0px); transition: all 0s ease 0s; width: 1428px;"><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-1.jpg" alt="" class="img-fluid">
                                                        <span>-65%</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-2.jpg" alt="" class="img-fluid">
                                                        <span>-50%</span>
                                                    </div></div><div class="owl-item" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-1.jpg" alt="" class="img-fluid">
                                                        <span>-65%</span>
                                                    </div></div><div class="owl-item active" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-2.jpg" alt="" class="img-fluid">
                                                        <span>-50%</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-1.jpg" alt="" class="img-fluid">
                                                        <span>-65%</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-2.jpg" alt="" class="img-fluid">
                                                        <span>-50%</span>
                                                    </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div><div class="owl-dots disabled"></div></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mega-bnr">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <a href="#" class="bnr-box text-center">
                                                                <img src="./index_files/mega-b-1.jpg" alt="">
                                                                <span>Camera</span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="#" class="bnr-box text-center">
                                                                <img src="./index_files/mega-b-2.jpg" alt="">
                                                                <span>Mouse</span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="#" class="bnr-box text-center">
                                                                <img src="./index_files/mega-b-3.jpg" alt="">
                                                                <span>Earphone</span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="#" class="bnr-box text-center">
                                                                <img src="./index_files/mega-b-4.jpg" alt="">
                                                                <span>Speaker</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item"><a>PAGES <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown list-unstyled">
                                        <li><a href="03-about-us.html">About Us</a></li>
                                        <li><a href="04-category.html">Category</a></li>
                                        <li><a href="05-single-product.html">Single Product</a></li>
                                        <li><a href="06-shopping-cart.html">Shopping Cart</a></li>
                                        <li><a href="07-checkout.html">Checkout</a></li>
                                        <li><a href="08-login.html">Log In</a></li>
                                        <li><a href="09-register.html">Register</a></li>
                                        <li><a href="10-wishlist.html">Wishlist</a></li>
                                        <li><a href="11-compare.html">Compare</a></li>
                                        <li><a href="15-track-order.html">Track Order</a></li>
                                        <li><a href="12-terms-condition.html">Terms &amp; Condition</a></li>
                                        <li><a href="13-faq.html">Faq</a></li>
                                        <li><a href="14-404.html">404</a></li>
                                    </ul>
                                </li>
                                <li class="list-inline-item"><a>BLOG <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown list-unstyled">
                                        <li><a href="16-blog-one.html">Blog Style 1</a></li>
                                        <li><a href="17-blog-two.html">Blog Style 2</a></li>
                                        <li><a href="18-blog-three.html">Blog Style 3</a></li>
                                        <li><a href="19-blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li class="list-inline-item"><a href="20-contact.html">CONTACT</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-2">
                        <div class="carts-area d-flex">
                            <div class="src-box">
                                <form action="#">
                                    <input type="text" name="search" placeholder="Search Here">
                                    <button type="button" name="button"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <div class="wsh-box ml-auto">
                                <a href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wishlist">
                                    <img src="./index_files/heart.png" alt="favorite">
                                    <span>0</span>
                                </a>
                            </div>
                            <div class="cart-box ml-4">
                                <a href="" data-toggle="tooltip" data-placement="top" title="" class="cart-btn" data-original-title="Shopping Cart">
                                    <img src="./index_files/cart.png" alt="cart">
                                    <span>2</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Sticky Menu -->

        <!-- Menu Area -->
     <!--    <section class="menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-menu">
                            <ul class="list-unstyled list-inline">
                                <li class="list-inline-item"><a>HOME <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown list-unstyled">
                                        <li><a href="index.html">Home Style 1</a></li>
                                        <li><a href="02-home-two.html">Home Style 2</a></li>
                                    </ul>
                                </li>
                                <li class="list-inline-item mega-menu"><a>MEGA MENU <i class="fa fa-angle-down"></i></a>
                                    <div class="mega-box">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="clt-area">
                                                    <h6>Clothing</h6>
                                                    <div class="link-box">
                                                        <a href="">- Western Clothing</a>
                                                        <a href="">- Traditional Clothing</a>
                                                        <a href="">- Winter Clothing</a>
                                                        <a href="">- Summer Clothing</a>
                                                        <a href="">- Inner Wear</a>
                                                        <a href="">- Night Wear</a>
                                                        <a href="">- Mens Clothing</a>
                                                        <a href="">- Womens Clothing</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="sm-phn">
                                                    <h6>Smartphones</h6>
                                                    <div class="dept-box">
                                                        <a href="">- Samsung</a>
                                                        <a href="">- Huawei</a>
                                                        <a href="">- One Plus</a>
                                                        <a href="">- Xiaomi</a>
                                                        <a href="">- Iphone</a>
                                                        <a href="">- Blackberry</a>
                                                        <a href="">- Nokia</a>
                                                        <a href="">- Oppo</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="lt-news">
                                                    <h6>Latest News</h6>
                                                    <div class="news-box d-flex">
                                                        <div class="news-img">
                                                            <img src="./index_files/mega-img-1.jpg" alt="">
                                                        </div>
                                                        <div class="news-con">
                                                            <p>Lorem ipsum dolor sit...</p>
                                                            <span>Feb 10, 2020</span>
                                                        </div>
                                                    </div>
                                                    <div class="news-box d-flex">
                                                        <div class="news-img">
                                                            <img src="./index_files/mega-img-2.jpg" alt="">
                                                        </div>
                                                        <div class="news-con">
                                                            <p>Lorem ipsum dolor sit...</p>
                                                            <span>Feb 12, 2020</span>
                                                        </div>
                                                    </div>
                                                    <div class="news-box d-flex">
                                                        <div class="news-img">
                                                            <img src="./index_files/mega-img-3.jpg" alt="">
                                                        </div>
                                                        <div class="news-con">
                                                            <p>Lorem ipsum dolor sit...</p>
                                                            <span>Feb 21, 2020</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="m-slider owl-carousel owl-loaded owl-drag">
                                                    
                                                    
                                                <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-714px, 0px, 0px); transition: all 0.5s ease 0s; width: 1428px;"><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-1.jpg" alt="" class="img-fluid">
                                                        <span>-65%</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-2.jpg" alt="" class="img-fluid">
                                                        <span>-50%</span>
                                                    </div></div><div class="owl-item" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-1.jpg" alt="" class="img-fluid">
                                                        <span>-65%</span>
                                                    </div></div><div class="owl-item active" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-2.jpg" alt="" class="img-fluid">
                                                        <span>-50%</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-1.jpg" alt="" class="img-fluid">
                                                        <span>-65%</span>
                                                    </div></div><div class="owl-item cloned" style="width: 238px;"><div class="slider-item">
                                                        <img src="./index_files/mega-2.jpg" alt="" class="img-fluid">
                                                        <span>-50%</span>
                                                    </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div><div class="owl-dots disabled"></div></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mega-bnr">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <a href="#" class="bnr-box text-center">
                                                                <img src="./index_files/mega-b-1.jpg" alt="">
                                                                <span>Camera</span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="#" class="bnr-box text-center">
                                                                <img src="./index_files/mega-b-2.jpg" alt="">
                                                                <span>Mouse</span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="#" class="bnr-box text-center">
                                                                <img src="./index_files/mega-b-3.jpg" alt="">
                                                                <span>Earphone</span>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a href="#" class="bnr-box text-center">
                                                                <img src="./index_files/mega-b-4.jpg" alt="">
                                                                <span>Speaker</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item"><a>PAGES <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown list-unstyled">
                                        <li><a href="03-about-us.html">About Us</a></li>
                                        <li><a href="04-category.html">Category</a></li>
                                        <li><a href="05-single-product.html">Single Product</a></li>
                                        <li><a href="06-shopping-cart.html">Shopping Cart</a></li>
                                        <li><a href="07-checkout.html">Checkout</a></li>
                                        <li><a href="08-login.html">Log In</a></li>
                                        <li><a href="09-register.html">Register</a></li>
                                        <li><a href="10-wishlist.html">Wishlist</a></li>
                                        <li><a href="11-compare.html">Compare</a></li>
                                        <li><a href="15-track-order.html">Track Order</a></li>
                                        <li><a href="12-terms-condition.html">Terms &amp; Condition</a></li>
                                        <li><a href="13-faq.html">Faq</a></li>
                                        <li><a href="14-404.html">404</a></li>
                                    </ul>
                                </li>
                                <li class="list-inline-item"><a>BLOG <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown list-unstyled">
                                        <li><a href="16-blog-one.html">Blog Style 1</a></li>
                                        <li><a href="17-blog-two.html">Blog Style 2</a></li>
                                        <li><a href="18-blog-three.html">Blog Style 3</a></li>
                                        <li><a href="19-blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li class="list-inline-item"><a href="20-contact.html">CONTACT</a></li>
                                <li class="list-inline-item trac-btn"><a href="">Track Your Order</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Menu Area -->

        <!-- Mobile Menu -->
       <!--  <section class="mobile-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mobile-menu">
                            <nav id="dropdown" style="display: block;">
                                <a href=""><img src="./index_files/logo.png" alt=""></a>
                                <a href=""><span>Sign In</span></a>
                                <ul class="list-unstyled">
                                    <li><a href="">Home</a>
                                        <ul class="list-unstyled">
                                            <li><a href="index.html">Home Style 1</a></li>
	                                        <li><a href="02-home-two.html">Home Style 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Pages</a>
                                        <ul class="list-unstyled">
                                            <li><a href="03-about-us.html">About Us</a></li>
                                            <li><a href="04-category.html">Category</a></li>
                                            <li><a href="05-single-product.html">Single Product</a></li>
                                            <li><a href="06-shopping-cart.html">Shopping Cart</a></li>
                                            <li><a href="07-checkout.html">Checkout</a></li>
                                            <li><a href="08-login.html">Log In</a></li>
                                            <li><a href="09-register.html">Register</a></li>
                                            <li><a href="10-wishlist.html">Wishlist</a></li>
                                            <li><a href="11-compare.html">Compare</a></li>
                                            <li><a href="15-track-order.html">Track Order</a></li>
                                            <li><a href="12-terms-condition.html">Terms &amp; Condition</a></li>
                                            <li><a href="13-faq.html">Faq</a></li>
                                            <li><a href="14-404.html">404</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Blog</a>
                                        <ul class="list-unstyled">
                                            <li><a href="16-blog-one.html">Blog Style 1</a></li>
                                            <li><a href="17-blog-two.html">Blog Style 2</a></li>
                                            <li><a href="18-blog-three.html">Blog Style 3</a></li>
                                            <li><a href="19-blog-details.html">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="20-contact.html">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Mobile Menu -->

        <!-- Slider Area -->
        <section class="slider-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-0">
                       <div class="row">
                           <?php include "./topleft.php"; ?>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 padding-fix-l20">
                       <div class="row products">
                           <?php include "./indexproduct.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Slider Area -->

        <!-- Footer Area -->
   
        <!-- <section class="footer-btm">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>Copyright © 2020 | Designed With <i class="fa fa-heart"></i> by <a href="#" target="_blank">SnazzyTheme</a></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <img src="./index_files/payment.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="back-to-top text-center" style="display: block;">
                <img src="./index_files/backtotop.png" alt="" class="img-fluid">
            </div>
        </section> -->
        <!-- End Footer Area -->


        <!-- =========================================
        JavaScript Files
        ========================================== -->

        <!-- jQuery JS -->
        <script src="./index_files/jquery-1.12.4.min.js.download"></script>

        <!-- Bootstrap -->
        <script src="./index_files/popper.min.js.download"></script>
        <script src="./index_files/bootstrap.min.js.download"></script>

        <!-- Owl Slider -->
        <script src="./index_files/owl.carousel.min.js.download"></script>

        <!-- Wow Animation -->
        <script src="./index_files/wow.min.js.download"></script>

        <!-- Price Filter -->
        <script src="./index_files/price-filter.js.download"></script>

        <!-- Mean Menu -->
        <script src="./index_files/jquery.meanmenu.min.js.download"></script>

        <!-- Custom JS -->
        <script src="./index_files/plugins.js.download"></script>
        <script src="./index_files/custom.js.download"></script>

    

</body></html>