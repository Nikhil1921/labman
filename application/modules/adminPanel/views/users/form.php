<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open_multipart('', '', ['image' => isset($data['image']) ? $data['image'] : '']) ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Name', 'name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "name",
                        'name' => "name",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('name') ? set_value('name') : (isset($data['name']) ? $data['name'] : '')
                    ]); ?>
                    <?= form_error('name') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Mobile no.', 'mobile', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "mobile",
                        'name' => "mobile",
                        'maxlength' => 10,
                        'minlength' => 10,
                        'required' => "",
                        'value' => set_value('mobile') ? set_value('mobile') : (isset($data['mobile']) ? $data['mobile'] : '')
                    ]); ?>
                    <?= form_error('mobile') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Email', 'email', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => 'email',
                        'id' => "email",
                        'name' => "email",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('email') ? set_value('email') : (isset($data['email']) ? $data['email'] : '')
                    ]); ?>
                    <?= form_error('email') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Password', 'password', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "password",
                        'id' => "password",
                        'name' => "password",
                        'maxlength' => 100,
                        (! isset($data['mobile']) ? 'required' : ''),
                    ]); ?>
                    <?= form_error('password') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Date of birth', 'dob', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "date",
                        'id' => "dob",
                        'name' => "dob",
                        'required' => '',
                        'value' => set_value('dob') ? set_value('dob') : (isset($data['dob']) ? $data['dob'] : '')
                    ]); ?>
                    <?= form_error('dob') ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Gender', '', 'class="col-form-label"') ?>
                    <br />
                    <div class="checkbox">
                        <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                            <div class="radio radio-danger">
                                <?= form_radio('gender', "Male", set_value('gender') ? set_radio('gender', 'Male') : (isset($data['gender']) && $data['gender'] === 'Male' ? 'checked' : true), 'id="Male"') ?>
                                <?= form_label("Male", "Male", 'class="mb-0"') ?>
                            </div>
                            <div class="radio radio-danger">
                                <?= form_radio('gender', "Female", set_value('gender') ? set_radio('gender', 'Female') : (isset($data['gender']) && $data['gender'] === 'Female' ? 'checked' : ''), 'id="Female"') ?>
                                <?= form_label("Female", "Female", 'class="mb-0"') ?>
                            </div>
                            <div class="radio radio-danger">
                                <?= form_radio('gender', "Other", set_value('gender') ? set_radio('gender', 'Other') : (isset($data['gender']) && $data['gender'] === 'Other' ? 'checked' : ''), 'id="Other"') ?>
                                <?= form_label("Other", "Other", 'class="mb-0"') ?>
                            </div>
                        </div>
                        <?= form_error('gender') ?>
                    </div>
                </div>
            </div>
            <div class="col-12"></div>
            <div class="col-6 col-md-3">
                <?= form_button([
                    'type'    => 'submit',
                    'class'   => 'btn btn-outline-primary btn-block col-12',
                    'content' => 'SAVE'
                ]); ?>
            </div>
            <div class="col-6 col-md-3">
                <?= anchor("$url", 'CANCEL', 'class="btn btn-outline-danger col-12"'); ?>
            </div>
        </div>
    <?= form_close() ?>
</div>