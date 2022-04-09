<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="account-area mt-70 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="basic-login mb-50">
                    <h5>Login</h5>
                    <?= form_open('login', 'id="login-form"'); ?>
                        <?= form_label('Mobile No. <span>*</span>', 'otp'); ?>
                        <?= form_input([
                                    'id'          => "mobile",
                                    'placeholder' => "Mobile No.",
                                    'name'        => "mobile",
                                    'value'       => set_value('mobile'),
                                    'maxlength'   => 10
                                ]); ?>
                        <?= form_error('mobile'); ?>
                        <?= form_label('Password <span>*</span>', 'pass'); ?>
                        <?= form_input([
                                    'id'          => "pass",
                                    'type'        => "password",
                                    'placeholder' => "Password",
                                    'name'        => "pass",
                                    'maxlength'   => 100
                                ]); ?>
                        <?= form_error('pass'); ?>
                        <div class="login-action mb-10 fix">
                            <span class="log-rem f-left">
                                <input id="show-password" type="checkbox" onclick="document.getElementById('pass').type = (this.checked === true ? 'text' : 'password' );">
                                <label for="show-password">Show password</label>
                            </span>
                            <span class="forgot-login f-right">
                                <?= anchor('forgotPassword', 'Lost your password?'); ?>
                            </span>
                        </div>
                        <?= form_button([
                                'type'    => 'submit',
                                'class'   => 'tp-in-btn w-100',
                                'content' => 'log in'
                            ]); ?>
                    <?= form_close(); ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="basic-login">
                    <h5>Register</h5>
                    <?php
                    switch (true):
                        case $this->session->reg_mobile:
                            echo form_open('register/check', 'id="register-form"');
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

                        case $this->session->verified:
                            echo form_open('register/register', 'id="register-form"');
                            echo form_label('Fullname <span>*</span>', 'fullname');
                            echo form_input([
                                    'id'          => "fullname",
                                    'placeholder' => "Fullname",
                                    'name'        => "fullname",
                                    'value'       => set_value('fullname'),
                                    'maxlength'   => 100
                                ]);
                            echo form_error('fullname');
                            echo form_label('Password <span>*</span>', 'password');
                            echo form_input([
                                    'id'          => "password",
                                    'type'        => "password",
                                    'placeholder' => "Password",
                                    'name'        => "password",
                                    'maxlength'   => 100
                                ]);
                            echo form_error('password');
                            /* echo form_label('Address <span>*</span>', 'address');
                            echo form_input([
                                    'id'          => "address",
                                    'placeholder' => "Address",
                                    'name'        => "address",
                                    'value'       => set_value('address'),
                                    'maxlength'   => 255
                                ]);
                            echo form_error('address'); */
                            echo form_button([
                                'type'    => 'submit',
                                'class'   => 'tp-in-btn w-100',
                                'content' => 'Register'
                            ]);
                            break;
                        
                        default:
                            echo form_open('register', 'id="register-form"');
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