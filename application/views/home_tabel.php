<?php
	if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
	$this->db->order_by($order_column='id',$order_type='desc');
	$info = $this->db->get_where($tabel,array('cek'=>'0'))->result();
?>
			<?php $no=0; foreach($info as $row ): $no++;?>
				<tr>
					<td><?php echo $no;?></td>
					<td><a data-toggle="modal" href="#m-view-<?php echo $row->id;?>" ><b><?php echo $row->nama;?></b>
					<br><?php echo $row->kota;?> - <?php echo $row->provinsi;?></a></td>
					<td><?php echo $row->cp;?> - <?php echo $row->hp;?>
					<br><?php echo $row->email;?></td>
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></td>
				<?php } ?>
					<td width="70">
						<div class="btn-group-vertical">
				<?php if($this->session->userdata('ADMIN') <='2'){ ?>
							<a title="" href="<?php echo base_url();?>index.php/supplier/hapus/<?php echo $row->id;?>" class="btn btn-danger btn-xs" 
							onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i> Hapus</a>
				<?php } ?>
						</div>
					</td>
				</tr>
			<?php endforeach;?>
