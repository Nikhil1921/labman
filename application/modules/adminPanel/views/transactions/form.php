<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Lab Name', 'lab_id', 'class="col-form-label"') ?>
                    <select name="lab_id" id="lab_id" class="form-control">
                        <option value="" disabled selected>Select lab</option>
                        <?php foreach($labs as $lab): ?>
                        <option value="<?= e_id($lab['id']) ?>" <?= set_value('lab_id') ? set_select('lab_id', e_id($lab['id'])) : (isset($data['lab_id']) && $data['lab_id'] === $lab['id'] ? 'selected' : '') ?>><?= $lab['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('lab_id') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Payment mode', 'pay_mod', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "pay_mod",
                        'name' => "pay_mod",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('pay_mod') ? set_value('pay_mod') : (isset($data['pay_mod']) ? $data['pay_mod'] : '')
                    ]); ?>
                    <?= form_error('pay_mod') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Amount', 'amount', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "amount",
                        'name' => "amount",
                        'maxlength' => 6,
                        'required' => "",
                        'value' => set_value('amount') ? set_value('amount') : (isset($data['amount']) ? $data['amount'] : '')
                    ]); ?>
                    <?= form_error('amount') ?>
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