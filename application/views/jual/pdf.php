<?php
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

// Customer 
$Customer = $info['customer_id'];
$NamaCustomer=$this->customer_model->NamaCustomer($Customer);
$NPWPCustomer=$this->customer_model->NPWPCustomer($Customer);
$KodeCustomer=$this->customer_model->KodeCustomer($Customer);
$CPCustomer = $this->customer_model->CPCustomer($Customer);
$HPCustomer = $this->customer_model->HPCustomer($Customer);
$AlamatCustomer = $this->customer_model->AlamatCustomer($Customer);
$Alamat1Customer = $this->customer_model->Alamat1Customer($Customer);
$KotaCustomer = $this->customer_model->KotaCustomer($Customer);
$ProvinsiCustomer = $this->customer_model->ProvinsiCustomer($Customer);
$TelpCustomer = $this->customer_model->TelpCustomer($Customer);
$FaxCustomer = $this->customer_model->FaxCustomer($Customer);
$EmailCustomer = $this->customer_model->EmailCustomer($Customer);

// Invoice
$nomor = $info['id_jual']; 
$no = $info['id'];
$nopo = $info['nopo']; 
$sales = $info['sales']; 
$angkutan = $info['angkutan']; 
$carrier = $info['carrier']; 
$term = $info['term']; 
$tempo=$this->jurnal_model->tgl_singkatan($info['tempo']);
$tglkirim=$this->jurnal_model->tgl_singkatan($info['tglkirim']);
$terbilang = $info['terbilang']; 
$bank = $info['bank']; 
$namarek = $info['namarek']; 
$rekening = $info['rekening']; 
$keterangan = $info['keterangan']; 

// Jurnal 
$day=$this->jurnal_model->tgl_inggris($info['tgl_invoice']); 
$tglpo=$this->jurnal_model->tgl_str($info['tglpo']); 

$judul="Invoice ".$no;
$payment=$this->jurnal_model->PayVoucher('9');
$due=$this->jurnal_model->DueVoucher('9');

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
$this->fpdf->SetMargins(0.5,3.5,0.5);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(15.4,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,$day,0,0,'L');

$this->fpdf->Ln(0.45);
$this->fpdf->Cell(15.4,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"INV-".$nomor,'0',0,'L');

$this->fpdf->Ln(0.45);
$this->fpdf->Cell(15.4,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,$nomor,'0',0,'L');

$this->fpdf->Ln(0.45);
$this->fpdf->Cell(15.4,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,$nopo,'0',0,'L');

$this->fpdf->Ln(0.45);
$this->fpdf->Cell(15.4,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"C-".$Customer."/".$KodeCustomer,'0',0,'L');

