<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card-header">
    <div class="row">
        <div class="col-md-8">
            <h5><?= $title ?> <?= $operation ?></h5>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered nowrap">
            <thead>
                <th>Sr.</th>
                <th>Full Address</th>
                <th>Location</th>
                <th>City</th>
            </thead>
            <tbody>
                <?php if($data): foreach($data as $k => $add): ?>
                    <tr>
                        <td><?= $k + 1 ?></td>
                        <td><?= $add['faddress'] ?></td>
                        <td><?= $add['ad_location'] ?></td>
                        <td><?= $add['ad_city'] ?></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No address available.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <br />
    <?= anchor("$url", 'GO BACK', 'class="btn btn-outline-danger col-md-3"'); ?>
</div>