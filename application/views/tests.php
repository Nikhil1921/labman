<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if($tests): ?>
<section class="test">
    <div class="container">
        <h1 class="text-center mb20">Tests</h1>
        <div class="test-index">
            <?php foreach($tests as $t): ?>
            <div class="te-in">
                <?= anchor('test/'.e_id($t['id']), '<div class="test-box">
                    <p>'.$t['t_name'].'</p><i class="fa fa-arrow-right" aria-hidden="true"></i>
                </div>'); ?>
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
                <h4>Test available.</h4>
            </div>
        </div>
    </div>
</section>
<?php endif ?>