$this->fpdf->Ln(1.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(9,0.5,substr($NPWPCustomer,0,2).".".substr($NPWPCustomer,2,3).".".substr($NPWPCustomer,5,3).".".substr($NPWPCustomer,8,1)."-".substr($NPWPCustomer,9,3).".".substr($NPWPCustomer,12,3),0,0,'L');

$this->fpdf->Ln(0.45);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(10,0.5,$NamaCustomer,0,0,'L');

$this->fpdf->Ln(0.35);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(11.5,0.5,substr($AlamatCustomer,0,70),0,0,'L');
$this->fpdf->Cell(7.7,0.5,$alamat,0,0,'L'); 

$this->fpdf->Ln(0.35);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(11.5,0.5,$Alamat1Customer,0,0,'L'); 
$this->fpdf->Cell(7.7,0.5,$alamat1,0,0,'L'); 

$this->fpdf->Ln(0.35);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(11.5,0.5,$KotaCustomer." - ".$ProvinsiCustomer,0,0,'L'); 
$this->fpdf->Cell(7.7,0.5,$kota." - ".$provinsi,0,0,'L'); 

$this->fpdf->Ln(0.35);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(11.5,0.5,"Phone : ".$TelpCustomer,0,0,'L'); 
$this->fpdf->Cell(7.7,0.5,"Phone : ".$telp,0,0,'L'); 

$this->fpdf->Ln(0.35);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(0.5,0.5,"",0,0,'L'); 
$this->fpdf->Cell(11.5,0.5,"Fax : ".$FaxCustomer,0,0,'L'); 
$this->fpdf->Cell(7.7,0.5,"Fax : ".$fax,0,0,'L'); 

$this->fpdf->Ln(1.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(3,0.5,$sales,0,0,'C');
$this->fpdf->Cell(2.5,0.5,$angkutan,0,0,'C');
$this->fpdf->Cell(3,0.5,$term,0,0,'C');
$this->fpdf->Cell(3,0.5,$tempo,0,0,'C');
$this->fpdf->Cell(3,0.5,$tglkirim,0,0,'C');

$this->fpdf->Ln(1.7);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(1.3,0.5,"",0,0,'L');
$this->fpdf->Cell(10,0.5,"High Speed Diesel (HSD) / Solar",0,0,'L');
$this->fpdf->Cell(1.8,0.5,$nvol,0,0,'C');
$this->fpdf->Cell(1,0.5,"Rp",0,0,'R');
$this->fpdf->Cell(2,0.5,$inharga,0,0,'R');
$this->fpdf->Cell(1.4,0.5,"Rp",0,0,'R');
$this->fpdf->Cell(2.3,0.5,$ng_total,0,0,'R');

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(3.3,0.5,"",0,0,'L');
$this->fpdf->Cell(9,0.5,"JN-ENERGY",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(3,0.5,"",0,0,'L');
if($t == 0){
$this->fpdf->Cell(8.3,0.5,"Include",0,0,'L');
$this->fpdf->Cell(1.8,0.5,"-",0,0,'C');
$this->fpdf->Cell(1,0.5,"",0,0,'R');
$this->fpdf->Cell(2,0.5,"-",0,0,'R');
$this->fpdf->Cell(1.4,0.5,"",0,0,'R');
$this->fpdf->Cell(2.3,0.5,"-",0,0,'R');
}else{
$this->fpdf->Cell(8.3,0.5,$carrier,0,0,'L');	
$this->fpdf->Cell(1.8,0.5,$nvol,0,0,'C');
$this->fpdf->Cell(1,0.5,"Rp",0,0,'R');
$this->fpdf->Cell(2,0.5,$ntr,0,0,'R');
$this->fpdf->Cell(1.4,0.5,"Rp",0,0,'R');
$this->fpdf->Cell(2.3,0.5,$ntt,0,0,'R');
}

$this->fpdf->Ln(1.9);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(14.5,0.5,"",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(14.5,0.5,"",0,0,'L');
$this->fpdf->Cell(0.5,0.5,"Rp",0,0,'L');
$this->fpdf->Cell(1,0.5,$nharga,0,0,'R');
$this->fpdf->Cell(1.4,0.5,"Rp",0,0,'R');
$this->fpdf->Cell(2.3,0.5,$ndisctotal,0,0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(13,0.5,"",0,0,'C');
if($nppn == 0){
$this->fpdf->Cell(1.5,0.5,"-",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"",0,0,'L');
}else{
$this->fpdf->Cell(1.5,0.5,"(10%)",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"Rp",0,0,'L');
}
if($nppn == 0){
$this->fpdf->Cell(1,0.5,"-",0,0,'R');
$this->fpdf->Cell(1.4,0.5,"",0,0,'R');
}else{
$this->fpdf->Cell(1,0.5,$ppnharga,0,0,'R');
$this->fpdf->Cell(1.4,0.5,"Rp",0,0,'R');
}
$this->fpdf->Cell(2.3,0.5,$nppn,0,0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(10,0.5,substr($terbilang,0,58),0,0,'C');
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(3,0.5,"",0,0,'C');
if($npph == 0){
$this->fpdf->Cell(1.5,0.5,"-",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"",0,0,'L');
}else{
$this->fpdf->Cell(1.5,0.5,"(0.3%)",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"Rp",0,0,'L');
}
if($npph == 0){
$this->fpdf->Cell(1,0.5,"-",0,0,'R');
$this->fpdf->Cell(1.4,0.5,"",0,0,'R');
}else{
$this->fpdf->Cell(1,0.5,$pphharga,0,0,'R');
$this->fpdf->Cell(1.4,0.5,"Rp",0,0,'R');
}
$this->fpdf->Cell(2.3,0.5,$npph,0,0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',8);
if(strlen($terbilang) > 58){
$this->fpdf->Cell(10,0.5,substr($terbilang,58,60),0,0,'C');
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(3,0.5,"",0,0,'C');
if($npbbkb == 0){
$this->fpdf->Cell(1.5,0.5,"-",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"",0,0,'L');
}else{
$this->fpdf->Cell(1.5,0.5,"(".$apbbkb."%)",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"Rp",0,0,'L');
}
if($npbbkb == 0){
$this->fpdf->Cell(1,0.5,"-",0,0,'R');
$this->fpdf->Cell(1.4,0.5,"",0,0,'R');
}else{
$this->fpdf->Cell(1,0.5,$pbbkbharga,0,0,'R');
$this->fpdf->Cell(1.4,0.5,"Rp",0,0,'R');
}
$this->fpdf->Cell(2.3,0.5,$npbbkb,0,0,'R');
}else{
$this->fpdf->Cell(10,0.5,'',0,0,'C');
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(3,0.5,"",0,0,'C');
if($npbbkb == 0){
$this->fpdf->Cell(1.5,0.5,"-",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"",0,0,'L');
}else{
$this->fpdf->Cell(1.5,0.5,"(".$apbbkb."%)",0,0,'C');
$this->fpdf->Cell(0.5,0.5,"Rp",0,0,'L');
}
if($npbbkb == 0){
$this->fpdf->Cell(1,0.5,"-",0,0,'R');
$this->fpdf->Cell(1.4,0.5,"",0,0,'R');
}else{
$this->fpdf->Cell(1,0.5,$pbbkbharga,0,0,'R');
$this->fpdf->Cell(1.4,0.5,"Rp",0,0,'R');
}
$this->fpdf->Cell(2.3,0.5,$npbbkb,0,0,'R');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(14.5,0.5,"",0,0,'C');
if($t == 0){
$this->fpdf->Cell(0.5,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"-",0,0,'R');
$this->fpdf->Cell(1.4,0.5,"",0,0,'R');
$this->fpdf->Cell(2.3,0.5,"-",0,0,'R');
}else{
$this->fpdf->Cell(0.5,0.5,"Rp",0,0,'L');
$this->fpdf->Cell(1,0.5,$ntr,0,0,'R');
$this->fpdf->Cell(1.4,0.5,"Rp",0,0,'R');
$this->fpdf->Cell(2.3,0.5,$ntt,0,0,'R');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','B',7);
$this->fpdf->Cell(16,0.5,"",0,0,'L');
$this->fpdf->Cell(1.4,0.5,"Rp",0,0,'R');
$this->fpdf->Cell(2.3,0.5,"$ngr_total",0,0,'R');

$this->fpdf->Ln(2);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(10,0.5,$bank,0,0,'C');
$this->fpdf->Cell(10,0.5,substr($keterangan,0,47),0,0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(10,0.5,$namarek,0,0,'C');
if(strlen($keterangan) > 47){
$this->fpdf->Cell(10,0.5,substr($keterangan,47,54),0,0,'C');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(10,0.5,$rekening,0,0,'C');
if(strlen($keterangan) > 100){
$this->fpdf->Cell(10,0.5,substr($keterangan,100,65),0,0,'C');
}

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(10,0.5,"",0,0,'C');
if(strlen($keterangan) > 165){
$this->fpdf->Cell(10,0.5,substr($keterangan,165,70),0,0,'C');
}

$this->fpdf->Ln(4.3);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(15.5,0.5,"",0,0,'L');
$this->fpdf->Cell(2.5,0.5,$penjualan,0,0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(15.5,0.5,"",0,0,'L');
$this->fpdf->Cell(2.5,0.5,"Manager of Finance & Accounting",0,0,'C');

$this->fpdf->Output("INVOICE_$no.pdf","I");
?>
