<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);?>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-view').click(function() {
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			location.href = '<?php echo site_url();?>tawaran/filter/'+cabang+'/'+from+'/'+to;
		});
		$('#button-print').click(function() {
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>tawaran/filter_pdf/'+cabang+'/'+from+'/'+to);
		});
		$('#button-xls').click(function() {
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>tawaran/filter_excel/'+cabang+'/'+from+'/'+to);
		});
		$('#button-reset').click(function() {
			location.href = '<?php echo site_url();?>tawaran/rekap';
		});
	});
</script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title;?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>
	<?php
		if($this->session->userdata('SUCCESSMSG')) {
			echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>";
			$this->session->unset_userdata('SUCCESSMSG');
		}
	?>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
					  <h3 class="box-title">Filter <?php echo $title; ?></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<select name="voucher" id="voucher" class="hidden" >
								<option value="<?php echo $this->uri->segment(3); ?>"></option>
							</select>
						<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<tr>
								<th><?php echo form_label('Cabang','cabang'); ?></th>
								<td>
									<div class="input-group">
									<select name="cabang" id="cabang" class="form-control" >
									<?php if($this->uri->segment(3) == 0){  ?>
										<option value="0">- Semua Cabang -</option>
									<?php }else{  ?>
										<option value="<?php echo $uri3; ?>"><?php echo $this->pajak_model->KotaCabang($uri3); ?></option>
										<option value="0">- Semua Cabang -</option>
									<?php } ?>
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
								<th><?php echo form_label('Tanggal','from_to'); ?></th>
								<td>
									<?php 
										$tanggalfrom['name'] = 'from';
										$tanggalfrom['id'] = 'datepicker-from';
										$tanggalfrom['class']='form-control';
										$tanggalfrom['value']= $this->uri->segment(4);
										echo '<div class="input-group">';
										echo form_input($tanggalfrom);
										echo '<span class="input-group-addon"> s/d </span>';
										$tanggalto['name'] = 'to';
										$tanggalto['id'] = 'datepicker-to';										
										$tanggalto['class']='form-control';
										$tanggalto['value'] = $this->uri->segment(5);										
										echo form_input($tanggalto);
										echo '</div>';
									?>					
								</td>	
							</tr>	
						</table>
					</div><!-- /.box-body -->
					<div class="box-footer">
						<div class="btn-group">
						<?php
							echo form_button('cari', 'Cari', "id = 'button-view', class = 'btn btn-info'" );
							echo form_button('cari', 'Cetak', "id = 'button-print', class = 'btn btn-primary'" );
							echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-success'" );
						?>
						</div>
						<div class="btn-group">
						  <a target="_blank" href="<?php echo site_url();?>tawaran/add" class="btn btn-warning"><i class="fa fa-plus"></i> Tambah Penawaran</a>
						</div>
						<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);?>
						<small class="pull-right"><?php if($uri4==''){ ?>Semua<?php }else{ ?>Date : <?php echo $this->jurnal_model->tgl_indo($uri4); ?> - <?php echo $this->jurnal_model->tgl_indo($uri5); ?><?php } ?></small>
					</div>
					<div class="box-body">
						<table id="group_table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>ID</th>
									<th>Tgl</th>
								<?php if($this->session->userdata('ADMIN')=='1'){ ?>
									<th>Cabang</th>
								<?php } ?>
									<th>Customer</th>
									<th>Harga Dasar</th>
									<th>PPN</th>
									<th>PPH</th>
									<th>PBBKB</th>
									<th>Harga Include</th>
								</tr>
							</thead>
	
<?php if($info->num_rows()>0){
		$vol=0;
		$g_total=0;
		$no =1;
		foreach($info->result_array() as $db){
		?>    
	<?php $item = '1'; $jml=$db['harga'];
		$disctotal=$jml; 
		$ppn=$disctotal/10*($db['ppn']);
		$pbbkb=$disctotal*($db['npbbkb']/100)*($db['pbbkb']); 
		$pph=$disctotal*3/1000*($db['pph']); 
?>
	<tbody>
		<tr>
			<td><?php echo $no;?></td>
			<td align="center"><a  href="<?php echo site_url('tawaran/view/'.$db['id']);?>"><?php echo $db['id_tawaran'];?>/PO/<?php echo $this->pajak_model->KodeCabang($db['wp_id']);?>/<?php echo $db['id'];?></a></td>
			<td align="center"><?php echo $this->app_model->tgl_str($db['tgl']);?></td>
		<?php if($this->session->userdata('ADMIN') =='1'){ ?>
			<td><?php echo $this->pajak_model->KotaCabang($db['wp_id']);?> - <?php echo $this->user_model->NamaUser($db['login_id']);?></td>
		<?php } ?>
			<td><b><?php echo $this->customer_model->NamaCustomer($db['customer_id']);?></b> - <?php echo $this->customer_model->CPCustomer($db['customer_id']);?></td>
			<td><b class="pull-right"><?php echo number_format ($jml, 0, ',', '.');?></b></td>
			<td>PPN <a class="pull-right"><?php echo number_format ($ppn, 0, ',', '.');?></a></td>
			<td>PPh <a class="pull-right"><?php echo number_format ($pph, 0, ',', '.');?></a></td>
			<td>PBBKB <a class="pull-right"><?php echo number_format ($pbbkb, 0, ',', '.');?></a></td>
			<td><b class="pull-right"><?php echo number_format ($db['include'], 0, ',', '.');?></b></td>
		</tr>
	</tbody>
    <?php
		$no++;
		$vol = $vol;
		}
	}else{ $g_total =0;	?>
    <tfoot>
    	<tr>
        	<td colspan="9" align="center" >Tidak Ada Data</td>
        </tr>
    </tfoot>
    <?php } ?>
<?php if($g_total=='0'){ ?><?php }else{ ?><?php } ?>
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
				
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
