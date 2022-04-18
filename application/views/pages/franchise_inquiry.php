<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="employee-registration-form">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?= img('assets/images/login.png') ?>
            </div>
            <div class="col-md-8">
                <h2>Franchise Inquiry Form</h2>
                <?= form_open('franchise', 'class="institutional-form"'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" maxlength="100" placeholder="Enter Your Name" type="text" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lab Name</label>
                                <input class="form-control" name="c_name" maxlength="255" placeholder="Enter Lab Name" type="text" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Id</label>
                                <input class="form-control" name="email" maxlength="100" placeholder="Enter Email Id" type="email" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile No</label>
                                <input class="form-control" name="mobile" maxlength="10" placeholder="Enter Mobile Number" type="text" required/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Lab Address</label>
                                <textarea class="form-control" name="address" maxlength="255" placeholder="Enter Lab Address"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</section>