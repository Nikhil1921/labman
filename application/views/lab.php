<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if(isset($lab['name'])): ?>
<div class="container">
    <ul class="breadcrumb">
        <li><?= anchor('', 'Home'); ?></li>
        <li><?= anchor('labs', 'Lab'); ?></li>
        <li class="active"><?= $lab['name']; ?></li>
    </ul>
    <div class="booking-item-details">
        <header class="booking-item-header">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="lh1em"><?= $lab['name']; ?></h2>
                </div>
            </div>
        </header>
        <div class="row">
            <div class="col-md-12">
                <div class="booking-item-meta lab-list-des">
                    <h2 class="lh1em">Description</h2>
                    <?= $lab['details']; ?>
                </div>
            </div>
        </div>
        <div class="gap"></div>
        <?php if($lab['gallery']): ?>
        <section class="lab-gallery">
            <div class="container">
                <h4 class="text-center">Lab Gallery Images</h4>
                <div class="category-slider">
                <?php foreach($lab['gallery'] as $gal): ?>
                <div class="items">
                    <div class="thumb">
                        <div class="gallery-images text-center">
                            <figure class="image-box">
                                <a href="<?= base_url($gal['image']) ?>" data-fancybox="images">
                                    <?= img($gal['image']) ?>
                                </a>
                            </figure>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
                </div>
            </div>
        </section>
        <?php endif ?>
        <?php if($lab['doctors']): ?>
        <div class="row">
            <div class="col-md-12 doctor-list">
                <h4 class="text-center">Lab Doctor List</h4>
                <?php foreach($lab['doctors'] as $doc): ?>
                <div class="col-md-3">
                    <div class="user-profile-sidebar-1">
                        <div class="user-profile-avatar text-center">
                            <?= img($doc['image']) ?>
                            <h5><?= $doc['name']; ?></h5>
                            <p><?= $doc['quilification']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <?php endif ?>
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
                    <h4>Lab available.</h4>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>