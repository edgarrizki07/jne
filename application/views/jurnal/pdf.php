<?php
$nama = $this->setting_model->Nama(); 
$nomor = $info['no_voucher']; 
$kode=$this->jurnal_model->KodeVoucher($info['voucher_id']); 
$no = $info['id'];
$cab = $this->pajak_model->KodeCabang($info['wp_id']);
$singkatan=$this->setting_model->singkatan();
$bln=$this->jurnal_model->ambilBln($info['tgl']); 
$thn=$this->jurnal_model->ambilThn($info['tgl']); 
$judul=$this->jurnal_model->NamaVoucher($info['voucher_id']); 
$payment=$this->jurnal_model->PayVoucher($info['voucher_id']);
$due=$this->jurnal_model->DueVoucher($info['voucher_id']);
$tgl=$this->jurnal_model->tgl_str($info['tgl']); 
$tempo=$this->jurnal_model->tgl_str($info['tempo']); 
$keterangan = $info['keterangan']; 
$o1=($info['other_id']); 
$o2=($info['other_id']);
$k1=$this->customer_model->NamaCustomer($info['customer_id']);  
$k2=$this->customer_model->NPWPCustomer($info['customer_id']); 
$s1=$this->supplier_model->NamaSupplier($info['supplier_id']); 
$s2=$this->supplier_model->NPWPSupplier($info['supplier_id']);
	
if($info['customer_id']==''){
		$journal1=$o1; $journal2='';
}else{
	if($info['voucher_id']=='7'){
		$journal1=$s1; $journal2=$s2;
	}else if($info['voucher_id']=='8'){
		$journal1=$s1; $journal2=$s2;
	}else if($info['voucher_id']=='9'){
		$journal1=$k1; $journal2=$k2;
	}else if($info['voucher_id']=='10'){
		$journal1=$k1; $journal2=$k2;
	}else if($info['voucher_id']=='11'){
		$journal1=$s1; $journal2=$s2;
	}else if($info['voucher_id']=='12'){
		$journal1=$k1; $journal2=$k2;
	} 
} 


	$user1 = $this->user_model->NamaUser($info['login_id']);
	$user2 = $this->user_model->NamaUser($info['user_id']);
	$user3 = $this->customer_model->NamaCustomer($info['customer_id']);
	$addr1 = $this->user_model->Level($this->user_model->LevelUser($info['login_id']));
	$addr2 = $this->user_model->Level($this->user_model->LevelUser($info['user_id']));
	$addr3 = $this->customer_model->AlamatCustomer($info['customer_id']);
	$phone1 = $this->user_model->PhoneUser($info['login_id']);
	$phone2 = $this->user_model->PhoneUser($info['user_id']);
	$phone3 = $this->customer_model->TelpCustomer($info['customer_id']);
	$email1 = $this->user_model->EmailUser($info['login_id']);
	$email2 = $this->user_model->EmailUser($info['user_id']);
	$email3 = $this->customer_model->CPCustomer($info['customer_id']);


