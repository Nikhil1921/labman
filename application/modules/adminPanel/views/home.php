<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <?php if(isset($banners)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('banners')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $banners ?></span>
                            </h5>
                            <p>Total Banners</p>
                        </div>
                        <i class="fa fa-image fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($news)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('news')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $news ?></span>
                            </h5>
                            <p>Total News</p>
                        </div>
                        <i class="fa fa-file-text fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($insurance)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('insurance')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $insurance ?></span>
                            </h5>
                            <p>Insurance</p>
                        </div>
                        <i class="fa fa-file-text fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($plans)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('insurance_plans')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $plans ?></span>
                            </h5>
                            <p>Total plans</p>
                        </div>
                        <i class="fa fa-file-text fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($companies)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('companies')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $companies ?></span>
                            </h5>
                            <p>Total companies</p>
                        </div>
                        <i class="fa fa-globe fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($partners)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('become_partners')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $partners ?></span>
                            </h5>
                            <p>Partner requests</p>
                        </div>
                        <i class="fa fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($branches)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('branches')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $branches ?></span>
                            </h5>
                            <p>Total branches</p>
                        </div>
                        <i class="fa fa-home fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($users)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('users')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $users ?></span>
                            </h5>
                            <p>Total users</p>
                        </div>
                        <i class="fa fa-home fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($leads)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('leads')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $leads ?></span>
                            </h5>
                            <p>Total leads</p>
                        </div>
                        <i class="fa fa-home fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($commission)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('purchased_plans')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $commission ?></span>
                            </h5>
                            <p>Total revenue</p>
                        </div>
                        <i class="fa fa-money fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($pending_commission)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('purchased_plans')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $pending_commission ?></span>
                            </h5>
                            <p>Pending revenue</p>
                        </div>
                        <i class="fa fa-money fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if(isset($paid_commission)): ?>
    <div class="col-md-3" onclick="window.location.href = '<?= base_url(admin('purchased_plans')) ?>'">
        <div class="card">
            <div class="card-body">
                <div class="chart-widget-dashboard">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0 f-w-600">
                                <span class="counter"><?= $paid_commission ?></span>
                            </h5>
                            <p>Paid revenue</p>
                        </div>
                        <i class="fa fa-money fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>