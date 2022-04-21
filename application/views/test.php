<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="test-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 test-content">
                <h2><?= $data['t_name']; ?></h2>
                <div class="content-detail">
                    <?= $data['details']; ?>
                    <ul class="test-ul mb10 clearfix">
                        <li>
                            <div class="left-content">
                            <i class="fa fa-flask" aria-hidden="true"></i><span>Sample Type</span>
                            </div>
                            <div class="right-content">
                                <p> : <?= $data['s_name']; ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="left-content">
                            <i class="fa fa-clock-o" aria-hidden="true"></i><span>Report Delivery </span>
                            </div>
                            <div class="right-content">
                                <p> : <?= $data['re_time']; ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>