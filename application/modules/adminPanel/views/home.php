<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('labs')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter">3</span>
                            </h5>
                            <p>Total labs</p>
                        </div>
                        <i class="fa fa-ambulance fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter">0</span>
                            </h5>
                            <p>Ongoing Order</p>
                        </div>
                        <i class="fa fa-file-text-o fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter">0</span>
                            </h5>
                            <p>Completed Order</p>
                        </div>
                        <i class="fa fa-file-text-o fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter">0</span>
                            </h5>
                            <p>Canceled Order</p>
                        </div>
                        <i class="fa fa-file-text-o fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs border-tab" role="tablist">
            <?php foreach($this->main->status() as $k => $status): ?>
                <?php if($k === 0) echo form_hidden('approval', $status) ?>
                <li class="nav-item"><a onclick="changeApproval('<?= $status ?>')" class="nav-link <?= $k === 0 ? 'active show' : '' ?>" data-toggle="tab" href="javascript:;" role="tab" aria-selected="true"><?= $status ?></a></li>
            <?php endforeach ?>
        </ul>
        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered nowrap">
                <thead>
                    <th class="target">Sr.</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Lab</th>
                    <th>Ref. Doctor</th>
                    <th>Doctor Remark</th>
                    <th>Address</th>
                    <th class="target">Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
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