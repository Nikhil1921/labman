<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-6">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="invoice">
        <div id="print-div">
            <div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="media">
                            <div class="media-left">
                                <?= img('assets/images/invoice-logo.png', '', 'class="media-object img-60 mt-2"'); ?>
                            </div>
                            <div class="media-body m-l-20">
                                <h4 class="media-heading"><?= APP_NAME ?></h4>
                                <p><?= $this->config->item('email') ?><br><span class="digits">+91 <?= $this->config->item('mobile') ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-md-right">
                            <h3>Invoice #<span class="digits counter">
                                <?php for ($i=strlen($order['id']); $i < 4; $i++) { 
                                    echo 0;
                                } ?><?= $order['id']; ?></span></h3>
                            <p>Order Date: <?= date('d-m-Y', strtotime($order['o_date'])) ?><br>
                            Delivery Date: <?= $order['d_date'] ? date('d-m-Y', strtotime($order['d_date'])) : 'Pending' ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="media">
                        <div class="media-body m-l-20">
                            <h4 class="media-heading"><?= $order['name'] ?></h4>
                            <p><span class="digits"><?= $order['mobile'] ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="table-responsive invoice-table" id="table">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>
                                    <h6 class="p-2 mb-0">Product</h6>
                                </td>
                                <td>
                                    <h6 class="p-2 mb-0">GST</h6>
                                </td>
                                <td>
                                    <h6 class="p-2 mb-0">Sub total</h6>
                                </td>
                            </tr>
                            <?php $t_gst = 0; foreach(json_decode($order['details']) as $prod): ?>
                                <tr>
                                    <td>
                                        <?= $prod->p_title ?> <strong> × <?= $prod->quantity ?></strong>
                                    </td>
                                    <td>
                                        <?php  $slab = explode(', ', $order['o_gst']); foreach($slab as $gst): $pri = round($prod->quantity * $prod->p_price * $prod->gst / (100 + $prod->gst)) ?>
                                        <strong><?= $gst ?> - </strong>₹ <?= $pri / count($slab) ?><br />
                                        <?php endforeach; $t_gst += $pri ?>
                                    </td>
                                    <td>
                                        ₹ <?= $prod->p_price * $prod->quantity ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <?php $dis = 0; if($order['discount']): ?>
                            <tr class="cart-subtotal">
                                <th>Discount</th>
                                <td>
                                    <span class="amount">₹ <?= $dis = $order['total_amount'] * $order['discount'] / 100 ?> - <?= $order['coupon'] ?></span>
                                </td>
                            </tr>
                            <?php endif ?>
                            <tr>
                                <th>Shipping</th>
                                <td>₹ 0</td>
                                <td>₹ <?= $order['shipping'] ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="Rate">
                                    <h6 class="mb-0 p-2">Total</h6>
                                </td>
                                <td class="payment digits">
                                    <h6 class="mb-0 p-2">₹ <?= $order['total_amount'] - $dis + $order['shipping'] ?></h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div>
                        <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please process this invoice within that time. There will be a 5% interest charge per month on late invoices.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 text-center mt-3">
            <button class="btn btn btn-outline-primary mr-2" type="button" onclick="printDiv()">Print</button>
            <?= anchor($url, 'Cancel', 'class="btn btn-outline-secondary"'); ?>
        </div>
    </div>
</div>
<script>
    "use strict";
    function printDiv() {
        let print = document.getElementById('print-div').innerHTML;
        let original = document.body.innerHTML;
        document.body.innerHTML = print;
        window.print();
        document.body.innerHTML = original;
    }
</script>