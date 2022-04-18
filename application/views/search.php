<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($tests): ?>
<section class="test">
    <div class="container">
        <div class="text-center">
            <h1 class="title-text">Select Lab</h1>
        </div>
        <div class="row">
            <div class="test-index"> 
            <?php foreach($tests as $test): ?>
            <div class="te-in">
                <?= anchor('test/'.e_id($test['id']), '
                <div class="test-box">
                    <p>
                        '.$test['t_name'].'
                    </p>
                    <i class="fa fa-arrow-right" aria-hidden="true"></i> 
                </div>
                '); ?>
            </div>
            <?php endforeach ?>
        </div>
        </div>
        <div class="row row-wrap">
            <?php foreach($labs as $lab): ?>
                <div class="col-md-4">
                    <?= form_open('add-to-cart', 'class="lab-box-shadow"', ['city' => $this->input->get('city'), 'lab_id' => e_id($lab['lab_id'])]) ?>
                    <?php foreach($this->input->get('tests') as $t) echo form_hidden('tests[]', $t); ?>
                        <div class="lab-img">
                            <?= img($lab['logo']) ?>
                        </div>
                        <div class="lab-box">
                            <h3><?= $lab['name'] ?></h3>
                            <p class="lab-certificate-pd">
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
                            </p>
                            <p class="lab-certificate-pd"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="lab-certificate">Report Time : <?= $lab['re_time']; ?></span></p>
                            <p class="lab-certificate-pd"><i class="fa fa-building" aria-hidden="true"></i><span class="lab-certificate">Location : <?= $this->input->get('city') ?></span></p>
                            <p class="lab-certificate-pd"><i class="fa fa-file-text" aria-hidden="true"></i><span class="lab-certificate">Lab Certification : <?= $lab['certificate']; ?></span></p>
                            <div class="price-box">
                                <div class="mrp">
                                    <p class="lab-total-price">M.R.P : <span class="text-color-read"><i class="fa fa-inr" aria-hidden="true"></i> <?= $lab['mrp']; ?></span></p>
                                </div>
                                <div class="our-price">
                                    <span class="lab-total-price">Our Price : <i class="fa fa-inr" aria-hidden="true"></i> <?= $lab['total']; ?></span>
                                </div>
                            </div>
                            <div class="lab-add-to-cart text-center">
                                <!-- <input type="button" name="" class="lab-add-to-select-btn" value="Selected"> -->
                                <input type="submit" class="lab-add-to-cart-btn" name="redirect" value="Add to Cart" />
                                <input type="submit" class="lab-add-to-cart-btn" name="redirect" value="Book Now" />
                            </div>
                            <!-- <div class="lab-add-to-cart text-center">
                                <?= anchor('checkout', 'Checkout', 'class="lab-add-to-cart-btn"'); ?>
                            </div> -->
                        </div>
                    </form>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<?php else: ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 cart-img">
                    <?= img('assets/images/empty_lab.png') ?>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>