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
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Relation</th>
                <th>Gender</th>
                <th>Date Of Birth</th>
            </thead>
            <tbody>
                <?php if($data): foreach($data as $k => $m): ?>
                    <tr>
                        <td><?= $k + 1 ?></td>
                        <td><?= $m['name'] ?></td>
                        <td><?= $m['mobile'] ?></td>
                        <td><?= $m['email'] ?></td>
                        <td><?= $m['relation'] ?></td>
                        <td><?= $m['gender'] ?></td>
                        <td><?= $m['dob'] ?></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No members available.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <br />
    <?= anchor("$url", 'GO BACK', 'class="btn btn-outline-danger col-md-3"'); ?>
</div>