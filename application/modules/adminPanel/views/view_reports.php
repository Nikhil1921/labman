<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="card">
    <div class="card-header">
        <h5><?= $title ?></h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-1"><strong>Name : </strong></div>
            <div class="col-md-2"><span><?= $data['name'] ?></span></div>
            <div class="col-md-2"><strong>Mobile : </strong></div>
            <div class="col-md-2"><span><?= $data['mobile'] ?></span></div>
            <div class="col-md-2"><strong>Collection : </strong></div>
            <div class="col-md-3"><span><?= date('d-m-Y h:i A', strtotime($data['collection_date'].$data['collection_time'])) ?></span></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <th>SR #</th>
                        <th>Test</th>
                        <th>Date</th>
                        <th>View report</th>
                    </thead>
                    <?php foreach($data['tests'] as $k => $test): ?>
                    <tr>
                        <td><?= $k+1 ?> </td>
                        <td><?= form_label($test['t_name'], '', 'class="col-form-label"') ?></td>
                        <td><?= $test['date'] ?></td>
                        <td><?= anchor(admin('report/'.e_id($test['id'])), '<i class="fa fa-eye"></i>', 'class="btn btn-outline-dark" target="_blank"') ?></td>
                    </tr>
                    <?php endforeach ?>
                </table>
            </div>
            <div class="col-12"></div>
            <div class="col-6 col-md-3 mt-4">
                <?= anchor("$url", 'CANCEL', 'class="btn btn-outline-danger col-12"'); ?>
            </div>
        </div>
    </div>
</div>