<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($labs): ?>
    <div class="bg-holder packages-section">
        <div class="bg-content">
            <div class="container">
                <div class="text-center">
                     <h1 class="title-text">Lab List</h1>
                </div>
                <div class="row row-wrap">
                    <?php foreach($labs as $lab): ?>
                    <div class="col-md-3 lab_page_vew">
                        <div class="thumb">
                            <header class="thumb-header">
                                <?= anchor('lab/'.e_id($lab['id']), img($lab['logo'], '', 'height="200"'), 'class="hover-img"'); ?>
                            </header>
                            <div class="thumb-caption">
                                <?= anchor('lab/'.e_id($lab['id']), '<h4 class="thumb-title">'.$lab['name'].'</h4>'); ?>
                                <?= anchor('lab/'.e_id($lab['id']), 'Read More'); ?>
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
                <h4>Lab available at this moment.</h4>
            </div>
        </div>
    </div>
</section>
<?php endif ?>