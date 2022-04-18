<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($pack): ?>
<div class="container">
    <ul class="breadcrumb">
        <li><?= anchor('', 'Home'); ?></li>
        <li><?= anchor('packages', 'Packages'); ?></li>
        <li class="active"><?= $pack['p_name'] ?></li>
    </ul>
    <div class="booking-item-details">
        <header class="booking-item-header">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="lh1em"><?= $pack['p_name'] ?></h2>
                  <p class="package-price">M.R.P : <span class="text-color-read"><i class="fa fa-inr" aria-hidden="true"></i> <?= $pack['mrp'] ?></span></p>&nbsp;&nbsp;&nbsp;
                  <p class="package-price">Our Price : <i class="fa fa-inr" aria-hidden="true"></i> <?= $pack['total'] - $pack['discount'] ?></p>
                </div>
            </div>
        </header>
        <div class="row">
            <div class="col-md-4">
               <?= img($pack['image']) ?>
            </div>
            <div class="col-md-8">
                <div class="booking-item-meta">
                    <h2 class="lh1em">Description</h2>
                    <p><?= $pack['description'] ?></p>
                </div>
                <div class="gap gap-small">
                    <?= form_open('add-to-cart') ?>
                    <?= form_hidden('lab_id', e_id($pack['lab_id'])) ?>
                    <?= form_hidden('pack_id', e_id($pack['id'])) ?>
                    <select name="city" id="city" class="btn btn-primary btn-lg">
                        <?php foreach($this->main->getCities() as $city): ?>
                            <option><?= $city['c_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <input type="submit" value="Book Now" name="redirect" class="btn btn-primary btn-lg" />
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <div class="gap"></div>
        <div class="row">
            <div class="col-md-8">
            <h4 class="text-center">Profile Include (<?= count($pack['tests']) ?>)</h4>
            <h3>Test List</h3>
            <?php foreach ($pack['tests'] as $t): ?>
                <div class="col-md-4">
                <ul class="booking-item-features booking-item-features-expand mb30 clearfix">
                    <li><i class="fa fa-flask" aria-hidden="true"></i></i><span class="booking-item-feature-title"><?= $t['t_name']?></span>
                    </li>
                </ul>
            </div>
            <?php endforeach ?>
            </div>
            <!-- <div class="col-md-4">
                <h4>Top Packages</h4>
                <ul class="booking-list">
                    <li>
                        <div class="booking-item booking-item-small">
                            <div class="row">
                                <a href="packages-detail.php?pp_id=">
                                <div class="col-xs-4">
                                    <img src="admin/images/package/" />
                                </div>
                                <div class="col-xs-5">
                                    <h5 class="booking-item-title"></h5>
                                    <ul class="icon-group booking-item-rating-stars">
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-3"><span class="booking-item-price"><i class="fa fa-inr" aria-hidden="true"></i></span>
                                </div>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div> -->
        </div>
        <div class="gap gap-small"></div>
    </div>
    <div class="gap gap-small"></div>
</div>
<?php else: ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 cart-img">
                    <?= img('assets/images/empty.png') ?>
                    <h4>Package available.</h4>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>