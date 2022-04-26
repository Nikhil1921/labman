<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <?php $add = verify_access($name, 'add') ?>
        <div class="col-md-<?= $add ? 8 : 10 ?>">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
        <div class="col-md-2">
            <select name="status" id="status" class="form-control">
                <option value="">Select type</option>
                <option value="Organ">Organ</option>
                <option value="Package">Package</option>
                <option value="Offer">Offer</option>
            </select>
        </div>
        <?php if($add): ?>
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
                <th>Lab</th>
                <th>Name</th>
                <th>Discount</th>
                <th class="target">Image</th>
                <th class="target">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>