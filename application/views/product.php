<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="breadcrumb__area box-plr-75">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__wrapper">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><?= anchor('', 'Home'); ?></li>
                            <li class="breadcrumb-item" aria-current="page"><?= anchor($prod->cat_slug, $prod->cat_name); ?></li>
                            <li class="breadcrumb-item" aria-current="page"><?= anchor($prod->sc_slug, $prod->sub_cat); ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $prod->p_title ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="product-details">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="product__details-nav d-sm-flex align-items-start">
                    <ul class="nav nav-tabs flex-sm-column justify-content-between" id="" role="tablist">
                        <?php if ($prod->multi_image): ?>
                        <?php foreach (explode(', ', $prod->multi_image) as $k => $img): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?= $k === 0 ? 'active' : '' ?>" id="thumb<?= $k ?>-tab" data-bs-toggle="tab" data-bs-target="#thumb<?= $k ?>" type="button" role="tab" aria-controls="thumb<?= $k ?>" aria-selected="true">
                                <?= img($prod->base."thumb/".$img); ?>
                            </button>
                        </li>
                        <?php endforeach ?>
                        <?php else: ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="thumb-tab" data-bs-toggle="tab" data-bs-target="#thumb" type="button" role="tab" aria-controls="thumb" aria-selected="true">
                                    <?= img(['src' => $prod->image, 'height' => 85]); ?>
                                </button>
                            </li>
                        <?php endif ?>
                    </ul>
                    <div class="product__details-thumb">
                        <div class="tab-content" id="productThumbContent">
                            <?php if ($prod->multi_image): ?>
                            <?php foreach (explode(', ', $prod->multi_image) as $k => $img): ?>
                            <div class="tab-pane fade show <?= $k === 0 ? 'active' : '' ?>" id="thumb<?= $k ?>" role="tabpanel" aria-labelledby="thumb<?= $k ?>-tab">
                                <div class="product__details-nav-thumb w-img">
                                    <?= img($prod->base.$img); ?>
                                </div>
                            </div>
                            <?php endforeach ?>
                            <?php else: ?>
                                <div class="product__details-nav-thumb w-img">
                                    <?= img(['src' => $prod->image, 'height' => 420]); ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="product__details-content">
                    <h6><?= $prod->p_title ?></h6>
                    <div class="price mb-10">
                        <span>₹ <?= $prod->p_price ?></span>
                    </div>
                    <div class="features-des mb-20 mt-10">
                        <p><?= $prod->short_desc ?></p>
                    </div>
                    <div class="cart-option mb-15">
                        <div class="product-quantity mr-20">
                            <div class="cart-plus-minus p-relative">
                                <input type="text" value="1" readonly id="input-quantity"><div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>
                            </div>
                        </div>
                        <a href="javascript:;" class="cart-btn" onclick="cart.add('<?= e_id($prod->id) ?>')">Add to Cart</a>
                    </div>
                    <div class="details-meta">
                        <div class="d-meta-left">
                            <div class="dm-item mr-20">
                                <a href="javascript:;" onclick="wish.add('<?= e_id($prod->id) ?>')"><i class="fal fa-heart"></i>Add to wishlist</a>
                            </div>
                        </div>
                        <div class="d-meta-left">
                            <div class="dm-item">
                                <a href="javascript:;" onclick="shareProd('<?= e_id($prod->id) ?>')"><i class="fal fa-share-alt"></i>Share</a>
                            </div>
                        </div>
                    </div>
                    <div class="product-tag-area mt-15">
                        <div class="product_info">
                            <span class="sku_wrapper">
                                <span class="title">SKU:</span>
                                <span class="sku"><?= $prod->sku_code ?></span>
                            </span>
                            <span class="posted_in">
                                <span class="title">Category:</span>
                                <a><?= $prod->cat_name ?></a>
                            </span>
                            <span class="posted_in">
                                <span class="title">Sub Category:</span>
                                <a><?= $prod->sub_cat ?></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-details-des mt-40 mb-60">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="product__details-des-tab">
                    <ul class="nav nav-tabs" id="productDesTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="des-tab" data-bs-toggle="tab" data-bs-target="#des" type="button" role="tab" aria-controls="des" aria-selected="true">Description </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content" id="prodductDesTaContent">
            <div class="tab-pane fade active show" id="des" role="tabpanel" aria-labelledby="des-tab">
                <div class="product__details-des-wrapper">
                    <p class="des-text mb-35"><?= $prod->description ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_hidden('cart-'.e_id($prod->id), json_encode([
    'prod' => e_id($prod->id),
    'p_title' => $prod->p_title,
    'image' => $prod->image,
    'p_price' => $prod->p_price,
    'slug' => "$prod->cat_slug/$prod->sc_slug/$prod->p_slug"
    ])) ?>
<?= form_hidden('prodPage', e_id($prod->id)) ?>