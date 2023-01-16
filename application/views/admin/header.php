<!DOCTYPE html>

<!--

This is a starter template page. Use this page to start your new project from

scratch. This page gets rid of all links and provides the needed markup only.

-->

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-wid c th, initial-scale=1">


    <title><?php echo PLATFORM_NAME; ?></title>



    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->

    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/summernote/summernote-bs4.css">

</head>



<body class="hold-transition sidebar-mini sidebar-collapse">

    <div class="wrapper">



        <!-- Navbar -->

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Left navbar links -->

            <ul class="navbar-nav">

                <li class="nav-item">

                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

                </li>

            </ul>



            <!-- Right navbar links -->

            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item dropdown">

                    <a class="nav-link" data-toggle="dropdown" href="#">

                        Welcome, <strong>Administrator</strong>

                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="dropdown-divider"></div>

                        <a href="<?php echo base_url() . 'admin/services/logout'; ?>" class="dropdown-item">

                            <i class="fas fa-power-off mr-1"></i> Logout

                        </a>

                    </div>

                </li>

            </ul>

        </nav>

        <!-- /.navbar -->



        <!-- Main Sidebar Container -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Brand Logo -->

            <a href="<?php echo base_url() . "admin/welcome/dashboard"; ?>" class="brand-link">
                <i class="brand-image fas solid fa-paw mt-2 ml-3"></i>
                <span class="brand-text font-weight-light ml-1"><strong>Pet Adopion Admin</strong></span>

            </a>



            <!-- Sidebar -->

            <div class="sidebar">

                <!-- Sidebar Menu -->

                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <!-- Add icons to the links using the .nav-icon class

               with font-awesome or any other icon font library -->

                        <li class="nav-item ">

                            <a href="<?php echo base_url() . "admin/welcome/dashboard"; ?>" class="nav-link <?php echo in_array($SelectedMenu['MainMenu'], array('dashbord')) ? "active" : ""; ?>">

                                <i class="nav-icon fas solid fa-house-user"></i>
                                <p>

                                    Dashbord

                                </p>

                            </a>

                        </li>

                        <li class="nav-item <?php echo in_array($SelectedMenu['MainMenu'], array('petscategory')) ? "menu-open" : ""; ?>">

                            <a href="#" class="nav-link <?php //echo $SelectedMenu['SubMenu'] == "Petscategory_view" ? "active" : "";
                                                        ?>">

                                <i class="nav-icon fas solid fa-dog fa-fw unchecked-icon"></i>

                                <p>

                                    Pets Category

                                    <i class="right fas fa-angle-left"></i>

                                </p>

                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">

                                    <a href="<?php echo base_url() . "admin/pets_category/create";
                                                ?>" class="nav-link <?php echo $SelectedMenu['SubMenu'] == "petscategory_create" ? "active" : "";
                                                                    ?>">

                                        <i class="nav-icon fas fa-plus"></i>

                                        <p>Add Pets Category</p>

                                    </a>

                                </li>

                                <li class="nav-item">

                                    <a href="<?php echo base_url() . "admin/pets_category/view";
                                                ?>" class="nav-link <?php echo $SelectedMenu['SubMenu'] == "Petscategory_view" ? "active" : "";
                                                                    ?>">

                                        <i class="nav-icon fas fa-eye"></i>

                                        <p>View Pets Category</p>

                                    </a>

                                </li>

                            </ul>

                        </li>

                        <li class="nav-item <?php echo in_array($SelectedMenu['MainMenu'], array('petsdetailes')) ? "menu-open" : ""; ?>">

                            <a href="<?php echo base_url() . "admin/Pets_detailes/view";
                                        ?>" class="nav-link <?php echo $SelectedMenu['SubMenu'] == "Petsdetailes_view" ? "active" : "";
                                                            ?>">
                                <i class="nav-icon fas fa-folder-open"></i>

                                <p>

                                    Pets Details

                                </p>

                            </a>

                        </li>

                        <li class="nav-item <?php echo in_array($SelectedMenu['MainMenu'], array('Petsusers')) ? "menu-open" : ""; ?>">

                            <a href="<?php echo base_url() . "admin/Pets_users/view";
                                        ?>" class="nav-link <?php echo $SelectedMenu['SubMenu'] == "Petsusers_view" ? "active" : "";
                                                            ?>">

                                <i class="nav-icon fas solid fa-user-check"></i>
                                <p>

                                    Pets Users

                                </p>

                            </a>

                        </li>

                    </ul>

                </nav>

                <!-- /.sidebar-menu -->

            </div>

            <!-- /.sidebar -->

        </aside>