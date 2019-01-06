<?php

$logo=base_url().'images/'.$this->setting_model->Logo1();
$nama = $this->setting_model->Nama(); 
$cabang = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID'));
$telp = $this->pajak_model->TelpCabang($this->session->userdata('SESS_WP_ID'));
$fax = $this->pajak_model->FaxCabang($this->session->userdata('SESS_WP_ID'));
$email = $this->pajak_model->EmailCabang($this->session->userdata('SESS_WP_ID'));
$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID'));
	$nama_pemilik = $wajib_pajak_data['pemilik'];
	$kota = $wajib_pajak_data['kota'];
	$sekarang = date("j").' '.nama_bulan(date("m")).' '.date("Y");

$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetMargins(2,1,2);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();


$this->fpdf->Ln();
$this->fpdf->Image($logo,2.5,1,2.75,0,'','');

$this->fpdf->SetFont('Times','B',16);
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(13,0.5,$nama,'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',12);
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(13,0.5,"Cabang ".$cabang,'0',0,'L');

$this->fpdf->Ln(0.7);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(13,0.5,substr($alamat,0,72),0,0,'L');

if(strlen($alamat) > 72){
$this->fpdf->Ln();
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(13,0.5,substr($alamat,72,100),0,0,'L');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',11);
$this->fpdf->Cell(4,0.5,"",'0',0,'R');
$this->fpdf->Cell(13,0.5,"Phone: ".$telp."  Fax : ".$fax."  Email : ".$email,'0',0,'L');

$this->fpdf->Ln(0.8);
$this->fpdf->Cell(17,0.05,"",'TLBR',0,'C',1);

$this->fpdf->Ln(0.7);
$this->fpdf->SetFont('Times','B',14);
$this->fpdf->Cell(17,0.5,"LAPORAN LABA RUGI GROUP 1",0,0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',12);
$periode = 'Periode ';
if($bulan) $periode .= "Bulan $bulan ";
if($tahun) $periode .= "Tahun $tahun";
if($periode != 'Periode ') $this->fpdf->Cell(17,0.5,$periode,0,0,'C');

$sum_pendapatan_proyek = 0;
if(isset($laba_rugi_data[1][4]))
{ foreach ($laba_rugi_data[1][4] as $key => $row) {if($row['saldo'] !='0'){$sum_pendapatan_proyek += -$row['saldo'];} } }

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(10,0.5,"Pendapatan Bersih",0,0,'L');
$this->fpdf->Cell(3.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3.5,0.5,to_rupiah($sum_pendapatan_proyek),0,0,'R');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(17,0.5,"HPP",0,0,'L');

$this->fpdf->SetFont('Times','',11);

$sum_biaya_proyek = 0;
if(isset($laba_rugi_data[1][5]))
{
	foreach ($laba_rugi_data[1][5] as $key => $row)
	{
		if($row['saldo'] !='0'){
		$this->fpdf->Ln();
		$this->fpdf->Cell(1,0.5,"",0,0,'L');
		$this->fpdf->Cell(9,0.5,$row['nama'],0,0,'L');
		$this->fpdf->Cell(3.5,0.5,to_rupiah($row['saldo']),0,0,'R');
		$this->fpdf->Cell(3.5,0.5,"",0,0,'L');
		$sum_biaya_proyek += $row['saldo'];
		}        
	}
}
$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(10,0.5,"Total HPP",0,0,'L');
$this->fpdf->Cell(3.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3.5,0.5,to_rupiah(-$sum_biaya_proyek),0,0,'R');

$laba_kotor = $sum_pendapatan_proyek - $sum_biaya_proyek;
$this->fpdf->Ln(0.7);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(10,0.5,"Laba/(Rugi) Kotor",0,0,'L');
$this->fpdf->Cell(3.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3.5,0.5,to_rupiah($laba_kotor),0,0,'R');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(17,0.5,"Pendapatan Luar Usaha",0,0,'L');

$this->fpdf->SetFont('Times','',11);

$sum_pendapatan = 0;
if(isset($laba_rugi_data[0][4]))
{
	foreach ($laba_rugi_data[0][4] as $key => $row)
	{
		if($row['saldo'] !='0'){
		$this->fpdf->Ln();
		$this->fpdf->Cell(1,0.5,"",0,0,'L');
		$this->fpdf->Cell(9,0.5,$row['nama'],0,0,'L');
		$this->fpdf->Cell(3.5,0.5,to_rupiah(-$row['saldo']),0,0,'R');
		$this->fpdf->Cell(3.5,0.5,"",0,0,'L');
		$sum_pendapatan += -$row['saldo'];
		}        
	}
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(10,0.5,"Total Pendapatan Luar Usaha",0,0,'L');
$this->fpdf->Cell(3.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3.5,0.5,to_rupiah($sum_pendapatan),0,0,'R');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(17,0.5,"Biaya-Biaya Luar Usaha",0,0,'L');

$this->fpdf->SetFont('Times','',11);

$sum_biaya = 0;
if(isset($laba_rugi_data[0][5]))
{
	foreach ($laba_rugi_data[0][5] as $key => $row)
	{
		if($row['saldo'] !='0'){
		$this->fpdf->Ln();
		$this->fpdf->Cell(1,0.5,"",0,0,'L');
		$this->fpdf->Cell(9,0.5,$row['nama'],0,0,'L');
		$this->fpdf->Cell(3.5,0.5,to_rupiah($row['saldo']),0,0,'R');
		$this->fpdf->Cell(3.5,0.5,"",0,0,'L');
		$sum_biaya += $row['saldo'];
		}        
	}
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(10,0.5,"Total Biaya Luar Usaha",0,0,'L');
$this->fpdf->Cell(3.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3.5,0.5,to_rupiah(-$sum_biaya),0,0,'R');

$sum = $laba_kotor + $sum_pendapatan - $sum_biaya;
$laba_rugi = ($sum < 0) ? 'Rugi' : 'Laba' ;
$this->fpdf->Ln(0.7);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(10,0.5,$laba_rugi,0,0,'L');
$this->fpdf->Cell(3.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3.5,0.5,to_rupiah($sum),0,0,'R');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Times','',12);
$this->fpdf->Cell(17,0.5,$kota.", ".$sekarang,0,0,'C');

$this->fpdf->Ln(3);
$this->fpdf->SetFont('Times','B',12);
$y = $this->fpdf->GetX();
$this->fpdf->SetX($y+5);
$this->fpdf->Cell(7,0.5,$nama_pemilik,'B',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',12);
$this->fpdf->Cell(17,0.5,"Finance",0,0,'C');

$this->fpdf->Output("Laporan_Laba_Rugi.pdf","I");
?>
