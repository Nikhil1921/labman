<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="blog-area mt-50 mb-50">
    <div class="container">
        <div class="row">
            <?php $this->load->view('user/sidebar') ?>
            <div class="col-xl-8 col-lg-7">
                <div class="news-detalis-content mb-50">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Products</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($orders): ?>
                            <?php foreach($orders as $k => $v): ?>
                                <tr>
                                    <td><?= ++$k ?></td>
                                    <td>
                                        <?php foreach(json_decode($v['details']) as $prod): ?>
                                            <?= $prod->p_title ?><br>
                                        <?php endforeach ?>
                                    </td>
                                    <td><?= $v['total_amount'] + $v['shipping'] - ($v['total_amount'] * $v['discount'] / 100) ?></td>
                                    <td><?= $v['status'] ?></td>
                                    <td>
                                        <?= anchor('user/order?order='.e_id($v['id']), '<i class="fa fa-eye"></i> View'); ?>
                                        <?php if($v['status'] === 'New Order'): ?>
                                        &nbsp;&nbsp;
                                        <?= form_open('user/cancel', 'id="'.e_id($v['id']).'"', ['id' => e_id($v['id'])]) ?>
                                        <a onclick="cancelOrder('<?= e_id($v['id']) ?>'); return false;" href=""><i class="fa fa-times"></i> Cancel</a>
                                        <?= form_close(); ?>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No orders available.</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>