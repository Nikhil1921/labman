<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-md-9">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
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
                <th class="target">Address</th>
                <th class="target">Total</th>
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