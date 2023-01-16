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
                        <!-- <div class="mr-3">
                            <a href="<?php //echo base_url() . "admin/pets_detailes/view"; 
                                        ?>" class="btn btn-block btn-secondary">Back</a>
                        </div> -->
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/welcome/dashboard"; ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/pets_users/view"; ?>">Pets Users</a></li>
                        <li class="breadcrumb-item active">Pets Detailes Data Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.col -->

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <?php if (!empty($PetsDetailes)) { ?>
                                <?php foreach ($PetsDetailes as $PetsDetaileRow) { ?>
                                    <div class="col-12 col-sm-6">
                                        <div class="col-12">
                                            <img src="<?php echo PET_IMAGE_URL . DS . $PetsDetaileRow['PetsPhoto'][0]['photo'];
                                                        ?>" alt="Photo 2" class="product-image" style="width: 90%;">
                                        </div>
                                        <div class="col-12 product-image-thumbs">
                                            <?php foreach ($PetsDetaileRow['PetsPhoto'] as $key =>  $PetsPhotosRow) { ?>
                                                <div class="product-image-thumb <?php if ($key == 0) {
                                                                                    echo 'active';
                                                                                } ?>">
                                                    <img src="<?php echo PET_IMAGE_URL . DS . $PetsPhotosRow['photo']; ?>" alt="Product Image">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <h1 class="my-3"><?php echo $PetsDetaileRow['name']; ?></h1>
                                        <h6><?php echo $PetsDetaileRow['about']; ?></h6>
                                        <hr>
                                        <h4 class="mr-3 my-3">Colors :
                                            <label class="text-center active">
                                                <h5><?php echo $PetsDetaileRow['color']; ?></h5>
                                            </label>
                                        </h4>

                                        <h4 class="mr-3 my-3">Weight :
                                            <label class="text-center active">
                                                <h5><?php echo $PetsDetaileRow['weight']; ?></h5>
                                            </label>
                                        </h4>

                                        <h4 class=" mr-3 my-3">Age :
                                            <label class="text-center active">
                                                <h5><?php echo $PetsDetaileRow['age']; ?></h5>
                                            </label>
                                        </h4>

                                        <h4 class=" mr-3 my-3">Breed :
                                            <label class="text-center active">
                                                <h5><?php echo $PetsDetaileRow['breed']; ?></h5>
                                            </label>
                                        </h4>

                                        <h4 class=" mr-3 my-3">Gender :
                                            <label class="text-center active">
                                                <?php if ($PetsDetaileRow['gender'] == 1) { ?>
                                                    <span class="badge badge-success">Male</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger">Female</span>
                                                <?php } ?>
                                            </label>
                                        </h4>

                                        <h4 class="mr-3 my-3">Address :
                                            <label class="text-center active">
                                                <h5><?php echo $PetsDetaileRow['address']; ?></h5>
                                            </label>
                                        </h4>
                                    </div>
                                <?php }  ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7">Records not found</td>
                                </tr>
                            <?php } ?>
                        </div>
                    </div>
                </div><!-- /.row -->
            </section>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<?php $this->load->view('admin/footer'); ?>

<script>
    $(document).ready(function() {
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>