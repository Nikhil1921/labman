<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="blog-area mt-50 mb-50">
    <div class="container">
        <div class="row">
            <?php $this->load->view('user/sidebar') ?>
            <div class="col-xl-8 col-lg-7">
                <div class="news-detalis-content mb-50">
                    <?= anchor('user/addAddress', 'Add new', 'class="cart-btn-2 w-50 mb-20"'); ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SR </th>
                                <th>Address</th>
                                <th>Pincode</th>
                                <th>Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($address): ?>
                            <?php foreach($address as $k => $v): ?>
                                <tr>
                                    <td><?= ++$k ?></td>
                                    <td><?= $v['address'] ?></td>
                                    <td><?= $v['pincode'] ?></td>
                                    <td>
                                        <?= anchor('user/updateAddress/'.e_id($v['id']), '<i class="fa fa-pencil"></i>'); ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No address available.</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>