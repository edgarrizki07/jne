<?php
// Buat File 
$NamaFile  = './files/pay_beli/Pay No.'.$this->uri->segment(3).'.pdf';

// Setting 
$logo=base_url().'images/'.$this->setting_model->Logo1();
$nama = $this->setting_model->Nama(); 
$inu = $this->setting_model->Inu(); 
$web = $this->setting_model->Web(); 
$singkatan=$this->setting_model->singkatan();

// Cabang 
$cabang = $this->pajak_model->NamaCabang($info['wp_id']);
$kode = $this->pajak_model->KodeCabang($info['wp_id']);
$NPWP = $this->pajak_model->NPWPCabang($info['wp_id']);
$alamat = $this->pajak_model->AlamatCabang($info['wp_id']);
$alamat1 = $this->pajak_model->Alamat1Cabang($info['wp_id']);
$kelurahan = $this->pajak_model->KelurahanCabang($info['wp_id']);
$kecamatan = $this->pajak_model->KecamatanCabang($info['wp_id']);
$kota = $this->pajak_model->KotaCabang($info['wp_id']);
$provinsi = $this->pajak_model->ProvinsiCabang($info['wp_id']);
$telp = $this->pajak_model->TelpCabang($info['wp_id']);
$fax = $this->pajak_model->FaxCabang($info['wp_id']);
$email = $this->pajak_model->EmailCabang($info['wp_id']);
$email1 = $this->pajak_model->Email1Cabang($info['wp_id']);
$email2 = $this->pajak_model->Email2Cabang($info['wp_id']);
$pemilik = $this->pajak_model->PemilikCabang($info['wp_id']);
$kepala = $this->pajak_model->KepalaCabang($info['wp_id']);
$keuangan = $this->pajak_model->KeuanganCabang($info['wp_id']);
$pembelian = $this->pajak_model->PembelianCabang($info['wp_id']);
$penjualan = $this->pajak_model->PenjualanCabang($info['wp_id']);
$operasional = $this->pajak_model->OperasionalCabang($info['wp_id']);
$pemasaran = $this->pajak_model->PemasaranCabang($info['wp_id']);

// supplier 
$supplier = $info['supplier_id'];
$Namasupplier=$this->supplier_model->Namasupplier($supplier);
$NPWPsupplier=$this->supplier_model->NPWPsupplier($supplier);
$Kodesupplier=$this->supplier_model->Kodesupplier($supplier);
$CPsupplier = $this->supplier_model->CPsupplier($supplier);
$HPsupplier = $this->supplier_model->HPsupplier($supplier);
$Alamatsupplier = $this->supplier_model->Alamatsupplier($supplier);
$Kotasupplier = $this->supplier_model->Kotasupplier($supplier);
$Provinsisupplier = $this->supplier_model->Provinsisupplier($supplier);
$Telpsupplier = $this->supplier_model->Telpsupplier($supplier);
$Faxsupplier = $this->supplier_model->Faxsupplier($supplier);
$Emailsupplier = $this->supplier_model->Emailsupplier($supplier);

// Invoice
$nomor = $info['id_beli']; 
$no = $info['id'];
$id_beli = $info['id_beli']; 
$term = $info['term']; 
$tempo=$this->jurnal_model->tgl_singkatan($info['tempo']);
$terbilang = $info['terbilang']; 
$depo = $info['depo']; 
$rekening = $info['rekening']; 
$rekening = $info['rekening']; 
$keterangan = $info['bayar']; 
if($bukti==''){ $filebukti=base_url().'images/empty.jpg'; }else{$filebukti=base_url().'files/pelunasan/'.$bukti;  }       

// Jurnal 
$day=$this->jurnal_model->tgl_str($info['tgl']); 
$tgl=$this->jurnal_model->tgl_str($info['tgl']); 
$tglbyr=$this->jurnal_model->tgl_str($info['tglbyr']); 
$akunbyr=$this->akun_model->NamaAkun($info['akunbyr']); 
$noakunbyr=$this->akun_model->KodeAkun($info['akunbyr']); 

$judul="Pelunasan ".$no;
$payment=$this->jurnal_model->PayVoucher('10');
$due=$this->jurnal_model->DueVoucher('10');

$tgl=$this->jurnal_model->ambilTgl($info['tgl']); 
$bln=$this->jurnal_model->ambilBln($info['tgl']); 
$thn=$this->jurnal_model->ambilThn($info['tgl']); 

$nvol = number_format($info['jml']);
$nharga = number_format($info['harga'], 2, '.', ',');
$ppnharga = number_format($info['harga']/10*($info['ppn']), 2, '.', ',');
$pphharga = number_format($info['harga']*3/1000*($info['pph']), 2, '.', ',');
$pbbkbharga = number_format($info['harga']*($info['npbbkb']/100)*($info['pbbkb']), 2, '.', ',');
$nsum = number_format(($info['harga']*$info['jml']), 2, '.', ',');

