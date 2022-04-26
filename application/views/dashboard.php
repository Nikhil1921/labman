<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="">
    <div class="container">
        <h1 class="page-title">User Profile</h1>
    </div>
    <div class="container">
        <div class="row">
            <?php $this->load->view('user-sidebar'); ?>
            <div class="col-md-9">
                <h4>Dashboard</h4>
                <ul class="list list-inline user-profile-statictics mb30">
                    <li>
                        <?= anchor('user/test-report', '<i class="fa fa-flask user-profile-statictics-icon"></i>
                        <p>Test Reports</p>'); ?>
                    </li>
                    <li>
                        <?= anchor('user', '<i class="fa fa-money user-profile-statictics-icon"></i>
                        <p>Wallet : '.$this->user['wallet'].'</p>'); ?>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 table-responsive">
                <table class="table table-bordered table-striped table-booking-history" data-url="<?= base_url('user/orders') ?>" id="datatable">
                    <thead>
                        <tr>
                            <th class="target">No</th>
                            <th>Order #</th>
                            <th>Name</th>
                            <th>Lab Name</th>
                            <th class="target">Test Name</th>
                            <th>Date</th>
                            <th class="target">Amount</th>
                            <th>Payment Method</th>
                            <th>Collection OTP</th>
                            <th>Process</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="gap"></div>
</section>