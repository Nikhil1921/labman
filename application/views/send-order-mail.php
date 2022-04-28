<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="page-wrap">
        <p id="header">INVOICE</p>
        <div id="identity">
            <div id="address">
                <p class="mr-b-p">Labman Diagnostic Private Limited,
                    1st Floor Shahibag Shopping Center Main Road, Nr Railway Bridge, Palanpur-385001
                </p>
            </div>
            <div id="logo">
              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value=""/><br/>
              </div>
                <?= img('assets/images/logo.png', '', 'class="im" id="image"') ?>
            </div>
        </div>
        <div style="clear:both"></div>
        <div id="customer">
           <table id="meta" class="mr-r">
                <tr>
                    <td class="meta-head">Name</td>
                    <td><?= $user['name'] ?></td>
                    <td class="meta-head">Mobile No</td>
                    <td><?= $user['mobile'] ?></td>
                </tr>
                <tr>
                    <td class="meta-head">Invoice No.</td>
                    <td><?= $order['or_id'] ?></td>
                    <td class="meta-head">Date</td>
                    <td><?= date('d-m-Y') ?></td>
                </tr>
            </table>
        </div>
        <table id="items">
            <tr>
              <th>Test Name</th>
              <th>Our Price</th>
            </tr>
                <?php $total = $mrp = 0; foreach($cart['tests'] as $test): $total += $test->total; $mrp += $test->ltl_mrp; ?>
                    <tr>
                        <td><?= $test->t_name ?></td>
                        <td class="total-value">
                            Rs. <?= $test->total ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="1"  class="total-line">Total M.R.P</td>
                    <td class="total-value">
                        <div id="subtotal">
                            Rs. <?= $mrp ?>
                        </div>
                    </td>
                </tr>
            <tr>
              <td colspan="1"  class="total-line balance">Hard Copy Charge</td>
              <td class="total-value balance">
                <div class="due">Rs. <?= $order['hardcopy'] ?>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="1"  class="total-line">Collection Charge</td>
              <td class="total-value">Rs. <?= $cart['cart']->home_visit ?></td>
            </tr>
            <tr>
                <td colspan="1"  class="total-line">Total Amount</td>
                <td class="total-value">Rs. <?= $mrp + $cart['cart']->home_visit + $order['hardcopy'] ?></td>
            </tr>
            <tr>
                <td colspan="1"  class="total-line">Discount</td>
                <?php $total = $total - $cart['cart']->discount ?>
                <td class="total-value">Rs. 
                    <?= $total >= $order['fix_price'] ? $mrp - $total + $cart['cart']->home_visit : $mrp - $total; ?>
                </td>
            </tr>
            <tr>
            <td colspan="1"  class="total-line balance">Net Pay Amount</td>
              <td class="total-value balance">
                <div class="due">Rs. <?= $total + ($total < $order['fix_price'] ? $order['home_visit'] : 0) + $order['hardcopy'] - $order['discount'] ?></div>
              </td>
            </tr>   
        </table>
    </div>
</body>
</html>