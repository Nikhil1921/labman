<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title><?= "$title | " . APP_NAME ?></title>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?= link_tag('assets/images/favicon.png', 'icon', 'image/x-icon') ?>
      <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
      <?= link_tag('assets/css/bootstrap.css') ?>
      <?= link_tag('assets/css/font-awesome.css') ?>
      <?= link_tag('assets/css/icomoon.css') ?>
      <?= link_tag('assets/css/styles.css') ?>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
      <?php if(in_array($name, ['login'])): ?>
         <?= link_tag('assets/css/switcher.css" ') ?>
      <?php endif ?>
   </head>
   <body>
      <div class="global-wrap">
         <header id="main-header">
            <div class="header-top">
               <div class="container-fluid">
                     <div class="row">
                        <div class="col-md-2">
                           <?= anchor('', img("assets/images/logo.png"), 'class="logo"'); ?>
                        </div>
                        <div class="col-md-6 m-my">
                           <div class="row-100 overflow-hidden">
                              <?= form_open('search', 'method="get"') ?>
                                 <div class="city-select-top">
                                    <select class="select2-icon form-control main-search" name="city">
                                       <?php foreach($this->main->getCities() as $k => $city):
                                       if(!$this->session->city && $k === 0) $this->session->set_userdata('city', $city['c_name']);
                                       if($this->input->get('city')) $this->session->set_userdata('city', $this->input->get('city'));
                                       ?>
                                          <option data-icon="fa fa-map-marker" <?= $this->session->city === $city['c_name'] ? 'selected' : '' ?>><?= $city['c_name'] ?></option>
                                       <?php endforeach ?>
                                    </select>
                                 </div>
                                 <div class="main-search">
                                    <select class="js-example-placeholder-multiple main-search" name="tests[]" multiple="multiple" id="tests-list"></select>
                                 </div>
                                 <div class="serch-lab">
                                    <button class="test-search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>                                           
                                 </div>                                   
                              </form>
                        </div>   
                     </div>
                     <div class="col-md-4 p-l-0 m-top">
                        <div class="top-user-area clearfix">
                           <h4 class="customer-care-no">
                              <?= img("assets/images/headset.png"); ?>844 845 5505 <span>Book Test - Help - Support</span>
                           </h4>
                           <ul class="top-user-area-list list list-horizontal list-border">
                           <?php if($this->session->userId): ?>
                              <li class="top-user-area-avatar">
                                 <?= anchor('user', img($this->config->item('users').$this->user['image']).$this->user['name']); ?>
                                 <ul class="list logout">
                                       <li>
                                          <?= anchor('user/profile', 'My Profile'); ?>
                                       </li>
                                       <li>
                                          <?= anchor('user', 'My Order'); ?>
                                       </li>
                                       <li>
                                          <?= anchor('user/test-report', 'Test Reports'); ?>
                                       </li>
                                       <li>
                                          <?= anchor('logout', 'Sign Out'); ?>
                                       </li>
                                 </ul>
                              </li>
                           <?php else: ?>
                              <li>
                                 <?= anchor('login', 'Login'); ?>
                              </li>
                           <?php endif ?>
                              <li>
                                 <?= anchor('cart', '<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="add-to-cart-counter">'.$this->main->cart_count().'</span>', 'class="add-to-cart-icon"'); ?>
                              </li>
                           </ul>
                        </div>
                        <div class="side-bar-open">
                           <?= img('assets/images/clicking.png') ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                        <div class="bottom-nav-div">
                           <div class="col-md-12 p-0">
                           <nav class="navbar my-navbar">
                              <div class="navbar-header">
                                 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#example-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                 </button>
                              </div>
                              <div class="collapse navbar-collapse p-0" id="example-1">
                                 <ul class="nav navbar-nav">
                                    <li class="active"><?= anchor('', 'Home'); ?></li>
                                    <li><?= anchor('about', 'About Us'); ?></li>
                                    <li><?= anchor('how-to-work', 'How to Work'); ?></li>
                                    <li><?= anchor('packages', 'Test Packages'); ?></li>
                                    <li><?= anchor('labs', 'Lab Partners'); ?></li>
                                    <li><?= anchor('career', 'Career'); ?></li>
                                    <li class="sub-drop"><a href="javascript:;">Contact Us<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                       <ul class="sub-menu">
                                          <li><?= anchor('contact', 'Contact Us'); ?></li>
                                          <li><?= anchor('corporate', 'Corporate Information'); ?></li>
                                          <li><?= anchor('institute', 'Institutional Inquiry'); ?></li>
                                          <li><?= anchor('franchise-inquiry', 'Become Franchise'); ?></li>
                                          <li><?= anchor('lab-registration', 'Become Lab Partner'); ?></li>
                                       </ul> 
                                    </li>
                                    <li class="sub-drop"><a href="javascript:;" class="last">More<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                       <ul class="sub-menu">
                                          <li><?= anchor('faq', 'FAQs'); ?></li>
                                          <li><?= anchor('gallery', 'Gallery'); ?></li>
                                          <li><?= anchor('lab-partner/login', 'Lab login'); ?></li>
                                       </ul>
                                    </li>
                                 </ul>
                              </div>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="right-side-bar">
            <div class="side-header">
               <div class="side-logo text-center">
                  <?= img('assets/images/logo.gif'); ?>
               </div>
               <p class="side-text">A leader in diagnostic tests and procedures, health check ups and counseling services.</p>
               <div class="side-menu-close">
                  <?= img('assets/images/clicking1.png'); ?>
               </div>
            </div>
            <div class="side-body">
               <div class="side-play-store-div">
                     <h2>Download Our App</h2>
                     <a href="https://play.google.com/store/apps/details?id=com.densetek.labmen&hl=en" target="_blank"><?= img('assets/images/play-store.png') ?></a>
               </div>
               <div class="side-qr-code-div">
                     <h2>Scan QR Code. Get App</h2>
                     <?= img('assets/images/qr-code.png') ?>
               </div>
            </div>
            <div class="side-footer">
               <h2>Get In Touch</h2>
               <p class="side-text">You can reach us by using the information provided on this page</p>
               <div class="contacts-item">
                     <div class="contacts-icon">
                        <?= img('assets/images/contact4.png') ?>
                     </div>
                     <div class="content">
                        <a href="#" class="title">844 845 5505</a>
                        <p class="sub-title">Call us for support</p>
                     </div>
               </div>
               <div class="contacts-item">
                     <div class="contacts-icon">
                        <?= img('assets/images/contact5.png') ?>
                     </div>
                     <div class="content">
                        <a href="#" class="title">support@labman.co</a>
                        <p class="sub-title">online support</p>
                     </div>
               </div>
               <div class="contacts-item">
                  <div class="contacts-icon">
                     <?= img('assets/images/contact6.png') ?>
                  </div>
                  <div class="content">
                     <a href="javascript:;" class="title">1st Floor Shahibag Shopping Center Main Road, Nr Railway Bridge, Palanpur-385001</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <?= $contents; ?>

      
         <footer id="main-footer" class="remove-footer">
         <div class="container">
            <div class="row row-wrap">
               <div class="col-md-4">
                  <?= anchor('', img("assets/images/logo.png"), 'class="footer-logo"'); ?>
                  <p class="f16">" We are dignostic proffessional committed to deliver best quality service in human healthcare."</p>
               </div>
               <div class="col-md-4 help-num">
                  <div class="f-icon">
                     <div><?= img("assets/images/mail.png") ?></div>
                     <div>
                        <p>Have Questions? Write Us :</p>
                        <h4><a href="javascript:;" class="text-color eml">support@labman.co</a></h4>
                     </div>
                  </div>
                  <div class="f-icon">
                     <div><?= img("assets/images/headset-green.png") ?></div>
                     <div>
                        <p>24/7 Dedicated Customer Support</p>
                        <h4 class="text-color num">844 845 5505 </h4>
                     </div>
                  </div>
               </div>
               <div class="col-md-4 reg-address help-num">
                  <div class="f-icon add-mr">
                     <div><?= img("assets/images/loction.png") ?></div>
                     <div>
                        <p class="pad-0">Registered Office :</p>
                        <p class="font-green"><span>Labman Diagnostic Private Limited </span>1st Floor Shahibag Shopping Center Main Road, Nr Railway Bridge, Palanpur-385001</p></div>
                     </div>
                  <div class="f-icon">
                     <div><?= img("assets/images/phone.png") ?></div>
                     <div><p class="font-green"><span class="color-white f17">Landline : </span>02742 255505</p></div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <ul class="list list-horizontal list-space text-center mb-10">
                     <li>
                        <a class="fa fa-facebook box-icon-normal round animate-icon-bottom-to-top" href="https://www.facebook.com" target="_blank"></a>
                     </li>
                     <li>
                        <a class="fa fa-twitter box-icon-normal round animate-icon-bottom-to-top" href="https://www.twitter.com" target="_blank"></a>
                     </li>
                     <li>
                        <a class="fa fa-instagram box-icon-normal round animate-icon-bottom-to-top" href="https://www.instagram.com" target="_blank"></a>
                     </li>
                  </ul>
                  <ul class="list list-footer-new text-center">
                     <li>
                        <?= anchor('', 'Home'); ?>
                     </li>
                     <li>
                        <?= anchor('about', 'About US'); ?>
                     </li>
                     <li>
                        <?= anchor('contact', 'Contact Us'); ?>
                     </li>
                     <li>
                        <?= anchor('faq', 'FAQs'); ?>
                     </li>
                     <li>
                        <?= anchor('refund', 'Refund & Cancellation Policy'); ?>
                     </li>
                     <li>
                        <?= anchor('terms-condition', 'Term & Conditions'); ?>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="call-back" data-toggle="tooltip" title="Call Back Now!" data-placement="top">
            <?= img("assets/images/call-back.png") ?>
         </div>
      </footer>
      <div class="footer-bottom">
         <div class="container">
            <p>All Right Reserved & Copyright @ 2020 by Labman Diagnostic Private Limited</p>
         </div>
      </div>

      <div class='toast' style='display:none'></div>
      <input type="hidden" name="base_url" value="<?= base_url(); ?>" />
      <input type="hidden" name="is_login" value="<?= $this->session->userId ? TRUE : FALSE ?>" />
      <input type="hidden" name="error" value="<?= $this->session->error ?>" />
      <input type="hidden" name="success" value="<?= $this->session->success ?>" />
      
      <script src="<?= base_url('assets/js/jquery.js') ?>"></script>
      <script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>
      <script src="<?= base_url('assets/js/select2.min.js') ?>"></script>
      <script src="<?= base_url('assets/js/nicescroll.js') ?>"></script>
      
      <?php if(in_array($name, ['home', 'gallery', 'lab'])): ?>
         <script src="<?= base_url('assets/js/owl-carousel.js') ?>"></script>
      <?php endif ?>
      <?php if(in_array($name, ['lab_registration', 'cart', 'employee_registration'])): ?>
         <script src="<?= base_url('assets/js/icheck.js') ?>"></script>
      <?php endif ?>
      <?php if(in_array($name, ['gallery', 'lab'])): ?>
         <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
      <?php endif ?>
      <?php if(in_array($name, ['home', 'login', 'contact', 'institute', 'franchise_inquiry', 'cart', 'employee_registration'])): ?>
         <input type="hidden" name="form_validate" value="true" />
         <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
      <?php endif ?>
      <?php if(in_array($name, ['login'])): ?>
         <script src="<?= base_url('assets/js/switcher.js') ?>"></script>
      <?php endif ?>
      <?php if(in_array($name, ['cart'])): ?>
         <script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiWWB6yJd6ilpII5N89O-vXAo2eXiVD9g&libraries=places"></script>
         <script src="<?= base_url('assets/js/jquery.geocomplete.js') ?>"></script>
      <?php endif ?>
      <?php if(in_array($name, ['cart', 'employee_registration'])): ?>
         <script src="<?= base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
         <script src="<?= base_url('assets/js/bootstrap-timepicker.js') ?>"></script>
      <?php endif ?>
      <?php if(in_array($name, ['cart'])): ?>
         <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
      <?php endif ?>
      <?php if(in_array($name, ['test_report', 'dashboard', 'booking_history'])): ?>
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
         <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
         <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
      <?php endif ?>
      <script src="<?= base_url('assets/js/custom.js?v='.time()) ?>"></script>
      <script>
         let tagArr = document.getElementsByTagName("input");
         for (let i = 0; i < tagArr.length; i++) {
            tagArr[i].autocomplete = 'off';
         }
      </script>
   </body>
</html>