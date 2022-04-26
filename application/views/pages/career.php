<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($openings): ?>
    <section class="about-section">
        <div class="container">
            <div class="row about-content">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="job-listing-header-title">Current Openings: (<?= $row; ?>)</h3>
                    </div>
                    <?php foreach($openings as $opening): ?>
                    <div class="col-md-6 col-sm-6 col-xs-12 read_more">
                        <article class="contentBox">
                            <header class="content-header">
                                <h3 class="entry-title1"><a><?= $data['v_post_name']; ?></h3>
                            </header>
                            <div class="slide-content1">
                            <div class="slide-meta">
                            <span class="job-meta slide-meta-exp">
                            <i class="fa fa-user"></i>&nbsp;<?= $data['v_post_name']; ?></span>
                            <span class="job-meta slide-meta-exp">
                            <i class="fa fa-briefcase"></i>&nbsp;<?= $data['v_position']; ?></span>
                            <span class="job-meta slide-meta-sal">
                                <i class="fa fa-history"></i>&nbsp;<?= $data['v_experience']; ?></span>
                                <span class="job-meta slide-meta-sal">
                                <i class="fa fa-graduation-cap"></i>&nbsp;<?= $data['v_qualification']; ?></span>
                                <span class="job-meta slide-meta-loc">
                                <i class="fa fa-map-marker"></i>&nbsp;<?= $data['v_detail']; ?></span>
                            </div>
                            <div class="slide-entry-excerpt entry-content">
                                <div class="read-more-link text-right">
                                <a target="_blank" href="employee-registration.php" class="read-btn">Apply Here</a>
                                </div>
                            </div>
                            </div>
                            <footer class="entry-footer"><div class="slide-meta-date"></div></footer>
                        </article>
                    </div>
                    <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 cart-img">
                <?= img('assets/images/empty.png') ?>
                <h4>Opening available at this moment.</h4>
            </div>
        </div>
    </div>
</section>
<?php endif ?>