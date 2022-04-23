<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($cart): ?>
    <section class="add-to-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mc">My Cart</h3>
                <div class="col-md-12 add-to-cart-list">
                    <div class="add-to-cart-top">
                        <div class="add-to-cart-top-left">
                            <span><?= $cart->lab_name ?></span>
                        </div>
                        <div class="add-to-cart-top-right">
                            <?= form_open('clear-cart') ?>
                                <button class="add-to-cart-close" name="del_lab"><i class="fa fa-times"></i></button>
                            <?= form_close() ?>
                        </div>
                    </div>
                    <div class="add-to-cart-test-list">
                        <p ><a class="test-list-a" data-toggle="collapse" href="#test-lists">Tests List <i style="float: right;" class="fa fa-arrow-down"></i></a></p>
                        <div class="test-list-lab panel-collapse collapse" id="test-lists">
                            <?php $total = $mrp = 0; foreach ($tests as $test): $total += $test->total; $mrp += $test->ltl_mrp; ?>
                            <p><?= $test->t_name ?></p>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="price-details">
                    <h3>Price Details</h3>
                </div>
                <div class="col-md-12 add-to-cart-list">
                    <div class="add-to-cart-top">
                        <span class="total-title"><?= $cart->pack_id > 0 ? 'Package' : 'Test' ?> M.R.P</span>
                        <span class="total-price">
                         <i class="fa fa-rupee"></i><?= $mrp ?>
                        </span>
                    </div>
                </div>
                <div class="col-md-12 add-to-cart-list">
                    <div class="add-to-cart-top">
                        <span class="total-title">Collection Charge</span>
                        <span class="total-price">
                            <i class="fa fa-rupee"></i> <?= $cart->home_visit; ?>
                        </span>
                    </div>
                </div>
                <div class="col-md-12 add-to-cart-list">
                    <div class="add-to-cart-top">
                        <span class="total-title">Total Amount</span>
                        <span class="total-price">
                            <i class="fa fa-rupee"></i> <?= $mrp + $cart->home_visit; ?>
                        </span>
                    </div>
                </div>
                <div class="col-md-12 add-to-cart-list dis">
                    <div class="add-to-cart-top">
                        <span class="total-title">Discount</span>
                        <?php $total = $total - $cart->discount ?>
                        <span class="total-price">
                            <i class="fa fa-rupee"></i> <?= $total >= $cart->fix_price ? $mrp - $total + $cart->home_visit : $mrp - $total; ?>
                        </span>
                    </div>
                </div>
                <div class="col-md-12 add-to-cart-list ap">
                    <div class="add-to-cart-top">
                        <span class="total-title">Amount Payable</span>
                        <span class="total-price">
                            <i class="fa fa-rupee"></i> <?= $total >= $cart->fix_price ? $total : $total + $cart->home_visit ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?= form_open('add-order', 'class="checkout-form" onsubmit="return false;"'); ?>
                    <div class="col-md-12">
                        <h3>COLLECTION DETAILS</h3>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Select Family member</label>
                        <select name="family" class="form-control">
                            <option value="0"><?= $this->user['name'] ?></option>
                            <?php foreach($family as $f): ?>
                                <option value="<?= e_id($f['id']) ?>"><?= $f['name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Add Family Member</label>
                        <input type="button" class="book-now-btn" value="Add Now" data-target="#add-member" data-toggle="modal">
                    </div>
                    <div class="form-group col-md-10">
                        <label>Address</label>
                        <select name="address" class="form-control">
                            <option value="">Select address</option>
                            <?php foreach($address as $add): ?>
                                <option value="<?= e_id($add['id']) ?>"><?= $add['ad_location']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Add new </label>
                        <input type="button" class="book-now-btn" data-toggle="modal" value="Add Now" data-target="#add-address" data-toggle="modal" />
                    </div>
                    <div class="form-group form-group-filled col-md-6">
                        <label>Collection Date</label>
                        <input type="text" name="collection_date" class="date-pick form-control" placeholder="Select Date" required>
                    </div>
                    <div class="form-group form-group-filled col-md-6">
                        <label>Collection Time</label>
                        <input type="text" name="collection_time" class="time-pick form-control" placeholder="Select Time">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Refer by Doctor (Optional)</label>
                         <input type="text" name="ref_doctor" maxlength="100" class="form-control" placeholder="Refer by Doctor">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Doctor Remarks (Optional)</label>
                        <textarea class="form-control" maxlength="255" name="remarks"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="checkbox" name="hardcopy" />Hard Copy Charges <?= $cart->hard_copy ?>.
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Payment Method</label>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="pay_method" value="Cash" checked />Cash
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="pay_method" value="Online" />Online
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="submit" class="book-now-btn" value="Book Now">
                    </div>    
                <?= form_close(); ?>
            </div> 
        </div>
    </div>
</section>
<div class="modal fade" id="add-address" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Address</h4>
            </div>
            <?= form_open('add-address', 'class="address-form" onsubmit="return false;"'); ?>
                <div class="modal-body row">
                    <div class="form-group col-md-12">
                        <label>Full Address (With landmark)</label>
                        <input type="text" name="faddress" maxlength="255" class="form-control" placeholder="Address" required>    
                    </div>
                    <div class="form-group col-md-12 location">
                        <label>Location</label>
                        <input type="text" name="address" maxlength="255" class="form-control geocomplete" placeholder="Enter Location" id="address" required />
                        <fieldset class="details" style="display: none;">
                            <input name="lat" type="text" value="" />
                            <input name="lng" type="text" value="" />
                        </fieldset>
                    </div>
                    <div class="form-group col-md-12 location">
                        <label>City</label>
                        <input type="text" name="city" value="<?= $cart->c_name ?>" maxlength="100" class="form-control" readonly required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="add-member" role="dialog">
    <div class="modal-dialog">
        <?= form_open('add-member', 'class="member-form" onsubmit="return false;"'); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Family Member</h4>
                </div>
                <div class="modal-body row">
                    <div class="form-group col-md-6">
                        <label>Member Relations</label>
                        <input type="text" name="relation" maxlength="20" class="form-control" placeholder="Enter Member Relations" required>    
                    </div>
                    <div class="form-group col-md-6">
                        <label>Member Name</label>
                        <input type="text" name="name" maxlength="100" class="form-control" placeholder="Enter Member Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Member Email</label>
                        <input type="email" name="email" maxlength="100" class="form-control" placeholder="Enter Member Email" required>    
                    </div>
                    <div class="form-group col-md-6">
                        <label>Member Mobile Number</label>
                        <input type="text" name="mobile" maxlength="10" class="form-control" placeholder="Enter Member Mobile Number" required>    
                    </div>
                    <div class="form-group col-md-6">
                        <label>Member DOB</label>
                        <input type="text" name="dob" class="date-pick form-control" placeholder="Select Date" required /> 
                    </div>
                    <div class="form-group col-md-6">
                        <label>Member Gender</label>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="gender" value="Male" checked required />Male
                            </label>
                        </div>
                        <div class="radio-inline radio-small">
                            <label>
                                <input class="i-radio" type="radio" name="gender" value="Female" required/>Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>
<?php else: ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 cart-img">
                <?= img('assets/images/empty.png') ?>
                <h4>Item available in cart.</h4>
            </div>
        </div>
    </div>
</section>
<?php endif ?>