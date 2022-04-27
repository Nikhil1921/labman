<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header">
        <h5><?= $title ?></h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-1"><strong>Name : </strong></div>
            <div class="col-md-2"><span><?= $data['name'] ?></span></div>
            <div class="col-md-2"><strong>Mobile : </strong></div>
            <div class="col-md-2"><span><?= $data['mobile'] ?></span></div>
            <div class="col-md-2"><strong>Collection : </strong></div>
            <div class="col-md-3"><span><?= date('d-m-Y h:i A', strtotime($data['collection_date'].$data['collection_time'])) ?></span></div>
        </div>
        <?= form_open_multipart() ?>
            <div class="row">
                <div class="col-md-<?= (isset($data['test_report'])) ? 4 : 6 ?>">
                    <div class="form-group">
                        <?= form_label('Report', 'test_report', 'class="col-form-label"') ?>
                        <?= form_input([
                            'class' => "form-control",
                            'type' => "file",
                            'id' => "test_report",
                            'accept' => "application/pdf",
                            'name' => "test_report",
                        ]); ?>
                        <span class="text-danger"><?= $report_error ?></span>
                    </div>
                </div>
                <?php if (isset($data['test_report'])): ?>
                    <div class="col-md-2">
                        <?= img(['src' => $this->path.$data['test_report'], 'width' => '100%', 'height' => '70', 'class' => 'mb-2']); ?>
                    </div>
                <?php endif ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <?= form_label('Tests', '', 'class="col-form-label"') ?>
                        <br />
                        <?php foreach($data['tests'] as $test): ?>
                        <div class="checkbox checkbox-dark">
                            <input id="test_<?= e_id($test['id']) ?>" value="<?= e_id($test['id']) ?>" name="reports[]" type="checkbox" <?= set_value('reports') ? set_checkbox('reports', e_id($test['id'])) : (isset($test['test_report']) && $test['test_report'] ? 'checked' : '') ?> <?= isset($test['test_report']) && $test['test_report'] ? 'disabled' : '' ?> />
                            <label for="test_<?= e_id($test['id']) ?>"><?= $test['t_name'] ?></label>
                        </div>
                        <?php endforeach ?>
                        <?= form_error('reports[]') ?>
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
</div>