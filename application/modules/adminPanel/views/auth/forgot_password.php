<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-body">
    <div class="text-center">
        <h4><?= ucwords($title) ?></h4>
        <h6>Enter your Mobile to get OTP</h6>
    </div>
    <?= form_open('', '', 'class="theme-form"') ?>
    <div class="form-group">
        <?= form_label('Your Mobile', 'mobile', 'class="col-form-label pt-0"') ?>
        <?= form_input([
            'class' => "form-control",
            'type' => "text",
            'id' => "mobile",
            'name' => "mobile",
            'maxlength' => 10,
            'required' => "",
            'value' => set_value('mobile')
        ]); ?>
        <?= form_error('mobile') ?>
    </div>
    <div class="checkbox">
        <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
            <div class="radio radio-danger">
                <?= form_radio('role', "Admin", set_radio('role', 'Admin', true), 'id="admin"') ?>
                <?= form_label("Admin", "admin", 'class="mb-0"') ?>
            </div>
            <?php foreach($this->main->roles() as $role): if(in_array($role, ['Phlebetomist'])) continue; ?>
                <div class="radio radio-danger">
                    <?= form_radio('role', $role, set_radio('role', 'Lab partner'), 'id="'.$role.'"') ?>
                    <?= form_label($role, $role, 'class="mb-0"') ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="col-12">
        <div class="text-right mt-3"><?= anchor(admin('login'), 'click here', 'class="btn-link text-capitalize"') ?> to login</div>
    </div>
    <div class="form-group form-row mt-3 mb-0">
        <?= form_button([
            'type'    => 'submit',
            'class'   => 'btn btn-outline-primary btn-block',
            'content' => 'Get OTP'
        ]); ?>
    </div>
    <?= form_close() ?>
</div>