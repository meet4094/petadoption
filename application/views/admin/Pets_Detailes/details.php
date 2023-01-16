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
                        <li class="breadcrumb-item"><a href="<?php echo base_url() . "admin/pets_detailes/view"; ?>">Pets Detailes</a></li>
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
                            <div class="col-12 col-sm-6">
                                <div class="col-12">
                                    <div class="position-relative">
                                        <img src="<?php echo PET_IMAGE_URL . DS . $PetsPhotos[0]['photo']; ?>" alt="Photo 2" class="product-image">
                                    </div>
                                </div>
                                <div class="col-12 product-image-thumbs">
                                    <?php foreach ($PetsPhotos as $key => $PetsPhotosRow) { ?>
                                        <div class="product-image-thumb <?php if ($key == 0) {
                                                                            echo 'active';
                                                                        } ?>">
                                            <img src="<?php echo PET_IMAGE_URL . DS . $PetsPhotosRow['photo']; ?>" alt="Product Image">
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <h1 class="my-3"><?php echo $PetsDetaile['name']; ?></h1>
                                <h6><?php echo $PetsDetaile['about']; ?></h6>
                                <hr>
                                <h4 class="mr-3 my-3">Colors :
                                    <label class="text-center active">
                                        <h5><?php echo $PetsDetaile['color']; ?></h5>
                                    </label>
                                </h4>

                                <h4 class="mr-3 my-3">Weight :
                                    <label class="text-center active">
                                        <h5><?php echo $PetsDetaile['weight']; ?></h5>
                                    </label>
                                </h4>

                                <h4 class=" mr-3 my-3">Age :
                                    <label class="text-center active">
                                        <h5><?php echo $PetsDetaile['age']; ?></h5>
                                    </label>
                                </h4>

                                <h4 class=" mr-3 my-3">Breed :
                                    <label class="text-center active">
                                        <h5><?php echo $PetsDetaile['breed']; ?></h5>
                                    </label>
                                </h4>

                                <h4 class=" mr-3 my-3">Gender :
                                    <label class="text-center active">
                                        <?php if ($PetsDetaile['gender'] == 1) { ?>
                                            <span class="badge badge-success">Male</span>
                                        <?php } else { ?>
                                            <span class="badge badge-danger">Female</span>
                                        <?php } ?>
                                    </label>
                                </h4>

                                <h4 class="mr-3 my-3">Address :
                                    <label class="text-center active">
                                        <h5><?php echo $PetsDetaile['address']; ?></h5>
                                    </label>
                                </h4>

                                <div class="mt-4">
                                    <a href="<?php echo base_url() . "admin/pets_detailes/view"; ?>" class="btn btn-block btn-secondary btn-lg">Back</a>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div><!-- /.row -->
            </section>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
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
        $('.product-image-thumb').on('click', function() {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>