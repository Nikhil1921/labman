<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
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