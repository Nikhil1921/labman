<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <table class="table">
        <tbody>
            <tr>
                <th class="col-2">Name</th>
                <td class="col-4"><?= $data['name'] ?></td>
                <th class="col-2">Contact no.</th>
                <td class="col-4"><?= $data['mobile'] ?></td>
            </tr>
            <tr>
                <th class="col-2">Email</th>
                <td class="col-4"><?= $data['email'] ?></td>
                <th class="col-2">Society</th>
                <td class="col-4"><?= $data['society'] ?></td>
            </tr>
            <tr>
                <th class="col-2">Area</th>
                <td class="col-4"><?= $data['area'] ?></td>
                <th class="col-2">Pincode</th>
                <td class="col-4"><?= $data['pincode'] ?></td>
            </tr>
            <tr>
                <th class="col-2">City</th>
                <td class="col-4"><?= $data['city'] ?></td>
                <th class="col-2">Role</th>
                <td class="col-4"><?= $data['role'] ?></td>
            </tr>
            <tr>
                <th class="col-2">Language known</th>
                <td class="col-4"><?= $data['language'] ?></td>
                <th class="col-2">Date Of Birth</th>
                <td class="col-4"><?= $data['dob'] ?></td>
            </tr>
            <tr>
                <th class="col-2">Gender</th>
                <td class="col-4"><?= $data['gender'] ?></td>
                <th class="col-2">Marital Status</th>
                <td class="col-4"><?= $data['marital'] ?></td>
            </tr>
            <tr>
                <th class="col-2">Physical Status</th>
                <td class="col-4"><?= $data['physical'] ?></td>
                <th class="col-2">Photo</th>
                <td class="col-4"><?= img($this->path.$data['photo'], '', 'height = 50 width="100"'); ?></td>
            </tr>
            <tr>
                <th class="col-2">Qulification</th>
                <td class="col-4"><?= $data['qulification'] ?></td>
                <th class="col-2">Qulification image</th>
                <td class="col-4"><?= img($this->path.$data['qulimg'], '', 'height = 50 width="100"'); ?></td>
            </tr>
            <tr>
                <th class="col-2">Aadhar Card No</th>
                <td class="col-4"><?= $data['aadhar'] ?></td>
                <th class="col-2">Aadhar Card image</th>
                <td class="col-4"><?= img($this->path.$data['aadhar_img'], '', 'height = 50 width="100"'); ?></td>
            </tr>
            <tr>
                <th class="col-2">Driving Licence</th>
                <td class="col-4"><?= $data['licence'] ?></td>
                <th class="col-2">Driving Licence image</th>
                <td class="col-4"><?= img($this->path.$data['licence_img'], '', 'height = 50 width="100"'); ?></td>
            </tr>
            <tr>
                <th class="col-2">Vehicle</th>
                <td class="col-4"><?= $data['vehicle'] ?></td>
                <th class="col-2">Computer certificate image</th>
                <td class="col-4"><?= img($this->path.$data['computer'], '', 'height = 50 width="100"'); ?></td>
            </tr>
            <tr>
                <th class="col-2">Office Time</th>
                <td class="col-4"><?= $data['office_time'].' : '.($data['office_time'] === 'Day' ? '8 AM To 8 PM' : '8 PM To 8 AM') ?></td>
            </tr>
        </tbody>
    </table>
    <?= form_open() ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Interview By', 'interview', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "interview",
                        'name' => "interview",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('interview') ? set_value('interview') : (isset($data['interview']) ? $data['interview'] : '')
                    ]); ?>
                    <?= form_error('interview') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Date Of Joining', 'joining', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "joining",
                        'type' => 'date',
                        'name' => "joining",
                        'required' => "",
                        'value' => set_value('joining') ? set_value('joining') : (isset($data['joining']) ? $data['joining'] : '')
                    ]); ?>
                    <?= form_error('joining') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Approval', '', 'class="col-form-label"') ?>
                    <div class="form-group mt-2 m-checkbox-inline mb-0 custom-radio-ml">
                        <div class="radio radio-primary">
                            <?= form_radio([
                                'id' => "yes",
                                'name' => "approval",
                                'value' => 'Yes',
                                'checked' => set_value('approval') ? set_radio('approval', 'Yes', true) : (isset($data['approval']) && $data['approval'] == 'Yes' ? true : true)
                            ]); ?>
                            <?= form_label('Yes', 'yes') ?>
                        </div>
                        <div class="radio radio-primary">
                            <?= form_radio([
                                'id' => "no",
                                'name' => "approval",
                                'value' => 'No',
                                'checked' => set_value('approval') ? set_radio('approval', 'No') : (isset($data['approval']) && $data['approval'] == 'No' ? true : false)
                            ]); ?>
                            <?= form_label('No', 'no') ?>
                        </div>
                    </div>
                    <?= form_error('approval') ?>
                </div>
            </div>
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