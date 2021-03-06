<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('City Name', 'c_name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control geocomplete",
                        'type' => "text",
                        'id' => "c_name",
                        'name' => "c_name",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('c_name') ? set_value('c_name') : (isset($data['c_name']) ? $data['c_name'] : '')
                    ]); ?>
                    <?= form_error('c_name') ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= form_label('Labs', 'lab_ids', 'class="col-form-label"') ?>
                    <select name="lab_ids[]" id="lab_ids" class="js-example-placeholder-multiple col-sm-12" multiple="multiple">
                        <?php foreach($labs as $lab): ?>
                        <option value="<?= e_id($lab['id']) ?>" <?= set_value('lab_ids') ? set_select('lab_ids', e_id($lab['id'])) : (isset($data['lab_ids']) && in_array($lab['id'], explode(',', $data['lab_ids'])) ? 'selected' : '') ?>><?= $lab['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('lab_ids[]') ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Hard Copy', 'hard_copy', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "hard_copy",
                        'name' => "hard_copy",
                        'maxlength' => 6,
                        'required' => "",
                        'value' => set_value('hard_copy') ? set_value('hard_copy') : (isset($data['hard_copy']) ? $data['hard_copy'] : '')
                    ]); ?>
                    <?= form_error('hard_copy') ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Home Visit', 'home_visit', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "home_visit",
                        'name' => "home_visit",
                        'maxlength' => 6,
                        'required' => "",
                        'value' => set_value('home_visit') ? set_value('home_visit') : (isset($data['home_visit']) ? $data['home_visit'] : '')
                    ]); ?>
                    <?= form_error('home_visit') ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Fix To Price', 'fix_price', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "fix_price",
                        'name' => "fix_price",
                        'maxlength' => 6,
                        'required' => "",
                        'value' => set_value('fix_price') ? set_value('fix_price') : (isset($data['fix_price']) ? $data['fix_price'] : '')
                    ]); ?>
                    <?= form_error('fix_price') ?>
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