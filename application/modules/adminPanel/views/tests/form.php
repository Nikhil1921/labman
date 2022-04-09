<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <?= form_label('Test Name', 't_name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "t_name",
                        'name' => "t_name",
                        'maxlength' => 255,
                        'required' => "",
                        'value' => set_value('t_name') ? set_value('t_name') : (isset($data['t_name']) ? $data['t_name'] : '')
                    ]); ?>
                    <?= form_error('t_name') ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= form_label('Lab Man margin', 't_price', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "t_price",
                        'name' => "t_price",
                        'maxlength' => 5,
                        'required' => "",
                        'value' => set_value('t_price') ? set_value('t_price') : (isset($data['t_price']) ? $data['t_price'] : '')
                    ]); ?>
                    <?= form_error('t_price') ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= form_label('Category', 'cat_id', 'class="col-form-label"') ?>
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="" selected disabled>Category</option>
                        <?php foreach($category as $c): ?>
                            <option value="<?= e_id($c['id']) ?>" <?= set_value('cat_id') ? set_select('cat_id', e_id($c['id'])) : (isset($data['cat_id']) && $data['cat_id'] === $c['id'] ? 'selected' : '') ?>><?= $c['cat_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('cat_id') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Test Department', 'dep_id', 'class="col-form-label"') ?>
                    <select name="dep_id" id="dep_id" class="form-control">
                        <option value="" selected disabled>Select Department</option>
                        <?php foreach($department as $d): ?>
                            <option value="<?= e_id($d['id']) ?>" <?= set_value('dep_id') ? set_select('dep_id', e_id($d['id'])) : (isset($data['dep_id']) && $data['dep_id'] === $d['id'] ? 'selected' : '') ?>><?= $d['d_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('dep_id') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Test Method', 'method_id', 'class="col-form-label"') ?>
                    <select name="method_id" id="method_id" class="form-control">
                        <option value="" selected disabled>Select Method</option>
                        <?php foreach($methods as $m): ?>
                            <option value="<?= e_id($m['id']) ?>" <?= set_value('method_id') ? set_select('method_id', e_id($m['id'])) : (isset($data['method_id']) && $data['method_id'] === $m['id'] ? 'selected' : '') ?>><?= $m['m_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('method_id') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Test Sample', 'samp_id', 'class="col-form-label"') ?>
                    <select name="samp_id" id="samp_id" class="form-control">
                        <option value="" selected disabled>Select Sample</option>
                        <?php foreach($samples as $s): ?>
                            <option value="<?= e_id($s['id']) ?>" <?= set_value('samp_id') ? set_select('samp_id', e_id($s['id'])) : (isset($data['samp_id']) && $data['samp_id'] === $s['id'] ? 'selected' : '') ?>><?= $s['s_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('samp_id') ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= form_label('Test Reporting Time', 're_time_id', 'class="col-form-label"') ?>
                    <select name="re_time_id" id="re_time_id" class="form-control">
                        <option value="" selected disabled>Select Reporting Time</option>
                        <?php foreach($report_time as $re): ?>
                            <option value="<?= e_id($re['id']) ?>" <?= set_value('re_time_id') ? set_select('re_time_id', e_id($re['id'])) : (isset($data['re_time_id']) && $data['re_time_id'] === $re['id'] ? 'selected' : '') ?>><?= $re['re_time'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('re_time_id') ?>
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