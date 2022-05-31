<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <h5><?= $title ?> <?= $operation ?></h5>
</div>
<div class="card-body">
    <form action="" method="get">
        <div class="row">
            <?php if(isset($data['prescription'])): ?>
            <div class="col-md-12 mb-3">
                <?= img($data['prescription'], '', 'width="100%"') ?>
            </div>
            <?php endif ?>
            <div class="col-md-12">
                <div class="text-center alert alert-danger">Search lab</div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <?= form_label('Test Names', 'tests', 'class="col-form-label"') ?>
                    <select name="tests[]" id="tests" class="js-example-placeholder-multiple col-sm-12" multiple="multiple">
                        <?php foreach($tests as $test): ?>
                        <option value="<?= e_id($test['id']) ?>" <?= $this->input->get('tests') && in_array(e_id($test['id']), $this->input->get('tests')) ? 'selected' : '' ?>><?= $test['t_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('tests[]') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label" for="city">City</label>
                    <select name="city" id="city" class="form-control">
                        <?php foreach($cities as $c): ?>
                            <option value="<?= $c['c_name']; ?>" <?= $this->input->get('city') === $c['c_name'] ? 'selected' : '' ?>><?= $c['c_name']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-12"></div>
            <div class="col-6 col-md-3 mb-4">
                <?= form_button([
                    'type'    => 'submit',
                    'class'   => 'btn btn-outline-primary btn-block col-12',
                    'content' => 'SEARCH'
                ]); ?>
            </div>
        </div>
    </form>
    <?= form_open("$save?".$this->input->server('REDIRECT_QUERY_STRING'), '', ['u_id' => e_id($data['u_id'])]) ?>
        <?php if($this->input->get('tests')) foreach($this->input->get('tests') as $test) echo form_hidden('tests[]', $test); ?>
        <?= form_hidden('city', $this->input->get('city')); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center alert alert-danger">Add order</div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-form-label" for="lab_id">Lab</label>
                    <select name="lab_id" id="lab_id" class="form-control">
                        <?php foreach($labs as $l): ?>
                            <option value="<?= e_id($l['lab_id']) ?>"><?= $l['name']; ?> - <?= $l['total']; ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('lab_id') ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= form_label('Address', 'address', 'class="col-form-label"') ?>
                    <select name="address" id="address" class="form-control">
                        <?php foreach($address as $add): ?>
                        <option value="<?= e_id($add['id']) ?>"><?= $add['ad_location']; ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('address') ?>
                </div>
            </div>
            <!-- <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-outline-primary mt-4 col-12" type="button" data-toggle="modal" data-target="#add-address">Add address</button>
                </div>
            </div> -->
            <div class="col-md-10">
                <div class="form-group">
                    <?= form_label('Select Family member', 'family', 'class="col-form-label"') ?>
                    <select name="family" id="family" class="form-control">
                        <option value="0"><?= $user['name'] ?></option>
                        <?php foreach($members as $f): ?>
                            <option value="<?= e_id($f['id']) ?>"><?= $f['name']; ?></option>
                        <?php endforeach ?>
                    </select>
                    <?= form_error('family') ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-outline-primary mt-4 col-12" type="button" data-toggle="modal" data-target="#add-member">Add member</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Refer by Doctor (Optional)', 'ref_doctor', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "ref_doctor",
                        'name' => "ref_doctor",
                        'maxlength' => 100,
                        'value' => set_value('ref_doctor')
                    ]); ?>
                    <?= form_error('ref_doctor') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Doctor Remarks (Optional)', 'remarks', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "text",
                        'id' => "remarks",
                        'name' => "remarks",
                        'maxlength' => 100,
                        'value' => set_value('remarks')
                    ]); ?>
                    <?= form_error('remarks') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Collection date', 'collection_date', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "date",
                        'id' => "collection_date",
                        'name' => "collection_date",
                        'value' => set_value('collection_date')
                    ]); ?>
                    <?= form_error('collection_date') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?= form_label('Collection time', 'collection_time', 'class="col-form-label"') ?>
                    <?= form_input([
                        'class' => "form-control",
                        'type' => "time",
                        'id' => "collection_time",
                        'name' => "collection_time",
                        'value' => set_value('collection_time')
                    ]); ?>
                    <?= form_error('collection_time') ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="checkbox checkbox-dark">
                        <input id="hardcopy" type="checkbox" <?= set_checkbox('hardcopy', "YES") ?> value="YES" name="hardcopy" />
                        <label for="hardcopy">Hardcopy charges?</label>
                    </div>
                </div>
            </div>
            <div class="col-12"></div>
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
<div class="modal fade" id="add-member" tabindex="-1" role="dialog" aria-labelledby="add-member" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New member</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <?= form_open(admin("prescriptions/add-member"), 'id="add_member"', ['u_id' => e_id($data['u_id'])]) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="relation">Member Relations</label>
                                <input type="text" name="relation" id="relation" maxlength="20" class="form-control" placeholder="Enter Member Relations" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="name">Member Name</label>
                                <input type="text" name="name" maxlength="100" class="form-control" placeholder="Enter Member Name" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="email">Member Email</label>
                                <input type="email" name="email" maxlength="100" class="form-control" placeholder="Enter Member Email" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="mobile">Member Mobile</label>
                                <input type="text" name="mobile" maxlength="10" class="form-control" placeholder="Enter Member Mobile Number" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="dob">Member DOB</label>
                                <input type="date" name="dob" class="date-pick form-control" placeholder="Select Date" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label">Member Gender</label>
                                <div class="form-group mt-1 m-checkbox-inline mb-0">
                                    <div class="radio radio-primary">
                                        <input id="male" type="radio" name="gender" value="Male" checked />
                                        <label class="mb-0" for="male">Male</label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input id="female" type="radio" name="gender" value="Female">
                                        <label class="mb-0" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="submitForm(document.getElementById('add_member'), this);" type="button">Add member</button>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <!-- <div class="modal fade" id="add-address" role="dialog" aria-labelledby="add-address" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New address</h5>
                <!-- <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> -->
            </div>
            <div class="modal-body">
                <?= form_open(admin("prescriptions/add-address"), 'id="add_address"', ['u_id' => e_id($data['u_id'])]) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="faddress">Full Address (With landmark)</label>
                                <input type="text" name="faddress" id="faddress" maxlength="100" class="form-control" placeholder="Full Address (With landmark)" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group location">
                                <label class="col-form-label" for="address">Location</label>
                                <input type="text" name="address" maxlength="255" class="form-control geocompletes" placeholder="Enter Location" id="address" required />
                                <fieldset class="details" style="display: none;">
                                    <input name="lat" type="text" value="" />
                                    <input name="lng" type="text" value="" />
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label" for="city">City</label>
                                <select name="city" id="city" class="form-control">
                                    <?php foreach($cities as $c): ?>
                                        <option value="<?= $c['c_name']; ?>"><?= $c['c_name']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button> -->
                <button class="btn btn-primary" onclick="submitForm(document.getElementById('add_address'), this);" type="button">Add address</button>
            </div>
        </div>
    <!-- </div>
</div> -->
</div>