<?php

	$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5); $uri6 = $this->uri->segment(6);
	if($uri6==''){	$cabang = 'Semua'; 	}else{	$cabang = $this->pajak_model->KotaCabang($uri6); 	}
	$nama = $this->setting_model->Nama(); 
	$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID')); 
	$kota = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID')); 
	$id = $this->uri->segment(3);
	$tgl0b = strtotime('-1 day',strtotime($uri4));
	$tgl0c = date('Y-m-d', $tgl0b);
	$tgl0 = date('d-m-Y', $tgl0b);
	$tgl1 = $this->jurnal_model->tgl_str($this->uri->segment(4));
	$tgl2 = $this->jurnal_model->tgl_str($this->uri->segment(5));
	$tgl3b = strtotime('+1 day',strtotime($uri5));
	$tgl3c = date('Y-m-d', $tgl3b);
	$tgl3 = date('d-m-Y', $tgl3b);
	$from = $this->uri->segment(4);
	$to = $this->uri->segment(5);
	$one = date("Y-m-1");
	$now = date("Y-m-d");
	$sekarang = date("d-m-Y");
	$kategori = $this->akun_model->NamaJenis($this->uri->segment(3));

	$KatDebit = number_format($this->jurnal_model->KatDebit($id), 0, '', '.'); 
	$KatKredit = number_format($this->jurnal_model->KatKredit($id), 0, '', '.'); 
	
	$KatDebitTgl1 = number_format($this->jurnal_model->KatDebitTgl($id,$from), 0, '', '.');
	$KatKreditTgl1 = number_format($this->jurnal_model->KatKreditTgl($id,$from), 0, '', '.');
	$KatDebitTgl2 = number_format($this->jurnal_model->KatDebitTgl($id,$to), 0, '', '.');
	$KatKreditTgl2 = number_format($this->jurnal_model->KatKreditTgl($id,$to), 0, '', '.');

	$KatDebitTgl = number_format($this->jurnal_model->KatDebitAll($uri3,$uri4,$uri5), 0, '', '.');
	$KatKreditTgl = number_format($this->jurnal_model->KatKreditAll($uri3,$uri4,$uri5), 0, '', '.');
	$KatDebitBulanIni = number_format($this->jurnal_model->KatDebitAll($uri3,$one,$now), 0, '', '.');
	$KatKreditBulanIni = number_format($this->jurnal_model->KatKreditAll($uri3,$one,$now), 0, '', '.');
	$KatDebitBulanLalu = number_format($this->jurnal_model->KatDebit($id)-$this->jurnal_model->KatDebitAll($uri3,$one,$now), 0, '', '.');
	$KatKreditBulanLalu = number_format($this->jurnal_model->KatKredit($id)-$this->jurnal_model->KatKreditAll($uri3,$one,$now), 0, '', '.');

	$KatDebitTglP = number_format($this->jurnal_model->KatDebitAll($uri3,'1900-01-01',$tgl0c), 0, '', '.');
	$KatKreditTglP = number_format($this->jurnal_model->KatKreditAll($uri3,'1900-01-01',$tgl0c), 0, '', '.');
	$KatDebitTglN = number_format($this->jurnal_model->KatDebitAll($uri3,$tgl3c,$now), 0, '', '.');
	$KatKreditTglN = number_format($this->jurnal_model->KatKreditAll($uri3,$tgl3c,$now), 0, '', '.');

	$sum = $this->jurnal_model->KatDebit($id)-$this->jurnal_model->KatKredit($id); 
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

$this->fpdf->FPDF("P","cm","A4");
if($from==''){
$this->fpdf->SetTitle("JURNAL Kategori ".$kategori." Bulan ini");
}else{
$this->fpdf->SetTitle("JURNAL Kategori ".$kategori." FROM DATE : ".$tgl1." TO : ".$tgl2);
}
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(1,1,1);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',14);
$this->fpdf->Cell(19,0.5,"$nama",'0',0,'L');


