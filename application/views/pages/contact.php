<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <h1 class="page-title">Feedback Form</h1>
</div>
<div class="container">
    <div class="gap"></div>
    <div class="row">
        <div class="col-md-7">
            <?= form_open('', 'class="validate-form"'); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Enter Your Name" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="email" name="email" placeholder="Enter Your Email Id" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" name="message" placeholder="Enter Message"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            <?= form_close(); ?>
        </div>
        <div class="col-md-4">
            <aside class="sidebar-right">
                <ul class="address-list list">
                    <li>
                        <h5>Email</h5><a href="mailto: supprot@labman.co">supprot@labman.co</a>
                    </li>
                    <li>
                        <h5>Phone Number</h5><a href="tel:+91 844 845 5505"> +91 844 845 5505 </a>
                    </li>
                    <li>
                        <h5>Address</h5>
                        <address><a href="javascript:;">1st Floor, Shahibag Shopping Center,<br/>Main Road, Nr.Railway Bridge,<br/>Palanpur - 385001<br/></a></address>
                    </li>
                </ul>
            </aside>
        </div>
    </div>
    <div class="gap"></div>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3641.8345353621417!2d72.42484911430556!3d24.171106778492515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395ce9c0e73721ff%3A0x6cef2dc36b5d25e3!2sLABMAN+DIAGNOSTIC+PRIVATE+LIMITED!5e0!3m2!1sen!2sin!4v1566543014084!5m2!1sen!2sin" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>