<script type="text/javascript" src="<?php echo base_url();?>js/group_table.js"></script>
<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5); $uri6 = $this->uri->segment(6);?>

<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-view').click(function() {
			var voucher = $('#voucher').val();
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			location.href = '<?php echo site_url();?>voucher/jurnal/'+voucher+'/'+cabang+'/'+from+'/'+to;
		});
		$('#button-print').click(function() {
			var voucher = $('#voucher').val();
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>voucher/jurnal_pdf/'+voucher+'/'+cabang+'/'+from+'/'+to);
		});
		$('#button-xls').click(function() {
			var voucher = $('#voucher').val();
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>voucher/jurnal_excel/'+voucher+'/'+cabang+'/'+from+'/'+to);
		});
		$('#button-reset').click(function() {
			var voucher = $('#voucher').val();
			location.href = '<?php echo site_url();?>voucher/jurnal/'+voucher;
		});
	});
</script>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?> <?php echo $this->jurnal_model->JenisVoucher($this->uri->segment(3)); ?> 
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
					if($this->session->userdata('SUCCESSMSG')) {
						echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>";
						$this->session->unset_userdata('SUCCESSMSG');
					}
				?>
	<div id="dialog-form"></div>
	<div class="clearer"></div>

<?php
	$data['class'] = 'input';	

	echo form_open();

?>
                <div class="box-header with-border">
                  <h3 class="box-title">Pencarian Jurnal</h3>
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
					<?php if($this->uri->segment(4) == 0){  ?>
						<option value="0">- Semua Cabang -</option>
					<?php }else{  ?>
						<option value="<?php echo $uri4; ?>"><?php echo $this->pajak_model->KotaCabang($uri4); ?></option>
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
					if($this->uri->segment(6) ==''){$tanggal=date('Y-m-d');}else{ $tanggal=$this->uri->segment(6);}
					$tanggalfrom['name'] = 'from';
					$tanggalfrom['id'] = 'datepicker-from';
					$tanggalfrom['class']='form-control';
					$tanggalfrom['value']= $this->uri->segment(5);
					echo '<div class="input-group">';
					echo form_input($tanggalfrom);
					echo '<span class="input-group-addon"> s/d </span>';
					$tanggalto['name'] = 'to';
					$tanggalto['id'] = 'datepicker-to';										
					$tanggalto['class']='form-control';
					$tanggalto['value'] = $tanggal ;										
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
						<?php if($this->jurnal_model->ProyekVoucher($this->uri->segment(3)) == 0){  ?>
						  <a target="_blank" href="<?php echo site_url('jurnal/jurnal_umum/'.$this->uri->segment(3));?>" class="btn btn-warning"><i class="fa fa-plus"></i> Jurnal Umum</a>
						<?php }else{  ?>
						<?php } ?>
					</div>
					<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);?>
					<small class="pull-right"><?php if($uri5==''){ ?>Bulan ini<?php }else{ ?>Date : <?php echo $this->jurnal_model->tgl_indo($uri5); ?> - <?php echo $this->jurnal_model->tgl_indo($uri6); ?><?php } ?></small>
				</div>
	
<?php echo form_fieldset_close(); ?>
<?php echo form_close(); ?>

                <div class="box-body">
	<table id="group_table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Bulan</th>
				<th>ID</th>
				<th>Tanggal</th>
				<th>Nomor</th>
			<?php if($this->session->userdata('ADMIN') =='1'){ ?>
				<th>Cabang</th>
			<?php } ?>
				<th>Jurnal</th>	
				<th>Akun</th>
				<th>Debit</th>
				<th>Credit</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php			
				if($journal_data)
				{
					$i = 0;
					foreach ($journal_data as $row)
					{
						if($row->debit_kredit == 1)
						{
							$d = number_format(($row->nilai), 0, '', '.');
							$k = '';
						}
						else
						{
							$d = '';
							$k = number_format(($row->nilai), 0, '', '.');
						}
						if($row->customer_id == 0){ $p=''; }else{ $p='B'; }
						$nomor = $row->no_voucher; 
						$cabang = $this->pajak_model->KotaCabang($row->wp_id); 
						$kode=$this->jurnal_model->KodeVoucher($row->voucher_id); 
						$no = $row->id;
						$cab = $this->pajak_model->KodeCabang($row->wp_id);
						$singkatan=$this->setting_model->singkatan();
						$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl)); 
						$thn=$this->jurnal_model->ambilThn($row->tgl); 
						$blnthn=$this->jurnal_model->thn_bln($row->tgl); 
						$j = $this->jurnal_model->FJurnal($row->f_id);
						$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
						echo '<tr>';
						echo '<td><b>'.$blnthn.'</b></td>';
						echo '<td>'.$row->id."-".$row->item.'</td>';
						if($row->customer_id == 0){ $jur="jurnal"; }else{ $jur="jurnal_proyek"; }
						echo '<td>'.anchor(site_url().$jur."/view/".$row->id, $row->tgl).'</td>';
						echo '<td>'.$nomor."/".$kode."/".$no."/".$cab."/".$bln."/".$thn.'</td>';
						if($this->session->userdata('ADMIN') =='1'){
						echo '<td>'.$cabang.'</td>';	
						}
						echo '<td>'.$j.' '.$p.'</td>';	
						echo '<td>'.$row->kelompok_akun_id."-".$row->kode." ".$row->account_name.'</td>';
						echo '<td class="text-right">'.$d.'</td>';
						echo '<td class="text-right">'.$k.'</td>';	
						echo '<td class="text-right">'.anchor(site_url().$jur."/view/".$row->id, 'Lihat').' | '.anchor(site_url()."jurnal/hapus/".$uri3."/".$row->id, 'Hapus').'</td>'; 							
						echo '</tr>';
						$i++;
					}
				}
			?>		
		</tbody>	
	</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
