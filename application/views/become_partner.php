<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="account-area mt-70 mb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
                <div class="basic-login">
                    <h5>Become Partner</h5>
                    <?php
                            echo form_open('', 'id="register-form"');
                            echo form_label('Mobile No. <span>*</span>', 'reg_mobile');
                            echo form_input([
                                    'id'          => "reg_mobile",
                                    'placeholder' => "Mobile No.",
                                    'name'        => "reg_mobile",
                                    'value'       => set_value('reg_mobile'),
                                    'maxlength'   => 10
                                ]);
                            echo form_error('reg_mobile');
                            echo form_label('Contact Person Name <span>*</span>', 'fullname');
                            echo form_input([
                                    'id'          => "fullname",
                                    'placeholder' => "Contact Person",
                                    'name'        => "fullname",
                                    'value'       => set_value('fullname'),
                                    'maxlength'   => 100
                                ]);
                            echo form_error('fullname');
                            echo form_label('State <span>*</span>', 'state');
                            echo form_input([
                                    'id'          => "state",
                                    'placeholder' => "State",
                                    'name'        => "state",
                                    'value'       => set_value('state'),
                                    'maxlength'   => 50
                                ]);
                            echo form_error('state');
                            echo form_label('City <span>*</span>', 'city');
                            echo form_input([
                                    'id'          => "city",
                                    'placeholder' => "City",
                                    'name'        => "city",
                                    'value'       => set_value('city'),
                                    'maxlength'   => 50
                                ]);
                            echo form_error('city');
                            echo form_label('Pincode <span>*</span>', 'pincode');
                            echo form_input([
                                    'id'          => "pincode",
                                    'placeholder' => "Pincode",
                                    'name'        => "pincode",
                                    'value'       => set_value('pincode'),
                                    'maxlength'   => 6
                                ]);
                            echo form_error('pincode');
                            echo form_label('Message <span>*</span>', 'message');
                            echo form_textarea([
                                    'id'          => "message",
                                    'class'       => 'form-control mb-3',
                                    'placeholder' => "Message",
                                    'name'        => "message",
                                    'rows'        => 3,
                                    'value'       => set_value('message'),
                                    'maxlength'   => 255
                                ]);
                            echo form_error('message');
                            echo form_button([
                                'type'    => 'submit',
                                'class'   => 'tp-in-btn w-100',
                                'content' => 'Save request'
                            ]);
                    echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>