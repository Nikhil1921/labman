<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="blog-area mt-50 mb-50">
    <div class="container">
        <div class="row">
            <?php $this->load->view('user/sidebar') ?>
            <div class="col-xl-8 col-lg-7">
                <div class="your-order mb-30 ">
                    <h3>Change Password</h3>
                    <div class="post-comment-form mt-20">
                        <?= form_open('', 'id="register-form"'); ?>
                            <div class="input-field">
                                <i class="fal fa-lock"></i>
                                <?= form_input([
                                    'type'        => "password",
                                    'id'          => "password",
                                    'placeholder' => "Password",
                                    'name'        => "password",
                                    'maxlength'   => 100
                                ]); ?>
                                <?= form_error('password') ?>
                            </div>
                            <div class="input-field">
                                <i class="fal fa-lock"></i>
                                <?= form_input([
                                    'type'        => "password",
                                    'id'          => "c_password",
                                    'placeholder' => "Confirm Password",
                                    'name'        => "c_password",
                                    'maxlength'   => 100
                                ]); ?>
                                <?= form_error('c_password') ?>
                            </div>
                            <?= form_button([
                                'type'    => 'submit',
                                'class'   => 'tp-in-btn w-30',
                                'content' => 'Update'
                            ]); ?>
                        </form>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>