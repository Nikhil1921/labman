<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-md-9">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
        <div class="col-md-3">
            <select name="status" id="status" class="form-control">
                <option value="Pending">Pending</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Collect Sample">Collect Sample</option>
                <option value="In Process">In Process</option>
                <option value="Completed">Completed</option>
            </select>
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
        </table>
    </div>
</div>
<div class="modal fade order-modal" tabindex="-1" role="dialog" aria-labelledby="order-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- <div class="modal-header">
            <h4 class="modal-title" id="order-modal">Tests details</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div> -->
            <div class="modal-body">
                <div class="text-center">Order details not available</div>
            </div>
        </div>
    </div>
</div>