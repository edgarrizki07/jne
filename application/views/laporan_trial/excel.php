<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_Trial_Balance.xls");
header("Pragma: no-cache");
header("Expires: 0");
$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);
if($uri5==''){	$cabang = 'Semua'; 	}else{	$cabang = $this->pajak_model->KotaCabang($uri5); 	}
$nama = $this->setting_model->Nama(); 
$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID')); 
$kota = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID')); 
$tgl1 = $this->jurnal_model->tgl_str($this->uri->segment(3));
$tgl2 = $this->jurnal_model->tgl_str($this->uri->segment(4));
$sekarang = date("d-m-Y");
?>
  <h3 class="box-title">Trial Balance </h3> <?php if($uri3==''){ ?><?php }else{ ?><h4 class="pull-right">Date : <?php echo $this->jurnal_model->tgl_indo($uri3); ?> - <?php echo $this->jurnal_model->tgl_indo($uri4); ?></h4><?php } ?>
	  <table id="group_table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Grup</th>
			<?php if($uri5==''){ ?>
				<th>Cabang</th>
			<?php } ?>
				<th>Kode</th>
				<th>Nama Perkiraan</th>
				<th>Saldo Awal</th>									
				<th>Mutasi Debit</th>									
				<th>Mutasi Credit</th>									
				<th>Saldo Akhir</th>									
			</tr>
		</thead>
		<tbody>		
			<?php
				if($account_data)
				{
					foreach ($account_data as $row) 
					{
					$SumDebit = $this->jurnal_model->SumDebit($row->id);
					$SumKredit = $this->jurnal_model->SumKredit($row->id);
					$SumDebitTgl1 = $this->jurnal_model->SumDebitTgl($row->id,$uri3);
					$SumKreditTgl1 = $this->jurnal_model->SumKreditTgl($row->id,$uri3);
					$SumDebitTgl2 = $this->jurnal_model->SumDebitTgl($row->id,$uri4);
					$SumKreditTgl2 = $this->jurnal_model->SumKreditTgl($row->id,$uri4);
					$SumDebitTgl = $SumDebitTgl2-$SumDebitTgl1;
					$SumKreditTgl = $SumKreditTgl2-$SumKreditTgl1;
					$SaldoAwal = $SumDebitTgl1-$SumKreditTgl1+$row->saldo_awal;
					$SaldoAkhir = $SumDebitTgl2-$SumKreditTgl2+$row->saldo_awal;
					if($uri3==''){
						$Debit = $SumDebit; $Kredit = $SumKredit; $Saldo_Awal = $row->saldo_awal; $Saldo_Akhir = $row->saldo_awal+$row->saldo;
					}else{
						$Debit = $SumDebitTgl; $Kredit = $SumKreditTgl; $Saldo_Awal = $SaldoAwal; $Saldo_Akhir = $SaldoAkhir;
					}
						echo '<tr>';
						echo '<td>'.$row->kelompok_akun_id." - ".$row->groups_name.'</td>';
						if($uri5==''){ echo '<td>'.$this->pajak_model->KotaCabang($row->wp_id).'</td>';		}
						echo '<td>'.$row->kode.'</td>';
						echo '<td>'.$row->nama.'</td>';
						echo '<td class="text-right">'.number_format(($Saldo_Awal), 0, '', '.').'</td>';						
						echo '<td class="text-right">'.number_format(($Debit), 0, '', '.').'</td>';						
						echo '<td class="text-right">'.number_format(($Kredit), 0, '', '.').'</td>';						
						echo '<td class="text-right">'.number_format(($Saldo_Akhir), 0, '', '.').'</td>';						
						echo '</tr>';
					}
				}
$saldo_awal = $this->akun_model->TotalSaldoAwal();
if($uri5==''){
$TotalDebitTgl1 = $this->jurnal_model->TotalDebitTgl($uri3);
$TotalKreditTgl1 = $this->jurnal_model->TotalKreditTgl($uri3);
$TotalDebitTgl2 = $this->jurnal_model->TotalDebitTgl($uri4);
$TotalKreditTgl2 = $this->jurnal_model->TotalKreditTgl($uri4);
$TotalDebitTgl = number_format(($TotalDebitTgl2-$TotalDebitTgl1), 0, '', '.');
$TotalKreditTgl = number_format(($TotalKreditTgl2-$TotalKreditTgl1), 0, '', '.');
$TotalSaldoAwal = number_format(($TotalDebitTgl1-$TotalKreditTgl1+$saldo_awal), 0, '', '.');
$TotalSaldoAkhir = number_format(($TotalDebitTgl2-$TotalKreditTgl2+$saldo_awal), 0, '', '.');
}else{	
$CabTotalDebitTgl1 = $this->jurnal_model->CabTotalDebitTgl($uri3,$uri5);
$CabTotalKreditTgl1 = $this->jurnal_model->CabTotalKreditTgl($uri3,$uri5);
$CabTotalDebitTgl2 = $this->jurnal_model->CabTotalDebitTgl($uri4,$uri5);
$CabTotalKreditTgl2 = $this->jurnal_model->CabTotalKreditTgl($uri4,$uri5);
$TotalDebitTgl = number_format(($CabTotalDebitTgl2-$CabTotalDebitTgl1), 0, '', '.');
$TotalKreditTgl = number_format(($CabTotalKreditTgl2-$CabTotalKreditTgl1), 0, '', '.');
$TotalSaldoAwal = number_format(($CabTotalDebitTgl1-$CabTotalKreditTgl1+$saldo_awal), 0, '', '.');
$TotalSaldoAkhir = number_format(($CabTotalDebitTgl2-$CabTotalKreditTgl2+$saldo_awal), 0, '', '.');
}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th></th>
			<?php if($uri5==''){ ?>
				<th></th>
			<?php } ?>
				<th></th>
				<th>TOTAL</th>
				<th><?php echo $TotalSaldoAwal; ?></th>									
				<th><?php echo $TotalDebitTgl; ?></th>									
				<th><?php echo $TotalKreditTgl; ?></th>									
				<th><?php echo $TotalSaldoAkhir; ?></th>									
			</tr>
		</tfoot>
	  </table>
