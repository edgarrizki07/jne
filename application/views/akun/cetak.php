<?php

$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);
if($uri5==''){	$cabang = 'Semua'; 	}else{	$cabang = $this->pajak_model->KotaCabang($uri5); 	}
$nama = $this->setting_model->Nama(); 
$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID')); 
$kota = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID')); 
$tgl1 = $this->jurnal_model->tgl_str($this->uri->segment(3));
$tgl2 = $this->jurnal_model->tgl_str($this->uri->segment(4));
$sekarang = date("d-m-Y");

$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle("DAFTAR AKUN");
$this->fpdf->SetSubject($nama);
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
$this->fpdf->SetFont('Times','B',9);
$this->fpdf->Cell(12,0.5,"DAFTAR AKUN",0,0,'L');
$this->fpdf->Cell(3,0.5,"Cabang ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": $cabang ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',9);
$this->fpdf->Cell(12,0.5,"FROM DATE : ".$tgl1." TO : ".$tgl2,0,0,'L');
$this->fpdf->Cell(3,0.5,"Tanggal ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $sekarang",0,0,'L');

$this->fpdf->Ln(0.8);
$this->fpdf->Cell(19,0.05,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');

if($uri5==''){	
$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',9);
$this->fpdf->Cell(2,0.5,"Kode",0,0,'L');
$this->fpdf->Cell(3,0.5,"Cabang",0,0,'L');
$this->fpdf->Cell(8,0.5,"Nama Akun",0,0,'L');
}else{	
$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',9);
$this->fpdf->Cell(2,0.5,"Kode",0,0,'L');
$this->fpdf->Cell(11,0.5,"Nama Perkiraan",0,0,'L');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(19,0.1,"",'B',0,'C');

$this->fpdf->SetFont('Times','',9);
$this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_kelompok',array('id !='=>'0')); $item = $sat->result();
if($item){ $no=1; foreach ($item as $row1) {
$nama=$row1->nama;
		$this->fpdf->Ln();
		$this->fpdf->Cell(2,0.5,$row1->id,0,0,'L');
		if($uri5==''){	$this->fpdf->Cell(3,0.5,'',0,0,'L'); }else{	}
		$this->fpdf->Cell(3,0.5,substr($nama,0,30),0,0,'L');
		
	$this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_kategori',array('kelompok_akun_id'=>$row1->id)); $item = $sat->result();
	if($item){ $no=1; foreach ($item as $row2) {
			$this->fpdf->Ln();
			$this->fpdf->Cell(2,0.5,$row1->id.'-'.$row2->kode,0,0,'L');
			if($uri5==''){	$this->fpdf->Cell(3,0.5,'',0,0,'L'); }else{	}
			$this->fpdf->Cell(0.5,0.5,'',0,0,'L');
			$this->fpdf->Cell(3,0.5,substr($row2->nama,0,30),0,0,'L');
			
		$this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_jenis',array('kategori_id'=>$row2->id)); $item = $sat->result();
		if($item){ $no=1; foreach ($item as $row3) {
				$this->fpdf->Ln();
				$this->fpdf->Cell(2,0.5,$row1->id.'-'.$row2->kode.''.$row3->kode,0,0,'L');
				if($uri5==''){	$this->fpdf->Cell(3,0.5,'',0,0,'L'); }else{	}
				$this->fpdf->Cell(1,0.5,'',0,0,'L');
				$this->fpdf->Cell(3,0.5,substr($row3->nama,0,30),0,0,'L');
				
$this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun',array('jenis_akun_id'=>$row3->id)); $item = $sat->result();
if($item){ $no=1; foreach ($item as $row) {
$saw= number_format(($row->saldo_awal), 0, '', '.');
$d=number_format(($this->jurnal_model->SumDebit($row->id)), 0, '', '.');
$k=number_format(($this->jurnal_model->SumKredit($row->id)), 0, '', '.');
$sak=number_format(($row->saldo), 0, '', '.');
$cab = $this->pajak_model->KotaCabang($row->wp_id);
$jenis_akun = $this->akun_model->KodeJenis($row->jenis_akun_id);
$kategori_akun = $this->akun_model->KodeKategori($row->kategori_akun_id);
$kode=$row->kelompok_akun_id."-".$kategori_akun."".$jenis_akun." ".$row->kode;
$level1 = $this->akun_model->NamaKelompok($row->kelompok_akun_id);
$level2 = $this->akun_model->NamaKategori($row->kategori_akun_id);
$level3 = $this->akun_model->NamaJenis($row->jenis_akun_id);
	$SumDebit = $this->jurnal_model->SumDebit($row->id);
	$SumKredit = $this->jurnal_model->SumKredit($row->id);
	$SumDebitTgl1 = $this->jurnal_model->SumDebitTgl($row->id,$uri3);
	$SumKreditTgl1 = $this->jurnal_model->SumKreditTgl($row->id,$uri3);
	$SumDebitTgl2 = $this->jurnal_model->SumDebitTgl($row->id,$uri4);
	$SumKreditTgl2 = $this->jurnal_model->SumKreditTgl($row->id,$uri4);
	$SumDebitTgl = number_format(($SumDebitTgl2-$SumDebitTgl1), 0, '', '.');
	$SumKreditTgl = number_format(($SumKreditTgl2-$SumKreditTgl1), 0, '', '.');
	$SaldoAwal = number_format(($SumDebitTgl1-$SumKreditTgl1+$row->saldo_awal), 0, '', '.');
	$SaldoAkhir = number_format(($SumDebitTgl2-$SumKreditTgl2+$row->saldo_awal), 0, '', '.');
		if($uri5==''){
		$this->fpdf->Ln();
		$this->fpdf->Cell(1,0.5,$no,0,0,'L');
		$this->fpdf->Cell(2,0.5,$kode,0,0,'L');
		$this->fpdf->Cell(3,0.5,$cab,0,0,'L');
		$this->fpdf->Cell(1.5,0.5,'',0,0,'L');
		$this->fpdf->Cell(5,0.5,substr($row->nama,0,100),0,0,'L');
		$no++;
		}else{
		$this->fpdf->Ln();
		$this->fpdf->Cell(1,0.5,$no,0,0,'L');
		$this->fpdf->Cell(2,0.5,$kode,0,0,'L');
		$this->fpdf->Cell(1.5,0.5,'',0,0,'L');
		$this->fpdf->Cell(8,0.5,substr($row->nama,0,100),0,0,'L');
		$no++;
		}
	}			
}			
				
		$no++; } }
	$no++; } }
$no++; } }


$this->fpdf->Output("Daftar_Akun.pdf","I");
?> 
