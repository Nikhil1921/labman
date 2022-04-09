<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="account-area mt-70 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
                <div class="basic-login">
                    <h5>Forgot Password</h5>
                    <?php
                    switch (true):
                        case $this->session->for_mobile:
                            echo form_open('forgotPassword/check', 'id="register-form"');
                            echo form_label('OTP <span>*</span>', 'otp');
                            echo form_input([
                                    'id'          => "otp",
                                    'placeholder' => "OTP",
                                    'name'        => "otp",
                                    'value'       => set_value('otp'),
                                    'maxlength'   => 4
                                ]);
                            echo form_error('otp');
                            echo form_button([
                                'type'    => 'submit',
                                'class'   => 'tp-in-btn w-100',
                                'content' => 'Verify OTP'
                            ]);
                            break;

                        case $this->session->for_verified:
                            echo form_open('forgotPassword/change-password', 'id="register-form"');
                            echo form_label('Password <span>*</span>', 'password');
                            echo form_input([
                                    'id'          => "password",
                                    'type'        => "password",
                                    'placeholder' => "New Password",
                                    'name'        => "password",
                                    'maxlength'   => 100
                                ]);
                            echo form_error('password');
                            echo form_label('Confirm Password <span>*</span>', 'c_password');
                            echo form_input([
                                    'id'          => "c_password",
                                    'type'        => "password",
                                    'placeholder' => "Confirm Password",
                                    'name'        => "c_password",
                                    'maxlength'   => 100
                                ]);
                            echo form_error('c_password');
                            echo form_button([
                                'type'    => 'submit',
                                'class'   => 'tp-in-btn w-100',
                                'content' => 'Register'
                            ]);
                            break;
                        
                        default:
                            echo form_open('forgotPassword', 'id="register-form"');
                            echo form_label('Mobile No. <span>*</span>', 'reg_mobile');
                            echo form_input([
                                    'id'          => "reg_mobile",
                                    'placeholder' => "Mobile No.",
                                    'name'        => "reg_mobile",
                                    'value'       => set_value('reg_mobile'),
                                    'maxlength'   => 10
                                ]);
                            echo form_error('reg_mobile');
                            echo form_button([
                                'type'    => 'submit',
                                'class'   => 'tp-in-btn w-100',
                                'content' => 'Send OTP'
                            ]);
                            break;
                    endswitch;
                    echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>