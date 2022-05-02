<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <?= form_open_multipart('', '', ['photo' => isset($data['photo']) ? $data['photo'] : '', 'qulimg' => isset($data['qulimg']) ? $data['qulimg'] : '', 'licence_img' => isset($data['licence_img']) ? $data['licence_img'] : '', 'computer' => isset($data['computer']) ? $data['computer'] : '', 'aadhar_img' => isset($data['aadhar_img']) ? $data['aadhar_img'] : '']) ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Name', 'name', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "name",
                        'name' => "name",
                        'maxlength' => 255,
                        'required' => "",
                        'value' => set_value('name') ? set_value('name') : (isset($data['name']) ? $data['name'] : '')
                    ]); ?>
                    <?= form_error('name') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Contact no.', 'mobile', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "mobile",
                        'name' => "mobile",
                        'maxlength' => 10,
                        'minlength' => 10,
                        'required' => "",
                        'value' => set_value('mobile') ? set_value('mobile') : (isset($data['mobile']) ? $data['mobile'] : '')
                    ]); ?>
                    <?= form_error('mobile') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Email', 'email', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => 'email',
                        'id' => "email",
                        'name' => "email",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('email') ? set_value('email') : (isset($data['email']) ? $data['email'] : '')
                    ]); ?>
                    <?= form_error('email') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Password', 'password', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "password",
                        'id' => "password",
                        'name' => "password",
                        'maxlength' => 100,
                        (! isset($data['mobile']) ? 'required' : ''),
                    ]); ?>
                    <?= form_error('password') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Flate No / House No / Socity', 'society', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "society",
                        'name' => "society",
                        'maxlength' => 100,
                        'required' => "",
                        'value' => set_value('society') ? set_value('society') : (isset($data['society']) ? $data['society'] : '')
                    ]); ?>
                    <?= form_error('society') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Area', 'area', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "area",
                        'name' => "area",
                        'maxlength' => 255,
                        'required' => "",
                        'value' => set_value('area') ? set_value('area') : (isset($data['area']) ? $data['area'] : '')
                    ]); ?>
                    <?= form_error('area') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Pincode', 'pincode', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "pincode",
                        'name' => "pincode",
                        'maxlength' => 6,
                        'minlength' => 6,
                        'required' => "",
                        'value' => set_value('pincode') ? set_value('pincode') : (isset($data['pincode']) ? $data['pincode'] : '')
                    ]); ?>
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="role">Select Role</label>
                    <select class="form-control" name="role" id="role" required="">
                        <?php foreach($this->main->roles() as $role): ?>
                            <option <?= set_value('role') ? set_select('role', $role) : (isset($data['role']) && $data['role'] === $role ? 'selected' : '') ?> value=<?= $role ?>><?= $role ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('role') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Language known', '', 'class="col-form-label"') ?>
                    <br />
                    <div class="checkbox checkbox-dark">
                        <input id="Gujarati" value="Gujarati" name="language[]" type="checkbox" <?= set_value('language') ? set_checkbox('language', 'Gujarati') : (isset($data['language']) && in_array('Gujarati', explode(', ', $data['language'])) ? 'checked' : '') ?> />
                        <label for="Gujarati">Gujarati</label>
                    </div>
                    <div class="checkbox checkbox-dark">
                        <input id="Hindi" value="Hindi" name="language[]" type="checkbox" <?= set_value('language') ? set_checkbox('language', 'Hindi') : (isset($data['language']) && in_array('Hindi', explode(', ', $data['language'])) ? 'checked' : '') ?> />
                        <label for="Hindi">Hindi</label>
                    </div>
                    <div class="checkbox checkbox-dark">
                        <input id="English" value="English" name="language[]" type="checkbox" <?= set_value('language') ? set_checkbox('language', 'English') : (isset($data['language']) && in_array('English', explode(', ', $data['language'])) ? 'checked' : '') ?> />
                        <label for="English">English</label>
                    </div>
                    <br />
                    <?= form_error('language[]') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Date Of Birth', 'dob', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "date",
                        'id' => "dob",
                        'name' => "dob",
                        'required' => "",
                        'value' => set_value('dob') ? set_value('dob') : (isset($data['dob']) ? $data['dob'] : '')
                    ]); ?>
                    <?= form_error('dob') ?>
                </div>
            </div>
            <div class="col-md-6">
                <?= form_label('Gender', '', 'class="col-form-label"') ?>
                <div class="form-group mt-2 m-checkbox-inline mb-0 custom-radio-ml">
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "male",
                            'name' => "gender",
                            'value' => "Male",
                            'checked' => set_value('gender') ? set_radio('gender', 'Male', true) : (isset($data['gender']) && $data['gender'] == 'Male' ? true : true)
                        ]); ?>
                        <?= form_label('Male', 'male') ?>
                    </div>
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Female",
                            'name' => "gender",
                            'value' => "Female",
                            'checked' => set_value('gender') ? set_radio('gender', 'Female') : (isset($data['gender']) && $data['gender'] == 'Female' ? true : false)
                        ]); ?>
                        <?= form_label('Female', 'Female') ?>
                    </div>
                </div>
                <?= form_error('gender') ?>
            </div>
            <div class="col-md-6">
                <?= form_label('Marital Status', '', 'class="col-form-label"') ?>
                <div class="form-group mt-2 m-checkbox-inline mb-0 custom-radio-ml">
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Married",
                            'name' => "marital",
                            'value' => "Married",
                            'checked' => set_value('marital') ? set_radio('marital', 'Married', true) : (isset($data['marital']) && $data['marital'] == 'Married' ? true : true)
                        ]); ?>
                        <?= form_label('Married', 'Married') ?>
                    </div>
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Unmarried",
                            'name' => "marital",
                            'value' => "Unmarried",
                            'checked' => set_value('marital') ? set_radio('marital', 'Unmarried') : (isset($data['marital']) && $data['marital'] == 'Unmarried' ? true : false)
                        ]); ?>
                        <?= form_label('Unmarried', 'Unmarried') ?>
                    </div>
                </div>
                <?= form_error('marital') ?>
            </div>
            <div class="col-md-6">
                <?= form_label('Physical Status', '', 'class="col-form-label"') ?>
                <div class="form-group mt-2 m-checkbox-inline mb-0 custom-radio-ml">
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Healthy",
                            'name' => "physical",
                            'value' => "Healthy",
                            'checked' => set_value('physical') ? set_radio('physical', 'Healthy', true) : (isset($data['physical']) && $data['physical'] == 'Healthy' ? true : true)
                        ]); ?>
                        <?= form_label('Healthy', 'Healthy') ?>
                    </div>
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Handycapt",
                            'name' => "physical",
                            'value' => "Handycapt",
                            'checked' => set_value('physical') ? set_radio('physical', 'Handycapt') : (isset($data['physical']) && $data['physical'] == 'Handycapt' ? true : false)
                        ]); ?>
                        <?= form_label('Handycapt', 'Handycapt') ?>
                    </div>
                </div>
                <?= form_error('physical') ?>
            </div>
            <div class="col-md-6">
                <?= form_label('Qulification', '', 'class="col-form-label"') ?>
                <div class="form-group mt-2 m-checkbox-inline mb-0 custom-radio-ml">
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "10th Standard",
                            'name' => "qulification",
                            'value' => "10th Standard",
                            'checked' => set_value('qulification') ? set_radio('qulification', '10th Standard', true) : (isset($data['qulification']) && $data['qulification'] == '10th Standard' ? true : true)
                        ]); ?>
                        <?= form_label('10th Standard', '10th Standard') ?>
                    </div>
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "12th Standard",
                            'name' => "qulification",
                            'value' => "12th Standard",
                            'checked' => set_value('qulification') ? set_radio('qulification', '12th Standard') : (isset($data['qulification']) && $data['qulification'] == '12th Standard' ? true : false)
                        ]); ?>
                        <?= form_label('12th Standard', '12th Standard') ?>
                    </div>
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Under Graduation",
                            'name' => "qulification",
                            'value' => "Under Graduation",
                            'checked' => set_value('qulification') ? set_radio('qulification', 'Under Graduation') : (isset($data['qulification']) && $data['qulification'] == 'Under Graduation' ? true : false)
                        ]); ?>
                        <?= form_label('Under Graduation', 'Under Graduation') ?>
                    </div>
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Post Graduation",
                            'name' => "qulification",
                            'value' => "Post Graduation",
                            'checked' => set_value('qulification') ? set_radio('qulification', 'Post Graduation') : (isset($data['qulification']) && $data['qulification'] == 'Post Graduation' ? true : false)
                        ]); ?>
                        <?= form_label('Post Graduation', 'Post Graduation') ?>
                    </div>
                </div>
                <?= form_error('qulification') ?>
            </div>
            <div class="col-md-<?= isset($data['qulimg']) ? 4 : 6 ?>">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Upload Qulification', 'qulimg', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => 'file',
                        'id' => "qulimg",
                        'name' => "qulimg",
                        'accept' => "image/jpg, image/jpeg, image/png",
                        isset($data['qulimg']) ? 'required' : '',
                    ]); ?>
                    <?= isset($qulimg) ? $qulimg : '' ?>
                </div>
            </div>
            <?php if(isset($data['qulimg'])): ?>
            <div class="col-md-2">
                <?= img($this->path.$data['qulimg'], '', 'class="mt-4 mb-2" height = 50 width="100"'); ?>
            </div>
            <?php endif ?>
            <div class="col-md-<?= isset($data['photo']) ? 4 : 6 ?>">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Photo', 'photo', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => 'file',
                        'id' => "photo",
                        'name' => "photo",
                        'accept' => "image/jpg, image/jpeg, image/png",
                        isset($data['photo']) ? 'required' : '',
                    ]); ?>
                    <?= isset($photo) ? $photo : '' ?>
                </div>
            </div>
            <?php if(isset($data['photo'])): ?>
            <div class="col-md-2">
                <?= img($this->path.$data['photo'], '', 'class="mt-4 mb-2" height = 50 width="100"'); ?>
            </div>
            <?php endif ?>
            <div class="col-md-<?= isset($data['computer']) ? 4 : 6 ?>">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Upload Computer Certificate', 'comp-certificate', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => 'file',
                        'id' => "comp-certificate",
                        'name' => "comp-certificate",
                        'accept' => "image/jpg, image/jpeg, image/png",
                        isset($data['comp-certificate']) ? 'required' : '',
                    ]); ?>
                    <?= isset($computer) ? $computer : '' ?>
                </div>
            </div>
            <?php if(isset($data['computer'])): ?>
            <div class="col-md-2">
                <?= img($this->path.$data['computer'], '', 'class="mt-4 mb-2" height = 50 width="100"'); ?>
            </div>
            <?php endif ?>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Aadhar Card No', 'aadhar', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'id' => "aadhar",
                        'name' => "aadhar",
                        'maxlength' => 12,
                        'minlength' => 12,
                        'required' => "",
                        'value' => set_value('aadhar') ? set_value('aadhar') : (isset($data['aadhar']) ? $data['aadhar'] : '')
                    ]); ?>
                    <?= form_error('aadhar') ?>
                </div>
            </div>
            <div class="col-md-<?= isset($data['aadhar_img']) ? 4 : 6 ?>">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Upload Aadhar', 'aadhar-card', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => 'file',
                        'id' => "aadhar-card",
                        'name' => "aadhar-card",
                        'accept' => "image/jpg, image/jpeg, image/png",
                        isset($data['aadhar-card']) ? 'required' : '',
                    ]); ?>
                    <?= isset($aadhar) ? $aadhar : '' ?>
                </div>
            </div>
            <?php if(isset($data['aadhar_img'])): ?>
            <div class="col-md-2">
                <?= img($this->path.$data['aadhar_img'], '', 'class="mt-4 mb-2" height = 50 width="100"'); ?>
            </div>
            <?php endif ?>
            <div class="col-md-6">
                <?= form_label('Driving Licence', '', 'class="col-form-label"') ?>
                <div class="form-group mt-2 m-checkbox-inline mb-0 custom-radio-ml">
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Two Wheeler",
                            'name' => "licence",
                            'value' => "Two Wheeler",
                            'checked' => set_value('licence') ? set_radio('licence', 'Two Wheeler', true) : (isset($data['licence']) && $data['licence'] == 'Two Wheeler' ? true : true)
                        ]); ?>
                        <?= form_label('Two Wheeler', 'Two Wheeler') ?>
                    </div>
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Four Wheeler",
                            'name' => "licence",
                            'value' => "Four Wheeler",
                            'checked' => set_value('licence') ? set_radio('licence', 'Four Wheeler') : (isset($data['licence']) && $data['licence'] == 'Four Wheeler' ? true : false)
                        ]); ?>
                        <?= form_label('Four Wheeler', 'Four Wheeler') ?>
                    </div>
                </div>
                <?= form_error('licence') ?>
            </div>
            <div class="col-md-<?= isset($data['licence_img']) ? 4 : 6 ?>">
                <div class="form-group m-b-15 m-checkbox-inline">
                    <?= form_label('Upload Driving Licence', 'driving-licence', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => 'file',
                        'id' => "driving-licence",
                        'name' => "driving-licence",
                        'accept' => "image/jpg, image/jpeg, image/png",
                        isset($data['driving-licence']) ? 'required' : '',
                    ]); ?>
                    <?= isset($driving) ? $driving : '' ?>
                </div>
            </div>
            <?php if(isset($data['licence_img'])): ?>
            <div class="col-md-2">
                <?= img($this->path.$data['licence_img'], '', 'class="mt-4 mb-2" height = 50 width="100"'); ?>
            </div>
            <?php endif ?>
            <div class="col-md-6">
                <?= form_label('Vehicle', '', 'class="col-form-label"') ?>
                <div class="form-group mt-2 m-checkbox-inline mb-0 custom-radio-ml">
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Moped",
                            'name' => "vehicle",
                            'value' => "Moped",
                            'checked' => set_value('vehicle') ? set_radio('vehicle', 'Moped', true) : (isset($data['vehicle']) && $data['vehicle'] == 'Moped' ? true : true)
                        ]); ?>
                        <?= form_label('Moped', 'Moped') ?>
                    </div>
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Bike",
                            'name' => "vehicle",
                            'value' => "Bike",
                            'checked' => set_value('vehicle') ? set_radio('vehicle', 'Bike') : (isset($data['vehicle']) && $data['vehicle'] == 'Bike' ? true : false)
                        ]); ?>
                        <?= form_label('Bike', 'Bike') ?>
                    </div>
                </div>
                <?= form_error('vehicle') ?>
            </div>
            <div class="col-md-6">
                <?= form_label('Office Time', '', 'class="col-form-label"') ?>
                <div class="form-group mt-2 m-checkbox-inline mb-0 custom-radio-ml">
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Day",
                            'name' => "office-time",
                            'value' => "Day",
                            'checked' => set_value('office-time') ? set_radio('office-time', 'Day', true) : (isset($data['office_time']) && $data['office_time'] == 'Day' ? true : true)
                        ]); ?>
                        <?= form_label('8 AM To 8 PM (Day)', 'Day') ?>
                    </div>
                    <div class="radio radio-primary">
                        <?= form_radio([
                            'id' => "Night",
                            'name' => "office-time",
                            'value' => "Night",
                            'checked' => set_value('office-time') ? set_radio('office-time', 'Night') : (isset($data['office_time']) && $data['office_time'] == 'Night' ? true : false)
                        ]); ?>
                        <?= form_label('8 PM To 8 AM (Night)', 'Night') ?>
                    </div>
                </div>
                <?= form_error('office-time') ?>
            </div>
            <div class="col-12 mb-4"></div>
            <div class="col-6 col-md-3">
                <?= form_button([
                    'type'    => 'submit',
                    'class'   => 'btn btn-outline-primary btn-block col-12',
                    'content' => 'SAVE'
                ]); ?>
            </div>
            <div class="col-6 col-md-3">
                <?= anchor("$url", 'CANCEL', 'class="btn btn-outline-danger col-12"'); ?>
            </div>
        </div>
    <?= form_close() ?>
</div>