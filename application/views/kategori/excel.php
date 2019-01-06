<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Jurnal_Kategori_$uri3.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
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
  <h3 class="box-title"><?php echo $title; ?> <?php echo $this->akun_model->NamaJenis($this->uri->segment(3)); ?> </h3> <?php if($uri4==''){ ?><?php }else{ ?><h4 class="pull-right">Date : <?php echo $this->jurnal_model->tgl_indo($uri4); ?> - <?php echo $this->jurnal_model->tgl_indo($uri5); ?></h4><?php } ?>
	<table id="group_table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Bulan</th>
				<th>ID</th>
				<th>Tanggal</th>
				<th>Nomor</th>
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
						echo '<td>'.$row->tgl.'</td>';
						echo '<td>'.$nomor."/".$kode."/".$no."/".$cab."/".$bln."/".$thn.'</td>';
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
		<tfoot>
			<?php if($uri4==''){ ?>
			<tr>
				<th colspan="7">BULAN INI</th>
				<td><?php echo $KatDebitBulanIni; ?></td>	
				<td><?php echo $KatKreditBulanIni; ?></td>	
			</tr>	
			<tr>
				<th colspan="7">BULAN SEBELUMNYA</th>
				<td><?php echo $KatDebitBulanLalu; ?></td>	
				<td><?php echo $KatKreditBulanLalu; ?></td>	
			</tr>	
			<?php }else{ ?>
			<tr>
				<th colspan="7">TGL : <?php echo $tgl1; ?> sd <?php echo $tgl2; ?></th>
				<td><?php echo $KatDebitTgl; ?></td>	
				<td><?php echo $KatKreditTgl; ?></td>	
			</tr>	
			<tr>
				<th colspan="7">TGL : Semua sd <?php echo $tgl0; ?></th>
				<td><?php echo $KatDebitTglP; ?></td>	
				<td><?php echo $KatKreditTglP; ?></td>	
			</tr>	
				<?php if($uri5 > $now){ ?><?php }else{ ?>
			<tr>
				<th colspan="7">TGL : <?php echo $tgl3; ?> sd <?php echo $sekarang; ?></th>
				<td><?php echo $KatDebitTglN; ?></td>	
				<td><?php echo $KatKreditTglN; ?></td>	
			</tr>	
				<?php } ?>
			<?php } ?>
			<tr>
				<th colspan="7">SEMUA</th>
				<td><?php echo $KatDebit; ?></td>	
				<td><?php echo $KatKredit; ?></td>	
			</tr>	
			<tr>
				<th colspan="7">SALDO</th>
				<td><?php echo $db; ?></td>	
				<td><?php echo $kd; ?></td>	
			</tr>	
		</tfoot>
	</table>
