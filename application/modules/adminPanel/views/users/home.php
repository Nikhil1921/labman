<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-md-10">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
        <?php if(verify_access($name, 'add')): ?>
        <div class="col-md-2">
            <?= anchor("$url/add", '<span class="fa fa-plus"></span> Add new', 'class="btn btn-outline-success btn-sm float-right"'); ?>
        </div>
        <?php endif ?>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatable table table-striped table-bordered nowrap">
            <thead>
                <th class="target">Sr.</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Age</th>
                <th class="target">Status</th>
                <th class="target">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>