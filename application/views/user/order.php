<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="blog-area mt-50 mb-50">
    <div class="container">
        <div class="row">
            <?php $this->load->view('user/sidebar') ?>
            <div class="col-xl-8 col-lg-7">
                <?php if($order): ?>
                <div class="your-order mb-30 ">
                    <h3>Your order</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th><b>Name</b></th>
                                    <th><?= $order['name'] ?></th>
                                    <th><b>Mobile No.</b></th>
                                    <th><?= $order['mobile'] ?></th>
                                </tr>
                                <tr>
                                    <th><b>Order Date</b></th>
                                    <th><?= date('d-m-Y', strtotime($order['o_date'])) ?></th>
                                    <th><b>Delivery Date</b></th>
                                    <th><?= $order['d_date'] ? date('d-m-Y', strtotime($order['d_date'])) : 'Pending' ?></th>
                                </tr>
                            </thead>
                        <table>
                        <br />
                        <b>Address</b>
                        <p style="white-space: normal;"><?= $order['address'] ?></p>
                        <hr />
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-name">GST</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $t_gst = 0; foreach(json_decode($order['details']) as $prod): ?>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            <?= $prod->p_title ?> <strong class="product-quantity"> × <?= $prod->quantity ?></strong>
                                        </td>
                                        <td class="product-name">
                                            <?php  $slab = explode(', ', $order['o_gst']); foreach($slab as $gst): $pri = round($prod->quantity * $prod->p_price * $prod->gst / (100 + $prod->gst)) ?>
                                            <strong class="product-quantity"><?= $gst ?> - </strong>₹ <?= $pri / count($slab) ?><br />
                                            <?php endforeach; $t_gst += $pri ?>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">₹ <?= $prod->p_price * $prod->quantity ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <?php $dis = 0; if($order['discount']): ?>
                                <tr class="cart-subtotal">
                                    <th>Discount</th>
                                    <td>
                                        <span class="amount">₹ <?= $dis = $order['total_amount'] * $order['discount'] / 100 ?> - <?= $order['coupon'] ?></span>
                                    </td>
                                </tr>
                                <?php endif ?>
                                <tr class="shipping">
                                    <th>Shipping</th>
                                    <td>₹ 0</td>
                                    <td>₹ <?= $order['shipping'] ?></td>
                                </tr>
                                <tr class="order-total">
                                    <th>Order Total</th>
                                    <th>₹ <?= $t_gst ?></th>
                                    <td><strong><span class="amount">₹ <?= $order['total_amount'] - $dis + $order['shipping'] ?></span></strong>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                <div class="your-order mb-30 ">
                    <h3>Your order</h3>
                    Order not available. OR Invalid order.
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>