$this->fpdf->FPDF("P","cm","A5S");
$this->fpdf->SetTitle($judul);
$this->fpdf->SetSubject($nama);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(2,1,2);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',14);
$this->fpdf->Cell(9,0.5,"$nama",'0',0,'L');
$this->fpdf->SetFont('Times','BI',14);
$this->fpdf->Cell(8,0.5,"$judul",'0',0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',11);
$this->fpdf->Cell(3,0.5,"$payment",0,0,'L');
$this->fpdf->Cell(7,0.5,": $journal1",0,0,'L');
$this->fpdf->Cell(3,0.5,"Voucher No ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": ".$nomor."/".$kode."/".$no."/".$cab."/".$bln."/".$thn,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',11);
if($info['customer_id']==''){ $this->fpdf->Cell(3,0.5,"",0,0,'L'); }else{ $this->fpdf->Cell(3,0.5,"NPWP",0,0,'L');} 
$this->fpdf->Cell(7,0.5,": $journal2",0,0,'L');
$this->fpdf->Cell(3,0.5,"Date ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $tgl",0,0,'L');

if($due=='1'){
$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',11);
$this->fpdf->Cell(3,0.5,"",0,0,'L');
$this->fpdf->Cell(7,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"Due Date ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $tempo",0,0,'L');
}

$this->fpdf->Ln(0.8);
$this->fpdf->Cell(17,0.05,"",'TLBR',0,'C',1);

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(8.5,0.5,"Pencatat",0,0,'L');
$this->fpdf->Cell(8.5,0.5,"Penerima ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',11);
$this->fpdf->Cell(8.5,0.5,$user1." - ".$addr1,0,0,'L');
$this->fpdf->Cell(8.5,0.5,$user2." - ".$addr2,0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',11);
$this->fpdf->Cell(1,0.5,"Phone",0,0,'L');
$this->fpdf->Cell(7.5,0.5," : $phone1",0,0,'L');
$this->fpdf->Cell(1,0.5,"Phone",0,0,'L');
$this->fpdf->Cell(7.5,0.5," : $phone2",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',11);
$this->fpdf->Cell(1,0.5,"Email",0,0,'L');
$this->fpdf->Cell(7.5,0.5," : $email1",0,0,'L');
$this->fpdf->Cell(1,0.5,"Email",0,0,'L');
$this->fpdf->Cell(7.5,0.5," : $email2",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->Cell(17,0.01,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(17,0.1,"",'B',0,'C');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(1,0.5,"No",0,0,'L');
$this->fpdf->Cell(3,0.5,"Kode Perkiraan",0,0,'L');
$this->fpdf->Cell(7,0.5,"Nama Perkiraan",0,0,'L');
$this->fpdf->Cell(3,0.5,"Debit",0,0,'R');
$this->fpdf->Cell(3,0.5,"Credit",0,0,'R');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(17,0.1,"",'B',0,'C');

$this->fpdf->SetFont('Times','',11);
$sum_pendapatan_proyek = 0;
$d_jurnal = $this->db->get_where('jurnal_detail',array('jurnal_id'=>$this->uri->segment(3))); 
$detail_jurnal = $d_jurnal->result();
$no=0; foreach($detail_jurnal as $row ): $no++; $kode = $this->akun_model->KodeAkun($row->akun_id); $nama = $this->akun_model->NamaAkun($row->akun_id);
	if($row->debit_kredit == 1) {$d=number_format(($row->nilai), 0, '', '.'); $k='';} else {$d=''; $k=number_format(($row->nilai), 0, '', '.');}
		$this->fpdf->Ln();
		$this->fpdf->Cell(1,0.5,$row->item,0,0,'L');
		$this->fpdf->Cell(3,0.5,$kode,0,0,'L');
		$this->fpdf->Cell(7,0.5,$nama,0,0,'L');
		$this->fpdf->Cell(3,0.5,$d,0,0,'R');
		$this->fpdf->Cell(3,0.5,$k,0,0,'R');
endforeach;

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Times','B',12);
$this->fpdf->Cell(11,0.5,"Keterangan :",0,0,'L');
$this->fpdf->Cell(3,0.5,"Penerima :",0,0,'L');
$this->fpdf->Cell(3,0.5,"Pencatat :",0,0,'L');

$this->fpdf->Ln(0.5);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(7,0.5,"$keterangan",0,0,'L');

$this->fpdf->Ln(1);
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(11,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"$user2",0,0,'L');
$this->fpdf->Cell(3,0.5,"$user1",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',11);
$this->fpdf->Cell(11,0.5,"",0,0,'L');
$this->fpdf->Cell(3,0.5,"$addr2",0,0,'L');
$this->fpdf->Cell(3,0.5,"$addr1",0,0,'L');

$this->fpdf->Output("Jurnal_Proyek_$nomor.pdf","I");
?>
