<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h2>Verify OTP</h2>
<form method="POST">
    <div class="form-group">
        <div class="fxt-transformY-50 fxt-transition-delay-1">
            <input type="tel" class="form-control" value="<?= set_value('otp') ?>" name="otp" maxlength="4" placeholder="OTP" required="required">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <?= form_error('otp') ?>
        </div>
    </div>
    <div class="form-group">
        <div class="fxt-transformY-50 fxt-transition-delay-3">
            <div class="fxt-content-between">
                <button type="submit" class="fxt-btn-fill">Verify OTP</button>
            </div>
        </div>
    </div>
</form>