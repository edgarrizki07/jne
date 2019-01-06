<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-save').click(function() {
			var jenis_laporan = $('#jenis_laporan').val();
			var group = $('#group').val();
			var cabang = $('#cabang').val();
			var bulan = $('#bulan').val();
			var tahun = $('#tahun').val();
			window.open('<?php echo site_url();?>laporan_keuangan/'+jenis_laporan+'/'+bulan+'/'+tahun+'/'+cabang+'/'+group);
		});
		$('#button-xls').click(function() {
			var jenis_laporan = $('#jenis_laporan').val();
			var group = $('#group').val();
			var cabang = $('#cabang').val();
			var bulan = $('#bulan').val();
			var tahun = $('#tahun').val();
			window.open('<?php echo site_url();?>laporan_keuangan/'+jenis_laporan+'_excel/'+bulan+'/'+tahun+'/'+cabang+'/'+group);
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
                  <h3 class="box-title">Buat Laporan Keuangan</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			  
	  <table id="example1" class="table table-bordered table-striped">
	<?php if($this->session->userdata('ADMIN') =='1'){ ?>
		<tr>
			<th><?php echo form_label('Cabang','cabang'); ?></th>
			<td>
				<div class="input-group">
				<select name="cabang" id="cabang" class="form-control" >
					<option value="0">- Semua Cabang -</option>
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
			<th><?php echo form_label('Pengelompokan','group'); ?></th>
			<td>
				<div class="input-group">
				<select name="group" id="group" class="form-control" >
					<option value="1">- Kepala Akun -</option>
					<option value="2">- Kategori Akun -</option>
					<option value="3">- Sub Kategori Akun -</option>
					<option value="4">- Akun -</option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Jenis Laporan','jenis_laporan'); ?></th>
			<td>
				<?php 
					$data['id'] = 'jenis_laporan';
					$data['class'] = 'form-control';
					$selected = 'laporan_neraca';
					$options = array( 'laporan_laba_rugi' => 'Laporan Laba Rugi',
								  	  // 'laporan_perubahan_modal' => 'Laporan Perubahan Modal',
								  	  // 'laporan_neraca' => 'Laporan Neraca',
								  	  // 'laporan_neraca_saldo_sebelum_penyesuaian' => 'Laporan Neraca Saldo Sebelum Penyesuaian',
								  	  // 'laporan_neraca_saldo_setelah_penyesuaian' => 'Laporan Neraca Saldo Setelah Penyesuaian',
								  	  'laporan_neraca' => 'Laporan Neraca');
					echo form_dropdown('jenis_laporan', $options, $selected, $data);
				?>					
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Bulan','bulan'); ?></th>
			<td>
				<?php 
					$data['id'] = 'bulan';
					$data['class'] = 'form-control';
					$selected = date("m");
					echo form_dropdown('bulan', $months, $selected, $data);
				?>					
			</td>
		</tr>	
		<tr>
			<th><?php echo form_label('Tahun','tahun'); ?></th>
			<td>
				<?php 
					$data['id'] = 'tahun';
					$data['class'] = 'form-control';
					$selected = date("Y");
					echo form_dropdown('tahun', $years, $selected, $data);
				?>					
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

              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
