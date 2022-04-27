<?php defined('BASEPATH') OR exit('No direct script access allowed');
$pers = $this->user->role === 'Admin' ? [] : $this->main->getAll('permissions', 'nav', ['role' => $this->user->role, 'operation' => 'view']); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= APP_NAME ?> | <?= ucwords($title) ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon">
        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/fontawesome.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/icofont.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/themify.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/flag-icon.css') ?>">
        <?php if(isset($datatable)): ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/datatables.css') ?>">
        <?php endif ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/feather-icon.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/select2.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/date-picker.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/bootstrap.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/style.css') ?>">

        <link id="color" rel="stylesheet" href="<?= base_url('assets/back/css/light-1.css') ?>" media="screen">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/back/css/responsive.css') ?>">
    </head>
    <body>
        <div class="loader-wrapper">
            <div class="loader bg-white">
                <div class="whirly-loader"> </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="page-main-header">
                <div class="main-header-right row">
                    <div class="mobile-sidebar d-block">
                        <div class="media-body text-right switch-sm">
                        <label class="switch"><a href="javascript:;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-left" id="sidebar-toggle"><line x1="17" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="17" y1="18" x2="3" y2="18"></line></svg></a></label>
                        </div>
                    </div>
                    <div class="nav-right col p-0">
                        <ul class="nav-menus">
                            <li></li>
                            <li class="onhover-dropdown" id="get-pending-tests"></li>
                            <li class="onhover-dropdown">
                                <div class="media align-items-center">
                                    <?= img(['class' => "align-self-center pull-right img-50 rounded-circle", 'src' => "assets/images/user.png"]) ?>
                                </div>
                                <ul class="profile-dropdown onhover-show-div p-20">
                                    <li><?= anchor(admin('profile'), '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Edit Profile') ?></li>
                                    <li><?= anchor(admin('logout'), '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>Logout') ?></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="d-lg-none mobile-toggle pull-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></div>
                    </div>
                </div>
            </div>
            <div class="page-body-wrapper">
                <div class="page-sidebar">
                    <div class="sidebar custom-scrollbar">
                        <div class="sidebar-user text-center">
                            <div><?= img(['src' => 'assets/images/user.png', 'class' => "img-60 rounded-circle"]) ?></div>
                            <h6 class="mt-3 f-14"><?= $this->user->name ?></h6>
                            <p>ADMIN</p>
                        </div>
                        <ul class="sidebar-menu">
                            <li>
                                <?= anchor(admin('dashboard'), '<i data-feather="home"></i><span> Dashboard</span>', 'class="sidebar-header '.($name === 'dashboard' ? 'active' : '').'"') ?>
                            </li>
                            <?php if(verify_nav('users', $pers)): ?>
                                <li>
                                    <?= anchor(admin('users'), '<i data-feather="users"></i><span> Users</span>', 'class="sidebar-header '.($name === 'users' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                            <?php if(verify_nav('orders', $pers)): ?>
                            <li>
                                <?= anchor(admin('orders'), '<i data-feather="file-text"></i><span> Completed orders</span>', 'class="sidebar-header '.($name === 'orders' ? 'active' : '').'"') ?>
                            </li>
                            <?php endif;
                            
                            $cat_nav = ['category', 'department', 'methods', 'samples', 'report_time', 'tests', 'test_details'];
                            $cat_nav_check = false;
                            foreach ($cat_nav as $v) if(verify_nav($v, $pers)) $cat_nav_check = true;

                            if($cat_nav_check): ?>
                            <li <?= in_array($name, $cat_nav) ? 'class="active"' : '' ?>>
                                <a class="sidebar-header" href="javascript:;" >
                                    <i data-feather="thermometer"></i><span>Test</span><i class="fa fa-angle-right pull-right"></i>
                                </a>
                                <ul class="sidebar-submenu <?= in_array($name, $cat_nav) ? 'menu-open' : '' ?>">
                                    <?php if(verify_nav('category', $pers)): ?>
                                        <li><?= anchor(admin('category'), '<i class="fa fa-circle"></i> Test Category', 'class="'.($name === 'category' ? 'active' : '').'"') ?></li>
                                    <?php endif ?>
                                    <?php if(verify_nav('department', $pers)): ?>
                                        <li><?= anchor(admin('department'), '<i class="fa fa-circle"></i> Test Department', 'class="'.($name === 'department' ? 'active' : '').'"') ?></li>
                                    <?php endif ?>
                                    <?php if(verify_nav('methods', $pers)): ?>
                                        <li><?= anchor(admin('methods'), '<i class="fa fa-circle"></i> Test Method', 'class="'.($name === 'methods' ? 'active' : '').'"') ?></li>
                                    <?php endif ?>
                                    <?php if(verify_nav('samples', $pers)): ?>
                                        <li><?= anchor(admin('samples'), '<i class="fa fa-circle"></i> Sample  Type', 'class="'.($name === 'samples' ? 'active' : '').'"') ?></li>
                                    <?php endif ?>
                                    <?php if(verify_nav('report_time', $pers)): ?>
                                        <li><?= anchor(admin('report_time'), '<i class="fa fa-circle"></i> Report Time', 'class="'.($name === 'report_time' ? 'active' : '').'"') ?></li>
                                    <?php endif ?>
                                    <?php if(verify_nav('tests', $pers)): ?>
                                        <li><?= anchor(admin('tests'), '<i class="fa fa-circle"></i> Test', 'class="'.($name === 'tests' ? 'active' : '').'"') ?></li>
                                    <?php endif ?>
                                    <?php if(verify_nav('test_details', $pers)): ?>
                                        <li><?= anchor(admin('test_details'), '<i class="fa fa-circle"></i> Test details', 'class="'.($name === 'test_details' ? 'active' : '').'"') ?></li>
                                    <?php endif ?>
                                </ul>
                            </li>
                            <?php endif; if(verify_nav('banners', $pers)): ?>
                                <li>
                                    <?= anchor(admin('banners'), '<i data-feather="image"></i><span> Banners</span>', 'class="sidebar-header '.($name === 'banners' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                            <?php if(verify_nav('city', $pers)): ?>
                                <li>
                                    <?= anchor(admin('city'), '<i data-feather="file-text"></i><span> City</span>', 'class="sidebar-header '.($name === 'city' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                            <?php if(verify_nav('gallery', $pers)): ?>
                                <li>
                                    <?= anchor(admin('gallery'), '<i data-feather="image"></i><span> Gallery</span>', 'class="sidebar-header '.($name === 'gallery' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                            <?php if(verify_nav('labs', $pers)): ?>
                                <li>
                                    <?= anchor(admin('labs'), '<i data-feather="truck"></i><span> Lab Partner</span>', 'class="sidebar-header '.($name === 'labs' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                            <?php if(verify_nav('employees', $pers)): ?>
                                <li>
                                    <?= anchor(admin('employees'), '<i data-feather="users"></i><span> Employees</span>', 'class="sidebar-header '.($name === 'employees' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                            <?php if(verify_nav('employees_applications', $pers)): ?>
                                <li>
                                    <?= anchor(admin('employees_applications'), '<i data-feather="users"></i><span> Employee applications</span>', 'class="sidebar-header '.($name === 'employees_applications' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                            <?php if(verify_nav('packages', $pers)): ?>
                                <li>
                                    <?= anchor(admin('packages'), '<i data-feather="shopping-bag"></i><span> Packages / Organs / Offer</span>', 'class="sidebar-header '.($name === 'packages' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                            <?php if(verify_nav('lab_test', $pers)): ?>
                                <li>
                                    <?= anchor(admin('lab_test'), '<i data-feather="dollar-sign"></i><span> Test by Lab</span>', 'class="sidebar-header '.($name === 'lab_test' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                            <?php if(verify_nav('permissions', $pers)): ?>
                                <li>
                                    <?= anchor(admin('permissions'), '<i data-feather="lock"></i><span> Permissions</span>', 'class="sidebar-header '.($name === 'permissions' ? 'active' : '').'"') ?>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
                <div class="page-body">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <div class="">
                                        <ol class="breadcrumb float-right">
                                            <li class="breadcrumb-item"><?= anchor(admin('dashboard'), '<i data-feather="home"></i></a>') ?></li>
                                            <?php if (! isset($operation)): ?>
                                              <li class="breadcrumb-item active"><?= $title ?></li>
                                            <?php else: ?>
                                              <li class="breadcrumb-item"><?= anchor($url, ucwords($title)) ?></li>
                                            <?php endif ?>
                                            <?php if (isset($operation)): ?>
                                              <li class="breadcrumb-item active"><?= $operation ?></li>
                                            <?php endif ?>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $name != 'dashboard' ? '<div class="card">' : ''  ?>
                                    <?= $contents ?>
                                <?= $name != 'dashboard' ? '</div>' : ''  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="error_msg" value="<?= $this->session->error ?>" />
        <input type="hidden" name="success_msg" value="<?= $this->session->success ?>" />
        <script src="<?= base_url('assets/back/js/jquery-3.2.1.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/bootstrap/popper.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/bootstrap/bootstrap.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/icons/feather-icon/feather.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/icons/feather-icon/feather-icon.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/sidebar-menu.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/notify/bootstrap-notify.min.js') ?>"></script>
        <input type="hidden" id="base_url" value="<?= base_url(admin()) ?>" />
        <input type="hidden" name="admin" value="<?= ADMIN ?>" />
        <?php if(isset($datatable)): ?>
        <input type="hidden" name="dataTableUrl" value="<?= base_url($datatable) ?>" />
        <script src="<?= base_url('assets/back/js/datatable/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/datatable/datatable-extension/dataTables.buttons.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/datatable/datatable-extension/buttons.colVis.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/datatable/datatable-extension/buttons.bootstrap4.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/datatable/datatable-extension/buttons.html5.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/datatable/datatable-extension/buttons.print.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/datatable/datatables/datatable.custom.js?v=1.0.2') ?>"></script>
        <script src="<?= base_url('assets/back/js/sweet-alert/sweetalert.min.js') ?>"></script>
        <?php endif ?>
        <script src="<?= base_url('assets/back/js/datepicker/date-picker/datepicker.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/datepicker/date-picker/datepicker.en.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/datepicker/date-picker/datepicker.custom.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/config.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/select2/select2.full.min.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/select2/select2-custom.js') ?>"></script>
        <script src="<?= base_url('assets/back/js/editor/ckeditor/ckeditor.js') ?>"></script>
        <?php if($name === 'city'): ?>
        <script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiWWB6yJd6ilpII5N89O-vXAo2eXiVD9g&sensor=false&libraries=places"></script>
        <script src="<?= base_url('assets/js/jquery.geocomplete.js') ?>"></script>
        <script>
        $(function(){
            $(".geocomplete")
                .geocomplete({
                    types: ["establishment"],
                })
                .bind("geocode:result", function(event, result){
                    let city;
                    result.address_components.map(function(object){
                        if(object.types.includes("locality"))
                            city = object.long_name;
                            return;
                    });
                $("input[name=c_name]").val(city);
            });
        });
        </script>
        <?php endif ?>
        <script src="<?= base_url('assets/back/js/script.js?v=1.0.1') ?>"></script>
        <script>
            $.ajax({
                url: "<?= base_url(admin('getPendingTests')) ?>",
                success: function (tests) {
                    $("#get-pending-tests").html(tests);
                }
            });
        </script>
    </body>
</html>