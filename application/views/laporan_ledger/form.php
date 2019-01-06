<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-view').click(function() {
			var akun = $('#akun').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			location.href = '<?php echo site_url();?>laporan_ledger/index/'+akun+'/'+from+'/'+to;
		});
		$('#button-print').click(function() {
			var akun = $('#akun').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>laporan_ledger/report/'+akun+'/'+from+'/'+to);
		});
		$('#button-xls').click(function() {
			var akun = $('#akun').val();
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			window.open('<?php echo site_url();?>laporan_ledger/excel/'+akun+'/'+from+'/'+to);
		});
		$('#button-reset').click(function() {
			var akun = $('#akun').val();
			location.href = '<?php echo site_url();?>laporan_ledger/index/'+akun;
		});
	});
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/group_table.js"></script>
<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4);?>

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
	echo form_open('laporan_ledger/report', 'id="laporanproyek_form"');
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
                  <h3 class="box-title">Laporan General Ledger</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				  <table id="example1" class="table table-bordered table-striped">
					<tr>
						<th><?php echo form_label('Akun','akun'); ?></th>
						<td>
							<div class="input-group">
							<select name="akun" id="akun" class="form-control" required>
								<option value="<?php echo $uri3; ?>">- Pilih Akun -</option>
							<?php if($this->session->userdata('ADMIN') =='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); } ?>
							<?php $this->db->order_by('wp_id', 'asc'); $this->db->order_by('kelompok_akun_id', 'asc'); $this->db->order_by('kode', 'asc'); $cab = $this->db->get_where('akun'); $item = $cab->result(); $no=0; foreach($item as $row ): $no++;?>
								<option value="<?php echo $row->id;?>"><?php if($this->session->userdata('ADMIN') =='1'){ ?><?php echo $this->pajak_model->KotaCabang($row->wp_id);?><?php } ?> <?php echo $row->kode;?> - <?php echo $row->nama;?></option>
							<?php endforeach;?>
							</select>
							</div>
						</td>
					</tr>
					<tr>
						<th><?php echo form_label('Tanggal','from_to'); ?></th>
						<td>
							<?php 
								if($this->uri->segment(4) ==''){$tanggal1=date('Y-m-1');}else{ $tanggal1=$this->uri->segment(4);}
								if($this->uri->segment(5) ==''){$tanggal2=date('Y-m-d');}else{ $tanggal2=$this->uri->segment(5);}
								$tanggalfrom['name'] = 'from';
								$tanggalfrom['id'] = 'datepicker-from';
								$tanggalfrom['class']='form-control';
								$tanggalfrom['value']= $tanggal1;
								echo '<div class="input-group">';
								echo form_input($tanggalfrom);
								echo '<span class="input-group-addon"> s/d </span>';
								$tanggalto['name'] = 'to';
								$tanggalto['id'] = 'datepicker-to';										
								$tanggalto['class']='form-control';
								$tanggalto['value'] = $tanggal2;										
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
						echo form_button(array('id' => 'button-view', 'class' => 'btn btn-info', 'content' => 'Lihat'));
						echo form_button(array('id' => 'button-print', 'class' => 'btn btn-primary', 'content' => 'Cetak'));
						echo form_button(array('id' => 'button-xls', 'class' => 'btn btn-primary', 'content' => 'Excel'));
						echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-success'" );
					?>
					</div>
				</div>
<?php echo form_close(); ?>

              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header with-border">
				<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);?>
                  <h3 class="box-title">Akun : <?php echo $account_data['nama']?>  </h3> <small class="pull-right"><?php if($uri4==''){ ?>Bulan ini<?php }else{ ?>Date : <?php echo $this->jurnal_model->tgl_indo($uri4); ?> - <?php echo $this->jurnal_model->tgl_indo($uri5); ?><?php } ?></small>
                </div><!-- /.box-header -->
                <div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>No Bukti</th>									
				<th>Keterangan</th>
				<th>Debit</th>
				<th>Kredit</th>
				<th>D/K</th>
				<th>Saldo</th>
			</tr>
		</thead>
