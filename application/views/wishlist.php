<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="cart-area pb-120 pt-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Images</th>
                                <th class="cart-product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Add</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="show-wishlist">
                            <tr>
                                <td colspan="5"><strong>Wish list is empty.</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cart-page-total">
                    <?= anchor('', '<i class="fa fa-shopping-cart"></i> add products', 'class="tp-btn-h1"'); ?>
                </div>
            </div>
        </div>
    </div>
</section>