<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="">
    <div class="container">
        <h1 class="page-title">Edit Profile</h1>
    </div>
    <div class="container">
        <div class="row">
            <?php $this->load->view('user-sidebar'); ?>
            <div class="col-md-9">
                <?= form_open_multipart() ?>
                    <div class="col-md-12 text-center">
                        <?= img($this->config->item('users').$this->user['image'], '', 'id="show-img" class="profile-img-select select-profile"') ?>
                        <p class="select-profile"> Select Image</p>
                        <input type='file' accept="image/jpeg,image/jpeg,image/png" name="image" id="imgInp" style="display: none;" />
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" value="<?= set_value('name') ? set_value('name') : $this->user['name'] ?>" name="name" placeholder="Enter First Name" type="text" required />
                            <?= form_error('name') ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email ID</label>
                            <input class="form-control" value="<?= set_value('email') ? set_value('email') : $this->user['email'] ?>" name="email" placeholder="Enter Email ID" type="text" required />
                            <?= form_error('email') ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input class="form-control" value="<?= set_value('mobile') ? set_value('mobile') : $this->user['mobile'] ?>" name="mobile" placeholder="Enter Mobile Number" type="text" required />
                            <?= form_error('mobile') ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="gap"></div>
</section>