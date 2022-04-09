<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title><?= "$title | " . APP_NAME ?></title>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?= link_tag('assets/images/favicon.png', 'icon', 'image/x-icon') ?>
      <?= link_tag('assets/css/preloader.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/bootstrap.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/meanmenu.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/animate.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/owl-carousel.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/swiper-bundle.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/backtotop.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/magnific-popup.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/nice-select.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/flaticon/flaticon.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/font-awesome-pro.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/default.css', 'stylesheet', 'text/css') ?>
      <?= link_tag('assets/css/style.css?v='.time(), 'stylesheet', 'text/css') ?>
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
   </head>
   <body>
      <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
               <svg viewBox="0 0 58 58" id="mustard" class="product">
                  <g>
                     <path style="fill:#ED7161;" d="M39.869,58H18.131C16.954,58,16,57.046,16,55.869V12.621C16,11.726,16.726,11,17.621,11h22.757
                        C41.274,11,42,11.726,42,12.621v43.248C42,57.046,41.046,58,39.869,58z" />
                     <polygon style="fill:#D13834;" points="35,11 23,11 27.615,0 30.385,0 	" />
                     <rect x="16" y="16" style="fill:#D75A4A;" width="26" height="2" />
                     <rect x="20" y="11" style="fill:#D75A4A;" width="2" height="6" />
                     <rect x="25" y="11" style="fill:#D75A4A;" width="2" height="6" />
                     <rect x="30" y="11" style="fill:#D75A4A;" width="2" height="6" />
                     <rect x="36" y="11" style="fill:#D75A4A;" width="2" height="6" />
                     <circle style="fill:#D13834;" cx="29" cy="36" r="10" />
                  </g>
               </svg>
               <svg viewBox="0 0 49.818 49.818" id="meat" class="product">
                  <g>
                     <path style="fill:#994530;" d="M0.953,38.891c0,0,3.184,6.921,11.405,9.64c1.827,0.604,3.751,0.751,5.667,0.922
                        c7.866,0.703,26.714-0.971,31.066-18.976c1.367-5.656,0.76-11.612-1.429-17.003C44.51,5.711,37.447-4.233,22.831,2.427
                        c-8.328,3.795-7.696,10.279-5.913,14.787c2.157,5.456-2.243,11.081-8.06,10.316C1.669,26.584-1.825,30.904,0.953,38.891z" />
                     <g>
                        <path style="fill:#D75A4A;" d="M4.69,37.18c0.402,0.785,3.058,5.552,9.111,7.554c1.335,0.441,2.863,0.577,4.482,0.72l0.282,0.025
                           c0.818,0.073,1.698,0.11,2.617,0.11c18.18,0,22.854-11.218,24.02-16.041c1.134-4.693,0.706-9.703-1.235-14.488
                           C41.049,7.874,36.856,4.229,31.506,4.229c-2.21,0-4.683,0.615-7.349,1.83c-2.992,1.364-6.676,3.921-4.13,10.36
                           c1.284,3.25,0.912,6.746-1.023,9.591c-2.17,3.191-6.002,4.901-9.895,4.39c-0.493-0.065-0.966-0.099-1.404-0.099
                           c-1.077,0-2.502,0.198-3.173,1.143C3.765,32.524,3.823,34.609,4.69,37.18z" />
                        <path style="fill:#C64940;" d="M21.184,46.589c-0.948,0-1.858-0.038-2.706-0.114l-0.283-0.025
                           c-1.674-0.147-3.257-0.287-4.706-0.767c-6.376-2.108-9.188-7.073-9.688-8.047l-0.058-0.137c-0.984-2.917-0.993-5.273-0.026-6.635
                           c0.912-1.285,2.89-1.807,5.524-1.456c3.537,0.466,6.959-1.054,8.936-3.961c1.746-2.565,2.082-5.723,0.921-8.661
                           c-3.189-8.065,2.707-10.754,4.645-11.638c9.68-4.407,16.81-1.155,21.152,9.535c2.021,4.981,2.464,10.202,1.28,15.099
                           C44.953,34.836,40.073,46.589,21.184,46.589z M5.613,36.787c0.401,0.758,2.936,5.155,8.503,6.997
                           c1.229,0.406,2.699,0.536,4.256,0.673l0.284,0.025c0.788,0.07,1.639,0.106,2.527,0.106c17.469,0,21.938-10.683,23.048-15.276
                           c1.084-4.487,0.672-9.286-1.19-13.877C40.29,8.663,36.409,5.229,31.506,5.229c-2.067,0-4.4,0.585-6.934,1.74
                           c-3.02,1.376-5.81,3.532-3.615,9.083c1.408,3.563,0.998,7.398-1.126,10.521c-2.404,3.534-6.563,5.386-10.852,4.818
                           c-1.793-0.236-3.197,0.019-3.632,0.632C4.912,32.636,4.756,34.207,5.613,36.787z" />
                     </g>
                     <g>
                        <circle style="fill:#E6E6E6;" cx="32.455" cy="12.779" r="4" />
                        <path style="fill:#7A3726;" d="M32.455,17.779c-2.757,0-5-2.243-5-5s2.243-5,5-5s5,2.243,5,5S35.212,17.779,32.455,17.779z
                           M32.455,9.779c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S34.109,9.779,32.455,9.779z" />
                     </g>
                     <path style="fill:#C64940;" d="M25.617,45.684l-1.941-0.479c0.435-1.761-1.063-3.216-3.446-4.859
                        c-2.875-1.984-4.817-5.117-5.327-8.595c-0.186-1.266-0.425-2.285-0.428-2.295l1.922-0.548c0.01,0.028,1.09,3.104,3.978,4.314
                        c2.094,0.877,4.667,0.598,7.648-0.832c11.578-5.554,17.102-2.646,17.332-2.52l-0.967,1.752c-0.04-0.021-4.97-2.48-15.5,2.57
                        c-3.53,1.694-6.662,1.984-9.312,0.863c-0.801-0.339-1.49-0.779-2.078-1.265c0.769,1.974,2.11,3.695,3.867,4.907
                        C23.149,39.931,26.472,42.222,25.617,45.684z" />
                     <path style="fill:#C64940;" d="M27.074,27.586c-5.37,0-7.605-3.694-7.633-3.74l1.727-1.01l-0.863,0.505l0.859-0.511
                        c0.108,0.179,2.714,4.335,9.738,2.105c1.54-0.794,12.038-6.002,15.619-2.289l-1.439,1.389c-1.979-2.052-9.229,0.576-13.332,2.714
                        l-0.154,0.064C29.892,27.364,28.389,27.586,27.074,27.586z" />
                  </g>
               </svg>
               <svg viewBox="0 0 49 49" id="soda" class="product">
                  <g>
                     <path style="fill:#E22F37;" d="M9.5,27V5.918c0-1.362,0.829-2.587,2.094-3.093l0,0C12.642,2.406,13.5,1.14,13.5,0.011L13.5,0v0
                        l11,0l11,0v0v0.011c0,1.129,0.858,2.395,1.906,2.814l0,0c1.265,0.506,2.094,1.73,2.094,3.093V27v-5v21.082
                        c0,1.362-0.829,2.587-2.094,3.093h0c-1.048,0.419-1.906,1.686-1.906,2.814V49l0,0h-11h-11l0,0l0-0.011
                        c0-1.129-0.858-2.395-1.906-2.814h0c-1.265-0.506-2.094-1.73-2.094-3.093V22" />
                     <path style="fill:#F75B57;" d="M18.5,7h-5c-0.553,0-1-0.447-1-1s0.447-1,1-1h5c0.553,0,1,0.447,1,1S19.053,7,18.5,7z" />
                     <path style="fill:#F75B57;" d="M35.5,7h-13c-0.553,0-1-0.447-1-1s0.447-1,1-1h13c0.553,0,1,0.447,1,1S36.053,7,35.5,7z" />
                     <path style="fill:#994530;" d="M18.5,45h-5c-0.553,0-1-0.447-1-1s0.447-1,1-1h5c0.553,0,1,0.447,1,1S19.053,45,18.5,45z" />
                     <path style="fill:#994530;" d="M35.5,45h-13c-0.553,0-1-0.447-1-1s0.447-1,1-1h13c0.553,0,1,0.447,1,1S36.053,45,35.5,45z" />
                     <polygon style="fill:#E6E6E6;" points="39.5,32 9.5,42 9.5,20 39.5,10 	" />
                     <polygon style="fill:#F9D70B;" points="39.5,28 9.5,38 9.5,24 39.5,14 	" />
                  </g>
               </svg>
               <div class="cart-container">
                  <svg viewBox="0 0 512 512" id="cart">
                     <circle cx="376.8" cy="440" r="55" />
                     <circle cx="192" cy="440" r="55" />
                     <polygon points="128,0 0.8,0 0.8,32 104.8,32 136.8,124.8 170.4,124.8 " />
                     <polygon style="fill:#ED7161;" points="250.4,49.6 224,124.8 411.2,124.8 " />
                     <polygon style="fill:#ee5a46;" points="411.2,124.8 224,124.8 170.4,124.8 136.8,124.8 68,124.8 141.6,361.6 427.2,361.6 
                        511.2,124.8 " />
                     <g>
                        <rect x="166.4" y="185.6" style="fill:#FFFFFF;" width="255.2" height="16" />
                        <rect x="166.4" y="237.6" style="fill:#FFFFFF;" width="166.4" height="16" />
                     </g>
                  </svg>
               </div>
            </div>
         </div>
      </div>
      <div class="progress-wrap">
         <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
         </svg>
      </div>
      <header class="header d-blue-bg">
         <div class="header-mid">
            <div class="container">
               <div class="heade-mid-inner">
                  <div class="row align-items-center">
                     <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4">
                        <div class="header__info">
                           <div class="logo">
                              <?= anchor('', img('assets/images/logo.png'),'class="logo-image"') ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-5 col-lg-4 d-none d-lg-block">
                        <div class="header__search">
                           <?= form_open('', 'method="GET"') ?>
                           <div class="header__search-box">
                              <?= form_input([
                                 'class' => "search-input",
                                 'type' => "text",
                                 'placeholder' => "क्या चाहिए...?",
                                 'name' => "search",
                                 'value' => $this->input->get('search')
                                 ]); ?>
                              <?= form_button([
                                 'type'    => 'submit',
                                 'class'   => 'button',
                                 'content' => '<i class="far fa-search"></i>'
                                 ]); ?>
                           </div>
                           <div class="header__search-cat">
                              <select name="category">
                                 <option value="all">All Categories</option>
                                 <?php foreach($this->cats as $cat): ?>
                                 <option value="<?= $cat['cat_slug'] ?>"><?= $cat['cat_name'] ?></option>
                                 <?php endforeach ?>
                              </select>
                           </div>
                           <?= form_close() ?>
                        </div>
                     </div>
                     <div class="col-xl-4 col-lg-5 col-md-8 col-sm-8">
                        <div class="header-action">
                           <div class="block-userlink">
                              <?= anchor(
                                 ($this->session->userId) ? 'user' : 'login',
                                 '<i class="flaticon-user"></i><span class="text"><span class="sub">'.
                                 (($this->session->userId) ? 'Logout' : 'Login').
                                 '</span>My Account </span>',
                                 'class="icon-link"'
                                 ); ?>
                           </div>
                           <div class="block-wishlist action">
                              <?= anchor('wishlist', 
                                 '<i class="flaticon-heart"></i><span class="count" id="wishlist-count">'.
                                 count($this->wishlist).
                                 '</span><span class="text"><span class="sub">Favorite</span><span>My Wishlist</span> </span>'
                                 ,'class="icon-link"'); ?>
                           </div>
                           <div class="block-cart action">
                              <?= anchor('cart', 
                                 '<i class="flaticon-shopping-bag"></i><span class="count cart-counts">'.
                                 count($this->cart).
                                 '</span><span class="text"><span class="sub">Your Cart</span><span class="cart-total">₹ 0.00</span> </span>'
                                 ,'class="icon-link"'); ?>
                              <div class="cart" id="show-cart"></div>
                              <div class="cart" id="show-cart"></div>
                              <div class="cart" id="show-cart"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="header__bottom">
            <div class="container">
               <div class="row g-0 align-items-center">
                  <div class="col-lg-3">
                     <div class="cat__menu-wrapper side-border d-none d-lg-block">
                        <div class="cat-toggle">
                           <button type="button" class="cat-toggle-btn cat-toggle-btn-1"><i class="fal fa-bars"></i> Categories</button>
                           <div class="cat__menu" style="display: none;">
                              <nav id="mobile-menu" style="display: block;">
                                 <ul>
                                    <li>
                                       <?= anchor('all', 'All Categories <i class="far fa-angle-down"></i>'); ?>
                                       <ul class="mega-menu">
                                          <?php foreach($this->cats as $cat): ?>
                                          <li>
                                             <?= anchor($cat['cat_slug'], $cat['cat_name']); ?>
                                             <ul class="mega-item">
                                                <?php foreach($cat['sub_cats'] as $sub_cat): ?>
                                                <li>
                                                   <?= anchor($cat['cat_slug'].'/'.$sub_cat['cat_slug'], $sub_cat['cat_name']); ?>
                                                </li>
                                                <?php endforeach ?>
                                             </ul>
                                          </li>
                                          <?php endforeach ?>
                                       </ul>
                                    </li>
                                    <?php foreach($this->cats as $cat): ?>
                                    <li>
                                       <?= anchor($cat['cat_slug'], $cat['cat_name'].'<i class="far fa-angle-down"></i>'); ?>
                                       <ul class="submenu">
                                          <?php foreach($cat['sub_cats'] as $sub_cat): ?>
                                          <li><?= anchor($cat['cat_slug'].'/'.$sub_cat['cat_slug'], $sub_cat['cat_name']); ?></li>
                                          <?php endforeach ?>
                                       </ul>
                                    </li>
                                    <?php endforeach ?>
                                 </ul>
                              </nav>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-9 col-3">
                     <div class="header__bottom-left d-flex d-xl-block align-items-center">
                        <div class="side-menu d-lg-none mr-20">
                           <button type="button" class="side-menu-btn offcanvas-toggle-btn"><i class="fas fa-bars"></i></button>
                        </div>
                        <div class="main-menu d-none d-lg-block">
                           <nav>
                              <ul>
                                 <li><?= anchor('', "Home", 'class="'.($name === 'home' ? 'active' : '').'"'); ?></li>
                                 <li><?= anchor('about-us', "About Us", 'class="'.($name === 'about' ? 'active' : '').'"'); ?></li>
                                 <li><?= anchor('become-partner', "Become partner", 'class="'.($name === 'become_partner' ? 'active' : '').'"'); ?></li>
                                 <?php if(! $this->session->userId): ?>
                                    <li><?= anchor('login', 'Login', 'class="'.($name === 'login' ? 'active' : '').'"') ?></li>
                                 <?php endif ?>
                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <div class="offcanvas__area">
         <div class="offcanvas__wrapper">
            <div class="offcanvas__close">
               <button class="offcanvas__close-btn" id="offcanvas__close-btn">
               <i class="fal fa-times"></i>
               </button>
            </div>
            <div class="offcanvas__content">
               <div class="offcanvas__logo mb-40">
                  <?= anchor('', img('assets/images/logo.png')) ?>
               </div>
               <div class="offcanvas__search mb-25">
                  <form action="#">
                     <input type="text" placeholder="What are you searching for?">
                     <button type="submit" ><i class="far fa-search"></i></button>
                  </form>
               </div>
               <div class="mobile-menu fix"></div>
               <div class="offcanvas__action"></div>
            </div>
         </div>
      </div>
      <div class="body-overlay"></div>
      <main>
         <?php if(isset($breadcrumb)): ?>
         <div class="page-banner-area page-banner-height-2" data-background="<?= base_url($breadcrumb) ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page-banner-content text-center">
                            <h4 class="breadcrumb-title"><?= $title ?></h4>
                            <div class="breadcrumb-two">
                                <nav>
                                   <nav class="breadcrumb-trail breadcrumbs">
                                      <ul class="breadcrumb-menu">
                                         <li class="breadcrumb-trail">
                                            <?= anchor('', '<span>Home</span>'); ?>
                                         </li>
                                         <li class="trail-item">
                                            <span><?= $title ?></span>
                                         </li>
                                      </ul>
                                   </nav> 
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <?php endif ?>
         <?= $contents ?>
      </main>
      <footer>
         <div class="fotter-area d-dark-bg">
            <div class="footer__top pt-80 pb-15">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-5 col-lg-4 order-last-md">
                        <div class="row">
                           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                              <div class="footer__widget">
                                 <div class="footer__widget-title">
                                    <h4>Follow us</h4>
                                 </div>
                                 <div class="footer__widget-content">
                                    <div class="footer__link">
                                       <div class="cta-social">
                                          <div class="social-icon">
                                                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                                <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                                                <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
                                                <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                                                <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                              <div class="footer__widget">
                                 <div class="footer__widget-title">
                                    <h4>Customer Service</h4>
                                 </div>
                                 <div class="footer__widget-content">
                                    <div class="footer__link">
                                       <ul>
                                          <li><?= anchor('contact-us', 'Contact Us') ?></li>
                                          <li><?= anchor('terms-conditions', 'Terms & Conditions') ?></li>
                                          <li><?= anchor('payment-protection', 'Payment protection') ?></li>
                                          <li><?= anchor('refund-policy', 'Refund policy') ?></li>
                                          <li><?= anchor('delivery-information', 'Delivery Information') ?></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-7 col-lg-8 order-first-md">
                        <div class="footer__top-left">
                           <div class="row">
                              <div class="col-xl-7 col-lg-6 col-md-6 col-sm-6">
                                 <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                       <div class="footer__widget">
                                          <div class="footer__widget-title">
                                             <h4>My Account</h4>
                                          </div>
                                          <div class="footer__widget-content">
                                             <div class="footer__link">
                                                <ul>
                                                   <?php if($this->session->userId): ?>
                                                      <li><?= anchor('user', 'Orders') ?></li>
                                                      <li><?= anchor('user/profile', 'Profile') ?></li>
                                                      <li><?= anchor('user/address', 'My address') ?></li>
                                                      <li><?= anchor('user/change-password', 'Change password') ?></li>
                                                      <li><?= anchor('user/logout', 'Logout') ?></li>
                                                      <?php else: ?>
                                                      <li><?= anchor('login', 'Login') ?></li>
                                                   <?php endif ?>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                       <div class="footer__widget">
                                          <div class="footer__widget-title">
                                             <h4>Quick Links</h4>
                                          </div>
                                          <div class="footer__widget-content">
                                             <div class="footer__link">
                                                <ul>
                                                   <li><?= anchor('cart', 'Cart') ?></li>
                                                   <li><?= anchor('wishlist', 'Wishlist') ?></li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xl-5 col-lg-6 col-md-6 col-sm-6">
                                 <div class="footer__widget">
                                    <div class="footer__widget-title mb-20">
                                       <h4>About The Store</h4>
                                    </div>
                                    <div class="footer__widget-content">
                                       <p class="footer-text mb-35">Our mission statement is to provide the absolute best customer experience available in the Electronic industry without exception.</p>
                                       <div class="footer__hotline d-flex align-items-center mb-10">
                                          <div class="icon mr-15">
                                             <i class="fal fa-headset"></i>
                                          </div>
                                          <div class="text">
                                             <h4>Got Question? Connect!</h4>
                                             <span><a href="tel:8320406016">(+91) 83 20 40 60 16</a></span>
                                          </div>
                                       </div>
                                       <div class="footer__info">
                                          <ul>
                                             <li>
                                                <span><a>Ahmedabad, Gujarat</a></span>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="footer__bottom">
                <div class="container">
                    <div class="footer__bottom-content pt-55 pb-45">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="copy-right-area text-center">
                                    <p>Visitor No. <span><?= $this->main->getVisitors() ?></span></p>
                                    <p>Copyright © <span>उत्पादक से.</span> All Rights Reserved. Powered by <a href="https://densetek.com/"><span class="main-color">Densetek Infotech</span></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
      </footer>
      <div class="modal fade" id="productModalId" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered product__modal" role="document">
            <div class="modal-content">
               <div class="product__modal-wrapper p-relative">
                  <div class="product__modal-close p-absolute">
                     <button data-bs-dismiss="modal"><i class="fal fa-times"></i></button>
                  </div>
                  <div class="product__modal-inner" id="prod-details">
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?= form_hidden('base_url', base_url()) ?>
      <?= script('assets/js/vendor/jquery.js') ?>
      <?= script('assets/js/vendor/waypoints.js') ?>
      <?= script('assets/js/bootstrap-bundle.js') ?>
      <?= script('assets/js/meanmenu.js') ?>
      <?= script('assets/js/swiper-bundle.js') ?>
      <?= script('assets/js/tweenmax.js') ?>
      <?= script('assets/js/owl-carousel.js') ?>
      <?= script('assets/js/magnific-popup.js') ?>
      <?= script('assets/js/parallax.js') ?>
      <?= script('assets/js/backtotop.js') ?>
      <?= script('assets/js/nice-select.js') ?>
      <?= script('assets/js/countdown.min.js') ?>
      <?= script('assets/js/counterup.js') ?>
      <?= script('assets/js/wow.js') ?>
      <?= script('assets/js/isotope-pkgd.js') ?>
      <?= script('assets/js/imagesloaded-pkgd.js') ?>
      <?php if($this->session->error || $this->session->success || $name == 'my-account'): ?>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <?= form_hidden('error', $this->session->error) ?>
      <?= form_hidden('success', $this->session->success) ?>
      <?php endif ?>
      <?= form_hidden('isLoggedIn', $this->session->userId ? true : false) ?>
      <?= form_hidden('discount', $this->session->coupon_discount ? $this->session->coupon_discount : 0) ?>
      <?php if(in_array($name, ['login', 'register', 'forgot_password', 'checkout', 'profile', 'become_partner'])): ?>
         <script src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
         <script src="//cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
      <?php endif ?>
      <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <?= script('assets/js/main.js?v='.time()) ?>
   </body>
</html>