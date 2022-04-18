<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Test name', 'test_id', 'class="col-form-label"') ?>
                    <select name="test_id" id="test_id" class="form-control">
                        <?php foreach($tests as $test): ?>
                            <option value="<?= e_id($test['id']) ?>" <?= set_value('test_id') ? set_select('test_id') : (isset($data['test_id']) && $data['test_id'] === 'selected' ? $data['test_id'] : '') ?>><?= $test['t_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('test_id') ?>
                </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Test MRP', 'ltl_mrp', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "ltl_mrp",
                        'name' => "ltl_mrp",
                        'maxlength' => 5,
                        'required' => "",
                        'value' => set_value('ltl_mrp') ? set_value('ltl_mrp') : (isset($data['ltl_mrp']) ? $data['ltl_mrp'] : '')
                    ]); ?>
                    <?= form_error('ltl_mrp') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Test Price', 'ltl_price', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "ltl_price",
                        'name' => "ltl_price",
                        'maxlength' => 5,
                        'required' => "",
                        'value' => set_value('ltl_price') ? set_value('ltl_price') : (isset($data['ltl_price']) ? $data['ltl_price'] : '')
                    ]); ?>
                    <?= form_error('ltl_price') ?>
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