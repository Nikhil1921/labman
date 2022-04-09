<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
    <a href="<?= base_url('sample.xlsx') ?>" class="btn btn-outline-success btn-sm float-right" download="">Download sample</a>
</div>
<div class="card-body">
    <?= form_open_multipart() ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('State name', 's_id', 'class="col-form-label"') ?>
                    <select name="s_id" id="s_id" class="form-control" required="">
                        <option value="">Select State</option>
                        <?php foreach ($this->states as $v): ?>
                            <option value="<?= e_id($v['id']) ?>" <?= set_value('s_id') ? set_select('s_id', e_id($v['id'])) : (isset($data['s_id']) && $data['s_id'] == $v['id'] ? 'selected' : '') ?>><?= $v['s_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('s_id') ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('CSV / Excel file', 'file', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "file",
                        'id' => "file",
                        'name' => "file",
                        'required' => "",
                    ]); ?>
                    <?= form_error('pincode') ?>
                </div>
            </div>
            <div class="col-12"></div>
            <div class="col-3">
                <?= form_button([
                    'type'    => 'submit',
                    'class'   => 'btn btn-outline-primary btn-block col-12',
                    'content' => 'UPLOAD'
                ]); ?>
            </div>
            <div class="col-3">
                <?= anchor("$url", 'CANCEL', 'class="btn btn-outline-danger col-12"'); ?>
            </div>
        </div>
    <?= form_close() ?>
</div>