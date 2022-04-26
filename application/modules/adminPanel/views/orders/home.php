<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <?php $tr = verify_access('transactions', 'view') ?>
    <div class="row">
        <div class="col-md-<?= $tr ? 4 : 6 ?>">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
        <div class="col-md-6">
            <select name="status" id="status" class="form-control">
                <?php foreach($labs as $lab): ?>
                <option value="<?= e_id($lab['id']) ?>"><?= $lab['name'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <?php if($tr): ?>
        <div class="col-md-2">
            <?= anchor(admin("transactions"), 'Transactions', 'class="btn btn-outline-success btn-sm float-right"'); ?>
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
                <th>Date</th>
                <th>Time</th>
                <th>Price</th>
                <th>Margin</th>
                <th class="target">Action</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="modal fade order-modal" tabindex="-1" role="dialog" aria-labelledby="order-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="order-modal">Tests details</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="text-center">Order details not available</div>
            </div>
        </div>
    </div>
</div>
<?= form_hidden('approval', 'Completed') ?>