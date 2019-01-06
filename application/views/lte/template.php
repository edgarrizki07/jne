
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
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/skins/_all-skins.min.css">

  </head>
  <body class="hold-transition skin-blue sidebar-mini fixed">
    <script src="<?php echo base_url();?>lte/plugins/jQuery/jQuery-2.2.3.min.js"></script>
    <script src="<?php echo base_url();?>lte/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/chartjs/Chart.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/fastclick/fastclick.min.js"></script>
    <script src="<?php echo base_url();?>lte/dist/js/app.min.js"></script>
    <script src="<?php echo base_url();?>lte/dist/js/demo.js"></script>
    <div class="wrapper">

<?php $this->load->view('header'); ?>
<?php $this->load->view('sidebar'); ?>
<?php $this->load->view($main_content); ?>
<?php $this->load->view('footer'); ?>
<?php $this->load->view('control'); ?>

    </div><!-- ./wrapper -->
  </body>
</html>
