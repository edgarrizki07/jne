<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Jurnal_Voucher_$uri3.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
  <h3 class="box-title"><?php echo $title; ?> <?php echo $this->jurnal_model->JenisVoucher($this->uri->segment(3)); ?> </h3> <?php if($uri4==''){ ?><?php }else{ ?><h4 class="pull-right">Date : <?php echo $this->jurnal_model->tgl_indo($uri4); ?> - <?php echo $this->jurnal_model->tgl_indo($uri5); ?></h4><?php } ?>
	<table id="group_table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Bulan</th>
				<th>ID</th>
				<th>Tanggal</th>
				<th>Nomor</th>
				<th>Jurnal</th>	
				<th>Akun</th>
				<th>Debit</th>
				<th>Credit</th>
			</tr>
		</thead>
		<tbody>
			<?php			
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
						$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl)); 
						$thn=$this->jurnal_model->ambilThn($row->tgl); 
						$blnthn=$this->jurnal_model->thn_bln($row->tgl); 
						$j = $this->jurnal_model->FJurnal($row->f_id);
						$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
						echo '<tr>';
						echo '<td><b>'.$blnthn.'</b></td>';
						echo '<td>'.$row->id."-".$row->item.'</td>';
						echo '<td>'.$row->tgl.'</td>';
						echo '<td>'.$nomor."/".$kode."/".$no."/".$cab."/".$bln."/".$thn.'</td>';
						echo '<td>'.$j.' '.$p.'</td>';	
						echo '<td>'.$row->kelompok_akun_id."-".$row->kode." ".$row->account_name.'</td>';
						echo '<td class="text-right">'.$d.'</td>';
						echo '<td class="text-right">'.$k.'</td>';	
						echo '</tr>';
						$i++;
					}
				}
			?>		
		</tbody>	
	</table>
