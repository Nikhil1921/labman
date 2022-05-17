<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="pop-menu">
    <div class="owl-carousel owl-slider owl-carousel-area" id="owl-carousel-slider">
        <?php foreach($banners as $banner): ?>
            <div class="item banner">
                <?= img($banner['banner']) ?>
            </div>
        <?php endforeach ?>
    </div>
</div>
<div class="container">
    <div class="search-tabs search-tabs-bg search-tabs-nobox search-tabs-lift-top">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-building-o"></i><span >Upload Prescription</span></a>
                </li>
                <li><a href="#tab-2" data-toggle="tab"><i class="fa fa-phone"></i> <span >Call Back Form</span></a>
                </li>
                <li><a href="#tab-3" data-toggle="tab"><i class="fa fa-home"></i> <span >Institutional</span></a>
                </li>
                <li><a href="#tab-4" data-toggle="tab"><i class="fa fa-flask"></i> <span >Popular Test</span></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab-1">
                    <h2>Upload Prescription</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-daterange">
                                <div class="row">
                                    <div class="col-md-8">
                                        <?= form_open_multipart('upload-prescription', 'id="upload-prescription"'); ?>
                                            <div class="form-group">
                                                <div class="input-group input-file" data-name="prescription">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default btn-choose bg-up-img" type="button">Upload Image</button>
                                                    </span>
                                                    <input type="text" class="form-control" readonly placeholder='Upload Prescription' required />
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-warning" type="submit">Submit</button>
                                                    </span>
                                                </div>
                                            </div>
                                        <?= form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-2">
                    <h2>Call Back Form</h2>
                    <?= form_open('callback', 'class="callback-form"'); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" maxlength="100" type="text" placeholder="Enter Name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input class="form-control" name="email" maxlength="100" type="email" placeholder="Enter email" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile No</label>
                                    <input class="form-control" name="mobile" type="text" placeholder="Enter Mobile No" maxlength="10" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
                <div class="tab-pane fade" id="tab-3">
                    <h2>Institutional Form</h2>
                    <?= form_open('institutional', 'class="institutional-form"'); ?>
                        <div class="row">
                            <div class="col-md-3">
                               <div class="form-group">
                                    <label>Company Name</label>
                                    <input class="form-control" type="text" name="c_name" maxlength="255" placeholder="Enter Company Name" required/>
                                </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" maxlength="100" placeholder="Enter Name" />
                                </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" name="address" maxlength="255" placeholder="Enter address" required/>
                                </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                    <label>Email address</label>
                                    <input class="form-control" type="email" name="email" maxlength="100" placeholder="Enter email" required/>
                                </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" name="mobile" maxlength="10" placeholder="Enter Mobile No" required/>
                                </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                    <label>Total Staff</label>
                                    <input class="form-control" type="text" name="total" maxlength="5" placeholder="Enter Total Staff" required/>
                                </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                    <label>Requirement</label>
                                    <input class="form-control" type="text" name="requirement" maxlength="255" placeholder="Enter Requirement" required>
                                </div>
                           </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
                <div class="tab-pane fade" id="tab-4">
                    <h2>Popular Test</h2>
                    <div class="row">
                        <?php foreach($tests as $po): ?>
                        <div class="col-md-3">
                            <?= anchor('test/'.e_id($po['id']), '<div class="test-box">
                                <p>'.$po['t_name'].'</p><i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </div>'); ?>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gap gap-small"></div>
</div>
<div class="bg-holder packages-section">
    <div class="bg-mask"></div>
    <div class="bg-parallax" style="background-image:url(<?= base_url('assets/images/street_1280x853.jpg') ?>);"></div>
    <div class="bg-content">
        <div class="container">
            <div class="text-center">
                 <h1 class="title-text-white">Packages</h1>
            </div>
            <div class="package-slider">
               <?php foreach($packs as $pack): if($pack['p_type'] !== 'Package') continue; ?>
                <div class="items">
                    <div class="thumb">
                        <header class="thumb-header package-img">
                            <?= anchor('package/'.$pack['id'], img($pack['image']).'<h5 class="hover-title-center">Book Now</h5>','class="hover-img"'); ?>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">
                                <?= anchor('package/'.$pack['id'], $pack['p_name'],'class="text-darken"'); ?>
                            </h4>
                            <p class="mb0 text-darken"> M.R.P : <span class="text-lg lh1em text-color-read"> <i class="fa fa-inr" aria-hidden="true"></i> <?= $pack['mrp']; ?></span><br>Our Price : <span class="text-lg lh1em"> <i class="fa fa-inr" aria-hidden="true"></i> <?= $pack['price']; ?></span><small></small><span class="packages-read"><?= anchor('package/'.$pack['id'], 'Read More'); ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="col-md-12 text-center">
                <?= anchor('packages', 'View All','class="btn btn-primary packages-view-all"'); ?>
            </div>
        </div>
    </div>
</div>
<section class="category">
    <div class="container">
        <div class="text-center">
            <h1 class="title-text">Organs Packages</h1>
        </div>
        <div class="category-slider">
            <?php foreach($packs as $pack): if($pack['p_type'] !== 'Organ') continue; ?>
            <div class="items">
                <?= anchor('package/'.$pack['id'], '<div class="thumb">
                        <div class="category-icon text-center">'.img($pack['image']).'</div>
                        <div class="category-name">
                            <h3>'.$pack['p_name'].'
                        </div>
                    </div>'); ?>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<section class="category">
    <div class="container">
        <div class="text-center">
            <h1 class="title-text">Offers</h1>
        </div>
        <div class="category-slider">
            <?php foreach($packs as $pack): if($pack['p_type'] !== 'Offer') continue; ?>
            <div class="items">
                <?= anchor('package/'.$pack['id'], '<div class="thumb">
                        <div class="category-icon text-center">'.img($pack['image']).'</div>
                        <div class="category-name">
                            <h3>'.$pack['p_name'].'
                        </div>
                    </div>'); ?>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<section class="our-process">
    <?= img("assets/images/our-process.jpg"); ?>
</section>
<section class="lab-partner bg-holder">
    <div class="bg-mask"></div>
    <div class="bg-parallax" style="background-image:url(<?= base_url('assets/images/lab-partners-bg.jpg') ?>);"></div>
    <div class="bg-content">
    <div class="container">
            <div class="gap"></div>
            <div class="text-center">
                 <h1 class="title-text-white">Lab Partners</h1>
            </div>
                <div class="lab-partner-slider">
                    <?php foreach($labs as $lab): ?>
                    <div class="items">
                        <div class="thumb">
                            <header class="thumb-header mb-0">
                                <?= anchor('lab/'.e_id($lab['id']), img($lab['logo']).'<i class="fa fa-plus box-icon-white box-icon-border hover-icon-top-right round"></i>', 'class="hover-img"'); ?>
                            </header>
                            <div class="thumb-caption">
                                <?= anchor('lab/'.e_id($lab['id']), '<h4 class="thumb-title">'.$lab['name'].'</h4>'); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <div class="col-md-12 text-center lab_view_butt">
                    <?= anchor('labs/', 'View All', 'class="btn btn-primary packages-view-all"'); ?>
                </div>
          <div class="gap"></div>
        </div>
    </div>
</section>
<section class="category">
    <div class="container">
        <div class="text-center">
                 <h1 class="title-text">Test Department</h1>
            </div>
        <div class="category-slider">
            <?php foreach($deps as $dep): ?>
            <div class="items">
                <?= anchor('tests/'.e_id($dep['id']), '<div class="thumb">
                        <div class="category-icon text-center">'.img($dep['image']).'</div>
                        <div class="category-name">
                            <h3>'.$dep['d_name'].'</h3>
                        </div>
                    </div>'); ?>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<section class="lab-part-reg-se">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="lab-part-div">
                    <h2>Be a Part of LabMan</h2>
                    <p>Join the LabMan family by becoming our Lab partner. Take part in the revolution to provide affordable health diagnostics.</p>
                    <?= anchor('lab-registration', 'Lab Partner', 'class="lab-part-btn"') ?>
                    <?= anchor('employee-registration', 'Employee Registration', 'class="lab-part-btn"') ?>
                    <?= anchor('franchise-inquiry', 'Franchise Inquiry', 'class="lab-part-btn"') ?>
                </div>
            </div>
        </div>
    </div>
</section>