$jml=$info['harga']*$info['jml']; 
$d=$info['discount']; 
$disc=$jml*$d/100; 
$disctotal=$jml-$disc; 
$ppn=$disctotal/10*($info['ppn']);
$apbbkb=$info['npbbkb']; 
$pbbkb=$disctotal*($info['npbbkb']/100)*($info['pbbkb']); 
$pph=$disctotal*3/1000*($info['pph']); 
$t=($info['ohp']); 
$tr=($t)+($info['ppnohp']*$t/10); 
$td=$t*$info['jml']; 
$tt=($td)+($info['ppnohp']*$td/10); 
$gr_total=$disctotal+$ppn+$pbbkb+$pph+($tt);
$g_total=$disctotal+$ppn+$pbbkb+$pph;

$njml = number_format($info['tot1'], 2, '.', ',');
$nd = number_format($d, 2, '.', ',');
$ndisc = number_format($info['tot2'], 2, '.', ',');
$ndisctotal = number_format($info['tot3'], 2, '.', ',');
$nppn = number_format($info['tot4'], 2, '.', ',');
$npbbkb= number_format($info['tot5'], 2, '.', ',');
$npph = number_format($info['tot6'], 2, '.', ',');
$nt = number_format($t, 2, '.', ',');
$ntr = number_format($tr, 2, '.', ',');
$ntd = number_format($info['tot7'], 2, '.', ',');
$ntt= number_format($tt, 2, '.', ',');
$rounding= number_format($info['rounding'], 2, '.', ',');
$ngr_total = number_format($info['tot9'], 2, '.', ',');

$ng_total = number_format($g_total, 2, '.', ',');
$inharga = number_format($g_total/$info['jml'], 2, '.', ',');

$this->fpdf->FPDF("P","cm","A4");
$this->fpdf->SetTitle($judul);
$this->fpdf->SetSubject($nama);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(2,2,2);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2,0.5,"supplier : ",0,0,'L'); 
$this->fpdf->Cell(8.5,0.5,"S-".$supplier."/".$Kodesupplier,'0',0,'L');
$this->fpdf->Cell(4,0.5,"Referensi",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(10,0.5,$Namasupplier,0,0,'L');
$this->fpdf->Cell(3,0.5,"Nomor PO",0,0,'L');
$this->fpdf->Cell(4,0.5,$id_beli,'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(2.5,0.5,"NPWP : ",0,0,'L'); 
$this->fpdf->Cell(8,0.5,substr($NPWPsupplier,0,2).".".substr($NPWPsupplier,2,3).".".substr($NPWPsupplier,5,3).".".substr($NPWPsupplier,8,1)."-".substr($NPWPsupplier,9,3).".".substr($NPWPsupplier,12,3),0,0,'L');
$this->fpdf->Cell(3,0.5,"Tanggal PO",0,0,'L');
$this->fpdf->Cell(4,0.5,$tgl,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(10,0.5,substr($Alamatsupplier,0,50),0,0,'L');
$this->fpdf->Cell(3,0.5,"Nomor Invoice",0,0,'L');
$this->fpdf->Cell(4,0.5,"INV-".$nomor,'0',0,'L');

if(strlen($Alamatsupplier) > 50){
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(10,0.5,substr($Alamatsupplier,50,120),0,0,'L');
}else{
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(10,0.5,'',0,0,'C');
}
$this->fpdf->Cell(3,0.5,"Tanggal Invoice",0,0,'L');
$this->fpdf->Cell(4,0.5,$day,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(10,0.5,$Kotasupplier." - ".$Provinsisupplier,0,0,'L'); 

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(4,0.5,"Phone : ".$Telpsupplier,0,0,'L'); 
$this->fpdf->Cell(4,0.5,"Fax : ".$Faxsupplier,0,0,'L'); 

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(5,0.5,"Tgl Bayar",'TLRB',0,'L');
$this->fpdf->Cell(8,0.5,"Akun",'TRB',0,'C');
$this->fpdf->Cell(4,0.5,"Sejumlah",'TRB',0,'C');

$this->fpdf->Ln();
$this->fpdf->Cell(5,0.5,$tglbyr,'LRB',0,'L');
$this->fpdf->Cell(2,0.5,$noakunbyr,'B',0,'L');
$this->fpdf->Cell(6,0.5,$akunbyr,'RB',0,'L');
$this->fpdf->Cell(1,0.5,"Rp",'B',0,'R');
$this->fpdf->Cell(3,0.5,$ngr_total,'RB',0,'R');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,'Keterangan',0,0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,substr($keterangan,0,80),0,0,'C');

if(strlen($keterangan) > 80){
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(16,0.5,substr($keterangan,80,160),0,0,'C');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',10);
$this->fpdf->Cell(13.5,0.5,"",0,0,'L');
$this->fpdf->Cell(2.5,0.5,$keuangan,0,0,'C');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',10);
$this->fpdf->Cell(13.5,0.5,"",0,0,'L');
$this->fpdf->Cell(2.5,0.5,"Finance",0,0,'C');

$this->fpdf->Ln();
$this->fpdf->Image($filebukti,2.5,10,16,0,'','');

$this->fpdf->Output($NamaFile,"F");
redirect('beli/email_accpay/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
?>
