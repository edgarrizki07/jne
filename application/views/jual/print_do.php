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
$KodeCustomer=$this->customer_model->KodeCustomer($Customer);
$NPWPCustomer=$this->customer_model->NPWPCustomer($Customer);
$CPCustomer = $this->customer_model->CPCustomer($Customer);
$HPCustomer = $this->customer_model->HPCustomer($Customer);
$AlamatCustomer = $this->customer_model->AlamatCustomer($Customer);
$KotaCustomer = $this->customer_model->KotaCustomer($Customer);
$ProvinsiCustomer = $this->customer_model->ProvinsiCustomer($Customer);
$TelpCustomer = $this->customer_model->TelpCustomer($Customer);
$FaxCustomer = $this->customer_model->FaxCustomer($Customer);
$EmailCustomer = $this->customer_model->EmailCustomer($Customer);

// Delivery Order
$no = $info['id_jual']."-".$info['id_do'];
$id_jual=$info['id_jual'];
$id_do=$info['id_do'];

$customer_id=$info['customer_id'];
$delivery=$info['delivery'];
$kirim=$info['kirim'];
$kirim1=$info['kirim1'];

$tglkirim=$this->jurnal_model->tgl_string($info['tglkirim']); 
$tgldo=$this->jurnal_model->tgl_string($this->jurnal_model->ambilDate($info['tgldo'])); 
$jamdo=$this->jurnal_model->ambilJamMenit($this->jurnal_model->ambilTime($info['tgldo'])); 
$nodo=$info['nodo'];

$barang_id=$info['barang_id'];
$nopo=$info['nopo'];
$volume = number_format($info['volume']);

$seals=$info['seals'];
$density=$info['density'];
$temperature=$info['temperature'];
$remarks=$info['remarks'];

$armada=$info['armada'];
$angkutan=$info['angkutan'];
$carrier=$info['carrier'];
$vehicle_id=$info['vehicle_id'];

$driver=$info['driver'];

// Jurnal 
$judul="Delivery Order ".$no;

// PDF Setting 
$this->fpdf->FPDF("P","cm","A5S");
$this->fpdf->SetTitle($judul);
$this->fpdf->SetSubject($cabang);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(1,2.5,1,0.1);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','B',12);
$this->fpdf->Cell(7.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4.5,0.5,"DELIVERY ORDER",'TBLR',0,'C');
$this->fpdf->Cell(7.5,0.5,"",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','I',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Sold to",0,0,'L');
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(8,0.5,": C-".$Customer."/".$KodeCustomer,'0',0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(11,0.5,$NamaCustomer,0,0,'L');
$this->fpdf->Cell(3,0.5,"Ship Date",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$tglkirim,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','I',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Delivery to",0,0,'L');
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(8,0.5,": ".$delivery,'0',0,'L');
$this->fpdf->Cell(3,0.5,"Print Date",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$tgldo."   ".$jamdo,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(11,0.5,substr($kirim,0,60),0,0,'L');
$this->fpdf->Cell(3,0.5,"DO / BR Number",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$id_jual." / ".$id_do,0,0,'L');


if(strlen($kirim) > 60){
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(11,0.5,substr($kirim,60,60),0,0,'L');
}

if(strlen($kirim) > 120){
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(11,0.5,substr($kirim,120,60),0,0,'L');
}

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(11,0.5,$kirim1,0,0,'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(5,0.5,"PRODUCT",0,0,'C');
$this->fpdf->Cell(5,0.5,"PO NUMBER",0,0,'C');
$this->fpdf->Cell(5,0.5,"QUANTITY",0,0,'C');
$this->fpdf->Cell(1,0.5,"UM",0,0,'C');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"JN-ENERGI (HSD)",'T',0,'C');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,$nopo,'T',0,'C');
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,$volume,'T',0,'C');
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(1,0.5,"LT",'T',0,'C');
$this->fpdf->Cell(0.5,0.5,"",0,0,'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Seals",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$seals,'0',0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Density",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$density,'0',0,'L');
$this->fpdf->Cell(3,0.5,"Made of Transport",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$angkutan,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Temperature",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$temperature." `C",'0',0,'L');
$this->fpdf->Cell(3,0.5,"Carrier",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$carrier,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Remarks",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$remarks,'0',0,'L');
$this->fpdf->Cell(3,0.5,"Vehicle ID",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$vehicle_id,0,0,'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"JNE Representative",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Driver",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Customer",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');

$this->fpdf->Ln(1.5);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(5.5,0.5,"",0,0,'C');
$this->fpdf->Cell(5.5,0.5,"",0,0,'C');
$this->fpdf->Cell(5.5,0.5,$NamaCustomer,0,0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Name : $operasional",'T',0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Name : $driver",'T',0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Name : $CPCustomer",'T',0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(5.5,0.5,"Date : $tgldo",0,0,'L');
$this->fpdf->Cell(5.5,0.5,"Date : $tgldo",0,0,'L');
$this->fpdf->Cell(5.5,0.5,"Date : ",0,0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Arial','BI',7);
$this->fpdf->Cell(19.5,0.5,"*)Commodity received in good order and condition by customer or hauler for or on behalf of customer",0,0,'C');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','BI',7);
$this->fpdf->Cell(2,0.5,"",0,0,'L');
$this->fpdf->Cell(5.5,0.5,"Original, Copy White, Red : JNE",0,0,'C');
$this->fpdf->Cell(5.5,0.5,"Yellow : Hauler",0,0,'C');
$this->fpdf->Cell(5.5,0.5,"Copy Green : Customer",0,0,'C');
$this->fpdf->Cell(2,0.5,"",0,0,'L');


$this->fpdf->Output("Delivery_Order_$no.pdf","I");
?>
