<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-save').click(function() {
			var proyek = $('#proyek').val();
			var cabang = $('#cabang').val();
			window.open('<?php echo site_url();?>laporan_proyek/report/'+proyek+'/'+cabang);
		});
		$('#button-xls').click(function() {
			var proyek = $('#proyek').val();
			var cabang = $('#cabang').val();
			window.open('<?php echo site_url();?>laporan_proyek/excel/'+proyek+'/'+cabang);
		});
	});
</script>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
<?php
	if($this->session->userdata('SUCCESSMSG'))
	{
		echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>";
		$this->session->unset_userdata('SUCCESSMSG');
	}
?>
<?php
	echo form_open('laporan_proyek/report', 'id="laporanproyek_form"');
	echo "<div id='error' class='alert alert-warning alert-dismissable' ";

	if($this->session->userdata('ERRMSG_ARR'))
	{
		echo ">";
		echo $this->session->userdata('ERRMSG_ARR');
		$this->session->unset_userdata('ERRMSG_ARR');
	}
	else
	{
		echo "style='display:none'>";
	}
	
	echo "</div>";

	$data['class'] = 'input';	
?>

                <div class="box-header with-border">
                  <h3 class="box-title">Buat Laporan Proyek</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			  
	  <table id="example1" class="table table-bordered table-striped">
	<?php if($this->session->userdata('ADMIN') =='1'){ ?>
		<tr>
			<th><?php echo form_label('Cabang','cabang'); ?></th>
			<td>
				<div class="input-group">
				<select name="cabang" id="cabang" class="form-control" >
					<option value="">- Semua Cabang -</option>
				<?php $cab = $this->db->get_where('wp'); $item = $cab->result(); $no=0; foreach($item as $row ): $no++;?>
					<option value="<?php echo $row->id;?>"><?php echo $row->id;?> - <?php echo $row->kota;?></option>
				<?php endforeach;?>
				</select>
				</div>
			</td>
		</tr>
	<?php }else{ ?><input name="cabang" id="cabang" type="hidden" class="form-control" value="<?php echo $this->session->userdata('SESS_WP_ID');?>" />
	<?php } ?>
		<tr>
			<th><?php echo form_label('Nama Proyek','proyek'); ?></th>
			<td>
				<div class="input-group">
				<select name="proyek" id="proyek" class="form-control" >
					<option value="">- Pilih Proyek -</option>
				<?php $cab = $this->db->get_where('proyek'); $item = $cab->result(); $no=0; foreach($item as $row ): $no++;?>
					<option value="<?php echo $row->id;?>"><?php echo $row->id;?> - <?php echo $row->nama;?></option>
				<?php endforeach;?>
				</select>
				</div>
			</td>
		</tr>
	</table>
                </div><!-- /.box-body -->

	<div class="box-footer">
		<div class="btn-group">
		<?php
			echo form_button(array('id' => 'button-save', 'class' => 'btn btn-info', 'content' => 'Buat Laporan'));
			echo form_button(array('id' => 'button-xls', 'class' => 'btn btn-primary', 'content' => 'Buat Excel'));
			echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-success'" );
		?>
		</div>
	</div>
<?php echo form_close(); ?>

              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
