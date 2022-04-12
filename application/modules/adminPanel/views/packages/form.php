<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open_multipart('', '', ['image' => isset($data['image']) ? $data['image'] : '']) ?>
        <div class="row">
            <div class="col-md-12">
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
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Original price', 'org_price', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "org_price",
                        'name' => "org_price",
                        'maxlength' => 6,
                        'required' => "",
                        'value' => set_value('org_price') ? set_value('org_price') : (isset($data['org_price']) ? $data['org_price'] : '')
                    ]); ?>
                    <?= form_error('org_price') ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Discounted price', 'price', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "price",
                        'name' => "price",
                        'maxlength' => 6,
                        'required' => "",
                        'value' => set_value('price') ? set_value('price') : (isset($data['price']) ? $data['price'] : '')
                    ]); ?>
                    <?= form_error('price') ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= form_label('Package Type', '', 'class="col-form-label"') ?>
                    <br />
                    <div class="checkbox">
                        <div class="form-group m-checkbox-inline mb-0 custom-radio-ml">
                            <div class="radio radio-danger">
                                <?= form_radio('p_type', "Package", set_value('p_type') ? set_radio('p_type', 'Package') : (isset($data['p_type']) && $data['p_type'] === 'Package' ? 'checked' : true), 'id="package"') ?>
                                <?= form_label("Package", "package", 'class="mb-0"') ?>
                            </div>
                            <div class="radio radio-danger">
                                <?= form_radio('p_type', "Organ", set_value('p_type') ? set_radio('p_type', 'Organ') : (isset($data['p_type']) && $data['p_type'] === 'Organ' ? 'checked' : ''), 'id="organ"') ?>
                                <?= form_label("Organ", "organ", 'class="mb-0"') ?>
                            </div>
                            <div class="radio radio-danger">
                                <?= form_radio('p_type', "Offer", set_value('p_type') ? set_radio('p_type', 'Offer') : (isset($data['p_type']) && $data['p_type'] === 'Offer' ? 'checked' : ''), 'id="offer"') ?>
                                <?= form_label("Offer", "offer", 'class="mb-0"') ?>
                            </div>
                        </div>
                        <?= form_error('p_type') ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Package Name', 'p_name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "p_name",
                        'name' => "p_name",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('p_name') ? set_value('p_name') : (isset($data['p_name']) ? $data['p_name'] : '')
                    ]); ?>
                    <?= form_error('p_name') ?>
                </div>
            </div>
            <div class="col-md-<?= (isset($data['image'])) ? 4 : 6 ?>">
                <div class="form-group">
                    <?= form_label('Image', 'image', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "file",
                        'id' => "image",
                        'accept' => "image/jpeg, image/jpg, image/png",
                        'name' => "image",
                    ]); ?>
                </div>
            </div>
            <?php if (isset($data['image'])): ?>
                <div class="col-md-2">
                    <?= img(['src' => $this->path.$data['image'], 'width' => '100%', 'height' => '70', 'class' => 'mb-2']); ?>
                </div>
            <?php endif ?>
            <div class="col-12">
                <div class="form-group">
                    <?= form_label('Test Names', 'tests', 'class="col-form-label"') ?>
                    <select name="tests[]" id="tests" class="js-example-placeholder-multiple col-sm-12" multiple="multiple">
                        <?php foreach($tests as $test): ?>
                        <option value="<?= e_id($test['id']) ?>" <?= set_value('tests') ? set_select('tests', e_id($test['id'])) : (isset($data['tests']) && in_array($test['id'], explode(',', $data['tests'])) ? 'selected' : '') ?>><?= $test['t_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('tests[]') ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= form_label('Description', 'description', 'class="col-form-label"') ?>
                    <?= form_textarea([
                        'class' => "form-control",
                        'id' => "description",
                        'rows' => 3,
                        'name' => "description",
                        'required' => "",
                        'value' => set_value('description') ? set_value('description') : (isset($data['description']) ? $data['description'] : '')
                    ]); ?>
                    <?= form_error('description') ?>
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