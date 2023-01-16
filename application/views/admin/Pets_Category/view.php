<?php $iData['SelectedMenu'] = array("MainMenu" => "petscategory", "SubMenu" => "Petscategory_view"); ?>

<?php echo $this->load->view('admin/header', $iData, true); ?>





<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="m-0">Pets Category</h1>

                </div><!-- /.col -->

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/welcome/dashboard"; ?>">Home</a></li>

                        <li class="breadcrumb-item active">Pets Category Page</li>

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

                        <div class="card-header">

                            <div class="card-tools">

                                <a href="<?php echo base_url() . 'admin/pets_category/create'; ?>" class="btn btn-primary"><i class="fas fa-plus"> Add Pets Category</i></a>

                            </div>
                        </div>

                        <div class="card-body p-3">
                            <table id="datatableid" class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">
                                            #
                                        </th>
                                        <th style="width: 15%">
                                            Name
                                        </th>
                                        <th style="width: 40%">
                                            Image
                                        </th>
                                        <th style="width: 10%">
                                            Created Date
                                        </th>
                                        <th style="width: 5%" class="text-center">
                                            Status
                                        </th>
                                        <th class="text-center" style="width: 13%">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($petscategories)) { ?>

                                        <?php foreach ($petscategories as $PetscategoriesRow) { ?>
                                            <tr>
                                                <td><?php echo $PetscategoriesRow['id'] ?></td>
                                                <td><?php echo $PetscategoriesRow['name'] ?></td>
                                                <td>
                                                    <img width="70" class="mt-3" src="<?php echo PETCATEGORY_IMAGE_URL . DS . $PetscategoriesRow['category_image']; ?>">
                                                </td>
                                                <td class="project_progress"><?php echo $PetscategoriesRow['created_date'] ?></td>
                                                <td class="project-state">
                                                    <?php if ($PetscategoriesRow['is_del'] == 0) { ?>

                                                        <span class="badge badge-success">Active</span>

                                                    <?php } else { ?>

                                                        <span class="badge badge-danger ">Block</span>

                                                    <?php } ?>

                                                </td>
                                                <td class="project-actions text-center">
                                                    <a class="btn btn-primary btn-sm" href="<?php echo base_url() . 'admin/pets_category/edit/' . $PetscategoriesRow['id']; ?>">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteCategory(<?php echo $PetscategoriesRow['id']; ?>)">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }  ?>

                                    <?php } else { ?>

                                        <tr>

                                            <td colspan="4">Records not found</td>

                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

<script type="text/javascript">
    function deleteCategory(id) {

        if (confirm("Are you sure you want to delete category?")) {

            window.location.href = '<?php echo base_url() . 'admin/pets_category/delete/'; ?>' + id;

        }

    }
</script>