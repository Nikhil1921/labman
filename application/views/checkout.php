<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="coupon-area pt-30 pb-30" id="coupon-section">
    <?php if (! $this->session->coupon_discount && ! $this->session->coupon_discount): ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="coupon-accordion">
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <?= form_open('apply-coupon', 'id="register-form"'); ?>
                            <p class="checkout-coupon">
                                <?= form_input([
                                    'id'          => "coupon_code",
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
    </div>
    <?php endif ?>
</section>
<section class="checkout-area pb-85" id="checkout-section">
    <div class="container">
        <?= form_open('', 'id="checkout-form"'); ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkbox-form">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <?= form_label('Full Name <span class="required">*</span>', 'fullname'); ?>
                                    <?= form_input([
                                        'name'        => "fullname",
                                        'id'          => "fullname",
                                        'value'       => $this->session->fullname,
                                        'maxlength'   => 100
                                    ]); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <?= form_label('Mobile No. <span class="required">*</span>', 'mobile'); ?>
                                    <?= form_input([
                                        'name'        => "mobile",
                                        'id'          => "mobile",
                                        'value'       => $this->session->mobile,
                                        'maxlength'   => 100
                                    ]); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="country-select">
                                    <?= form_label('Select address <span class="required">*</span>', 'add_id'); ?>
                                    <select name="add_id" id="add_id" onchange="checkAddress(this);">
                                        <option value="" disabled selected>Select address</option>
                                        <?php foreach ($address as $v): ?>
                                            <option value="<?= e_id($v['id']) ?>"><?= $v['address'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <?= form_label('Payment Type <span class="required">*</span>'); ?>
                                    <?= form_label(form_radio('pay_type', 'Cash on delivery', true)."Cash on delivery"); ?>
                                    <?= form_label(form_radio('pay_type', 'Online')."Online"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <input id="ship-box" type="checkbox" style="display: none;">
                                <?= form_label('Ship to a different address?', 'ship-box'); ?>
                            </h3>
                        </div>
                        <div id="ship-box-info">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <?= form_label('Address <span class="required">*</span>', 'address'); ?>
                                        <?= form_input([
                                            'name'        => "address",
                                            'id'          => "address",
                                            'maxlength'   => 255
                                        ]); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <?= form_label('Pincode <span class="required">*</span>', 'pincode'); ?>
                                        <?= form_input([
                                            'name'        => "pincode",
                                            'id'          => "pincode",
                                            'minlength'   => 6,
                                            'maxlength'   => 6
                                        ]); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <?= form_button([
                                            'onclick'     => "addAddress(this);",
                                            'class'       => 'tp-btn-h1 mt-3',
                                            'content'     => "Add address",
                                        ]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" id="order-details"></div>
            </div>
        <?= form_close() ?>
    </div>
</section>