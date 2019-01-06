	<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><b><?php echo $title;?></b><small></small></h1>
          <ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><b><?php echo $title;?></b></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Main row -->
          <div class="row">
            <div class="col-md-12">
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Grafik Harga Rata-Rata Akumulatif</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                      <p class="text-center">
                        <strong>Grafik Per Periode 1/2 Bulan Tahun : <?php echo date('Y'); ?> </strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="hargaChart" style="height: 370px;"></canvas>
                      </div><!-- /.chart-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="<?php echo site_url('harga');?>" class="btn btn-sm btn-default btn-flat pull-right">Lihat Detail</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Grafik Harga Rata-Rata Cabang</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                      <p class="text-center">
                        <strong>Grafik Per Periode 1/2 Bulan Tahun : <?php echo date('Y'); ?> </strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="cabangChart" style="height: 370px;"></canvas>
                      </div><!-- /.chart-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
					<p class="text-center"><strong>Keterangan</strong></p>
					<ul class="fc-color-picker" id="color-chooser">
				<?php if($this->uri->segment(3)==''){ }else{$this->db->where('id', $this->uri->segment(3)); } ?>
				<?php if($this->session->userdata('ADMIN')>'1'){ $this->db->where('id', $this->session->userdata('SESS_WP_ID')); } ?>
					<?php $info = $this->db->get_where('wp',array('status'=>'0'))->result(); $no=0; foreach($info as $row ): $no++;?>
					  <div class="external-event bg-<?php echo $row->warna;?>"><?php echo $row->id;?>. <?php echo $row->kota;?><br>
					  <?php $tahun=date('Y');?>
