<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Invoice</title>
    <style>
    *{margin:0;padding:0}body{font-size:15px;color:#000;line-height:22px;font-weight:400;background:#fff;font-family:Rasa,serif}#page-wrap{width:800px;margin:0 auto}textarea{border:0;font:14px Georgia,Serif;overflow:hidden;resize:none}table{border-collapse:collapse}table td,table th{border:1px solid #000;padding:5px}#header{height:15px;width:100%;margin:20px 0;background:#222;text-align:center;color:#fff;font:bold 15px Sans-Serif;text-decoration:uppercase;letter-spacing:20px;padding:8px 0}#address{width:220px;height:150px;float:left;text-align:justify}#customer{overflow:hidden}#logo{text-align:right;float:right;position:relative;margin-top:25px;border:1px solid #fff;max-width:540px;max-height:100px;overflow:hidden}#logo.edit,#logo:hover{border:1px solid #000;margin-top:0;max-height:125px}#logoctr{display:none}#logo.edit #logoctr,#logo:hover #logoctr{display:block;text-align:right;line-height:25px;background:#eee;padding:0 5px}#logohelp{text-align:left;display:none;font-style:italic;padding:10px 5px}#logohelp input{margin-bottom:5px}.edit #logohelp{display:block}.edit #cancel-logo,.edit #save-logo{display:inline}#cancel-logo,#save-logo,.edit #change-logo,.edit #delete-logo,.edit #image{display:none}#customer-title{font-size:20px;font-weight:700;float:left;border:1px solid #000}.meta-width{width:49%}.mr-r{margin:0 2% 0 0}.mr-b-p{margin-bottom:20px}#meta{float:left}#meta td.meta-head{text-align:left;background:#eee}#meta td textarea{width:100%;height:20px;text-align:right}#items{clear:both;width:100%;margin:30px 0 0 0}#items th{background:#eee}#items textarea{width:80px;height:50px}#items tr.item-row td{border:0;vertical-align:top;border:1px solid #000}#items td.description{width:300px}#items td.item-name{width:175px}#items td.description textarea,#items td.item-name textarea{width:100%}#items td.total-line{border-right:0;text-align:right}#items td.total-value{border-left:0;padding:10px;border:1px solid #000}#items td.total-value textarea{height:20px;background:0 0}#items td.balance{background:#eee}#items td.blank{border:0}#terms{text-align:center;margin:20px 0 0 0}#terms h5{text-transform:uppercase;font:13px Sans-Serif;letter-spacing:10px;border-bottom:1px solid #000;padding:0 0 8px 0;margin:0 0 8px 0}#terms textarea{width:100%;text-align:center}#items td.total-value textarea:focus,#items td.total-value textarea:hover,.delete:hover,textarea:focus,textarea:hover{background-color:#ef8}.delete-wpr{position:relative}.delete{display:block;color:#000;text-decoration:none;position:absolute;background:#eee;font-weight:700;padding:0 3px;border:1px solid;top:-6px;left:-22px;font-family:sans-serif;font-size:12px}#address1{width:325px;float:right;margin-top:15px}#logo{text-align:right;position:relative;margin-top:0;border:1px solid #fff;max-width:540px;max-height:130px;overflow:hidden}.im{width:225px;display:block;padding-right:35px}
    </style>
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
           <table id="meta" class="meta-width mr-r">
                <tr>
                    <td class="meta-head">Name</td>
                    <td><?= $user['name'] ?></td>
                </tr>
                <tr>
                    <td class="meta-head">Mobile No</td>
                    <td><?= $user['mobile'] ?></td>
                </tr>
            </table>
            <table id="meta" class="meta-width">
                <tr>
                    <td class="meta-head">Invoice No.</td>
                    <td><?= $order['or_id'] ?></td>
                </tr>
                <tr>
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
                <?php $total = 0; foreach($cart['tests'] as $test): $total += $test->total; ?>
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
                            Rs. <?= $total ?>
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
              <td class="total-value">Rs. <?= $total < $order['fix_price'] ? $order['home_visit'] : 0 ?></td>
            </tr>
            <tr>
                <td colspan="1"  class="total-line">Total Amount</td>
                <td class="total-value">Rs. <?= $total + ($total < $order['fix_price'] ? $order['home_visit'] : 0) + $order['hardcopy'] ?></td>
            </tr>
            <tr>
                <td colspan="1"  class="total-line">Discount</td>
                <td class="total-value">Rs. <?= $order['discount'] ?></td>
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