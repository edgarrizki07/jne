<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);?>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-view').click(function() {
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			location.href = '<?php echo site_url();?>beli/filter/'+cabang+'/'+from+'/'+to;
		});
		$('#button-print').click(function() {
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>beli/filter_pdf/'+cabang+'/'+from+'/'+to);
		});
		$('#button-xls').click(function() {
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>beli/filter_excel/'+cabang+'/'+from+'/'+to);
		});
		$('#button-reset').click(function() {
			location.href = '<?php echo site_url();?>beli/rekap';
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
							echo form_button('cari', 'Excel', "id = 'button-xls', class = 'btn btn-primary'" );
							echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-success'" );
						?>
						</div>
						<div class="btn-group">
						  <a target="_blank" href="<?php echo site_url();?>beli/add_out" class="btn btn-warning"><i class="fa fa-plus"></i> Tambah PO</a>
						</div>
						<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);?>
						<small class="pull-right"><?php if($uri4==''){ ?><?php }else{ ?>Date : <?php echo $this->jurnal_model->tgl_indo($uri4); ?> - <?php echo $this->jurnal_model->tgl_indo($uri5); ?><?php } ?></small>
					</div>
				</div><!-- /.box -->
				
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
