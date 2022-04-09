<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-xl-4 col-lg-5">
    <div class="news-sidebar pl-10">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h6 class="sidebar-title">My account</h6>
                    <ul class="n-sidebar-categories">
                        <li>
                            <?= anchor('user', '<div class="single-category p-relative mb-10">Orders</div>'); ?>
                        </li>
                        <li>
                            <?= anchor('user/profile', '<div class="single-category p-relative mb-10">Profile</div>'); ?>
                        </li>
                        <li>
                            <?= anchor('user/address', '<div class="single-category p-relative mb-10">My address</div>'); ?>
                        </li>
                        <li>
                            <?= anchor('user/change-password', '<div class="single-category p-relative mb-10">Change password</div>'); ?>
                        </li>
                        <li>
                            <?= anchor('user/logout', '<div class="single-category p-relative mb-10">Logout</div>'); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>