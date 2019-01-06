<?php

$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);
if($uri5==''){	$cabang = 'Semua'; 	}else{	$cabang = $this->pajak_model->KotaCabang($uri5); 	}
$nama = $this->setting_model->Nama(); 
$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID')); 
$kota = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID')); 
$bln=$this->jurnal_model->getBulan($this->uri->segment(3));
$thn = $this->uri->segment(4);
$blnthn = $bln."_".$thn;
$sekarang = date("j").' '.nama_bulan(date("m")).' '.date("Y");

$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle("JURNAL Bulan : ".$bln." Tahun : ".$thn);
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
$this->fpdf->Cell(12,0.5,"Bulan : ".$bln." Tahun : ".$thn,0,0,'L');
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
$this->fpdf->Cell(1.75,0.5,"Nomor",0,0,'L');
$this->fpdf->Cell(3.25,0.5,"Akun",0,0,'L');
$this->fpdf->Cell(7,0.5,"Keterangan",0,0,'L');
$this->fpdf->Cell(2,0.5,"Debit",0,0,'R');
$this->fpdf->Cell(2,0.5,"Credit",0,0,'R');

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
		$keterangan = substr($row->keterangan.' '.$this->supplier_model->NamaSupplier($row->supplier_id).' '.$this->customer_model->NamaCustomer($customer),0,40);
			$this->fpdf->Ln();
			$this->fpdf->SetFont('Times','',8);
			$this->fpdf->Cell(1.25,0.5,$j." ".$p,0,0,'L');
			$this->fpdf->Cell(1.75,0.5,$tgl,0,0,'L');
			$this->fpdf->Cell(1.75,0.5,$nomor."/".$kode."/".$no,0,0,'L');
			$this->fpdf->Cell(3.25,0.5,$row->kelompok_akun_id."-".$row->kode." ".substr($row->account_name,0,15),0,0,'L');
			$this->fpdf->Cell(7,0.5,$keterangan,0,0,'L');
			$this->fpdf->Cell(2,0.5,$d,0,0,'R');
			$this->fpdf->Cell(2,0.5,$k,0,0,'R');
		$i++;
	}
}


$this->fpdf->Output("Jurnal_$blnthn.pdf","I");
?> 
