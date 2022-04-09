<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="error-area pt-80 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-info text-center">
                    <div class="error-image text-center mb-50">
                        <?= img("assets/images/404.png") ?>
                    </div>
                    <div class="error-content">
                        <h5>Page Not Found</h5>
                        <p>Sorry, the page you've requested is not available. Please try searching for something else or return to Homepage.</p>
                        <div class="error-button">
                            <?= anchor('', 'Return to Homepage', 'class="error-btn"') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>