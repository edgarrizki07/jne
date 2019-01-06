<script type="text/javascript" src="<?php echo base_url();?>js/group_table.js"></script>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-view').click(function() {
			var kategori = $('#kategori').val();
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			location.href = '<?php echo site_url();?>kategori/akun/'+kategori+'/'+from+'/'+to+'/'+cabang;
		});
		$('#button-print').click(function() {
			var kategori = $('#kategori').val();
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>kategori/akun_pdf/'+kategori+'/'+from+'/'+to+'/'+cabang);
		});
		$('#button-xls').click(function() {
			var kategori = $('#kategori').val();
			var cabang = $('#cabang').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>kategori/akun_excel/'+kategori+'/'+from+'/'+to+'/'+cabang);
		});
		$('#button-reset').click(function() {
			var kategori = $('#kategori').val();
			location.href = '<?php echo site_url();?>kategori/akun/'+kategori;
		});
	});
</script>
<?php

	$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);
	$tgl0b = strtotime('-1 day',strtotime($uri4));
	$tgl0c = date('Y-m-d', $tgl0b);
	$tgl0 = date('d-m-Y', $tgl0b);
	$tgl1 = $this->jurnal_model->tgl_str($this->uri->segment(4));
	$tgl2 = $this->jurnal_model->tgl_str($this->uri->segment(5));
	$tgl3b = strtotime('+1 day',strtotime($uri5));
	$tgl3c = date('Y-m-d', $tgl3b);
	$tgl3 = date('d-m-Y', $tgl3b);
	$one = date("Y-m-1");
	$now = date("Y-m-d");
	$sekarang = date("d-m-Y");
	$kategori = $this->akun_model->NamaJenis($this->uri->segment(3));

	$KatDebit = number_format($this->jurnal_model->KatDebit($uri3), 0, '', '.'); 
	$KatKredit = number_format($this->jurnal_model->KatKredit($uri3), 0, '', '.'); 
	
	$KatDebitTgl1 = number_format($this->jurnal_model->KatDebitTgl($uri3,$uri4), 0, '', '.');
	$KatKreditTgl1 = number_format($this->jurnal_model->KatKreditTgl($uri3,$uri4), 0, '', '.');
	$KatDebitTgl2 = number_format($this->jurnal_model->KatDebitTgl($uri3,$uri5), 0, '', '.');
	$KatKreditTgl2 = number_format($this->jurnal_model->KatKreditTgl($uri3,$uri5), 0, '', '.');

	$KatDebitTgl = number_format($this->jurnal_model->KatDebitAll($uri3,$uri4,$uri5), 0, '', '.');
	$KatKreditTgl = number_format($this->jurnal_model->KatKreditAll($uri3,$uri4,$uri5), 0, '', '.');
	$KatDebitBulanIni = number_format($this->jurnal_model->KatDebitAll($uri3,$one,$now), 0, '', '.');
	$KatKreditBulanIni = number_format($this->jurnal_model->KatKreditAll($uri3,$one,$now), 0, '', '.');
	$KatDebitBulanLalu = number_format($this->jurnal_model->KatDebit($uri3)-$this->jurnal_model->KatDebitAll($uri3,$one,$now), 0, '', '.');
	$KatKreditBulanLalu = number_format($this->jurnal_model->KatKredit($uri3)-$this->jurnal_model->KatKreditAll($uri3,$one,$now), 0, '', '.');

	$KatDebitTglP = number_format($this->jurnal_model->KatDebitAll($uri3,'1900-01-01',$tgl0c), 0, '', '.');
	$KatKreditTglP = number_format($this->jurnal_model->KatKreditAll($uri3,'1900-01-01',$tgl0c), 0, '', '.');
	$KatDebitTglN = number_format($this->jurnal_model->KatDebitAll($uri3,$tgl3c,$now), 0, '', '.');
	$KatKreditTglN = number_format($this->jurnal_model->KatKreditAll($uri3,$tgl3c,$now), 0, '', '.');

	$sum = $this->jurnal_model->KatDebit($uri3)-$this->jurnal_model->KatKredit($uri3); 
	if ($sum < 0)
	{
		$db = '';
		$kd = number_format(-$sum, 0, '', '.');
	}
	else
	{
		$db = number_format($sum, 0, '', '.');
		$kd = '';
	}
