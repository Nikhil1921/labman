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