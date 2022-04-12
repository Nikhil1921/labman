<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open_multipart('', '', ['image' => isset($data['image']) ? $data['image'] : '']) ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Gallery Name', 'g_name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "g_name",
                        'name' => "g_name",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('g_name') ? set_value('g_name') : (isset($data['g_name']) ? $data['g_name'] : '')
                    ]); ?>
                    <?= form_error('g_name') ?>
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