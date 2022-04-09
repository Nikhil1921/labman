<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Category Name', 'cat_name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "cat_name",
                        'name' => "cat_name",
                        'maxlength' => 50,
                        'onkeyup' => "document.getElementById('cat_slug').value = this.value.trim().replaceAll(' ', '-')",
                        'required' => "",
                        'value' => set_value('cat_name') ? set_value('cat_name') : (isset($data['cat_name']) ? $data['cat_name'] : '')
                    ]); ?>
                    <?= form_error('cat_name') ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Category Slug', 'cat_slug', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "cat_slug",
                        'name' => "cat_slug",
                        'maxlength' => 50,
                        'readonly' => 'readonly',
                        'required' => "",
                        'value' => set_value('cat_slug') ? set_value('cat_slug') : (isset($data['cat_slug']) ? $data['cat_slug'] : '')
                    ]); ?>
                    <?= form_error('cat_slug') ?>
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