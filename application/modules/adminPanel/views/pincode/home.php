<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-5">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
        <div class="col-3">
            <select name="cat_id" id="cat_id" class="form-control">
                <option value="">Select State</option>
                <?php foreach ($this->states as $v): ?>
                    <option value="<?= e_id($v['id']) ?>"><?= $v['s_name'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-2">
            <?= anchor("$url/add", '<span class="fa fa-plus"></span> Add new', 'class="btn btn-outline-success btn-sm float-right"'); ?>
        </div>
        <div class="col-2">
            <?= anchor("$url/bulk", '<span class="fa fa-upload"></span> Upload', 'class="btn btn-outline-primary btn-sm float-right"'); ?>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatable table table-striped table-bordered nowrap">
            <thead>
                <th class="target">Sr.</th>
                <th>Pincode</th>
                <th>Delivery charge</th>
                <th class="target">Action</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>