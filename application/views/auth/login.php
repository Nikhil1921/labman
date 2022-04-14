<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="global-wrap">
    <div class="full-page registration">
        <div class="bg-holder full">
            <div class="bg-mask"></div>
            <div class="bg-img" style="background-image:url(<?= base_url('assets/images/registration-bg.jpg') ?>);"></div>
            <div class="bg-holder-content full text-white">
                <?= anchor('', img('assets/images/logo.gif'), 'class="logo-holder"'); ?>
                <div class="full-center">
                    <div class="container">
                        <div class="row row-wrap" data-gutter="60">
                            <div class="col-md-4 col-xs-12 col-md-offset-4">
                                <h3 class="mb15">Login</h3>
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group form-group-ghost form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                                <label>User Mobile</label>
                                                <input class="form-control" name="mobile" type="text" placeholder="Enter User Mobile" min="10" max="10" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </div> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>