<?php $iData['SelectedMenu'] = array("MainMenu" => "petsdetailes", "SubMenu" => "Petsdetailes_view"); ?>

<?php echo $this->load->view('admin/header', $iData, true); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pets Detailes </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/welcome/dashboard"; ?>">Home</a></li>
                        <li class="breadcrumb-item active">Pets Detailes Data Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($this->session->flashdata('success') != "") { ?>
                        <span class="reversed reversedRight">
                            <span>
                                &#9888;
                            </span>
                        </span>
                        <span class="reversed reversedLeft">
                            <?php echo $this->session->flashdata('success'); ?>
                        </span>
                    <?php } ?>
                    <?php if ($this->session->flashdata('error') != "") { ?>
                        <span class="reversed reversedRight">
                            <span>
                                &#9888;
                            </span>
                        </span>
                        <span class="reversed reversedLeft">
                            <?php echo $this->session->flashdata('error'); ?>
                        </span>
                    <?php } ?>
                    <div class="card">
                        <div class="card-body p-3">
                            <table id="datatableid" class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 5%">User</th>
                                        <th>Name</th>
                                        <th>Breed</th>
                                        <th>Weight</th>
                                        <th>Color</th>
                                        <th>Age</th>
                                        <th>Category</th>
                                        <th>Gender</th>
                                        <th class="text-center">Status</th>
                                        <th style="width:10%;">More Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($PetsDetailes)) { ?>
                                        <?php foreach ($PetsDetailes as $PetsDetailesRow) { ?>
                                            <tr>
                                                <td><?php echo $PetsDetailesRow['id'] ?></td>
                                                <td><?php echo $PetsDetailesRow['user_id'] ?></td>
                                                <td><?php echo $PetsDetailesRow['name'] ?></td>
                                                <td><?php echo $PetsDetailesRow['breed'] ?></td>
                                                <td><?php echo $PetsDetailesRow['weight'] ?></td>
                                                <td><?php echo $PetsDetailesRow['color'] ?></td>
                                                <td><?php echo $PetsDetailesRow['age'] ?></td>
                                                <td><?php echo $PetsDetailesRow['pets_category'] ?></td>
                                                <td><?php if ($PetsDetailesRow['gender'] == 1) { ?>
                                                        <span class="badge badge-success">Male</span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger">Female</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="project-state">
                                                    <?php if ($PetsDetailesRow['is_del'] == 0) { ?>

                                                        <span class="badge badge-success">Active</span>

                                                    <?php } else { ?>

                                                        <span class="badge badge-danger ">Block</span>

                                                    <?php } ?>

                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="<?php echo base_url() . 'admin/Pets_detailes/details/' . $PetsDetailesRow['id']; ?>">
                                                        <i class="fas fa-folder">
                                                        </i>
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }  ?>

                                    <?php } else { ?>

                                        <tr>

                                            <td colspan="11">Records not found</td>

                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<?php $this->load->view('admin/footer'); ?>

<script src="<?php echo BASE_URL; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo BASE_URL; ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo BASE_URL; ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo BASE_URL; ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        $('#datatableid').DataTable({
            columnDefs: [{
                    targets: [0],
                    orderData: [0, 1],
                },
                {
                    targets: [1],
                    orderData: [1, 0],
                },
                {
                    targets: [4],
                    orderData: [4, 0],
                },
            ],
        });
    });
</script>