?> 

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?> <?php echo $this->akun_model->NamaJenis($this->uri->segment(3)); ?> 
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
                <div class="box-header with-border">
                  <h3 class="box-title"><b>Jurnal <?php echo $title; ?> <?php echo $this->akun_model->NamaJenis($this->uri->segment(3)); ?></b> 
				  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<select name="kategori" id="kategori" class="hidden" >
							<option value="<?php echo $this->uri->segment(3); ?>"></option>
						</select>
						<tr>
							<th><?php if($uri4==''){ ?>Bulan ini<?php }else{ ?>Date : <?php echo $this->jurnal_model->tgl_indo($uri4); ?> - <?php echo $this->jurnal_model->tgl_indo($uri5); ?><?php } ?></th>
							<th>Debit</th>
							<th>Credit</th>
						</tr>	
						<?php if($uri4==''){ ?>
						<tr>
							<th>BULAN INI</th>
							<td><?php echo $KatDebitBulanIni; ?></td>	
							<td><?php echo $KatKreditBulanIni; ?></td>	
						</tr>	
						<tr>
							<th>BULAN SEBELUMNYA</th>
							<td><?php echo $KatDebitBulanLalu; ?></td>	
							<td><?php echo $KatKreditBulanLalu; ?></td>	
						</tr>	
						<?php }else{ ?>
						<tr>
							<th>TGL : <?php echo $tgl1; ?> sd <?php echo $tgl2; ?></th>
							<td><?php echo $KatDebitTgl; ?></td>	
							<td><?php echo $KatKreditTgl; ?></td>	
						</tr>	
						<tr>
							<th>TGL : Semua sd <?php echo $tgl0; ?></th>
							<td><?php echo $KatDebitTglP; ?></td>	
							<td><?php echo $KatKreditTglP; ?></td>	
						</tr>	
							<?php if($uri5 > $now){ ?><?php }else{ ?>
						<tr>
							<th>TGL : <?php echo $tgl3; ?> sd <?php echo $sekarang; ?></th>
							<td><?php echo $KatDebitTglN; ?></td>	
							<td><?php echo $KatKreditTglN; ?></td>	
						</tr>	
							<?php } ?>
						<?php } ?>
						<tr>
							<th>SEMUA</th>
							<td><?php echo $KatDebit; ?></td>	
							<td><?php echo $KatKredit; ?></td>	
						</tr>	
						<tr>
							<th>SALDO</th>
							<td><?php echo $db; ?></td>	
							<td><?php echo $kd; ?></td>	
						</tr>	
					</table>
                </div><!-- /.box-body -->
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
						<select name="kategori" id="kategori" class="hidden" >
							<option value="<?php echo $this->uri->segment(3); ?>"></option>
						</select>
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
							<th><?php echo form_label('Tanggal','from_to'); ?></th>
							<td>
								<?php 
									if($this->uri->segment(5) ==''){$tanggal=date('Y-m-d');}else{ $tanggal=$this->uri->segment(5);}
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
				<th><?php echo $this->akun_model->NamaJenis($this->uri->segment(3)); ?></th>
				<th>Nomor</th>
			<?php if($this->session->userdata('ADMIN') =='1'){ ?>
				<th>Cabang</th>
			<?php } ?>
				<th>Jurnal</th>	
				<th>Voucher</th>
				<th>Akun</th>
				<th>Debit</th>
				<th>Credit</th>
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
						$kode=$this->jurnal_model->KodeVoucher($row->voucher_id); 
						$cabang = $this->pajak_model->KotaCabang($row->wp_id); 
						$no = $row->id;
						$cab = $this->pajak_model->KodeCabang($row->wp_id);
						$singkatan=$this->setting_model->singkatan();
						$customer1=$this->customer_model->NamaCustomer($row->customer_id); 
						$customer2=$this->customer_model->CPCustomer($row->customer_id); 
						$supplier1=$this->supplier_model->NamaSupplier($row->id); 
						$supplier2=$this->supplier_model->CPSupplier($row->id); 
						$other1=$this->user_model->NamaUser($row->other_id); 
						$other2=$this->user_model->NamaBUser($row->other_id); 
						$voucher=$this->jurnal_model->ProyekVoucher($row->voucher_id); 
						$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl)); 
						$thn=$this->jurnal_model->ambilThn($row->tgl); 
						$blnthn=$this->jurnal_model->thn_bln($row->tgl); 
						$j = $this->jurnal_model->FJurnal($row->f_id);
						$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
						echo '<tr>';
						echo '<td><b>'.$blnthn.'</b></td>';
						echo '<td>'.$row->id."-".$row->item.'</td>';
						if($row->customer_id == 0){ 
						echo '<td>'.anchor(site_url()."jurnal/view/".$row->id, $row->tgl).'</td>';
						echo '<td>'.$other1." ".$other2.'</td>';
						}else{ 
						echo '<td>'.anchor(site_url()."jurnal_proyek/view/".$row->id, $row->tgl).'</td>';
							if($voucher == 1){ 
							echo '<td>'.$supplier1." - ".$supplier2.'</td>';
							}else{ 
							echo '<td>'.$customer1." - ".$customer2.'</td>';
							}
						}
						echo '<td>'.$nomor."/".$kode."/".$no."/".$cab."/".$bln."/".$thn.'</td>';
						if($this->session->userdata('ADMIN') =='1'){
						echo '<td>'.$cabang.'</td>';	
						}
						echo '<td>'.$j.' '.$p.'</td>';	
						echo '<td>'.$v.'</td>';	
						echo '<td>'.$row->kelompok_akun_id."-".$row->kode." ".$row->account_name.'</td>';
						echo '<td class="text-right">'.$d.'</td>';
						echo '<td class="text-right">'.$k.'</td>';	
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
