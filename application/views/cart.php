<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="cart-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Images</th>
                                <th class="cart-product-name">Product</th>
                                <th class="product-price">Unit Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody id="cart-body">
                            <tr><td colspan="6"><strong>Your cart is empty! Start shopping Now!</strong></td></tr>
                        </tbody>
                        <tfoot id="cart-foot">
                        </tfoot>
                    </table>
                </div>
                <div class="row" id="check-out"></div>
            </div>
        </div>
    </div>
</section>