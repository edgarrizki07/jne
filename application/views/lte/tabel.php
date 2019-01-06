<!DOCTYPE html>
<html>
  <head>
	<link rel="shortcut icon" href="<?php echo base_url();?>uploads/setting/favicon.ico" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title;?> - <?php echo $this->user_model->NamaUser($this->session->userdata('SESS_USER_ID'));?> | <?php echo $this->setting_model->Nama();?> | <?php echo date('d-m-Y H:i');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
    <link rel="stylesheet" href="<?php echo base_url();?>lte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/ionicons.min.css">
	
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/iCheck/all.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/morris/morris.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  </head>
  <body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>
<?php $this->load->view($main_content); ?>
<?php $this->load->view('footer'); ?>
<?php $this->load->view('control'); ?>

    </div><!-- ./wrapper -->

    <script src="<?php echo base_url();?>lte/plugins/jQuery/jQuery-2.2.3.min.js"></script>
    <script src="<?php echo base_url();?>lte/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>lte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/fastclick/fastclick.min.js"></script> 
    <script src="<?php echo base_url();?>lte/plugins/select2/select2.min.js"></script>
    <script src="<?php echo base_url();?>lte/dist/js/app.min.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        $("#example0").DataTable();
        $("#example1").DataTable();
        $("#example2").DataTable();
        $("#example3").DataTable();
        $("#example4").DataTable();
        $("#example5").DataTable();
        $("#example6").DataTable();
        $("#example7").DataTable();
        $("#example8").DataTable();
        $("#example9").DataTable();
        $("#example10").DataTable();
		//Timepicker
		$(".timepicker").timepicker({ showInputs: false });
		//Timepicker1
		$(".timepicker1").timepicker({ showInputs: false });
      });
    </script>
  </body>
</html>
