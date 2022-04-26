<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-6">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
        <?php if(verify_access($name, 'add')): ?>
        <div class="col-6">
            <?= anchor("$url/add", '<span class="fa fa-plus"></span> Add new', 'class="btn btn-outline-success btn-sm float-right"'); ?>
        </div>
        <?php endif ?>
    </div>
</div>
<div class="card-body">
    <ul class="nav nav-tabs border-tab" role="tablist">
        <?= form_hidden('approval', 'Yes') ?>
        <?php foreach($this->main->roles() as $k => $role): ?>
            <?php if($k === 0) echo form_hidden('status', $role) ?>
            <li class="nav-item"><a onclick="changeEmps('<?= $role ?>')" class="nav-link <?= $k === 0 ? 'active show' : '' ?>" data-toggle="tab" href="javascript:;" role="tab" aria-selected="true"><?= $role ?></a></li>
        <?php endforeach ?>
    </ul>
    <div class="table-responsive">
        <table class="datatable table table-striped table-bordered nowrap">
            <thead>
                <th class="target">Sr.</th>
                <th>Name</th>
                <th>Contact no.</th>
                <th>Address</th>
                <th>Qulification</th>
                <th class="target">Status</th>
                <th class="target">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
