<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open_multipart(''); ?>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <?= form_label('Upload images', 'cat_id', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "file",
                        'id' => "image",
                        'name' => "image[]",
                        'accept' => "image/png, image/jpeg, image/jpg",
                        'onchange' => 'this.form.submit()',
                        'multiple' => 'multiple'
                    ]); ?>
                </div>
            </div>
            <div class="col-12"></div>
            <div class="col-3">
                <?= anchor("$url", 'Go Back', 'class="btn btn-outline-danger col-12"'); ?>
            </div>
        </div>
    <?= form_close(); ?>
</div>