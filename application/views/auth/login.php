<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2>Log In</h2>
<form method="POST">
    <div class="form-group">
        <div class="fxt-transformY-50 fxt-transition-delay-1">
            <input type="tel" class="form-control" value="<?= set_value('mobile') ?>" name="mobile" maxlength="10" placeholder="Mobile Number" required="required">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <?= form_error('mobile') ?>
        </div>
    </div>
    <div class="form-group">
        <div class="fxt-transformY-50 fxt-transition-delay-3">
            <div class="fxt-content-between">
                <button type="submit" class="fxt-btn-fill">Log in</button>
            </div>
        </div>
    </div>
</form>