$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',10);
$this->fpdf->Cell(12,0.5,"JURNAL",0,0,'L');
$this->fpdf->Cell(3,0.5,"Cabang ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": $cabang ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',10);
$this->fpdf->Cell(12,0.5,"Kategori : $kategori",0,0,'L');
$this->fpdf->Cell(3,0.5,"Halaman ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',10);
if($from==''){
$this->fpdf->Cell(12,0.5,"Bulan ini",0,0,'L');
}else{
$this->fpdf->Cell(12,0.5,"From Date : ".$tgl1." To : ".$tgl2,0,0,'L');
}
$this->fpdf->Cell(3,0.5,"Tanggal ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $sekarang",0,0,'L');

$this->fpdf->Ln(0.8);
$this->fpdf->Cell(19,0.05,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',10);
$this->fpdf->Cell(1.25,0.5,"Jurnal",0,0,'L');
$this->fpdf->Cell(1.75,0.5,"Tanggal",0,0,'L');
$this->fpdf->Cell(1.5,0.5,"Nomor",0,0,'L');
$this->fpdf->Cell(3,0.5,"Akun",0,0,'L');
$this->fpdf->Cell(7,0.5,"Keterangan",0,0,'L');
$this->fpdf->Cell(2.25,0.5,"Debit",0,0,'R');
$this->fpdf->Cell(2.25,0.5,"Credit",0,0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');


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
		$tgl=$this->jurnal_model->tgl_str($row->tgl); 
		$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl)); 
		$thn=$this->jurnal_model->ambilThn($row->tgl); 
		$blnthn=$this->jurnal_model->thn_bln($row->tgl); 
		$j = $this->jurnal_model->FJurnal($row->f_id);
		$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
		$customer = $row->customer_id;
		$keterangan = substr($row->keterangan.' '.$this->supplier_model->NamaSupplier($row->supplier_id).' '.$this->customer_model->NamaCustomer($customer),0,50);
			$this->fpdf->Ln();
			$this->fpdf->SetFont('Times','',8);
			$this->fpdf->Cell(1.25,0.5,$j." ".$p,0,0,'L');
			$this->fpdf->Cell(1.75,0.5,$tgl,0,0,'L');
			$this->fpdf->Cell(1.5,0.5,$nomor."/".$kode."/".$no,0,0,'L');
			$this->fpdf->Cell(3,0.5,$row->kelompok_akun_id."-".$row->kode." ".substr($row->account_name,0,13),0,0,'L');
			$this->fpdf->Cell(7,0.5,$keterangan,0,0,'L');
			$this->fpdf->Cell(2.25,0.5,$d,0,0,'R');
			$this->fpdf->Cell(2.25,0.5,$k,0,0,'R');
		$i++;
	}
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');

if($from==''){

	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(3.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(5,0.5,"",0,0,'L');
	$this->fpdf->Cell(4,0.5,"BULAN INI",0,0,'L');
	$this->fpdf->Cell(2.25,0.5,$KatDebitBulanIni,0,0,'R');
	$this->fpdf->Cell(2.25,0.5,$KatKreditBulanIni,0,0,'R');

	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(3.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(5,0.5,"",0,0,'L');
	$this->fpdf->Cell(4,0.5,"BULAN SEBELUMNYA",0,0,'L');
	$this->fpdf->Cell(2.25,0.5,$KatDebitBulanLalu,0,0,'R');
	$this->fpdf->Cell(2.25,0.5,$KatKreditBulanLalu,0,0,'R');


}else{

	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(3.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(5,0.5,"",0,0,'L');
	$this->fpdf->Cell(4,0.5,"TGL : ".$tgl1." sd ".$tgl2,0,0,'L');
	$this->fpdf->Cell(2.25,0.5,$KatDebitTgl,0,0,'R');
	$this->fpdf->Cell(2.25,0.5,$KatKreditTgl,0,0,'R');
	

	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(3.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(5,0.5,"",0,0,'L');
	$this->fpdf->Cell(4,0.5,"TGL : ALL sd ".$tgl0,0,0,'L');
	$this->fpdf->Cell(2.25,0.5,$KatDebitTglP,0,0,'R');
	$this->fpdf->Cell(2.25,0.5,$KatKreditTglP,0,0,'R');
	
	if ($uri5 > $now)  { } else
	{
	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(3.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(5,0.5,"",0,0,'L');
	$this->fpdf->Cell(4,0.5,"TGL : ".$tgl3." sd ".$sekarang,0,0,'L');
	$this->fpdf->Cell(2.25,0.5,$KatDebitTglN,0,0,'R');
	$this->fpdf->Cell(2.25,0.5,$KatKreditTglN,0,0,'R');
	}
	
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
$this->fpdf->Cell(3.75,0.5,"",0,0,'L');
$this->fpdf->Cell(5,0.5,"",0,0,'L');
$this->fpdf->Cell(8.5,0,"",'B',0,'C');

	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(3.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(5,0.5,"",0,0,'L');
	$this->fpdf->Cell(4,0.5,"SEMUA",0,0,'L');
	$this->fpdf->Cell(2.25,0.5,$KatDebit,0,0,'R');
	$this->fpdf->Cell(2.25,0.5,$KatKredit,0,0,'R');

	$this->fpdf->Ln();
	$this->fpdf->SetFont('Times','B',8);
	$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(3.75,0.5,"",0,0,'L');
	$this->fpdf->Cell(5,0.5,"",0,0,'L');
	$this->fpdf->Cell(4,0.5,"SALDO",0,0,'L');
	$this->fpdf->Cell(2.25,0.5,$db,0,0,'R');
	$this->fpdf->Cell(2.25,0.5,$kd,0,0,'R');


$this->fpdf->Output("Jurnal_Kategori_.$kategori._.$from.sd.$to.pdf","I");
?> 
