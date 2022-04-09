<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="breadcrumb__area box-plr-75">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><?= anchor('', 'Home'); ?></li>
                            <?php foreach($bread as $k => $b): ?>
                                <?php if($k === array_key_last($bread)): ?>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $b['name'] ?></li>
                                <?php else: ?>
                                    <li class="breadcrumb-item" aria-current="page"><?= anchor($b['slug'], $b['name']); ?></li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="shop-area mb-20">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
            <?php if($prods): ?>
                <div class="product-lists-top">
                    <div class="product__filter-wrap">
                        <div class="row align-items-center">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="product__filter d-sm-flex align-items-center">
                                    <div class="product__col">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="FourCol-tab" data-bs-toggle="tab" data-bs-target="#FourCol" type="button" role="tab" aria-controls="FourCol" aria-selected="true">
                                                <i class="fal fa-th"></i>
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="FiveCol-tab" data-bs-toggle="tab" data-bs-target="#FiveCol" type="button" role="tab" aria-controls="FiveCol" aria-selected="false">
                                                <i class="fal fa-list"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__result pl-60">
                                        <p>Showing <?= $start ?> - <?= $end ?> of <?= $total ?> relults</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                <div class="product__filter-right d-flex align-items-center justify-content-md-end">
                                    <div class="product__sorting product__show-no">
                                        <?= form_open(current_url(), 'method="get"'); ?>
                                        <?php foreach($this->input->get() as $g => $v): if($g != 'show') 
                                        echo form_hidden($g, $v);
                                        endforeach ?>
                                        <select name="show" onchange="this.form.submit();">
                                            <option <?= $this->input->get('show') == 12 ? 'selected' : '' ?>>12</option>
                                            <option <?= $this->input->get('show') == 24 ? 'selected' : '' ?>>24</option>
                                            <option <?= $this->input->get('show') == 36 ? 'selected' : '' ?>>36</option>
                                            <option <?= $this->input->get('show') == 48 ? 'selected' : '' ?>>48</option>
                                        </select>
                                        <?= form_close(); ?>
                                    </div>
                                    <div class="product__sorting product__show-position ml-20">
                                        <?= form_open(current_url(), 'method="get"'); ?>
                                        <?php foreach($this->input->get() as $g => $v): if($g != 'products') 
                                        echo form_hidden($g, $v);
                                        endforeach ?>
                                        <select name="products" onchange="this.form.submit();">
                                            <option <?= $this->input->get('products') == 'Letest' ? 'selected' : '' ?>>Letest</option>
                                            <?php foreach($this->show as $show): ?>
                                                <option <?= $this->input->get('products') == $show ? 'selected' : '' ?>><?= $show ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <?= form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="productGridTabContent">
                    <div class="tab-pane fade show active" id="FourCol" role="tabpanel" aria-labelledby="FourCol-tab">
                        <div class="tp-wrapper">
                            <div class="row g-0">
                                <?php foreach($prods as $p): ?>
                                <?= form_hidden('cart-'.e_id($p->id), json_encode([
                                    'prod' => e_id($p->id),
                                    'p_title' => $p->p_title,
                                    'image' => $p->image,
                                    'p_price' => $p->p_price,
                                    'slug' => $p->slug])) ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item product__item-d">
                                        <div class="product__thumb fix">
                                            <div class="product-image w-img">
                                                <?= anchor($p->slug, img($p->image)) ?>
                                            </div>
                                            <div class="product-action">
                                                <a href="javascript:;" class="icon-box icon-box-1" data-bs-toggle="modal" data-bs-target="#productModalId">
                                                    <i class="fal fa-eye"></i>
                                                    <i class="fal fa-eye"></i>
                                                </a>
                                                <a href="javascript:;" onclick="wish.add(<?= e_id($p->id) ?>)" class="icon-box icon-box-1">
                                                    <i class="fal fa-heart"></i>
                                                    <i class="fal fa-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product__content-3">
                                            <h6><?= anchor($p->slug, $p->p_title) ?></h6>
                                            <div class="price mb-10">
                                                <span>₹ <?= $p->p_price ?></span>
                                            </div>
                                        </div>
                                        <div class="product__add-cart-s text-center">
                                            <button type="button" onclick="cart.add(<?= e_id($p->id) ?>)" class="cart-btn d-flex mb-10 align-items-center justify-content-center w-100">
                                            Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="FiveCol" role="tabpanel" aria-labelledby="FiveCol-tab">
                        <div class="tp-wrapper-2">
                            <?php foreach($prods as $p): ?>
                            <div class="single-item-pd">
                                <div class="row align-items-center">
                                    <div class="col-xl-9">
                                        <div class="single-features-item single-features-item-df b-radius mb-20">
                                            <div class="row  g-0 align-items-center">
                                                <div class="col-md-4">
                                                    <div class="features-thum">
                                                        <div class="features-product-image w-img">
                                                            <?= anchor($p->slug, img($p->image)) ?>
                                                        </div>
                                                        <div class="product-action">
                                                            <a href="javascript:;" class="icon-box icon-box-1" data-bs-toggle="modal" data-bs-target="#productModalId">
                                                                <i class="fal fa-eye"></i>
                                                                <i class="fal fa-eye"></i>
                                                            </a>
                                                            <a href="javascript:;" onclick="wish.add(<?= e_id($p->id) ?>)" class="icon-box icon-box-1">
                                                                <i class="fal fa-heart"></i>
                                                                <i class="fal fa-heart"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="product__content product__content-d">
                                                        <h6><?= anchor($p->slug, $p->p_title) ?></h6>
                                                        <div class="rating mb-5"></div>
                                                        <div class="features-des">
                                                            <?= $p->description ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="product-stock mb-15">
                                            <h5>Availability: <span> Available</span></h5>
                                            <h6>₹ <?= $p->p_price ?></h6>
                                        </div>
                                        <div class="stock-btn ">
                                            <button type="button" onclick="cart.add(<?= e_id($p->id) ?>)" class="cart-btn d-flex mb-10 align-items-center justify-content-center w-100">
                                            Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="tp-pagination text-center">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="basic-pagination pt-30 pb-30">
                                <nav>
                                    <ul>
                                        <?= $this->pagination->create_links(); ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="error-area pt-80 pb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="error-info text-center">
                                    <div class="error-content">
                                        <h5>No products available</h5>
                                        <div class="error-button">
                                            <?= anchor('all', 'Go to shop', 'class="error-btn"') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            </div>
        </div>
    </div>
</div>