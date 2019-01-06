<?php
// Setting 
$logo=base_url().'images/'.$this->setting_model->Logo1();
$nama = $this->setting_model->Nama(); 
$inu = $this->setting_model->Inu(); 
$web = $this->setting_model->Web(); 
$singkatan=$this->setting_model->singkatan();

// Cabang 
$cabang = strtoupper($this->pajak_model->NamaCabang($info['wp_id']));
$kode = $this->pajak_model->KodeCabang($info['wp_id']);
$NPWP = $this->pajak_model->NPWPCabang($info['wp_id']);
$alamat = strtoupper($this->pajak_model->AlamatCabang($info['wp_id']));
$kelurahan = strtoupper($this->pajak_model->KelurahanCabang($info['wp_id']));
$kecamatan = strtoupper($this->pajak_model->KecamatanCabang($info['wp_id']));
$kota = strtoupper($this->pajak_model->KotaCabang($info['wp_id']));
$provinsi = strtoupper($this->pajak_model->ProvinsiCabang($info['wp_id']));
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
$kirim=$info['kirim'];

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
$vehicle_transport=$info['vehicle_transport'];

$driver=$info['driver'];

// Loading Instruction
$terminal_loading=$info['terminal_loading'];
$alamat_loading=$info['alamat_loading'];
$wilayah_loading=$info['wilayah_loading'];
$date_loading=$this->jurnal_model->tgl_string($info['date_loading']); 
$time1_loading=$this->jurnal_model->ambilJamMenit($info['time1_loading']); 
$time2_loading=$this->jurnal_model->ambilJamMenit($info['time2_loading']); 
$reff_li=$info['reff_li'];
$reff_lo=$info['reff_lo'];
$reff_po=$info['reff_po'];
$reff_do=$info['reff_do'];

$angkutan=$info['angkutan'];
$vehicle_id=$info['vehicle_id'];
$driver=$info['driver'];
$capacity=$info['capacity'];

$barang_id=$info['barang_id'];
$volume = number_format($info['volume']);
$carrier_li=$info['carrier_li'];
$seals=$info['seals'];

// Jurnal 
$judul="Loading Instruction ".$no;


// PDF Setting 
$this->fpdf->FPDF("P","cm","A5S");
$this->fpdf->SetTitle($judul);
$this->fpdf->SetSubject($cabang);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(2,2.5,2,0.1);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','B',12);
$this->fpdf->Cell(6,0.5,"",0,0,'L');
$this->fpdf->Cell(5.5,0.5,"LOADING INSTRUCTION",'TBLR',0,'C');
$this->fpdf->Cell(6,0.5,"",0,0,'L');

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(10,0.5,"TERMINAL LOADING",0,0,'L');
$this->fpdf->Cell(3,0.5,"HAULER",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','BI',8);
$this->fpdf->Cell(10,0.5,$terminal_loading,0,0,'L');
$this->fpdf->Cell(7,0.5,$nama,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(10,0.5,$alamat_loading,0,0,'L');
$this->fpdf->Cell(7,0.5,$alamat,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(10,0.5,$wilayah_loading,0,0,'L');
$this->fpdf->Cell(7,0.5,$kota." - ".$provinsi." - INDONESIA",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(11,0.5,"",0,0,'L');
$this->fpdf->Cell(7,0.5,"IZIN ANGKUT BBM : 05.NW.03.18.00.123",0,0,'L');

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(3,0.5,"Loading Date",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$date_loading,'0',0,'L');
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(3,0.5,"Made of Transport",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$angkutan,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(3,0.5,"Loading Time",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$time1_loading." - ".$time2_loading,'0',0,'L');
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(3,0.5,"Vehicle ID",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$vehicle_id,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(3,0.5,"Reff LO",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$reff_lo,'0',0,'L');
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(3,0.5,"Driver",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$driver,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(3,0.5,"Reff PO",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$reff_po,'0',0,'L');
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(3,0.5,"Tank Capacity",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$capacity,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(3,0.5,"Reff DO",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$reff_do,'0',0,'L');
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(3,0.5,"Transportir Vehicle ID",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$vehicle_transport,0,0,'L');

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(4,0.5,"PRODUCT NAME",0,0,'L');
$this->fpdf->Cell(6,0.5,": JN-ENERGI (HSD)",'0',0,'L');
$this->fpdf->Cell(1,0.5,"Seals",0,0,'L');
$this->fpdf->Cell(4,0.5,": ".$seals,0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(4,0.5,"DETAIL OF PRODUCT",0,0,'L');
$this->fpdf->Cell(8,0.5,": High Speed Diesel (HSD)",'0',0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(4,0.5,"QUANTITY",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$volume." liter",0,0,'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(4,0.5,"CARRIER",0,0,'L');
$this->fpdf->Cell(8,0.5,": ".$carrier_li,0,0,'L');

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"JNE Representative",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');

$this->fpdf->Ln(0.3);
$this->fpdf->SetFont('Arial','B',8);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Kepala Operasional",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Kepala Terminal",0,0,'C');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');

$this->fpdf->Ln(1.7);
$this->fpdf->SetFont('Arial','',8);
$this->fpdf->Cell(1,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Name : $operasional",'T',0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"",0,0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(4,0.5,"Name : ",'T',0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');
$this->fpdf->Cell(1.5,0.5,"",0,0,'L');

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Arial','',6);
$this->fpdf->Cell(4,0.5,$id_jual." / ".$id_do,0,0,'L');
$this->fpdf->SetFont('Arial','BI',7);
$this->fpdf->Cell(4.5,0.5,"Original, Copy White, Red : JNE",0,0,'C');
$this->fpdf->Cell(3.5,0.5,"Yellow : Terminal",0,0,'C');
$this->fpdf->Cell(3.5,0.5,"Green : Hauler",0,0,'C');
$this->fpdf->Cell(5,0.5,"",0,0,'L');


$this->fpdf->Output("Loading_Instruction_$no.pdf","I");
?>
