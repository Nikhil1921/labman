<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="slider-area">
    <div class="swiper-container slider__active">
        <div class="slider-wrapper swiper-wrapper">
            <?php foreach($banners as $banner): ?>
            <div class="single-slider swiper-slide slider-height d-flex align-items-center" data-background="<?= $banner['banner']; ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="slider-content">
                                <h2 data-animation="fadeInLeft" data-delay="1.7s" class="pt-15 slider-title pb-5"><?= $banner['title']; ?></h2>
                                <p class="pr-20 slider_text" data-animation="fadeInLeft" data-delay="1.9s"><?= $banner['sub_title']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            <div class="main-slider-paginations"></div>
        </div>
    </div>
</div>
<!-- <section class="banner__area pt-20 pb-10">
    <div class="container">
        <div class="row">
            <?php $sub_bans = [
                [
                    'banner' => 'banner-1.jpg',
                    'title'  => 'Intelligent <br> New Touch Control',
                    'sub_title'  => 'Discount 20% On Products',
                ],
                [
                    'banner' => 'banner-2.jpg',
                    'title'  => 'On-sale <br> Best Prices',
                    'sub_title'  => 'Limited Time: Online Only!',
                ],
                [
                    'banner' => 'banner-3.jpg',
                    'title'  => 'Hot Sale <br> Super Laptops 2022',
                    'sub_title'  => 'Free Shipping All Order',
                ],
            ] ?>
            <?php foreach($sub_bans as $sb): ?>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="banner__item p-relative w-img mb-30">
                    <div class="banner__img">
                        <a href="javascript:;">
                        <?= img("assets/images/banners/".$sb['banner']); ?>
                        </a>
                    </div>
                    <div class="banner__content">
                        <h6><a href="javascript:;"><?= $sb['title'] ?></a></h6>
                        <p><?= $sb['sub_title'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section> -->
<?php if($prods && $prods['Deals Of The Day']):  ?>
<section class="topsell__area-1 pt-15">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section__head d-flex justify-content-between mb-10">
                    <div class="section__title">
                        <h5 class="st-titile">Top Deals Of The Day</h5>
                    </div>
                    <div class="button-wrap">
                        <?= anchor('all', 'See All Product <i class="fal fa-chevron-right"></i>', ); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product-bs-slider">
                <div class="product-slider swiper-container">
                    <div class="swiper-wrapper">
                    <?php foreach($prods['Deals Of The Day'] as $deal): ?>
                        <?= form_hidden('cart-'.e_id($deal->id), json_encode([
                            'prod' => e_id($deal->id),
                            'p_title' => $deal->p_title,
                            'image' => $deal->image,
                            'p_price' => $deal->p_price,
                            'slug' => $deal->slug])) ?>
                        <div class="product__item swiper-slide">
                            <div class="product__thumb fix">
                                <div class="product-image w-img">
                                    <?= anchor($deal->slug, img($deal->image)); ?>
                                </div>
                                <div class="product-action">
                                    <a href="javascript:;" class="icon-box icon-box-1" data-bs-toggle="modal" data-bs-target="#productModalId">
                                        <i class="fal fa-eye"></i>
                                        <i class="fal fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" onclick="wish.add(<?= e_id($deal->id) ?>)" class="icon-box icon-box-1">
                                        <i class="fal fa-heart"></i>
                                        <i class="fal fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product__content">
                                <h6><?= $deal->p_title; ?></h6>
                                <div class="rating mb-5">
                                </div>
                                <div class="price mb-10">
                                    <span>₹<?= $deal->p_price; ?></span>
                                </div>
                                <!-- <div class="progress-rate">
                                    <span>Qty : 0</span>
                                </div> -->
                            </div>
                            <div class="product__add-cart text-center">
                                <button type="button" onclick="cart.add(<?= e_id($deal->id) ?>)" name="cart" class="cart-btn product-modal-sidebar-open-btn d-flex align-items-center justify-content-center w-100">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>
                <!-- If we need navigation buttons -->
                <div class="bs-button bs-button-prev"><i class="fal fa-chevron-left"></i></div>
                <div class="bs-button bs-button-next"><i class="fal fa-chevron-right"></i></div>
            </div>
        </div>
    </div>
</section>
<?php endif ?>
<!-- <?php $sub_bans = [
    [
        'banner' => 'banner-4.jpg',
        'span'  => 'Bestseller Products',
        'title'  => 'PC & Docking Station',
        'sub_title'  => 'Discount 20% Off, Top Quality Products',
    ],
    [
        'banner' => 'banner-5.jpg',
        'span'  => 'Featured Products',
        'title'  => 'Accessories iPhone',
        'sub_title'  => 'Free Shipping All Order Over ₹ 99',
    ]
    ];  ?>
<section class="banner__area banner__area-d pb-10">
    <div class="container">
        <div class="row">
            <?php foreach($sub_bans as $sb): ?>
            <div class="col-xl-6 col-lg-6 col-md-12">
                <div class="banner__item p-relative w-img mb-30">
                    <div class="banner__img">
                        <a href="javascript:;"><?= img("assets/images/banners/".$sb['banner']) ?></a>
                    </div>
                    <div class="banner__content">
                        <span><?= $sb['span'] ?></span>
                        <h6><a href="javascript:;"><?= $sb['title'] ?></a></h6>
                        <p><?= $sb['sub_title'] ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section> -->
<?php if($prods && $prods['Top Selling']):  ?>
<section class="topsell__area-2 pt-15">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section__head d-flex justify-content-between mb-10">
                    <div class="section__title">
                        <h5 class="st-titile">Top Selling Products</h5>
                    </div>
                    <div class="button-wrap">
                        <?= anchor('all', 'See All Product <i class="fal fa-chevron-right"></i>', ); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product-bs-slider">
                <div class="product-slider swiper-container">
                    <div class="swiper-wrapper">
                    <?php foreach($prods['Top Selling'] as $deal): ?>
                        <?= form_hidden('cart-'.e_id($deal->id), json_encode([
                            'prod' => e_id($deal->id),
                            'p_title' => $deal->p_title,
                            'image' => $deal->image,
                            'p_price' => $deal->p_price,
                            'slug' => $deal->slug])) ?>
                        <?= form_hidden('cart-'.e_id($deal->id), json_encode([
                            'prod' => e_id($deal->id),
                            'p_title' => $deal->p_title,
                            'image' => $deal->image,
                            'p_price' => $deal->p_price,
                            'slug' => $deal->slug])) ?>
                        <div class="product__item swiper-slide">
                            <div class="product__thumb fix">
                                <div class="product-image w-img">
                                    <?= anchor($deal->slug, img($deal->image)); ?>
                                </div>
                                <div class="product-action">
                                    <a href="javascript:;" class="icon-box icon-box-1" onclick="getProd(<?= e_id($deal->id) ?>);">
                                        <i class="fal fa-eye"></i>
                                        <i class="fal fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" onclick="wish.add(<?= e_id($deal->id) ?>)" class="icon-box icon-box-1">
                                        <i class="fal fa-heart"></i>
                                        <i class="fal fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product__content">
                                <h6><?= $deal->p_title; ?></h6>
                                <div class="rating mb-5">
                                </div>
                                <div class="price mb-10">
                                    <span>₹<?= $deal->p_price; ?></span>
                                </div>
                            </div>
                            <div class="product__add-cart text-center">
                                <button type="button" onclick="cart.add(<?= e_id($deal->id) ?>)" name="cart" class="cart-btn product-modal-sidebar-open-btn d-flex align-items-center justify-content-center w-100">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>
                <div class="bs-button bs-button-prev"><i class="fal fa-chevron-left"></i></div>
                <div class="bs-button bs-button-next"><i class="fal fa-chevron-right"></i></div>
            </div>
        </div>
    </div>
</section>
<?php endif ?>
<?php if($prods && $prods['Top Selling']):  ?>
<section class="featured light-bg pt-55 pb-40">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section__head d-flex justify-content-between mb-30">
                    <div class="section__title">
                        <h5 class="st-titile">Top Featured Products</h5>
                    </div>
                    <div class="button-wrap">
                        <?= anchor('all', 'See All Product <i class="fal fa-chevron-right"></i>', ); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach($prods['Top Featured'] as $k => $deal): if ($k != 0) break; ?>
            <?= form_hidden('cart-'.e_id($deal->id), json_encode([
                            'prod' => e_id($deal->id),
                            'p_title' => $deal->p_title,
                            'image' => $deal->image,
                            'p_price' => $deal->p_price,
                            'slug' => $deal->slug])) ?>
            <div class="col-xl-6 col-lg-12">
                <div class="single-features-item single-features-item-d b-radius mb-20">
                    <div class="row  g-0 align-items-center">
                        <div class="col-md-6">
                            <div class="features-thum">
                                <div class="features-product-image w-img">
                                    <?= anchor($deal->slug, img($deal->image)); ?>
                                </div>
                                <div class="product-action">
                                    <a href="javascript:;" class="icon-box icon-box-1" data-bs-toggle="modal" data-bs-target="#productModalId">
                                        <i class="fal fa-eye"></i>
                                        <i class="fal fa-eye"></i>
                                    </a>
                                    <a href="javascript:;" onclick="wish.add(<?= e_id($deal->id) ?>)" class="icon-box icon-box-1">
                                        <i class="fal fa-heart"></i>
                                        <i class="fal fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product__content product__content-d">
                                <h6><?= anchor($deal->slug, $deal->p_title); ?></h6>
                                <div class="rating mb-5"></div>
                                <div class="price d-price mb-10">
                                    <span>₹ <?= $deal->p_price ?> </span>
                                </div>
                                <div class="features-des mb-25">
                                    <?= anchor($deal->slug, $deal->description); ?>
                                </div>
                                <div class="cart-option">
                                    <a href="javascript:;" onclick="cart.add(<?= e_id($deal->id) ?>)" class="cart-btn-2 w-100 mr-10">Add to Cart</a>
                                    <a href="javascript:;" onclick="wish.add(<?= e_id($deal->id) ?>)" class="transperant-btn"><i class="fal fa-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            <div class="col-xl-6 col-lg-12">
                <div class="row">
                    <?php foreach($prods['Top Featured'] as $k => $deal): if ($k == 0) continue; if ($k > 4) break; ?>
                    <div class="col-md-6">
                        <div class="single-features-item b-radius mb-20">
                            <div class="row  g-0 align-items-center">
                                <div class="col-6">
                                    <div class="features-thum">
                                        <div class="features-product-image w-img">
                                            <?= anchor($deal->slug, img($deal->image)); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="product__content product__content-d">
                                        <h6><?= anchor($deal->slug, $deal->p_title); ?></h6>
                                        <div class="rating mb-5"></div>
                                        <div class="price d-price">
                                            <span>₹ <?= $deal->p_price ?></span>
                                        </div>
                                    </div>
                                    <div class="features-des mb-25">
                                        <?= anchor($deal->slug, substr($deal->description, 0, 30)); ?>...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif ?>
<!-- <section class="moveing-text-area">
    <div class="container">
        <div class="ovic-running">
            <div class="wrap">
                <div class="inner">
                    <p class="item">Free Delivery - Return Over ₹ 100.00 ( Excluding Homeware) | Free Collect From Store</p>
                    <p class="item">Design Week / 15% Off the website / Code: AYOSALE-2020</p>
                    <p class="item">Always iconic. Now organic. Introducing the ₹ 20 Organic Tee.</p>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="features__area pt-20">
    <div class="container">
        <div class="row row-cols-xxl-4 row-cols-xl-4 row-cols-lg-4 row-cols-md-2 row-cols-sm-2 row-cols-1 gx-0">
            <div class="col">
                <div class="features__item d-flex white-bg">
                    <div class="features__icon mr-20">
                        <i class="fal fa-truck"></i>
                    </div>
                    <div class="features__content">
                        <h5>वोकल से लोकल</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="features__item d-flex white-bg">
                    <div class="features__icon mr-20">
                        <i class="fal fa-money-check"></i>
                    </div>
                    <div class="features__content">
                        <h5>आत्मनिर्भर भारत</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="features__item d-flex white-bg">
                    <div class="features__icon mr-20">
                        <i class="fal fa-comments-alt"></i>
                    </div>
                    <div class="features__content">
                        <h5>१०० % भारत में निर्मित</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="features__item features__item-last d-flex white-bg">
                    <div class="features__icon mr-20">
                        <i class="fad fa-user-headset"></i>
                    </div>
                    <div class="features__content">
                        <h5>उत्पादक से उपभोक्ता तक</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>