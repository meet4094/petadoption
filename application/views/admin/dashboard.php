<?php $iData['SelectedMenu'] = array("MainMenu" => "dashbord", "SubMenu" => ""); ?>

<?php echo $this->load->view('admin/header', $iData, true); ?>





<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

        <?php

        if (!empty($this->session->flashdata('msg'))) {

            echo "<div class='alert alert-danger mb-2'>" . $this->session->flashdata('msg') . "</div>";
        } ?>

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="m-0">Dashbord</h1>

                </div><!-- /.col -->

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/welcome/dashboard"; ?>">Home</a></li>

                        <li class="breadcrumb-item active">Dashbord Page</li>

                    </ol>

                </div><!-- /.col -->

            </div><!-- /.row -->

        </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $iCategoryCount; ?></h3>

                            <p>New Category</p>
                        </div>
                        <div class="icon">
                            <i class="fas solid fa-paw"></i>
                        </div>
                        <a href="<?php echo base_url('admin/pets_category/view') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $iPetsDetailesCount ?></h3>

                            <p>Pets Details</p>
                        </div>
                        <div class="icon">
                            <i class="fas solid fa-info"></i>
                        </div>
                        <a href="<?php echo base_url('admin/pets_detailes/view') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $iPetsPhotoCount ?></h3>

                            <p>Pets Photos</p>
                        </div>
                        <div class="icon">
                            <i class="fas solid fa-images"></i>
                        </div>
                        <a href="<?php echo base_url('admin/pets_detailes/view') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $iUserCount ?></h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="fas solid fa-users"></i>
                        </div>
                        <a href="<?php echo base_url('admin/pets_users/view') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Sales
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </section>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- /.content -->

</div>

<!-- /.content-wrapper -->

<?php $this->load->view('admin/footer'); ?>