<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open_multipart('', '', ['image' => isset($data['image']) ? $data['image'] : '']) ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Doctor Name', 'name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
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
                    <?= form_label('Qualification', 'quilification', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "quilification",
                        'name' => "quilification",
                        'maxlength' => 255,
                        'required' => "",
                        'value' => set_value('quilification') ? set_value('quilification') : (isset($data['quilification']) ? $data['quilification'] : '')
                    ]); ?>
                    <?= form_error('quilification') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Remark', 'remark', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "remark",
                        'name' => "remark",
                        'maxlength' => 255,
                        'required' => "",
                        'value' => set_value('remark') ? set_value('remark') : (isset($data['remark']) ? $data['remark'] : '')
                    ]); ?>
                    <?= form_error('remark') ?>
                </div>
            </div>
            <div class="col-md-<?= (isset($data['image'])) ? 4 : 6 ?>">
                <div class="form-group">
                    <?= form_label('Image', 'image', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "file",
                        'id' => "image",
                        'accept' => "image/jpeg, image/jpg, image/png",
                        'name' => "image",
                    ]); ?>
                </div>
            </div>
            <?php if (isset($data['image'])): ?>
                <div class="col-md-2">
                    <?= img(['src' => $this->path.$data['image'], 'width' => '100%', 'height' => '70', 'class' => 'mb-2']); ?>
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