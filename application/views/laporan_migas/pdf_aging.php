<?php

	$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5); $uri6 = $this->uri->segment(6);
	$nama = $this->setting_model->Nama(); 
	$alamat = $this->pajak_model->AlamatCabang($this->session->userdata('SESS_WP_ID')); 
	$kota = $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID')); 
	if($uri3=='1'){$judul='Debitur';  }else if($uri3=='2'){$judul='Creditur';  }else if($uri3=='0'){$judul='Debitur/Creditur';  }
	$cabang = $this->pajak_model->KotaCabang($this->uri->segment(4));
	$tgl = $this->jurnal_model->tgl_str($this->uri->segment(6));
	$sekarang = date("d-m-Y");

$this->fpdf->FPDF("L","cm","A4");
$this->fpdf->SetTitle($judul." Aging Report FROM DATE : ".$tgl);
$this->fpdf->SetSubject($nama);
$this->fpdf->SetAuthor('Davidoank');
$this->fpdf->SetMargins(2,1,1);
$this->fpdf->SetAutoPageBreak(true,1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',14);
$this->fpdf->Cell(26,0.5,"$nama",'0',0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',12);
$this->fpdf->Cell(19,0.5,$judul." Aging Report",0,0,'L');
$this->fpdf->SetFont('Times','',10);
$this->fpdf->Cell(3,0.5,"Halaman ",'0',0,'L');
$this->fpdf->Cell(4,0.5,": ",0,0,'L');

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','',10);
$this->fpdf->Cell(5,0.5,"Cabang : ".$cabang,0,0,'L');
$this->fpdf->Cell(14,0.5,"From Date : ".$tgl,0,0,'L');
$this->fpdf->Cell(3,0.5,"Tanggal ",0,0,'L');
$this->fpdf->Cell(4,0.5,": $sekarang",0,0,'L');

$this->fpdf->Ln(0.6);
$this->fpdf->Cell(26,0.05,"",'TLBR',0,'C',1);

$this->fpdf->Ln();
$this->fpdf->SetFont('Times','B',11);
$this->fpdf->Cell(26,0.5,"",0,0,'L');
if(!$uri3 == ''){
	if($uri3 == '1'){
				if($uri4 == '0'){}else{ $this->db->where('wp_id', $uri4);}
				$this->db->order_by($order_column='wp_id',$order_type='asc'); $this->db->order_by($order_column='id',$order_type='asc'); 
				$cab = $this->db->get_where('customer',array('cek'=>'0')); $info = $cab->result(); $no1=0; foreach($info as $row1 ): $no1++;
					if(!$this->bbm_model->customer_jurnal($row1->id)) {

						$this->fpdf->Ln(0.6);
						$this->fpdf->SetFont('Times','B',9);
						$this->fpdf->Cell(2,0.5,"Kode",0,0,'L');
						$this->fpdf->Cell(2,0.5,": C-".$row1->id_customer,0,0,'L');
						if($this->session->userdata('ADMIN') =='1'){
						$this->fpdf->Cell(5,0.5," - ID : ".$row1->id." | Cabang : ".$this->pajak_model->KotaCabang($row1->wp_id),0,0,'L');}

						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','B',9);
						$this->fpdf->Cell(2,0.5,"NAMA",0,0,'L');
						$this->fpdf->Cell(20,0.5,": ".$row1->nama." | Kota : ".$row1->kota." | CP : ".$row1->cp,0,0,'L');

					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','B',11);
					$this->fpdf->Cell(26,0.1,"",'B',0,'C');

						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','B',8);
						$this->fpdf->Cell(1.75,0.5,"INVOICE",0,0,'L');
						$this->fpdf->Cell(3,0.5,"INVOICE",0,0,'L');
						$this->fpdf->Cell(1.75,0.5,"DUE",0,0,'L');
						$this->fpdf->Cell(2.75,0.5,"PAY",0,0,'L');
						$this->fpdf->Cell(1.25,0.5,"TERM",0,0,'R');
						$this->fpdf->Cell(2,0.5,"TOTAL",0,0,'R');
						$this->fpdf->Cell(2,0.5,"CURRENT",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(1.5,0.5,"FROM",0,0,'R');

						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','B',8);
						$this->fpdf->Cell(1.75,0.5,"DATE",0,0,'L');
						$this->fpdf->Cell(3,0.5,"NOMOR",0,0,'L');
						$this->fpdf->Cell(1.75,0.5,"DATE",0,0,'L');
						$this->fpdf->Cell(2.75,0.5,"SISA",0,0,'L');
						$this->fpdf->Cell(1.25,0.5,"",0,0,'R');
						$this->fpdf->Cell(2,0.5,"INVOICE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"AMOUNT",0,0,'R');
						$this->fpdf->Cell(2,0.5,"<=30 DAYS",0,0,'R');
						$this->fpdf->Cell(2,0.5,"<=60 DAYS",0,0,'R');
						$this->fpdf->Cell(2,0.5,"<=90 DAYS",0,0,'R');
						$this->fpdf->Cell(2,0.5,"<=120 DAYS",0,0,'R');
						$this->fpdf->Cell(2,0.5,">120 DAYS",0,0,'R');
						$this->fpdf->Cell(1.5,0.5,"NOW",0,0,'R');

					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','B',11);
					$this->fpdf->Cell(26,0.1,"",'B',0,'C');

// _____________________________________________

$this->db->where('jurnal_detail.kategori_id', '3');
$this->db->where('jurnal.customer_id', $row1->id); $this->db->where('jurnal.voucher_id', '9'); 
if(!$uri4=='0'){ $this->db->where('jurnal.wp_id', $uri4); }
if(!$uri6==''){ $this->db->where('jurnal.tempo >=', $uri6); }
if($this->session->userdata('ADMIN')>='2'){$this->db->where('jurnal.wp_id', $this->session->userdata('SESS_WP_ID'));   }	

$this->db->order_by($order_column='tempo',$order_type='asc');
$this->db->select('*'); $this->db->from('jurnal');
$this->db->join('jurnal_detail', 'jurnal_detail.jurnal_id=jurnal.id');
$sat = $this->db->get(); $journal_aging = $sat->result();
if($journal_aging>0)
{
$i = 0; $TA=0; $TA1=0; $TA2=0; $TA3=0; $TA4=0; $TA5=0; $TA6=0; $Tpay =0;
foreach ($journal_aging as $rows)
{
$now = date("Y-m-d");
$tgl=$this->jurnal_model->tgl_str($rows->tgl); 
$due=$this->jurnal_model->tgl_str($rows->tempo); 
$nomor = $rows->no_voucher; 
$kode=$this->jurnal_model->KodeVoucher($rows->voucher_id); 
$no = $rows->jurnal_id;
$cab = $this->pajak_model->KodeCabang($rows->wp_id);
$bln=$this->jurnal_model->ambilBln($rows->tgl); 
$thn=$this->jurnal_model->ambilThn($rows->tgl); 
$n=$tgl."</br>".$nomor."/".$kode."/".$no; 

$idjual=$this->jurnal_model->IdJual($no); 
if($this->bbm_model->JmlSisaBayarJual($idjual) =='0'){ $pay='LUNAS';}else{
$pay=number_format($this->bbm_model->JmlSisaBayarJual($idjual), 0, ',', '.');}

$nt = $rows->nilai;
$daytgl= strtotime('0 day',strtotime($rows->tgl));
$dayt= strtotime('0 day',strtotime($rows->tempo));
$dayn= strtotime('0 day',strtotime($now));
$dayx= $dayn-$dayt; 
$day= $dayx/86400;
$dayterm= $dayt-$daytgl; 
$term=number_format(($dayterm/86400), 0, '', '.'); 
if($now <= $rows->tempo){$days=''; }else{$days=number_format(($day), 0, '', '.').' Days'; }
if($day > 120){$ca='0'; $b1='0'; $b2='0'; $b3='0'; $b4='0'; $b5=$nt; }else{
	if($day > 90){$ca=''; $b1='0'; $b2='0'; $b3='0'; $b4=$nt; $b5='0'; }else{
		if($day > 60){$ca='0'; $b1='0'; $b2='0'; $b3=$nt; $b4='0'; $b5='0'; }else{
			if($day > 30){$ca='0'; $b1='0'; $b2=$nt; $b3='0'; $b4='0'; $b5='0'; }else{
				if($day > 0){$ca='0'; $b1=$nt; $b2='0'; $b3='0'; $b4='0'; $b5='0'; }else{
				$ca=$nt; $b1='0'; $b2='0'; $b3='0'; $b4='0'; $b5='0'; 
				}
			}
		}
	}
}
if(!$nt=='0'){$nilai = number_format(($nt), 0, '', '.'); }else{$nilai = '0';}
if(!$ca=='0'){$nca = number_format(($ca), 0, '', '.'); }else{$nca = '0';}
if(!$b1=='0'){$nb1 = number_format(($b1), 0, '', '.'); }else{$nb1 = '0';}
if(!$b2=='0'){$nb2 = number_format(($b2), 0, '', '.'); }else{$nb2 = '0';}
if(!$b3=='0'){$nb3 = number_format(($b3), 0, '', '.'); }else{$nb3 = '0';}
if(!$b4=='0'){$nb4 = number_format(($b4), 0, '', '.'); }else{$nb4 = '0';}
if(!$b5=='0'){$nb5 = number_format(($b5), 0, '', '.'); }else{$nb5 = '0';}
if($uri5=='0'){ 
					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','',8);
					$this->fpdf->Cell(1.75,0.5,$tgl,0,0,'L');
					$this->fpdf->Cell(3,0.5,$nomor."/".$kode."/".$no,0,0,'L');
					$this->fpdf->Cell(1.75,0.5,$due,0,0,'L');
					$this->fpdf->Cell(2.75,0.5,$pay,0,0,'R');
					$this->fpdf->Cell(1.25,0.5,$term." Days",0,0,'R');
					$this->fpdf->Cell(2,0.5,$nilai,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nca,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb1,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb2,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb3,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb4,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb5,0,0,'R');
					$this->fpdf->Cell(1.5,0.5,$days,0,0,'R');
}else{
	if(!$this->bbm_model->JmlSisaBayarJual($idjual) =='0'){ 
						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','',8);
						$this->fpdf->Cell(1.75,0.5,$tgl,0,0,'L');
						$this->fpdf->Cell(3,0.5,$nomor."/".$kode."/".$no,0,0,'L');
						$this->fpdf->Cell(1.75,0.5,$due,0,0,'L');
						$this->fpdf->Cell(2.75,0.5,$pay,0,0,'R');
						$this->fpdf->Cell(1.25,0.5,$term." Days",0,0,'R');
						$this->fpdf->Cell(2,0.5,$nilai,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nca,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb1,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb2,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb3,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb4,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb5,0,0,'R');
						$this->fpdf->Cell(1.5,0.5,$days,0,0,'R');
	}
}
	$i++; $TA = $TA+$nt; $TA1 = $TA1+$ca; $TA2 = $TA2+$b1; $TA3 = $TA3+$b2; $TA4 = $TA4+$b3; $TA5 = $TA5+$b4; $TA6 = $TA6+$b5; 
	$Tpay = $Tpay+$this->bbm_model->JmlSisaBayarJual($this->jurnal_model->IdJual($no));
}
}else{ $TA =0; $TA1 =0; $TA2 =0; $TA3 =0; $TA4 =0; $TA5 =0; $TA6 =0; $Tpay =0;
}
$nTA = number_format(($TA), 0, '', '.');
$nTA1 = number_format(($TA1), 0, '', '.');
$nTA2 = number_format(($TA2), 0, '', '.');
$nTA3 = number_format(($TA3), 0, '', '.');
$nTA4 = number_format(($TA4), 0, '', '.');
$nTA5 = number_format(($TA5), 0, '', '.');
$nTA6 = number_format(($TA6), 0, '', '.');
$nTpay = number_format(($Tpay), 0, '', '.');
					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','B',11);
					$this->fpdf->Cell(26,0.1,"",'B',0,'C');

						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','B',8);
						$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
						$this->fpdf->Cell(3,0.5,"",0,0,'L');
						$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
						$this->fpdf->Cell(2.75,0.5,$nTpay,0,0,'R');
						$this->fpdf->Cell(1.25,0.5,"",0,0,'L');
						$this->fpdf->Cell(2,0.5,$nTA,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA1,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA2,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA3,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA4,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA5,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA6,0,0,'R');
						$this->fpdf->Cell(1.5,0.5,"",0,0,'R');

					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','B',11);
					$this->fpdf->Cell(26,0,"",'B',0,'C');
					 }
				 endforeach;
		 }else{ // ___________________________________SUPPLIER____________________________________________________________________________
				if($uri4 == '0'){}else{ $this->db->where('wp_id', $uri4);}
				$this->db->order_by($order_column='wp_id',$order_type='asc'); $this->db->order_by($order_column='id',$order_type='asc'); 
				$cab = $this->db->get_where('supplier',array('cek'=>'0')); $info = $cab->result(); $no1=0; foreach($info as $row1 ): $no1++;
					if(!$this->bbm_model->supplier_jurnal($row1->id)) {

						$this->fpdf->Ln(0.6);
						$this->fpdf->SetFont('Times','B',9);
						$this->fpdf->Cell(2,0.5,"Kode",0,0,'L');
						$this->fpdf->Cell(2,0.5,": S-".$row1->id_supplier,0,0,'L');
						if($this->session->userdata('ADMIN') =='1'){
						$this->fpdf->Cell(5,0.5," - ID : ".$row1->id." | Cabang : ".$this->pajak_model->KotaCabang($row1->wp_id),0,0,'L');}

						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','B',9);
						$this->fpdf->Cell(2,0.5,"NAMA",0,0,'L');
						$this->fpdf->Cell(20,0.5,": ".$row1->nama." | Kota : ".$row1->kota." | CP : ".$row1->cp,0,0,'L');

					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','B',11);
					$this->fpdf->Cell(26,0.1,"",'B',0,'C');

						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','B',8);
						$this->fpdf->Cell(1.75,0.5,"BILL",0,0,'L');
						$this->fpdf->Cell(3,0.5,"BILL",0,0,'L');
						$this->fpdf->Cell(1.75,0.5,"DUE",0,0,'L');
						$this->fpdf->Cell(2.75,0.5,"PAY",0,0,'L');
						$this->fpdf->Cell(1.25,0.5,"TERM",0,0,'R');
						$this->fpdf->Cell(2,0.5,"TOTAL",0,0,'R');
						$this->fpdf->Cell(2,0.5,"CURRENT",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"BALANCE",0,0,'R');
						$this->fpdf->Cell(1.5,0.5,"FROM",0,0,'R');

						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','B',8);
						$this->fpdf->Cell(1.75,0.5,"DATE",0,0,'L');
						$this->fpdf->Cell(3,0.5,"NOMOR",0,0,'L');
						$this->fpdf->Cell(1.75,0.5,"DATE",0,0,'L');
						$this->fpdf->Cell(2.75,0.5,"SISA",0,0,'L');
						$this->fpdf->Cell(1.25,0.5,"",0,0,'R');
						$this->fpdf->Cell(2,0.5,"INVOICE",0,0,'R');
						$this->fpdf->Cell(2,0.5,"AMOUNT",0,0,'R');
						$this->fpdf->Cell(2,0.5,"<=30 DAYS",0,0,'R');
						$this->fpdf->Cell(2,0.5,"<=60 DAYS",0,0,'R');
						$this->fpdf->Cell(2,0.5,"<=90 DAYS",0,0,'R');
						$this->fpdf->Cell(2,0.5,"<=120 DAYS",0,0,'R');
						$this->fpdf->Cell(2,0.5,">120 DAYS",0,0,'R');
						$this->fpdf->Cell(1.5,0.5,"NOW",0,0,'R');

					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','B',11);
					$this->fpdf->Cell(26,0.1,"",'B',0,'C');

// _____________________________________________

$this->db->where('jurnal_detail.kategori_id', '18');
$this->db->where('jurnal.supplier_id', $row1->id); $this->db->where('jurnal.voucher_id', '7'); 
if(!$uri4=='0'){ $this->db->where('jurnal.wp_id', $uri4); }
if(!$uri6==''){ $this->db->where('jurnal.tempo >=', $uri6); }
if($this->session->userdata('ADMIN')>='2'){$this->db->where('jurnal.wp_id', $this->session->userdata('SESS_WP_ID'));   }	

$this->db->order_by($order_column='tempo',$order_type='asc');
$this->db->select('*'); $this->db->from('jurnal');
$this->db->join('jurnal_detail', 'jurnal_detail.jurnal_id=jurnal.id');
$sat = $this->db->get(); $journal_aging = $sat->result();
if($journal_aging>0)
{
$i = 0; $TA=0; $TA1=0; $TA2=0; $TA3=0; $TA4=0; $TA5=0; $TA6=0; $Tpay =0;
foreach ($journal_aging as $rows)
{
$now = date("Y-m-d");
$tgl=$this->jurnal_model->tgl_str($rows->tgl); 
$due=$this->jurnal_model->tgl_str($rows->tempo); 
$nomor = $rows->no_voucher; 
$kode=$this->jurnal_model->KodeVoucher($rows->voucher_id); 
$no = $rows->jurnal_id;
$cab = $this->pajak_model->KodeCabang($rows->wp_id);
$bln=$this->jurnal_model->ambilBln($rows->tgl); 
$thn=$this->jurnal_model->ambilThn($rows->tgl); 
$n=$tgl."</br>".$nomor."/".$kode."/".$no; 

$idbeli=$this->jurnal_model->IdBeli($no); 
if($this->bbm_model->JmlSisaBayarBeli($idbeli) =='0'){ $pay='LUNAS';}else{
$pay=number_format($this->bbm_model->JmlSisaBayarBeli($idbeli), 0, ',', '.');}

$nt = $rows->nilai;
$daytgl= strtotime('0 day',strtotime($rows->tgl));
$dayt= strtotime('0 day',strtotime($rows->tempo));
$dayn= strtotime('0 day',strtotime($now));
$dayx= $dayn-$dayt; 
$day= $dayx/86400;
$dayterm= $dayt-$daytgl; 
$term=number_format(($dayterm/86400), 0, '', '.'); 
if($now <= $rows->tempo){$days=''; }else{$days=number_format(($day), 0, '', '.').' Days'; }
if($day > 120){$ca='0'; $b1='0'; $b2='0'; $b3='0'; $b4='0'; $b5=$nt; }else{
	if($day > 90){$ca=''; $b1='0'; $b2='0'; $b3='0'; $b4=$nt; $b5='0'; }else{
		if($day > 60){$ca='0'; $b1='0'; $b2='0'; $b3=$nt; $b4='0'; $b5='0'; }else{
			if($day > 30){$ca='0'; $b1='0'; $b2=$nt; $b3='0'; $b4='0'; $b5='0'; }else{
				if($day > 0){$ca='0'; $b1=$nt; $b2='0'; $b3='0'; $b4='0'; $b5='0'; }else{
				$ca=$nt; $b1='0'; $b2='0'; $b3='0'; $b4='0'; $b5='0'; 
				}
			}
		}
	}
}
if(!$nt=='0'){$nilai = number_format(($nt), 0, '', '.'); }else{$nilai = '0';}
if(!$ca=='0'){$nca = number_format(($ca), 0, '', '.'); }else{$nca = '0';}
if(!$b1=='0'){$nb1 = number_format(($b1), 0, '', '.'); }else{$nb1 = '0';}
if(!$b2=='0'){$nb2 = number_format(($b2), 0, '', '.'); }else{$nb2 = '0';}
if(!$b3=='0'){$nb3 = number_format(($b3), 0, '', '.'); }else{$nb3 = '0';}
if(!$b4=='0'){$nb4 = number_format(($b4), 0, '', '.'); }else{$nb4 = '0';}
if(!$b5=='0'){$nb5 = number_format(($b5), 0, '', '.'); }else{$nb5 = '0';}
if($uri5=='0'){ 
					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','',8);
					$this->fpdf->Cell(1.75,0.5,$tgl,0,0,'L');
					$this->fpdf->Cell(3,0.5,$nomor."/".$kode."/".$no,0,0,'L');
					$this->fpdf->Cell(1.75,0.5,$due,0,0,'L');
					$this->fpdf->Cell(2.75,0.5,$pay,0,0,'R');
					$this->fpdf->Cell(1.25,0.5,$term." Days",0,0,'R');
					$this->fpdf->Cell(2,0.5,$nilai,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nca,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb1,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb2,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb3,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb4,0,0,'R');
					$this->fpdf->Cell(2,0.5,$nb5,0,0,'R');
					$this->fpdf->Cell(1.5,0.5,$days,0,0,'R');
}else{
	if(!$this->bbm_model->JmlSisaBayarBeli($idbeli) =='0'){ 
						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','',8);
						$this->fpdf->Cell(1.75,0.5,$tgl,0,0,'L');
						$this->fpdf->Cell(3,0.5,$nomor."/".$kode."/".$no,0,0,'L');
						$this->fpdf->Cell(1.75,0.5,$due,0,0,'L');
						$this->fpdf->Cell(2.75,0.5,$pay,0,0,'R');
						$this->fpdf->Cell(1.25,0.5,$term." Days",0,0,'R');
						$this->fpdf->Cell(2,0.5,$nilai,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nca,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb1,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb2,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb3,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb4,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nb5,0,0,'R');
						$this->fpdf->Cell(1.5,0.5,$days,0,0,'R');
	}
}
	$i++; $TA = $TA+$nt; $TA1 = $TA1+$ca; $TA2 = $TA2+$b1; $TA3 = $TA3+$b2; $TA4 = $TA4+$b3; $TA5 = $TA5+$b4; $TA6 = $TA6+$b5; 
	$Tpay = $Tpay+$this->bbm_model->JmlSisaBayarBeli($this->jurnal_model->IdBeli($no));
}
}else{ $TA =0; $TA1 =0; $TA2 =0; $TA3 =0; $TA4 =0; $TA5 =0; $TA6 =0; $Tpay =0;
}
$nTA = number_format(($TA), 0, '', '.');
$nTA1 = number_format(($TA1), 0, '', '.');
$nTA2 = number_format(($TA2), 0, '', '.');
$nTA3 = number_format(($TA3), 0, '', '.');
$nTA4 = number_format(($TA4), 0, '', '.');
$nTA5 = number_format(($TA5), 0, '', '.');
$nTA6 = number_format(($TA6), 0, '', '.');
$nTpay = number_format(($Tpay), 0, '', '.');
					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','B',11);
					$this->fpdf->Cell(26,0.1,"",'B',0,'C');

						$this->fpdf->Ln();
						$this->fpdf->SetFont('Times','B',8);
						$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
						$this->fpdf->Cell(3,0.5,"",0,0,'L');
						$this->fpdf->Cell(1.75,0.5,"",0,0,'L');
						$this->fpdf->Cell(2.75,0.5,$nTpay,0,0,'R');
						$this->fpdf->Cell(1.25,0.5,"",0,0,'L');
						$this->fpdf->Cell(2,0.5,$nTA,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA1,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA2,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA3,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA4,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA5,0,0,'R');
						$this->fpdf->Cell(2,0.5,$nTA6,0,0,'R');
						$this->fpdf->Cell(1.5,0.5,"",0,0,'R');

					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','B',11);
					$this->fpdf->Cell(26,0,"",'B',0,'C');
					 }
				 endforeach;	
	}
}

					$this->fpdf->Ln();
					$this->fpdf->SetFont('Times','B',11);
					$this->fpdf->Cell(26,0.5,"",0,0,'L');


$this->fpdf->Output("$judul.Laporan_Aging_from.$tgl.pdf","I");
?> 
