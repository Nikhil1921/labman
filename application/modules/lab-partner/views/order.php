<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="col-12">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th class="target">Sr.</th>
                <th>Test name</th>
                <th>Price</th>
            </thead>
            <tbody>
                <?php foreach($order['tests'] as $k => $t): ?>
                    <tr>
                        <td><?= $k+1 ?></td>
                        <td><?= $t['t_name'] ?></td>
                        <td><?= $t['price'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
