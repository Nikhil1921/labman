<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title><?= "$title | " . APP_NAME ?></title>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?= link_tag('assets/images/favicon.png', 'icon', 'image/x-icon') ?>
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
      <?= link_tag('assets/css/bootstrap.css') ?>
      <?= link_tag('assets/css/font-awesome.css') ?>
      <?= link_tag('assets/css/login.css?v=1.0.2') ?>
   </head>
   <body>
        <section class="fxt-template-animation fxt-template-layout15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12 fxt-bg-img">
                        <div class="left_img">
                            <?= img('assets/images/login1.png') ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 fxt-bg-color">
                        <div class="fxt-content">
                            <div class="fxt-header">
                                <?= anchor('', img('assets/images/logo.gif'), 'class="fxt-logo"') ?>
                            </div>
                            <div class="fxt-form">
                                <?= $contents; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class='toast' style='display:none'></div>
        <input type="hidden" name="base_url" value="<?= base_url(); ?>" />
        <input type="hidden" name="error" value="<?= $this->session->error ?>" />
        <input type="hidden" name="success" value="<?= $this->session->success ?>" />
        <script src="<?= base_url('assets/js/jquery.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>
        <script src="<?= base_url('assets/js/imagesloaded.pkgd.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/login.js?v='.time()) ?>"></script>
    </body>
</html>