<!DOCTYPE html>
<html>
  <head>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title;?> - <?php echo $this->user_model->NamaUser($this->session->userdata('SESS_USER_ID'));?> | <?php echo $this->setting_model->Nama();?> | <?php echo date('d-m-Y H:i');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/ionicons.min.css">

	<link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/skins/_all-skins.min.css">
	<script src="<?php echo base_url();?>lte/plugins/jQuery/jquery.js"></script>
	<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker({
			dateFormat: "yy-mm-dd",
			regional: "id"
		});
		$("#datepicker-from").datepicker({
			dateFormat: "yy-mm-dd",
			regional: "id"
		});
		$("#datepicker-to").datepicker({
			dateFormat: "yy-mm-dd",
			regional: "id"
		});
	});
	</script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>
<?php $this->load->view($main_content); ?>
<?php $this->load->view('control'); ?>

    </div><!-- ./wrapper -->

    <script src="<?php echo base_url();?>lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url();?>lte/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/select2/select2.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/fastclick/fastclick.min.js"></script>
    <script src="<?php echo base_url();?>lte/dist/js/app.min.js"></script>
    <script src="<?php echo base_url();?>lte/dist/js/demo.js"></script>
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
		//DataTable
        $("#example0").DataTable();
        $("#example1").DataTable();
        $("#example2").DataTable();
        $("#example3").DataTable();
        $("#example4").DataTable();
        $("#example5").DataTable();
      });
    </script>
  </body>
</html>
