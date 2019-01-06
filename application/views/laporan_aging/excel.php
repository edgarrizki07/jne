<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_Aging.xls");
header("Pragma: no-cache");
header("Expires: 0");
$uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);
if($uri3=='1'){ $judul='Debitur';  }else if($uri3=='2'){ $judul='Creditur';  }else if($uri3==''){ $judul='Debitur/Creditur';  }
?>
  <h3 class="box-title"><?php echo $judul; ?> Aging Report </h3> <?php if($uri5==''){ ?><?php }else{ ?><h4>From : <?php echo $this->jurnal_model->tgl_indo($uri5); ?></h4><?php } ?>
	<table id="" class="table table-bordered">
		<thead>
			<tr>
				<th><?php echo $judul; ?> </th>
			</tr>
		</thead>
		<tbody>
			<?php			
				if($journal_data)
				{
					$i = 0;
					foreach ($journal_data as $row)
					{
						$IdWP=$this->pajak_model->KotaCabang($row->wp_id); 
						$voucher=$this->jurnal_model->ProyekVoucher($row->voucher_id); 
						$klien=$this->proyek_model->KlienProyek($row->proyek_id); 
						$klien1=$this->klien_model->NamaKlien($this->proyek_model->KlienProyek($row->proyek_id)); 
						$klien2=$this->klien_model->CPKlien($this->proyek_model->KlienProyek($row->proyek_id)); 
						$supplier=$row->id; 
						$supplier1=$this->supplier_model->NamaSupplier($row->id); 
						$supplier2=$this->supplier_model->CPSupplier($row->id); 
						$other=$row->other_id; 
						$other1=$this->user_model->NamaUser($row->other_id); 
						$other2=$this->user_model->NamaBUser($row->other_id); 

						$now = date("Y-m-d");
						$day29= date('Y-m-d', strtotime('-29 day',strtotime($now)));
						$day28= date('Y-m-d', strtotime('-28 day',strtotime($now)));
						$day22= date('Y-m-d', strtotime('-22 day',strtotime($now)));
						$day21= date('Y-m-d', strtotime('-21 day',strtotime($now)));
						$day15= date('Y-m-d', strtotime('-15 day',strtotime($now)));
						$day14= date('Y-m-d', strtotime('-14 day',strtotime($now)));
						$day8= date('Y-m-d', strtotime('-8 day',strtotime($now)));
						$day7= date('Y-m-d', strtotime('-7 day',strtotime($now)));
						$day1= date('Y-m-d', strtotime('-1 day',strtotime($now)));

						if($uri3=='1'){$dk_id='1';}else if($uri3=='2'){$dk_id='0';}else if($uri3==''){$dk_id='0';}
						$TotalO= number_format(($this->jurnal_model->OtherAgingAll($row->other_id,$dk_id)), 0, '', '.'); 
						$TotalS= number_format(($this->jurnal_model->SupplierAgingAll($row->supplier_id,$dk_id)), 0, '', '.'); 
						$TotalK= number_format(($this->jurnal_model->KlienAgingAll($this->proyek_model->KlienProyek($row->proyek_id),$dk_id)), 0, '', '.'); 
						$TotalOF= number_format(($this->jurnal_model->OtherAgingFrom($row->other_id,$dk_id,$uri5)), 0, '', '.'); 
						$TotalSF= number_format(($this->jurnal_model->SupplierAgingFrom($row->supplier_id,$dk_id,$uri5)), 0, '', '.'); 
						$TotalKF= number_format(($this->jurnal_model->KlienAgingFrom($this->proyek_model->KlienProyek($row->proyek_id),$dk_id,$uri5)), 0, '', '.'); 
						
						if($uri3 == ''){ 
						$TotalOther=''; $TotalSupplier=''; $TotalKlien='';
						}else{ 
							if($uri5 == ''){ 
							$TotalOther=$TotalO; $TotalSupplier=$TotalS; $TotalKlien=$TotalK; $day29up='2000-01-01';
							}else{ 
							$TotalOther=$TotalOF; $TotalSupplier=$TotalSF; $TotalKlien=$TotalKF; $day29up=$uri5;
							}
						}

						$TotalO28up= number_format(($this->jurnal_model->OtherAgingFromTo($row->other_id,$dk_id,$day29up,$day29)), 0, '', '.'); 
						$TotalS28up= number_format(($this->jurnal_model->SupplierAgingFromTo($row->supplier_id,$dk_id,$day29up,$day29)), 0, '', '.'); 
						$TotalK28up= number_format(($this->jurnal_model->KlienAgingFromTo($this->proyek_model->KlienProyek($row->proyek_id),$dk_id,$day29up,$day29)), 0, '', '.'); 
						$TotalO28= number_format(($this->jurnal_model->OtherAgingFromTo($row->other_id,$dk_id,$day28,$day22)), 0, '', '.'); 
						$TotalS28= number_format(($this->jurnal_model->SupplierAgingFromTo($row->supplier_id,$dk_id,$day28,$day22)), 0, '', '.'); 
						$TotalK28= number_format(($this->jurnal_model->KlienAgingFromTo($this->proyek_model->KlienProyek($row->proyek_id),$dk_id,$day28,$day22)), 0, '', '.'); 
						$TotalO21= number_format(($this->jurnal_model->OtherAgingFromTo($row->other_id,$dk_id,$day21,$day15)), 0, '', '.'); 
						$TotalS21= number_format(($this->jurnal_model->SupplierAgingFromTo($row->supplier_id,$dk_id,$day21,$day15)), 0, '', '.'); 
						$TotalK21= number_format(($this->jurnal_model->KlienAgingFromTo($this->proyek_model->KlienProyek($row->proyek_id),$dk_id,$day21,$day15)), 0, '', '.'); 
						$TotalO14= number_format(($this->jurnal_model->OtherAgingFromTo($row->other_id,$dk_id,$day14,$day8)), 0, '', '.'); 
						$TotalS14= number_format(($this->jurnal_model->SupplierAgingFromTo($row->supplier_id,$dk_id,$day14,$day8)), 0, '', '.'); 
						$TotalK14= number_format(($this->jurnal_model->KlienAgingFromTo($this->proyek_model->KlienProyek($row->proyek_id),$dk_id,$day14,$day8)), 0, '', '.'); 
						$TotalO7= number_format(($this->jurnal_model->OtherAgingFromTo($row->other_id,$dk_id,$day7,$day1)), 0, '', '.'); 
						$TotalS7= number_format(($this->jurnal_model->SupplierAgingFromTo($row->supplier_id,$dk_id,$day7,$day1)), 0, '', '.'); 
						$TotalK7= number_format(($this->jurnal_model->KlienAgingFromTo($this->proyek_model->KlienProyek($row->proyek_id),$dk_id,$day7,$day1)), 0, '', '.'); 
						$TotalO0= number_format(($this->jurnal_model->OtherAgingFromTo($row->other_id,$dk_id,$now,$day29up)), 0, '', '.'); 
						$TotalS0= number_format(($this->jurnal_model->SupplierAgingFromTo($row->supplier_id,$dk_id,$now,$day29up)), 0, '', '.'); 
						$TotalK0= number_format(($this->jurnal_model->KlienAgingFromTo($this->proyek_model->KlienProyek($row->proyek_id),$dk_id,$now,$day29up)), 0, '', '.'); 

						if($row->proyek_id == ''){ 
						$IdAging='Ext.'.$other;
						$NamaAging1=$other1;
						$NamaAging2=$other2;
						$TotalAging=$TotalOther;
						$TotalAging28up=$TotalO28up;
						$TotalAging28=$TotalO28;
						$TotalAging21=$TotalO21;
						$TotalAging14=$TotalO14;
						$TotalAging7=$TotalO7;
						$TotalAging0=$TotalO0;
						}else{ 
							if($voucher == '1'){ 
								$transaksi = 'beli';
								$IdAging='Supplier '.$supplier;
								$NamaAging1=$supplier1;
								$NamaAging2='CP : '.$supplier2;
								$TotalAging=$TotalSupplier;
								$TotalAging28up=$TotalS28up;
								$TotalAging28=$TotalS28;
								$TotalAging21=$TotalS21;
								$TotalAging14=$TotalS14;
								$TotalAging7=$TotalS7;
								$TotalAging0=$TotalS0;
							}else{ 
								$transaksi = 'jual';
								$IdAging='Klien '.$klien;
								$NamaAging1=$klien1;
								$NamaAging2='CP : '.$klien2;
								$TotalAging=$TotalKlien;
								$TotalAging28up=$TotalK28up;
								$TotalAging28=$TotalK28;
								$TotalAging21=$TotalK21;
								$TotalAging14=$TotalK14;
								$TotalAging7=$TotalK7;
								$TotalAging0=$TotalK0;
							}
						}

						echo '<tr>';
							echo '<td>ID : '.$IdAging.' - '.$IdWP.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>Nama : '.$NamaAging1." ".$NamaAging2.'</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td>';
								echo '<table id="example1" class="table table-bordered table-striped">';
									echo '<tr>';
										echo '<td><b>Tanggal - Nomor</b></td>';
										echo '<td><b>Tempo - Term</b></td>';
										echo '<td><b>Tgl Bayar</b></td>';
										echo '<td><b>Total</b></td>';
										echo '<td><b>C. Amount</td>';
										echo '<td><b>B <=7 D</b></td>';
										echo '<td><b>B <=14 D</b></td>';
										echo '<td><b>B <=21 D</b></td>';
										echo '<td><b>B <=28 D</b></td>';
										echo '<td><b>B >28 D</b></td>';
										echo '<td></td>';
									echo '</tr>';
							$this->jurnal_model->set_aging('1');
							$this->jurnal_model->set_due('1');
							  if($uri3==''){
							  }else{
								$this->jurnal_model->set_aging_id($uri3);
								$this->jurnal_model->set_setelah_tgl($uri5);
							  }
							if($row->proyek_id == ''){ 
							$this->jurnal_model->set_other_id($row->other_id);
							}else{ 
								if($voucher == '1'){ 
									$this->jurnal_model->set_supplier_id($row->supplier_id);
								}else{ 
									$this->jurnal_model->set_proyek_id($row->proyek_id);
								}
							}
							$journal_aging = $this->jurnal_model->get_data();
							if($journal_aging)
							{
								$i = 0;
								foreach ($journal_aging as $row)
								{
									$nomor = $row->no_voucher; 
									$kode=$this->jurnal_model->KodeVoucher($row->voucher_id); 
									$no = $row->id;
									$cab = $this->pajak_model->KodeCabang($row->wp_id);
									$singkatan=$this->setting_model->singkatan();
									$bln=$this->jurnal_model->ambilBln($row->tgl); 
									$thn=$this->jurnal_model->ambilThn($row->tgl); 

									$voucher=$this->jurnal_model->ProyekVoucher($row->voucher_id); 
									$t = "SELECT * FROM $transaksi WHERE jurnal_id='$no'"; $d = $this->akun_model->manualQuery($t); $r = $d->num_rows();
									if($r>0){ foreach($d->result() as $h){ $bunker = $h->bunker_id; if($h->tglbyr>0){$tglbyr = $h->tglbyr;}else{$tglbyr = '';} } }else{ $bunker = ''; $tglbyr = ''; }

									$nilai = number_format(($row->nilai), 0, '', '.');
									$now = date("Y-m-d");
									$tgl=$this->jurnal_model->tgl_str($row->tgl); 
									$due=$this->jurnal_model->tgl_str($row->tempo); 
									$pay=$this->jurnal_model->tgl_str($tglbyr); 
									$daytgl= strtotime('0 day',strtotime($row->tgl));
									$dayt= strtotime('0 day',strtotime($row->tempo));
									$dayn= strtotime('0 day',strtotime($now));;
									$dayx= $dayn-$dayt; 
									$day= $dayx/86400;
									$dayterm= $dayt-$daytgl; 
									$term=number_format(($dayterm/86400), 0, '', '.'); 
									if($now <= $row->tempo){$days=''; }else{ $days=number_format(($day), 0, '', '.').' Days'; }
									if($day > 28){$ca='0'; $b7='0'; $b14='0'; $b21='0'; $b28='0'; $b28up=$nilai; }else{
										if($day > 21){$ca=''; $b7='0'; $b14='0'; $b21='0'; $b28=$nilai; $b28up='0'; }else{
											if($day > 14){$ca='0'; $b7='0'; $b14='0'; $b21=$nilai; $b28='0'; $b28up='0'; }else{
												if($day > 7){$ca='0'; $b7='0'; $b14=$nilai; $b21='0'; $b28='0'; $b28up='0'; }else{
													if($day > 0){$ca='0'; $b7=$nilai; $b14='0'; $b21='0'; $b28='0'; $b28up='0'; }else{
													$ca=$nilai; $b7='0'; $b14='0'; $b21='0'; $b28='0'; $b28up='0'; 
													}
												}
											}
										}
									}
									echo '<tr>';
										echo '<td>'.$tgl." - ".$nomor."/".$kode."/".$no."/".$cab."/".$singkatan."/".$bln."/".$thn.'</td>';
										echo '<td>'.$due." - ".$term.' Days</td>';
										echo '<td>'.$pay.'</td>';	
										echo '<td class="text-right">'.$nilai.'</td>';	
										echo '<td class="text-right">'.$ca.'</td>';	
										echo '<td class="text-right">'.$b7.'</td>';	
										echo '<td class="text-right">'.$b14.'</td>';	
										echo '<td class="text-right">'.$b21.'</td>';	
										echo '<td class="text-right">'.$b28.'</td>';	
										echo '<td class="text-right">'.$b28up.'</td>';	
										echo '<td class="text-right">'.$days.'</td>';	
									echo '</tr>';
										$i++;
									}
								}
									echo '<tr>';
										echo '<td></td>';
										echo '<td></td>';
										echo '<td></td>';
										echo '<td class="text-right">'.$TotalAging.'</td>';	
										echo '<td class="text-right">'.$TotalAging0.'</td>';	
										echo '<td class="text-right">'.$TotalAging7.'</td>';	
										echo '<td class="text-right">'.$TotalAging14.'</td>';	
										echo '<td class="text-right">'.$TotalAging21.'</td>';	
										echo '<td class="text-right">'.$TotalAging28.'</td>';	
										echo '<td class="text-right">'.$TotalAging28up.'</td>';	
										echo '<td></td>';
									echo '</tr>';
								echo '</table>';
							echo '</td>';
						echo '</tr>';
						echo '<tr>';
							echo '<td></td>';
						echo '</tr>';
						$i++;
					}
				}
			?>		
		</tbody>	
	</table>
