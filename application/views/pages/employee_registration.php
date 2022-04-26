<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="employee-registration-form">
    <div class="container">
        <h2>Employee Registration Form</h2>
        <form method="POST" enctype="multipart/form-data" id="employee-form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Employee Name</label>
                        <input class="form-control" name="name" pattern="[a-zA-Z ]{5,}" maxlength="100" id="name" value="<?= set_value('name') ?>" placeholder="Enter Employee Name" type="text" required />
                        <?= form_error('name') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input class="form-control" pattern="[0-9]{10}" name="mobile" maxlength="10" id="mobile" value="<?= set_value('mobile') ?>" placeholder="Enter Mobile Number" type="text" required />
                        <?= form_error('mobile') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email Id</label>
                        <input class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="100" id="email" value="<?= set_value('email') ?>" placeholder="Enter Email Id" type="email" required />
                        <?= form_error('email') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" maxlength="100" id="password" placeholder="Enter Password" type="password" value="<?= set_value('password') ?>" required />
                        <?= form_error('password') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="gender" value="Male" <?= set_radio('gender', 'Male', true) ?> />Male
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="gender" value="Female" <?= set_radio('gender', 'Female') ?> />Female
                            </label>
                        </div>
                    </div>
                    <?= form_error('gender') ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dob">Date Of Birth</label>
                        <input class="date-pick form-control" id="dob" value="<?= set_value('dob') ?>" name="dob" type="text" required />
                        <?= form_error('dob') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="society">Flate No / House No / Socity</label>
                        <input class="form-control" pattern="[a-zA-Z0-9 ]{3,}" id="society" maxlength="100" value="<?= set_value('society') ?>" name="society" placeholder="Enter Flate No / House No / Socity" type="text" required />
                        <?= form_error('society') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group location">
                        <label for="area">Area</label>
                        <input class="form-control" id="area" pattern="[a-zA-Z0-9, ]{3,}" maxlength="100" value="<?= set_value('area') ?>" name="area" placeholder="Enter Area" id="area" required />
                        <?= form_error('area') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pincode">Pin Code</label>
                        <input class="form-control" id="pincode" pattern="[0-9]{6}" maxlength="6" value="<?= set_value('pincode') ?>" name="pincode" placeholder="Enter Pin Code" type="text" required />
                        <?= form_error('pincode') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">Select City</label>
                        <select class="form-control" name="city" id="city" required="">
                            <?php foreach($this->main->getCities() as $city): ?>
                                <option <?= set_select('city', e_id($city['id'])) ?> value=<?= e_id($city['id']) ?>><?= $city['c_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <?= form_error('city') ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <label>Apply For</label>
                    <div class="form-group">
                        <?php foreach($this->main->roles() as $r => $role): ?>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('role', $role, $r === 0 ? true : false) ?> name="role" value="<?= $role ?>" required /><?= $role ?>
                            </label>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <?= form_error('role') ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Marital Status</label>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('marital', 'Married', true) ?> name="marital" value="Married" required />Married
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('marital', 'Unmarried') ?> name="marital" value="Unmarried" required />Unmarried
                            </label>
                        </div>
                    </div>
                    <?= form_error('marital') ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Physical Status</label>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('physical', 'Healthy', true) ?> name="physical" value="Healthy" required />Healthy
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('physical', 'Handycapt') ?> name="physical" value="Handycapt" required />Handycapt
                            </label>
                        </div>
                    </div>
                    <?= form_error('physical') ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Qulification</label>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('qulification', '10th Standard', true) ?> name="qulification" value="10th Standard" required />10th Standard
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('qulification', '12th Standard') ?> name="qulification" value="12th Standard" required />12th Standard
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('qulification', 'Under Graduation') ?> name="qulification" value="Under Graduation" required />Under Graduation
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('qulification', 'Post Graduation') ?> name="qulification" value="Post Graduation" required />Post Graduation
                            </label>
                        </div>
                    </div>
                    <?= form_error('qulification') ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Qulification</label>
                        <div class="input-group input-file" data-name="qulimg">
                            <input type="text" class="form-control" placeholder='Upload Qulification'/>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-choose" type="button">Choose</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Driving Licence</label>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('licence', 'Two Wheeler', true) ?> name="licence" value="Two Wheeler" required />Two Wheeler
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" <?= set_radio('licence', 'Four Wheeler') ?> name="licence" value="Four Wheeler" required />Four Wheeler
                            </label>
                        </div>
                    </div>
                    <?= form_error('licence') ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Driving Licence</label>
                        <div class="input-group input-file" data-name="driving-licence">
                            <input type="text" class="form-control" placeholder='Upload Driving Licence'/>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-choose" type="button">Choose</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Have Any Vehicle</label>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="vehicle" <?= set_radio('vehicle', 'Moped', true) ?> value="Moped" required />Moped
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="vehicle" <?= set_radio('vehicle', 'Bike') ?> value="Bike" required />Bike
                            </label>
                        </div>
                    </div>
                    <?= form_error('vehicle') ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Office Time</label>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="office-time" <?= set_radio('office-time', 'Day', true) ?> value="Day" required />8 AM To 8 PM (Day)
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="office-time" <?= set_radio('office-time', 'Night') ?> value="Night" required />8 PM To 8 AM (Night)
                            </label>
                        </div>
                    </div>
                    <?= form_error('office-time') ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Language You Know</label>
                        <div class="checkbox-inline checkbox-small">
                            <label>
                                <input class="i-check" type="checkbox" <?= set_checkbox('language[]', 'Gujarati') ?> name="language[]" value="Gujarati" />Gujarati
                            </label>
                        </div>
                        <div class="checkbox-inline checkbox-small">
                            <label>
                                <input class="i-check" type="checkbox" <?= set_checkbox('language[]', 'Hindi') ?> name="language[]" value="Hindi" />Hindi
                            </label>
                        </div>
                        <div class="checkbox-inline checkbox-small">
                            <label>
                                <input class="i-check" type="checkbox" <?= set_checkbox('language[]', 'English') ?> name="language[]" value="English" />English
                            </label>
                        </div>
                    </div>
                    <?= form_error('language[]') ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Computer Certificate</label>
                        <div class="input-group input-file" data-name="comp-certificate">
                            <input type="text" class="form-control" placeholder='Upload Computer Certificate'/>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-choose" type="button">Choose</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aadhar">Aadhar Card No</label>
                        <input class="form-control" pattern="[0-9]{12}" maxlength="12" minlength="12" name="aadhar" id="aadhar" value="<?= set_value('aadhar') ?>" placeholder="Enter Aadhar Card No" type="text" required />
                        <?= form_error('aadhar') ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Aadhar Card</label>
                        <div class="input-group input-file" data-name="aadhar-card">
                            <input type="text" class="form-control" placeholder='Upload Aadhar Card'/>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-choose" type="button">Choose</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Photo</label>
                        <div class="input-group input-file" data-name="photo">
                            <input type="text" class="form-control" placeholder='Upload Photo'/>
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-choose" type="button">Choose</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <input class="btn btn-primary" type="submit" value="Submit" />
                </div>
            </div>
        </form>
    </div>
</section>