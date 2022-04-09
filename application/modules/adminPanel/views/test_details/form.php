<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= form_label('Test Name', 't_name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'disabled' => "disabled",
                        'value' => set_value('t_name') ? set_value('t_name') : (isset($data['t_name']) ? $data['t_name'] : '')
                    ]); ?>
                    <?= form_error('t_name') ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= form_label('Test details', 'details', 'class="col-form-label"') ?>
                    <?= form_textarea([
                        'class' => "form-control ckeditor",
                        'name' => 'details',
                        'value' => set_value('details') ? set_value('details') : (isset($data['details']) ? $data['details'] : '')
                    ]); ?>
                    <?= form_error('details') ?>
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