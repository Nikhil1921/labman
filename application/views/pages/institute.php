<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="employee-registration-form">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?= img('assets/images/login1.png') ?>
            </div>
            <div class="col-md-8">
                <h2>Institutional Inquiry Form</h2>
                <?= form_open('institutional', 'class="institutional-form"'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input class="form-control" type="text" name="c_name" maxlength="255" placeholder="Enter Company Name" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" maxlength="100" placeholder="Enter Name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address" maxlength="255" placeholder="Enter address" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email address</label>
                                <input class="form-control" type="email" name="email" maxlength="100" placeholder="Enter email" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" name="mobile" maxlength="10" placeholder="Enter Mobile No" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Staff</label>
                                <input class="form-control" type="text" name="total" maxlength="5" placeholder="Enter Total Staff" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Requirement</label>
                                <textarea class="form-control" maxlength="255" name="requirement" placeholder="Enter Requirement" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</section>