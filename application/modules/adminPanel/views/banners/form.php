<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open_multipart('', '', ['image' => isset($data['banner']) ? $data['banner'] : '']) ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Title', 'title', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "title",
                        'name' => "title",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('title') ? set_value('title') : (isset($data['title']) ? $data['title'] : '')
                    ]); ?>
                    <?= form_error('title') ?>
                </div>
            </div>
            <div class="col-<?= (isset($data['banner'])) ? 4 : 6 ?>">
                <div class="form-group">
                    <?= form_label('Image <span class="text-danger">(Size should be 1900*500)</span>', 'image', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "file",
                        'id' => "image",
                        'name' => "image",
                    ]); ?>
                </div>
            </div>
            <?php if (isset($data['banner'])): ?>
                <div class="col-2">
                    <?= img(['src' => $this->path.$data['banner'], 'width' => '100%', 'height' => '70']); ?>
                </div>
            <?php endif ?>
            <div class="col-12">
                <div class="form-group">
                    <?= form_label('Sub Title', 'sub_title', 'class="col-form-label"') ?>
                    <?= form_textarea([
                        'class' => "form-control",
                        'type' => "text",
                        'rows'=>"3",
                        'id' => "sub_title",
                        'name' => "sub_title",
                        'maxlength' => 200,
                        'required' => "",
                        'value' => set_value('sub_title') ? set_value('sub_title') : (isset($data['sub_title']) ? $data['sub_title'] : '')
                    ]); ?>
                    <?= form_error('sub_title') ?>
                </div>
            </div>
            <div class="col-12"></div>
            <div class="col-3">
                <?= form_button([
                    'type'    => 'submit',
                    'class'   => 'btn btn-outline-primary btn-block col-12',
                    'content' => 'SAVE'
                ]); ?>
            </div>
            <div class="col-3">
                <?= anchor("$url", 'CANCEL', 'class="btn btn-outline-danger col-12"'); ?>
            </div>
        </div>
    <?= form_close() ?>
</div>