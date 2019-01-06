<!DOCTYPE html>
<html>
  <head>
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/iCheck/flat/blue.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue">
<div class="content">
	<!-- Main content -->
	<section class="content invoice">
		<div class="row">
			<div class="col-xs-6">
			<table class="table table-bordered">
				<tr>
					<td><strong>Pembayaran : </strong>
				<?php $customer = $info['customer_id'] ; echo $this->customer_model->CPcustomer($customer);?> - <?php echo $this->customer_model->HPcustomer($customer);?><br>
				<strong><?php echo $this->customer_model->Namacustomer($customer);?></strong><br>
				<?php $npwp=$this->customer_model->NPWPcustomer($customer);?>
				<strong>NPWP :  <?php echo substr($npwp,0,2);?>.<?php echo substr($npwp,2,3);?>.<?php echo substr($npwp,5,3);?>.<?php echo substr($npwp,8,1);?>-<?php echo substr($npwp,9,3);?>.<?php echo substr($npwp,12,3);?></strong><br>
				<strong>Alamat :</strong><br>
				<?php echo $this->customer_model->Alamatcustomer($customer);?><br>
				Phone : <?php echo $this->customer_model->Telpcustomer($customer);?> 
				Fax : <?php echo $this->customer_model->Faxcustomer($customer);?> 
				Email : <?php echo $this->customer_model->Emailcustomer($customer);?>
					</td>
				</tr>
				</table>
			</div><!-- /.col -->
			<div class="col-xs-6">
				<table class="table table-bordered">
					<tr>
						<td>
							<h4>Referensi <h4>
							<h5>PO : <?php echo $info['nopo'];?> Tanggal <?php echo $this->jurnal_model->tgl_indo($info['tglpo']);?></h5>
							<h5>Invoice : <?php echo $info['jurnal_id'];?>/INV/<?php echo $this->pajak_model->KodeCabang($info['wp_id']);?>/<?php echo $info['id'];?>/<?php echo $this->setting_model->singkatan();?>/<?php echo $this->jurnal_model->ambilBln($info['tgl']);?>/<?php echo $this->jurnal_model->ambilThn($info['tgl']);?> Tanggal <?php echo $this->jurnal_model->tgl_indo($info['tgl']);?></h5>
						</td>
					</tr>
				</table>
				<table class="table" width='100%'>
					<h5 class="text-center text-bold">Detail</h5>
					<tr>
						<td>Term</br>Payment Due Date</td>
						<td> : </br> : </td>
						<td><?php echo $info['term'];?></br><?php echo $this->jurnal_model->tgl_str($info['tempo']);?></td>
					</tr>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<!-- Table row -->
		<div class="row invoice-info">
			<div class="col-xs-12 table-responsive">
				<table class="table table-striped">
					<thead>
						<tr class="text-bold">
							<td>Tanggal Bayar</td>
							<td>Akun</td>
							<td align="right">Pembayaran Sejumlah</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $this->jurnal_model->tgl_str($info['tglbyr']);?></td>
							<td><?php echo $this->akun_model->KelompokAkun($info['akunbyr']);?> <?php echo $this->akun_model->KodeAkun($info['akunbyr']);?>-<?php echo $this->akun_model->NamaAkun($info['akunbyr']);?></td>
							<td align="right"><?php echo number_format($this->bbm_model->Total9Jual($this->uri->segment(3), 0, ',', '.'));?></td>
						</tr>
					</tbody>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<div class="row invoice-info">
			<!-- accepted payments column -->
			<div class="col-xs-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<td>
								<p class="lead">Keterangan: <br><?php echo ($info['bayar']);?></p>
							</td>
						</tr>
					</thead>
				</table>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->

	<div class="clearfix"></div>
</div><!-- /.content-wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url();?>lte/plugins/select2/select2.full.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url();?>lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>lte/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>lte/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>lte/dist/js/demo.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>lte/plugins/iCheck/icheck.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url();?>lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Page Script -->
    <script>
      $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
        //Add text editor
        $("#tulis-textarea").wysihtml5();
        //Initialize Select2 Elements
        $("#tulis-textarea1").wysihtml5();
        //Initialize Select2 Elements
        $("#tulis-textarea2").wysihtml5();
        //Initialize Select2 Elements
        $("#tulis-textarea3").wysihtml5();
        //Initialize Select2 Elements
        $(".select2").select2();
      });
    </script>
  </body>
</html>

