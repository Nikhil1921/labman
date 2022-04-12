<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-md-6">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
        <div class="col-md-6">
            <select name="status" id="status" class="form-control">
                <?php foreach($labs as $lab): ?>
                <option value="<?= e_id($lab['id']) ?>"><?= $lab['name'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="datatable table table-striped table-bordered nowrap">
            <thead>
                <th class="target">Sr.</th>
                <th>Category</th>
                <th>Test name</th>
                <th>Lab to lab price</th>
                <th>Labman margin</th>
                <th class="target">Total</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>