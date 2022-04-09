<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Coupon code', 'coupon_code', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "coupon_code",
                        'name' => "coupon_code",
                        'maxlength' => 20,
                        'required' => "",
                        'value' => set_value('coupon_code') ? set_value('coupon_code') : (isset($data['coupon_code']) ? $data['coupon_code'] : '')
                    ]); ?>
                    <?= form_error('coupon_code') ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Coupon discount', 'coupon_discount', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "coupon_discount",
                        'name' => "coupon_discount",
                        'maxlength' => 2,
                        'required' => "",
                        'value' => set_value('coupon_discount') ? set_value('coupon_discount') : (isset($data['coupon_discount']) ? $data['coupon_discount'] : '')
                    ]); ?>
                    <?= form_error('coupon_discount') ?>
                </div>
            </div>
            <div class="col-12"></div>
            <div class="col-3">
                <?= form_button([
                    'type'    => 'submit',
                    'class'   => 'btn btn-outline-primary btn-block col-12',
                    'content' => 'SAVE'
                ]); ?>
            </div>
            <div class="col-3">
                <?= anchor("$url", 'CANCEL', 'class="btn btn-outline-danger col-12"'); ?>
            </div>
        </div>
    <?= form_close() ?>
</div>