<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="">
   <div class="container">
        <h1 class="page-title">Test Reports</h1>
    </div>
    <div class="container">
        <div class="row">
            <?php $this->load->view('user-sidebar'); ?>
            <div class="col-md-9">   
                <table class="table table-bordered table-striped table-booking-history" data-url="<?= base_url('user/test-reports') ?>" id="datatable">
                    <thead>
                        <tr>
                            <th class="target">No</th>
                            <th>Order #</th>
                            <th>Name</th>
                            <th>Test Name</th>
                            <th>Report upload Date</th>
                            <th class="target">Report View</th>
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