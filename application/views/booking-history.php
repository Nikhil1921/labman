<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="">
   <div class="container">
        <h1 class="page-title">Booking History</h1>
    </div>
    <div class="container">
        <div class="row">
            <?php $this->load->view('user-sidebar'); ?>
            <div class="col-md-9">   
                <table class="table table-bordered table-striped table-booking-history" data-url="<?= base_url('user/history') ?>" id="datatable">
                    <thead>
                        <tr>
                            <th class="target">No</th>
                            <th>Name</th>
                            <th>Lab Name</th>
                            <th class="target">Test Name</th>
                            <th>Date</th>
                            <th class="target">Amount</th>
                            <th>Payment Method</th>
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