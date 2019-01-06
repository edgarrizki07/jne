<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_Proyek_$uri3.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php

	$npwp = $wajib_pajak_data['npwp'];
	$nama = $wajib_pajak_data['nama'];
	$nama_pemilik = $wajib_pajak_data['pemilik'];
	$alamat = $wajib_pajak_data['alamat'];
	$kota = $wajib_pajak_data['kota'];

?> 
	<table id="group_table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th colspan="4"><h3 class="box-title"><?php echo $nama; ?></h3></th>
			</tr>
			<tr>
				<th colspan="4"><h3><?php echo $alamat; ?></h3></th>
			</tr>
			<tr>
				<th colspan="4">NPWP : <?php echo $npwp; ?></th>
			</tr>
			<tr>
				<th colspan="4">LAPORAN LABA RUGI</th>
			</tr>
			<tr>
				<th colspan="4">PROYEK <?php echo $proyek; ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><b>Pendapatan</b></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
<?php 
$sum_pendapatan_proyek = 0;
if(isset($laporan_data[4]))
{
	foreach ($laporan_data[4] as $key => $row)
	{
		echo '<tr>';
		echo '<td></td>';
		echo '<td>'.$row['nama'].'</b></td>';
		echo '<td>Rp '.-$row['saldo'].'</td>';
		echo '<td></td>';
		$sum_pendapatan_proyek += -$row['saldo'];
		echo '</tr>';
	}
}
?>
			<tr>
				<td><b>Total Pendapatan</b></td>
				<td></td>
				<td></td>
				<td><b>Rp <?php echo $sum_pendapatan_proyek; ?></b></td>
			</tr>
			<tr>
				<td><b>Biaya</b></td>
				<td></td>
			</tr>
<?php 
$sum_biaya_proyek = 0;
if(isset($laporan_data[5]))
{
	foreach ($laporan_data[5] as $key => $row)
	{
		if($row['saldo'] !='0'){
		echo '<tr>';
		echo '<td></td>';
		echo '<td>'.$row['nama'].'</td>';
		echo '<td>Rp '.$row['saldo'].'</td>';
		echo '<td></td>';
		$sum_biaya_proyek += $row['saldo'];
		echo '</tr>';
		}        
	}
}
?>
			<tr>
				<td><b>Total Biaya</b></td>
				<td></td>
				<td></td>
				<td><b>Rp <?php echo $sum_biaya_proyek; ?></b></td>
			</tr>
<?php 
$sum_laba_rugi = $sum_pendapatan_proyek - $sum_biaya_proyek;
$laba_rugi = ($sum_laba_rugi < 0) ? "( Rp ".abs($sum_laba_rugi)." )" : "Rp $sum_laba_rugi" ;
$text_laba_rugi = ($sum_laba_rugi < 0) ? 'Rugi' : 'Laba' ;
?>
			<tr>
				<td><b><?php echo $text_laba_rugi; ?></b></td>
				<td></td>
				<td></td>
				<td><b><?php echo $laba_rugi; ?></b></td>
			</tr>
		</tbody>	
		<tfoot>
<?php $sekarang = date("d-m-Y"); ?>
			<tr>
				<th colspan="4"><?php echo $kota; ?>, <?php echo $sekarang; ?></th>
			</tr>	
			<tr>
				<th></th>
			</tr>	
			<tr>
				<th></th>
			</tr>	
			<tr>
				<th colspan="4"><?php echo $nama_pemilik; ?></th>
			</tr>	
			<tr>
				<th colspan="4">Direktur</th>
			</tr>	
		</tfoot>
	</table>
