<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="coupon-area pt-30 pb-30">
    <?php if (! $this->session->coupon_discount && ! $this->session->coupon_discount): ?>
    <!-- <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="coupon-accordion">
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <?= form_open('apply-coupon', 'id="coupon-form"'); ?>
                            <p class="checkout-coupon">
                                <?= form_input([
                                    'name'        => "coupon_code",
                                    'placeholder' => "Coupon Code",
                                    'maxlength'   => 20
                                ]); ?>
                                <?= form_button([
                                    'class'   => "tp-btn-h1",
                                    'type'    => "submit",
                                    'content' => "Apply Coupon"
                                ]); ?>
                            </p>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <?php endif ?>
</section>
<section class="checkout-area pb-85">
    <div class="container">
        <?= form_open(); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkbox-form">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Full Name <span class="required">*</span></label>
                                    <?= form_input([
                                        'name'        => "fullname",
                                        'value'       => $this->session->fullname,
                                        'maxlength'   => 100
                                    ]); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="country-select">
                                    <label>Select address <span class="required">*</span></label>
                                    <select style="display: none;">
                                        <option value="" disabled selected>Select address</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="different-address">
                            <div class="ship-different-title">
                                <h3>
                                    <input id="ship-box" type="checkbox" style="display: none;">
                                    <label for="ship-box">Ship to a different address?</label>
                                </h3>
                            </div>
                            <div id="ship-box-info">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" placeholder="Street address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input type="text" placeholder="Postcode / Zip">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- <div class="col-lg-6">
                    <div class="your-order mb-30 ">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive" id="checkout-order">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            Vestibulum suscipit <strong class="product-quantity"> × 1</strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">$165.00</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">$215.00</span></td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Shipping</th>
                                        <td><span class="amount">$215.00</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">$215.00</span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="order-button-payment mt-20">
                                <button type="submit" disabled class="tp-btn-h1">Place order</button>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        <?= form_close() ?>
    </div>
</section>