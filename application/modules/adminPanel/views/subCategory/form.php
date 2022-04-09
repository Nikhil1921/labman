<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Category name', 'cat_name', 'class="col-form-label"') ?>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">Select Category</option>
                        <?php foreach ($this->cats as $v): ?>
                            <option value="<?= e_id($v['id']) ?>" <?= set_value('parent_id') ? set_select('parent_id', e_id($v['id'])) : (isset($data['parent_id']) && $data['parent_id'] == $v['id'] ? 'selected' : '') ?>><?= $v['cat_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('parent_id') ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Sub Category name', 'cat_name', 'class="col-form-label"') ?>
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
                    <?= form_label('Sub Category Slug', 'cat_slug', 'class="col-form-label"') ?>
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