<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($gallery): ?>
<section class="lab-gallery">
    <div class="container">
        <h4 class="text-center">Gallery Images</h4>
        <div class="category-slider">
            <?php foreach($gallery as $g): ?>
            <div class="items">
                <div class="thumb">
                    <div class="gallery-images text-center">
                        <figure class="image-box">
                            <a href="<?= $g['image'] ?>" data-fancybox="images">
                                <?= img($g['image']); ?>
                            </a>
                        </figure>
                    </div>
                </div>
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
                <?= img('assets/images/empty.png') ?>
                <h4>Gallery available at this moment.</h4>
            </div>
        </div>
    </div>
</section>
<?php endif ?>