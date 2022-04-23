<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> FOR <?= $role ?></h5>
</div>
<div class="card-body">
    <?= form_open('', '', ['role' => $role]) ?>
        <div class="row">
            <?php foreach($navs as $nav): ?>
                <div class="col-12">
                    <div class="form-group">
                        <div class="alert alert-dark outline">
                            <?= form_label($nav['title'], $nav['name'], 'class="col-form-label"'); ?>
                            <hr />
                            <div class="form-group m-t-15 m-checkbox-inline mb-0">
                            <?php foreach($nav['permissions'] as $per): ?>
                            <div class="checkbox checkbox-dark">
                                <input id="<?= $nav['name'].$per ?>" type="checkbox" <?= in_array($per, $nav['added']) ? 'checked' : '' ?> value="<?= $per ?>" name="permissions[<?= $nav['name'] ?>][]">
                                <label for="<?= $nav['name'].$per ?>"><?= ucfirst($per) ?></label>
                            </div>
                            <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
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