<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2>Register</h2>
<form method="POST">
    <div class="form-group">
        <div class="fxt-transformY-50 fxt-transition-delay-1">
            <input type="text" class="form-control" value="<?= set_value('name') ?>" name="name" maxlength="100" placeholder="Your full name" required="required">
            <i class="fa fa-user" aria-hidden="true"></i>
            <?= form_error('name') ?>
        </div>
    </div>
    <div class="form-group">
        <div class="fxt-transformY-50 fxt-transition-delay-1">
            <input type="email" class="form-control" value="<?= set_value('email') ?>" name="email" maxlength="100" placeholder="Your email" required="required">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <?= form_error('email') ?>
        </div>
    </div>
    <div class="form-group">
        <div class="fxt-transformY-50 fxt-transition-delay-1">
            <input type="date" class="form-control" max='<?= date('Y-m-d') ?>' min="<?= date('Y-m-d', strtotime('-90 years')) ?>" value="<?= set_value('dob') ?>" name="dob" placeholder="Your dob" required="required">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <?= form_error('dob') ?>
        </div>
    </div>
    <div class="form-group">
        <div class="fxt-transformY-50 fxt-transition-delay-1">
            <select name="gender" id="gender" class="form-control" required="required">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <i class="fa fa-user" aria-hidden="true"></i>
            <?= form_error('gender') ?>
        </div>
    </div>
    <div class="form-group">
        <div class="fxt-transformY-50 fxt-transition-delay-3">
            <div class="fxt-content-between">
                <button type="submit" class="fxt-btn-fill">Register</button>
            </div>
        </div>
    </div>
</form>