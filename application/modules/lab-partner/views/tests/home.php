<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-md-9">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
        <div class="col-md-3">
            <?= anchor("$url/add", '<span class="fa fa-plus"></span> Add new', 'class="btn btn-outline-success btn-sm float-right"'); ?>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatable table table-striped table-bordered nowrap">
            <thead>
                <th class="target">Sr.</th>
                <th>Category</th>
                <th>Name</th>
                <th>Sample</th>
                <th>Department</th>
                <th>Method</th>
                <th>Time</th>
                <th>MRP</th>
                <th>Price</th>
                <th class="target">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>