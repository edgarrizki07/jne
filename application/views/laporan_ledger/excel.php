<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_General_Ledger_$uri3.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
  <h3 class="box-title">Akun : <?php echo $account_data['nama']?>  </h3> <?php if($uri4==''){ ?><?php }else{ ?><small class="pull-right">Date : <?php echo $this->jurnal_model->tgl_indo($uri4); ?> - <?php echo $this->jurnal_model->tgl_indo($uri5); ?></small><?php } ?>
	<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>No Bukti</th>
				<th>Keterangan</th>
				<th></th>
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
						echo '<tr>';
						echo '<td>'.$row->tgl.'</td>';
						echo '<td>'.$nomor."/".$kode."/".$no."/".$cab."/".$bln."/".$thn.'</td>';
						echo '<td>'.$row->keterangan.'</td>';
						echo '<td>'.$this->supplier_model->NamaSupplier($row->supplier_id).' '.$this->customer_model->NamaCustomer($customer).'</td>';
						echo '<td class="text-right">'.$d.'</td>';
						echo '<td class="text-right">'.$k.'</td>';	
						echo '<td class="text-center">'.$dk.'</td>';
						echo '<td class="text-right">'.number_format(abs($sum), 0, '', '.').'</td>';				
						echo '</tr>';
					}
				}
			?>
		</tbody>
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
	</table>										
