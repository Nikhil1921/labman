<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header">
        <h5><?= $title ?> <?= $operation ?></h5>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach($this->main->roles() as $role): if(in_array($role, ['Phlebetomist', 'Admin'])) continue; ?>
                <div class="col-3 mb-2">
                    <?= anchor("$url/add/".$role, $role, 'class="btn btn-outline-danger col-12"'); ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>