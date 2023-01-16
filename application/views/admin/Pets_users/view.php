<?php $iData['SelectedMenu'] = array("MainMenu" => "Petsusers", "SubMenu" => "Petsusers_view"); ?>

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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Address</th>
                                        <th>created_date</th>
                                        <th class="text-center">Status</th>
                                        <th>More Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($PetsUsers)) { ?>

                                        <?php foreach ($PetsUsers as $PetsUsersRow) { ?>

                                            <tr>
                                                <td><?php echo $PetsUsersRow['uid']; ?></td>
                                                <td>
                                                    <img width="70" class="mt-3" src="<?php echo USER_AVATAR_URL . DS . $PetsUsersRow['avatar']; ?>">
                                                </td>
                                                <td><?php echo $PetsUsersRow['name']; ?></td>
                                                <td><?php echo $PetsUsersRow['email']; ?></td>
                                                <td><?php echo $PetsUsersRow['mobile_number']; ?></td>
                                                <td><?php echo $PetsUsersRow['address']; ?></td>
                                                <td><?php echo $PetsUsersRow['created_date']; ?></td>
                                                <td class="project-state">
                                                    <?php if ($PetsUsersRow['is_del'] == 0) { ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger ">Block</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="<?php echo base_url() . 'admin/Pets_users/petsdetails/' . $PetsUsersRow['uid']; ?>">
                                                        <i class="fas fa-folder">
                                                        </i>
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }  ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="7">Records not found</td>
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