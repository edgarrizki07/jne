<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_Laba_Rugi.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php

	$npwp = $wajib_pajak_data['npwp'];
	$nama = $wajib_pajak_data['nama'];
	$nama_pemilik = $wajib_pajak_data['pemilik'];
	$alamat = $wajib_pajak_data['alamat'];
	$kota = $wajib_pajak_data['kota'];
	$sekarang = date("j").' '.nama_bulan(date("m")).' '.date("Y");
	$periode = 'Periode ';
	if($bulan) $periode .= "Bulan $bulan ";
	if($tahun) $periode .= "Tahun $tahun";

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
				<th colspan="4"><?php if($periode != 'Periode ') echo $periode; ?></th>
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
				<td><b>Pendapatan Usaha</b></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
<?php 
$sum_pendapatan_proyek = 0;
if(isset($laba_rugi_data[1][4]))
{
	foreach ($laba_rugi_data[1][4] as $key => $row)
	{
		if($row['saldo'] !='0'){
		echo '<tr>';
		echo '<td></td>';
		echo '<td>'.$row['nama'].'</td>';
		echo '<td>Rp '.-$row['saldo'].'</td>';
		echo '<td></td>';
		$sum_pendapatan_proyek += -$row['saldo'];
		echo '</tr>';
		}        
	}
}
?>
			<tr>
				<td><b>Pendapatan Bersih</b></td>
				<td></td>
				<td></td>
				<td><b>Rp <?php echo $sum_pendapatan_proyek; ?></b></td>
			</tr>
			<tr>
				<td><b>Biaya-Biaya Usaha</b></td>
				<td></td>
			</tr>
<?php 
$sum_biaya_proyek = 0;
if(isset($laba_rugi_data[1][5]))
{
	foreach ($laba_rugi_data[1][5] as $key => $row)
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
				<td><b>Total Biaya Usaha</b></td>
				<td></td>
				<td></td>
				<td><b>Rp <?php echo -$sum_biaya_proyek; ?></b></td>
			</tr>
<?php 
$laba_kotor = $sum_pendapatan_proyek - $sum_biaya_proyek;
?>
			<tr>
				<td><b>Laba/(Rugi) Kotor</b></td>
				<td></td>
				<td></td>
				<td><b>Rp <?php echo $laba_kotor; ?></b></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td><b>Pendapatan Luar Usaha</b></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
<?php 
$sum_pendapatan = 0;
if(isset($laba_rugi_data[0][4]))
{
	foreach ($laba_rugi_data[0][4] as $key => $row)
	{
		if($row['saldo'] !='0'){
		echo '<tr>';
		echo '<td></td>';
		echo '<td>'.$row['nama'].'</td>';
		echo '<td>Rp '.-$row['saldo'].'</td>';
		echo '<td></td>';
		$sum_pendapatan += -$row['saldo'];
		echo '</tr>';
		}        
	}
}
?>
			<tr>
				<td><b>Total Pendapatan Luar Usaha</b></td>
				<td></td>
				<td></td>
				<td><b>Rp <?php echo $sum_pendapatan; ?></b></td>
			</tr>
			<tr>
				<td><b>Biaya-Biaya Luar Usaha</b></td>
				<td></td>
			</tr>
<?php 
$sum_biaya = 0;
if(isset($laba_rugi_data[0][5]))
{
	foreach ($laba_rugi_data[0][5] as $key => $row)
	{
		if($row['saldo'] !='0'){
		echo '<tr>';
		echo '<td></td>';
		echo '<td>'.$row['nama'].'</td>';
		echo '<td>Rp '.$row['saldo'].'</td>';
		echo '<td></td>';
		$sum_biaya += $row['saldo'];
		echo '</tr>';
		}        
	}
}
?>
			<tr>
				<td><b>Total Biaya Luar Usaha</b></td>
				<td></td>
				<td></td>
				<td><b>Rp <?php echo -$sum_biaya; ?></b></td>
			</tr>
<?php 
$sum = $laba_kotor + $sum_pendapatan - $sum_biaya;
$laba_rugi = ($sum < 0) ? 'Rugi' : 'Laba' ;
?>
			<tr>
				<td><b><?php echo $laba_rugi; ?></b></td>
				<td></td>
				<td></td>
				<td><b>Rp <?php echo $sum; ?></b></td>
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
