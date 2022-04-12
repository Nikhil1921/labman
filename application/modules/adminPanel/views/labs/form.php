<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open_multipart('', '', ['logo' => isset($data['logo']) ? $data['logo'] : '', 'cert_image' => isset($data['cert_image']) ? $data['cert_image'] : '']) ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Lab Name', 'l_name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "l_name",
                        'name' => "l_name",
                        'maxlength' => 255,
                        'required' => "",
                        'value' => set_value('l_name') ? set_value('l_name') : (isset($data['l_name']) ? $data['l_name'] : '')
                    ]); ?>
                    <?= form_error('l_name') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Doctor Name', 'doc_name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "doc_name",
                        'name' => "doc_name",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('doc_name') ? set_value('doc_name') : (isset($data['doc_name']) ? $data['doc_name'] : '')
                    ]); ?>
                    <?= form_error('doc_name') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Contact no.', 'mobile', 'class="col-form-label"') ?>
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
                    <?= form_label('Pincode', 'pincode', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "pincode",
                        'name' => "pincode",
                        'maxlength' => 6,
                        'minlength' => 6,
                        'required' => "",
                        'value' => set_value('pincode') ? set_value('pincode') : (isset($data['pincode']) ? $data['pincode'] : '')
                    ]); ?>
                    <?= form_error('pincode') ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= form_label('Address', 'address', 'class="col-form-label"') ?>
                    <?= form_textarea([
                        'class' => "form-control",
                        'id' => "address",
                        'rows' => 5,
                        'name' => "address",
                        'maxlength' => 255,
                        'required' => "",
                        'value' => set_value('address') ? set_value('address') : (isset($data['address']) ? $data['address'] : '')
                    ]); ?>
                    <?= form_error('address') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Certificates', '', 'class="col-form-label"') ?>
                    <br />
                    <div class="checkbox checkbox-dark">
                        <input id="nabl" value="NABL" name="certificate[]" type="checkbox" <?= set_value('certificate') ? set_checkbox('certificate', 'NABL') : (isset($data['certificate']) && in_array('NABL', explode(', ', $data['certificate'])) ? 'checked' : '') ?> />
                        <label for="nabl">NABL</label>
                    </div>
                    <div class="checkbox checkbox-dark">
                        <input id="iso" value="ISO" name="certificate[]" type="checkbox" <?= set_value('certificate') ? set_checkbox('certificate', 'ISO') : (isset($data['certificate']) && in_array('ISO', explode(', ', $data['certificate'])) ? 'checked' : '') ?> />
                        <label for="iso">ISO</label>
                    </div>
                    <br />
                    <?= form_error('certificate[]') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Report Delivery Time', 'del_time', 'class="col-form-label"') ?>
                    <select name="del_time" id="del_time" class="form-control">
                        <option value="" selected disabled>Select Reporting Time</option>
                        <?php foreach($report_time as $re): ?>
                            <option value="<?= e_id($re['id']) ?>" <?= set_value('del_time') ? set_select('del_time', e_id($re['id'])) : (isset($data['del_time']) && $data['del_time'] === $re['id'] ? 'selected' : '') ?>><?= $re['re_time'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('del_time') ?>
                </div>
            </div>
            <div class="col-md-<?= isset($data['logo']) ? 4 : 6 ?>">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Logo', 'logo', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => 'file',
                        'id' => "logo",
                        'name' => "logo",
                        'accept' => "image/jpg, image/jpeg, image/png",
                        isset($data['logo']) ? 'required' : '',
                    ]); ?>
                </div>
            </div>
            <?php if(isset($data['logo'])): ?>
            <div class="col-md-2">
                <?= img($this->path.$data['logo'], '', 'class="mt-4 mb-2" height = 50 width="100"'); ?>
            </div>
            <?php endif ?>
            <div class="col-md-<?= isset($data['cert_image']) ? 4 : 6 ?>">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Upload Certificate', 'cert_image', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => 'file',
                        'id' => "cert_image",
                        'name' => "cert_image",
                        'accept' => "image/jpg, image/jpeg, image/png",
                        isset($data['cert_image']) ? 'required' : '',
                    ]); ?>
                </div>
            </div>
            <?php if(isset($data['cert_image'])): ?>
            <div class="col-md-2">
                <?= img($this->path.$data['cert_image'], '', 'class="mt-4 mb-2" height = 50 width="100"'); ?>
            </div>
            <?php endif ?>
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