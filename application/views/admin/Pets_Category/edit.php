<?php $iData['SelectedMenu'] = array("MainMenu" => "petscategory", "SubMenu" => "Petscategory_view"); ?>

<?php echo $this->load->view('admin/header', $iData, true); ?>





<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="m-0">Edit Pets Category</h1>

                </div><!-- /.col -->

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/welcome/dashboard"; ?>">Home</a></li>

                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/pets_category/view"; ?>">Pets Category</a></li>

                        <li class="breadcrumb-item active">Edit Pets Category</li>

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

                    <div class="card card-primary">

                        <div class="card-header">

                            <div class="card-title">

                            Edit Pets Category

                            </div>

                        </div>

                        <!-- <?php //echo $category[''] ?> -->

                        <form name="categoryForm" id="categoryForm" method="post" enctype="multipart/form-data" action="<?php echo base_url() . 'admin/pets_category/edit/' . $category['id']; ?>">

                            <div class="card-body">

                                <div class="form-group">

                                    <label>Name</label>

                                    <input type="text" name="name" id="name" value="<?php echo set_value('name', $category['name']);  ?>" class="form-control <?php echo (form_error('name') != "") ? 'is-invalid' : ''; ?>">

                                    <?php echo form_error('name'); ?>

                                </div>



                                <div class="form-group">

                                    <label>Image</label><br>

                                    <input type="file" name="category_image" id="category_image" class="<?php echo (!empty($errorImageUpload)) ? 'is-invalid' : ''; ?>">

                                    <br>



                                    <?php echo (!empty($errorImageUpload)) ? $errorImageUpload : ''; ?>

                                    <?php if ($category['category_image'] != "" && file_exists(PETCATEGORY_IMAGE_PATH . DS . $category['category_image'])) { ?>

                                        <img width="150" class="mt-3" src="<?php echo PETCATEGORY_IMAGE_URL . DS . $category['category_image']; ?>">

                                    <?php } else { ?>

                                        <img width="250" src="<?php echo PETCATEGORY_IMAGE_URL . DS . 'no-image.jpg'; ?>">

                                    <?php } ?>

                                </div>



                                <div class="custom-control custom-radio float-left">

                                    <input class="form-check-input" type="radio" value="0" name="is_del" id="statusAction" <?php echo ($category['is_del'] == 0) ? 'checked' : ''; ?>>

                                    <label for="statusAction" class="custom-control-lable">Active</label>

                                </div>



                                <div class="custom-control custom-radio float-left ml-3">

                                    <input class="form-check-input" type="radio" value="1" name="is_del" id="statusBlock" <?php echo ($category['is_del'] == 1) ? 'checked' : ''; ?>>

                                    <label for="statusBlock" class="custom-control-lable">Block</label>

                                </div>



                            </div>

                            <div class="card-footer">

                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>

                                <a href="<?php echo base_url() . "admin/pets_category/view"; ?>" class="btn btn-secondary">Back</a>

                            </div>

                        </form>

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