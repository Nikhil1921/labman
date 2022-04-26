<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-md-3">
    <aside class="user-profile-sidebar">
        <div class="user-profile-avatar text-center">
            <?= img($this->config->item('users').$this->user['image']) ?>
            <h5><?= $this->user['name'] ?></h5>
        </div>
        <ul class="list user-profile-nav">
            <li><?= anchor('user', '<i class="fa fa-home"></i>Dashbord'); ?></li>
            <li><?= anchor('user/profile', '<i class="fa fa-user"></i>Edit Profile'); ?></li>
            <li><?= anchor('user/test-report', '<i class="fa fa-flask"></i>Test Reports'); ?></li>
            <li><?= anchor('user/booking-history', '<i class="fa fa-clock-o"></i>Booking History'); ?></li>
        </ul>
    </aside>
</div>