<?php 
	$saldo_awal = $this->akun_model->SaldoAwalAkun($uri3);
	$SumDebit = number_format($this->jurnal_model->SumDebit($uri3), 0, '', '.'); 
	$SumKredit = number_format($this->jurnal_model->SumKredit($uri3), 0, '', '.'); 
	$SumAll = number_format($this->jurnal_model->SumDebit($uri3)-$this->jurnal_model->SumKredit($uri3)+$this->akun_model->SaldoAwalAkun($uri3), 0, '', '.');
	$SumDebitTgl1 = number_format($this->jurnal_model->SumDebitTgl($uri3,$uri4), 0, '', '.');
	$SumKreditTgl1 = number_format($this->jurnal_model->SumKreditTgl($uri3,$uri4), 0, '', '.');
	$SumDebitTgl2 = number_format($this->jurnal_model->SumDebitTgl($uri3,$uri5), 0, '', '.');
	$SumKreditTgl2 = number_format($this->jurnal_model->SumKreditTgl($uri3,$uri5), 0, '', '.');
	$SumDebitTgl = number_format($this->jurnal_model->SumDebitAll($uri3,$uri4,$uri5), 0, '', '.');
	$SumKreditTgl = number_format($this->jurnal_model->SumKreditAll($uri3,$uri4,$uri5), 0, '', '.');
	$NSaldoAwal = $this->jurnal_model->SumDebitTgl($uri3,$uri4)-$this->jurnal_model->SumKreditTgl($uri3,$uri4)+$this->akun_model->SaldoAwalAkun($uri3);
	$SaldoAwal = number_format($this->jurnal_model->SumDebitTgl($uri3,$uri4)-$this->jurnal_model->SumKreditTgl($uri3,$uri4)+$this->akun_model->SaldoAwalAkun($uri3), 0, '', '.');
	$SaldoAkhir = number_format($NSaldoAwal+$this->jurnal_model->SumDebitAll($uri3,$uri4,$uri5)-$this->jurnal_model->SumKreditAll($uri3,$uri4,$uri5), 0, '', '.');
?>
		<tfoot>
		<?php if($uri4==''){ ?>
			<tr class="text-bold">
				<td colspan="3">TOTAL</td>
				<td class="text-right"><?php echo $SumDebit;?></td>
				<td class="text-right"><?php echo $SumKredit;?></td>
				<td></td>
				<td class="text-right"><?php echo $SumAll;?></td>
			</tr>
		<?php }else{ ?>
			<tr class="text-bold">
				<td colspan="3">TOTAL</td>
				<td class="text-right"><?php echo $SumDebitTgl;?></td>
				<td class="text-right"><?php echo $SumKreditTgl;?></td>
				<td></td>
				<td class="text-right"><?php echo $SaldoAkhir;?></td>
			</tr>
		<?php } ?>
		</tfoot>
		<tbody>
			<?php 
				// Saldo Awal
				$sum = 0;
				if ($account_data['saldo_awal'] != 0)
				{
				  if($uri3==''){
					$sum = $account_data['saldo_awal'];
				  }else{
					$sum = $NSaldoAwal;
				  }
					if ($sum < 0)
					{
						$d = '';
						$k = number_format(-$sum, 0, '', '.');
						$dk = 'K';
					}
					else
					{
						$d = number_format($sum, 0, '', '.');
						$k = '';
						$dk = 'D';
					}
					echo '<tr>';
					echo '<td></td>';
					echo '<td>Saldo Awal</td>';
					echo '<td></td>';
					echo '<td class="text-right">'.$d.'</td>';
					echo '<td class="text-right">'.$k.'</td>';	
					echo '<td class="text-center">'.$dk.'</td>';
					echo '<td class="text-right">'.number_format(abs($sum), 0, '', '.').'</td>';				
					echo '</tr>';
				}


				
				if($journal_data)
				{
					foreach ($journal_data as $row) 
					{ 
						if($row->debit_kredit == 1)
						{
							$sum += $row->nilai;
							$d = number_format($row->nilai, 0, '', '.');
							$k = '';
						}
						else
						{
							$sum -= $row->nilai;
							$d = '';
							$k = number_format($row->nilai, 0, '', '.');
						}
						$dk = ($sum>=0) ? 'D' : 'K';
						$customer = $row->customer_id;
						$nomor = $row->no_voucher; 
						$cabang = $this->pajak_model->KotaCabang($row->wp_id); 
						$kode=$this->jurnal_model->KodeVoucher($row->voucher_id); 
						$no = $row->id;
						$cab = $this->pajak_model->KodeCabang($row->wp_id);
						$singkatan=$this->setting_model->singkatan();
						$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl)); 
						$thn=$this->jurnal_model->ambilThn($row->tgl); 
						$blnthn=$this->jurnal_model->thn_bln($row->tgl); 
						if($row->customer_id == 0){ $jur="jurnal"; }else{ $jur="jurnal_proyek"; }
						echo '<tr>';
						echo '<td>'.anchor(site_url().$jur."/view/".$row->id, $row->tgl).'</td>'; 							
						echo '<td>'.anchor(site_url().$jur."/view/".$row->id, $nomor."/".$kode."/".$no."/".$cab."/".$bln."/".$thn).'</td>'; 							
						echo '<td>'.$row->keterangan.' '.$this->supplier_model->NamaSupplier($row->supplier_id).' '.$this->customer_model->NamaCustomer($customer).'</td>';
						echo '<td class="text-right">'.$d.'</td>';
						echo '<td class="text-right">'.$k.'</td>';	
						echo '<td class="text-center">'.$dk.'</td>';
						echo '<td class="text-right">'.number_format(abs($sum), 0, '', '.').'</td>';				
						echo '</tr>';
					}
				}
			?>
		</tbody>
	</table>										
                </div><!-- /.box-body -->
			  </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
