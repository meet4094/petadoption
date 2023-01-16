<!-- Main Footer -->

<footer class="main-footer">

    <strong><?php echo date("Y") ?> @ Brawl Stars.</strong>

</footer>

</div>

<!-- ./wrapper -->



<!-- REQUIRED SCRIPTS -->



<!-- jQuery -->

<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->

<script src="<?php echo base_url() ?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->

<script src="<?php echo base_url() ?>public/admin/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url() ?>public/admin/plugins/summernote/summernote-bs4.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js" type="text/javascript"></script>


<script>
    $(function() {

        $('.textarea').summernote({

            height: '400px'

        })

    })
</script>

</body>



</html>