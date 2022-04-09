<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="blog-area mt-50 mb-50">
    <div class="container">
        <div class="row">
            <?php $this->load->view('user/sidebar') ?>
            <div class="col-xl-8 col-lg-7">
                <div class="your-order mb-30 ">
                    <h3>Update Profile</h3>
                    <div class="post-comment-form mt-20">
                        <?= form_open('', 'id="register-form"'); ?>
                            <div class="input-field">
                                <i class="fal fa-user"></i>
                                <?= form_input([
                                    'id'          => "fullname",
                                    'placeholder' => "Fullname",
                                    'name'        => "fullname",
                                    'value'       => set_value('fullname') ? set_value('fullname') : $user['fullname'],
                                    'maxlength'   => 100
                                ]); ?>
                                <?= form_error('fullname') ?>
                            </div>
                            <div class="input-field">
                                <i class="fal fa-mobile"></i>
                                <?= form_input([
                                    'id'          => "reg_mobile",
                                    'placeholder' => "Mobile No.",
                                    'name'        => "reg_mobile",
                                    'value'       => set_value('reg_mobile') ? set_value('reg_mobile') : $user['mobile'],
                                    'maxlength'   => 10
                                ]); ?>
                                <?= form_error('reg_mobile') ?>
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