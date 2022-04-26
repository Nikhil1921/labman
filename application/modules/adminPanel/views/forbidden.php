<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="error-wrapper">
    <div class="container">
        <img class="img-100" src="<?= base_url('assets/images/sad.png') ?>" alt="">
        <div class="error-heading">
            <h2 class="headline font-danger">403</h2>
        </div>
        <div class="col-md-8 offset-md-2">
            <p class="sub-content">You are not authorized to view this page. To be authorized contact admin.</p>
        </div>
        <div><a class="btn btn-danger-gradien btn-lg" href="<?= base_url(admin()) ?>">BACK TO HOME PAGE</a></div>
    </div>
</div>