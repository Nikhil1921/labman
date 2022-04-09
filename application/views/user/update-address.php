<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="blog-area mt-50 mb-50">
    <div class="container">
        <div class="row">
            <?php $this->load->view('user/sidebar') ?>
            <div class="col-xl-8 col-lg-7">
                <div class="your-order mb-30 ">
                    <h3>Update address</h3>
                    <div class="post-comment-form mt-20">
                        <?php if($address): ?>
                        <?= form_open('', 'data-id="'.$id.'"'); ?>
                            <div class="input-field">
                                <i class="fa fa-address-book"></i>
                                <?= form_input([
                                    'name'        => "address",
                                    'id'          => "address",
                                    'placeholder' => "Address",
                                    'value'       => set_value('fullname') ? set_value('fullname') : $address['address'],
                                    'maxlength'   => 255
                                ]); ?>
                            </div>
                            <div class="input-field">
                                <i class="fa fa-address-book"></i>
                                <?= form_input([
                                    'name'        => "pincode",
                                    'id'          => "pincode",
                                    'placeholder' => "Pincode",
                                    'value'       => set_value('pincode') ? set_value('pincode') : $address['pincode'],
                                    'minlength'   => 6,
                                    'maxlength'   => 6
                                ]); ?>
                            </div>
                            <?= form_button([
                                'type'    => 'button',
                                'onclick' => "updateAddress(this.form);",
                                'class'   => 'tp-in-btn w-30',
                                'content' => 'Update'
                            ]); ?>
                            <?= anchor('user/address', 'Go back', 'class="tp-in-btn w-30"'); ?>
                        <?= form_close(); ?>
                        <?php else: ?>
                            <p>Address not available.</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>