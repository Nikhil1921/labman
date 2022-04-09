<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open() ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('State Name', 's_name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "s_name",
                        'name' => "s_name",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('s_name') ? set_value('s_name') : (isset($data['s_name']) ? $data['s_name'] : '')
                    ]); ?>
                    <?= form_error('s_name') ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group m-checkbox-inline mb-0">
                    <?= form_label('GST Slabs') ?>
                    <br>
                    <div class="checkbox checkbox-dark">
                        <?= form_checkbox([
                            'id' => "SGST",
                            'name' => "s_gst[]",
                            'value' => "SGST",
                            'checked' => set_value('s_gst') ? set_checkbox('s_gst', 'SGST') : (isset($data['s_gst']) ? in_array('SGST', explode(', ', $data['s_gst'])) : FALSE)
                        ]); ?>
                        <?= form_label('SGST', 'SGST') ?>
                    </div>
                    <div class="checkbox checkbox-dark">
                        <?= form_checkbox([
                            'id' => "CGST",
                            'name' => "s_gst[]",
                            'value' => "CGST",
                            'checked' => set_value('s_gst') ? set_checkbox('s_gst', 'CGST') : (isset($data['s_gst']) ? in_array('CGST', explode(', ', $data['s_gst'])) : FALSE)
                        ]); ?>
                        <?= form_label('CGST', 'CGST') ?>
                    </div>
                    <div class="checkbox checkbox-dark">
                        <?= form_checkbox([
                            'id' => "IGST",
                            'name' => "s_gst[]",
                            'value' => "IGST",
                            'checked' => set_value('s_gst') ? set_checkbox('s_gst', 'IGST') : (isset($data['s_gst']) ? in_array('IGST', explode(', ', $data['s_gst'])) : FALSE)
                        ]); ?>
                        <?= form_label('IGST', 'IGST') ?>
                    </div>
                    <?= form_error('s_gst[]') ?>
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