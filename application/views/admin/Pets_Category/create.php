<?php $iData['SelectedMenu'] = array("MainMenu" => "petscategory", "SubMenu" => "petscategory_create"); ?>

<?php echo $this->load->view('admin/header', $iData, true); ?>





<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <div class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="ml-1">Create Pets Category</h1>

                </div><!-- /.col -->

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/welcome/dashboard"; ?>">Home</a></li>

                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/pets_category/view"; ?>">Character</a></li>

                        <li class="breadcrumb-item active">Create New Pets Category</li>

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

                                Create Pets Category

                            </div>

                        </div>

                        <form name="categoryForm" id="categoryForm" method="post" enctype="multipart/form-data" action="<?php echo base_url() . 'admin/pets_category/create'; ?>">

                            <div class="card-body">

                                <div class="form-group">

                                    <label>Name</label>

                                    <input type="text" name="name" id="name" value="<?php echo set_value('name');  ?>" class="form-control <?php echo (form_error('name') != "") ? 'is-invalid' : ''; ?>">

                                    <?php echo form_error('name'); ?>

                                </div>



                                <div class="form-group">

                                    <label>Image</label><br>

                                    <input type="file" name="category_image" id="category_image" class="<?php echo (!empty($errorImageUpload)) ? 'is-invalid' : ''; ?>">

                                    <?php echo (!empty($errorImageUpload)) ? $errorImageUpload : ''; ?>

                                </div>



                                <div class="custom-control custom-radio float-left">

                                    <input class="form-check-input" type="radio" value="0" name="is_del" id="statusAction" checked="">

                                    <label for="statusAction" class="custom-control-lable">Active</label>

                                </div>



                                <div class="custom-control custom-radio float-left ml-3">

                                    <input class="form-check-input" type="radio" value="1" name="is_del" id="statusBlock">

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