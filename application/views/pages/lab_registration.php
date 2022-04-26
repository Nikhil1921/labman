<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="lab-registration-form">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Lab Registration Form</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="l_name">Laboratory Name</label>
                                <input class="form-control" maxlength="255" value="<?= set_value('l_name') ?>" name="l_name" id="l_name" placeholder="Enter Laboratory Name" type="text" required />
                                <?= form_error('l_name') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doc_name">Doctor Name</label>
                                <input class="form-control" maxlength="100" id="doc_name" value="<?= set_value('doc_name') ?>" name="doc_name" placeholder="Enter Doctor Name" type="text" required />
                                <?= form_error('doc_name') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Mobile Number</label>
                                <input class="form-control" maxlength="10" value="<?= set_value('mobile') ?>" name="mobile" id="mobile" placeholder="Enter Mobile Number" type="text" required />
                                <?= form_error('mobile') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" id="password" maxlength="100" name="password" placeholder="Enter Password" type="password" required />
                                <?= form_error('password') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Id</label>
                                <input class="form-control" id="email" maxlength="100" value="<?= set_value('email') ?>" name="email" placeholder="Enter Email Id" type="email" required />
                                <?= form_error('email') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pincode">Pincode</label>
                                <input class="form-control" id="pincode" value="<?= set_value('pincode') ?>" name="pincode" placeholder="Enter Pincode" type="text" maxlength="6" required />
                                <?= form_error('pincode') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Certificate</label>
                                <div class="checkbox-inline checkbox-small">
                                    <label>
                                        <input class="i-check" <?= set_checkbox('certificate[]', 'NABL') ?> name="certificate[]" type="checkbox" value="NABL" />NABL
                                    </label>
                                </div>
                                <div class="checkbox-inline checkbox-small">
                                    <label>
                                        <input class="i-check" <?= set_checkbox('certificate[]', 'ISO') ?> name="certificate[]" type="checkbox" value="ISO" />ISO
                                    </label>
                                </div>
                            </div>
                            <?= form_error('certificate[]') ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="del_time">Report Delivery Time</label>
                                <select name="del_time" id="del_time" class="form-control">
                                    <option value="" selected disabled>Select Reporting Time</option>
                                    <?php foreach($report_time as $re): ?>
                                        <option value="<?= e_id($re['id']) ?>" <?= set_value('del_time') ? set_select('del_time', e_id($re['id'])) : (isset($data['del_time']) && $data['del_time'] === $re['id'] ? 'selected' : '') ?>><?= $re['re_time'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('del_time') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Certificate</label>
                                <div class="input-group input-file" data-name="cert_image">
                                    <input type="text" class="form-control" placeholder='Upload Certificate' />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-choose" type="button">Choose</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Logo</label>
                                <div class="input-group input-file" data-name="logo">
                                    <input type="text" class="form-control" placeholder='Upload Logo' />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default btn-choose" type="button">Choose</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" maxlength="255" name="address" placeholder="Enter Address" id="address" required><?= set_value('address') ?></textarea>
                                <?= form_error('address') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="checkbox-inline checkbox-small">
                                    <label>
                                        <input class="i-check" <?= set_checkbox('agree', 'YES') ?> name="agree" value="YES" type="checkbox" required="" />
                                        Please confirm that you agree to our Terms & Conditions
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>