<?php if(date('m')>=1){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(1);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-1-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-1-16'){  ?><b title="16-<?php echo days_in_month(1,$tahun);?> <?php echo $this->jurnal_model->getBln(1);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-1-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=2){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(2);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-2-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-2-16'){  ?><b title="16-<?php echo days_in_month(2,$tahun);?> <?php echo $this->jurnal_model->getBln(2);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-2-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=3){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(3);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-3-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-3-16'){  ?><b title="16-<?php echo days_in_month(3,$tahun);?> <?php echo $this->jurnal_model->getBln(3);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-3-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=4){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(4);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-4-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-4-16'){  ?><b title="16-<?php echo days_in_month(4,$tahun);?> <?php echo $this->jurnal_model->getBln(4);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-4-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=5){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(5);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-5-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-5-16'){  ?><b title="16-<?php echo days_in_month(5,$tahun);?> <?php echo $this->jurnal_model->getBln(5);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-5-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=6){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(6);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-6-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-6-16'){  ?><b title="16-<?php echo days_in_month(6,$tahun);?> <?php echo $this->jurnal_model->getBln(6);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-6-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=7){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(7);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-7-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-7-16'){  ?><b title="16-<?php echo days_in_month(7,$tahun);?> <?php echo $this->jurnal_model->getBln(7);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-7-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=8){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(8);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-8-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-8-16'){  ?><b title="16-<?php echo days_in_month(8,$tahun);?> <?php echo $this->jurnal_model->getBln(8);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-8-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=9){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(9);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-9-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-9-16'){  ?><b title="16-<?php echo days_in_month(9,$tahun);?> <?php echo $this->jurnal_model->getBln(9);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-9-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=10){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(10);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-10-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-10-16'){  ?><b title="16-<?php echo days_in_month(10,$tahun);?> <?php echo $this->jurnal_model->getBln(10);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-10-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=11){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(11);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-11-1',$row->id);?></b>, 
<?php if(date('Ymd')>=date('Y').'-11-16'){  ?><b title="16-<?php echo days_in_month(11,$tahun);?> <?php echo $this->jurnal_model->getBln(11);?>"><?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-11-16',$row->id);?></b>, <?php } else { ?><?php } ?><?php } else { ?><?php } ?>
<?php if(date('m')>=12){  ?><b title="1-15 <?php echo $this->jurnal_model->getBln(12);?>"<?php } ?>
					  </div>
					<?php endforeach;?>
					</ul>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2010-2016 <a href="http://davidoank.com">Davidoank</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->

          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>lte/dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url();?>lte/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url();?>lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url();?>lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url();?>lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url();?>lte/plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>lte/dist/js/demo.js"></script>
        <script type="text/javascript">
$(function () {

  'use strict';

  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */
  //-----------------------
  //- MONTHLY HARGA CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var hargaChartCanvas = $("#hargaChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var hargaChart = new Chart(hargaChartCanvas);

  var hargaChartData = {
    labels: 
	[
			<?php $tahun=date('Y');?>
			<?php if(date('m')>=1){  ?>"1-15 <?php echo $this->jurnal_model->getBln(1);?>",<?php if(date('Ymd')>=date('Y').'-1-16'){  ?>"16-<?php echo days_in_month(1,$tahun);?> <?php echo $this->jurnal_model->getBln(1);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=2){  ?>"1-15 <?php echo $this->jurnal_model->getBln(2);?>",<?php if(date('Ymd')>=date('Y').'-2-16'){  ?>"16-<?php echo days_in_month(2,$tahun);?> <?php echo $this->jurnal_model->getBln(2);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=3){  ?>"1-15 <?php echo $this->jurnal_model->getBln(3);?>",<?php if(date('Ymd')>=date('Y').'-3-16'){  ?>"16-<?php echo days_in_month(3,$tahun);?> <?php echo $this->jurnal_model->getBln(3);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=4){  ?>"1-15 <?php echo $this->jurnal_model->getBln(4);?>",<?php if(date('Ymd')>=date('Y').'-4-16'){  ?>"16-<?php echo days_in_month(4,$tahun);?> <?php echo $this->jurnal_model->getBln(4);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=5){  ?>"1-15 <?php echo $this->jurnal_model->getBln(5);?>",<?php if(date('Ymd')>=date('Y').'-5-16'){  ?>"16-<?php echo days_in_month(5,$tahun);?> <?php echo $this->jurnal_model->getBln(5);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=6){  ?>"1-15 <?php echo $this->jurnal_model->getBln(6);?>",<?php if(date('Ymd')>=date('Y').'-6-16'){  ?>"16-<?php echo days_in_month(6,$tahun);?> <?php echo $this->jurnal_model->getBln(6);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=7){  ?>"1-15 <?php echo $this->jurnal_model->getBln(7);?>",<?php if(date('Ymd')>=date('Y').'-7-16'){  ?>"16-<?php echo days_in_month(7,$tahun);?> <?php echo $this->jurnal_model->getBln(7);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=8){  ?>"1-15 <?php echo $this->jurnal_model->getBln(8);?>",<?php if(date('Ymd')>=date('Y').'-8-16'){  ?>"16-<?php echo days_in_month(8,$tahun);?> <?php echo $this->jurnal_model->getBln(8);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=9){  ?>"1-15 <?php echo $this->jurnal_model->getBln(9);?>",<?php if(date('Ymd')>=date('Y').'-9-16'){  ?>"16-<?php echo days_in_month(9,$tahun);?> <?php echo $this->jurnal_model->getBln(9);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=10){  ?>"1-15 <?php echo $this->jurnal_model->getBln(10);?>",<?php if(date('Ymd')>=date('Y').'-10-16'){  ?>"16-<?php echo days_in_month(10,$tahun);?> <?php echo $this->jurnal_model->getBln(10);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=11){  ?>"1-15 <?php echo $this->jurnal_model->getBln(11);?>",<?php if(date('Ymd')>=date('Y').'-11-16'){  ?>"16-<?php echo days_in_month(11,$tahun);?> <?php echo $this->jurnal_model->getBln(11);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=12){  ?>"1-15 <?php echo $this->jurnal_model->getBln(12);?>"<?php } ?>
	],
    datasets: [
		{
        label: "Semua",
        fillColor: "#00a65a",
        strokeColor: "green",
        pointColor: "#00a65a",
        pointStrokeColor: "green",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: 
		[
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-1-1');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-1-16');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-2-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-2-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-3-1');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-3-16');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-4-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-4-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-5-1');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-5-16');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-6-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-6-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-7-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-7-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-8-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-8-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-9-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-9-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-10-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-10-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-11-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-11-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-12-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-12-16');?> 
		]
      }
    ]
  };

  var hargaChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 5,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  hargaChart.Line(hargaChartData, hargaChartOptions);

  //---------------------------
  //- END MONTHLY HARGA CHART -
  //---------------------------

  //-----------------------
  //- MONTHLY CABANG CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var cabangChartCanvas = $("#cabangChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var cabangChart = new Chart(cabangChartCanvas);

  var cabangChartData = {
    labels: 
	[
			<?php $tahun=date('Y');?>
			<?php if(date('m')>=1){  ?>"1-15 <?php echo $this->jurnal_model->getBln(1);?>",<?php if(date('Ymd')>=date('Y').'-1-16'){  ?>"16-<?php echo days_in_month(1,$tahun);?> <?php echo $this->jurnal_model->getBln(1);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=2){  ?>"1-15 <?php echo $this->jurnal_model->getBln(2);?>",<?php if(date('Ymd')>=date('Y').'-2-16'){  ?>"16-<?php echo days_in_month(2,$tahun);?> <?php echo $this->jurnal_model->getBln(2);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=3){  ?>"1-15 <?php echo $this->jurnal_model->getBln(3);?>",<?php if(date('Ymd')>=date('Y').'-3-16'){  ?>"16-<?php echo days_in_month(3,$tahun);?> <?php echo $this->jurnal_model->getBln(3);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=4){  ?>"1-15 <?php echo $this->jurnal_model->getBln(4);?>",<?php if(date('Ymd')>=date('Y').'-4-16'){  ?>"16-<?php echo days_in_month(4,$tahun);?> <?php echo $this->jurnal_model->getBln(4);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=5){  ?>"1-15 <?php echo $this->jurnal_model->getBln(5);?>",<?php if(date('Ymd')>=date('Y').'-5-16'){  ?>"16-<?php echo days_in_month(5,$tahun);?> <?php echo $this->jurnal_model->getBln(5);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=6){  ?>"1-15 <?php echo $this->jurnal_model->getBln(6);?>",<?php if(date('Ymd')>=date('Y').'-6-16'){  ?>"16-<?php echo days_in_month(6,$tahun);?> <?php echo $this->jurnal_model->getBln(6);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=7){  ?>"1-15 <?php echo $this->jurnal_model->getBln(7);?>",<?php if(date('Ymd')>=date('Y').'-7-16'){  ?>"16-<?php echo days_in_month(7,$tahun);?> <?php echo $this->jurnal_model->getBln(7);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=8){  ?>"1-15 <?php echo $this->jurnal_model->getBln(8);?>",<?php if(date('Ymd')>=date('Y').'-8-16'){  ?>"16-<?php echo days_in_month(8,$tahun);?> <?php echo $this->jurnal_model->getBln(8);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=9){  ?>"1-15 <?php echo $this->jurnal_model->getBln(9);?>",<?php if(date('Ymd')>=date('Y').'-9-16'){  ?>"16-<?php echo days_in_month(9,$tahun);?> <?php echo $this->jurnal_model->getBln(9);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=10){  ?>"1-15 <?php echo $this->jurnal_model->getBln(10);?>",<?php if(date('Ymd')>=date('Y').'-10-16'){  ?>"16-<?php echo days_in_month(10,$tahun);?> <?php echo $this->jurnal_model->getBln(10);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=11){  ?>"1-15 <?php echo $this->jurnal_model->getBln(11);?>",<?php if(date('Ymd')>=date('Y').'-11-16'){  ?>"16-<?php echo days_in_month(11,$tahun);?> <?php echo $this->jurnal_model->getBln(11);?>",<?php } else { ?><?php } ?><?php } else { ?><?php } ?>
			<?php if(date('m')>=12){  ?>"1-15 <?php echo $this->jurnal_model->getBln(12);?>"<?php } ?>
	],
    datasets: [
				<?php if($this->uri->segment(3)==''){ }else{$this->db->where('id', $this->uri->segment(3)); } ?>
				<?php if($this->session->userdata('ADMIN')>'1'){ $this->db->where('id', $this->session->userdata('SESS_WP_ID')); } ?>
				<?php $info = $this->db->get_where('wp',array('status'=>'0'))->result(); $no=0; foreach($info as $row ): $no++;?>
		{
        label: "Cabang <?php echo $row->kota;?>",
        fillColor: "<?php echo $row->warna;?>",
        strokeColor: "<?php echo $row->warna;?>",
        pointColor: "<?php echo $row->warna;?>",
        pointStrokeColor: "<?php echo $row->warna;?>",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: 
		[
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-1-1',$row->id);?>,
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-1-16',$row->id);?>,
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-2-1',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-2-16',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-3-1',$row->id);?>,
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-3-16',$row->id);?>,
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-4-1',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-4-16',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-5-1',$row->id);?>,
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-5-16',$row->id);?>,
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-6-1',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-6-16',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-7-1',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-7-16',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-8-1',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-8-16',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-9-1',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-9-16',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-10-1',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-10-16',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-11-1',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-11-16',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-12-1',$row->id);?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeliCabang(date('Y').'-12-16',$row->id);?> 
		]
      },
				<?php endforeach;?>
		{
        label: "Semua",
        fillColor: "#00a65a",
        strokeColor: "green",
        pointColor: "#00a65a",
        pointStrokeColor: "green",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgb(220,220,220)",
        data: 
		[
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-1-1');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-1-16');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-2-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-2-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-3-1');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-3-16');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-4-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-4-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-5-1');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-5-16');?>,
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-6-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-6-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-7-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-7-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-8-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-8-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-9-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-9-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-10-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-10-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-11-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-11-16');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-12-1');?>, 
		<?php echo $this->jurnal_model->GrafikAvgBeli(date('Y').'-12-16');?> 
		]
      }
    ]
  };

  var cabangChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 5,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  //Create the line chart
  cabangChart.Line(cabangChartData, cabangChartOptions);

  //---------------------------
  //- END MONTHLY CABANG CHART -
  //---------------------------

  /* SPARKLINE CHARTS
   * ----------------
   * Create a inline charts with spark line
   */

  //-----------------
  //- SPARKLINE BAR -
  //-----------------
  $('.sparkbar').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type: 'bar',
      height: $this.data('height') ? $this.data('height') : '30',
      barColor: $this.data('color')
    });
  });

  //-----------------
  //- SPARKLINE PIE -
  //-----------------
  $('.sparkpie').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type: 'pie',
      height: $this.data('height') ? $this.data('height') : '90',
      sliceColors: $this.data('color')
    });
  });

  //------------------
  //- SPARKLINE LINE -
  //------------------
  $('.sparkline').each(function () {
    var $this = $(this);
    $this.sparkline('html', {
      type: 'line',
      height: $this.data('height') ? $this.data('height') : '90',
      width: '100%',
      lineColor: $this.data('linecolor'),
      fillColor: $this.data('fillcolor'),
      spotColor: $this.data('spotcolor')
    });
  });
});
        </script>
