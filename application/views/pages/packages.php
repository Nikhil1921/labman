<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($packs): ?>
<div class="bg-holder packages-section">
    <div class="bg-content">
        <div class="container">
            <div class="text-center">
                 <h1 class="title-text">Package List</h1>
            </div>
            <div class="row row-wrap">
                <?php foreach($packs as $pack): if($pack['p_type'] !== 'Package') continue; ?>
                <div class="col-md-3">
                    <div class="thumb">
                        <header class="thumb-header">
                            <?= anchor('package/'.$pack['id'], img($pack['image'], '', 'height="200"').'<h5 class="hover-title-center">Book Now</h5>','class="hover-img"'); ?>
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
        </div>
    </div>
</div>
<?php else: ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 cart-img">
                <?= img('assets/images/empty.png') ?>
                <h4>Package available at this moment.</h4>
            </div>
        </div>
    </div>
</section>
<?php endif ?>