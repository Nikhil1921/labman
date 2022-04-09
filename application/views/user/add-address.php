<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="blog-area mt-50 mb-50">
    <div class="container">
        <div class="row">
            <?php $this->load->view('user/sidebar') ?>
            <div class="col-xl-8 col-lg-7">
                <div class="your-order mb-30 ">
                    <h3>Add address</h3>
                    <div class="post-comment-form mt-20">
                        <?= form_open(); ?>
                            <div class="input-field">
                                <i class="fa fa-address-book"></i>
                                <?= form_input([
                                    'name'        => "address",
                                    'id'          => "address",
                                    'placeholder' => "Address",
                                    'maxlength'   => 255
                                ]); ?>
                            </div>
                            <div class="input-field">
                                <i class="fa fa-address-book"></i>
                                <?= form_input([
                                    'name'        => "pincode",
                                    'id'          => "pincode",
                                    'placeholder' => "Pincode",
                                    'minlength'   => 6,
                                    'maxlength'   => 6
                                ]); ?>
                            </div>
                            <?= form_button([
                                'type'    => 'button',
                                'onclick' => "addAddress(this);",
                                'class'   => 'tp-in-btn w-30',
                                'content' => 'Add'
                            ]); ?>
                            <?= anchor('user/address', 'Go back', 'class="tp-in-btn w-30"'); ?>
                        </form>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>