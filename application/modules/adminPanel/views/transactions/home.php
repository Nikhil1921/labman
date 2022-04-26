<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <?php $add = verify_access($name, 'add') ?>
        <div class="col-md-<?= $add ? 4 : 6 ?>">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
        <div class="col-md-6">
            <select name="status" id="status" class="form-control">
                <?php foreach($labs as $lab): ?>
                <option value="<?= e_id($lab['id']) ?>"><?= $lab['name'] ?></option>
                <?php endforeach ?>
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
                <th>Amount</th>
                <th>Date</th>
                <th>Time</th>
                <th>Payment mode</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>