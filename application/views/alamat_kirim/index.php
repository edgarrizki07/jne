      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>
		<section class="content-header">
			<div class="input-group-btn">
			</div><!-- /btn-group -->
		</section>

        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
				<?php if($this->session->userdata('SUCCESSMSG')){echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>"; $this->session->unset_userdata('SUCCESSMSG');} ?>
                <div class="box-header">
					<div class="btn-group">
						<a target="_blank"href="<?php echo site_url('alamat_kirim/tambah');?>" class="btn btn-success"><i class="fa fa-plus"></i><b> Tambah <?php echo $title;?></b></a>
					<?php if($this->session->userdata('ADMIN') <'6'){ ?>
						<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>jual/wait"><i class="fa fa-edit"></i> Draft Penjualan</a>
					<?php } ?>
						<a target="_blank" class="btn btn-primary" href="<?php echo site_url();?>so/list_po"><i class="fa fa-edit"></i> Tambah SO</a>
					</div>
                </div><!-- /.box-header -->
                <div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Customer</th>
							<th>Alamat Kirim</th>
						<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<th>Cabang</th>
						<?php } ?>
							<th>Action</th>
						</tr>
					</thead>						
					<tbody>
					<?php
					if(!$this->uri->segment(3)==''){ $this->db->where('customer_id', $this->uri->segment(3)); }	
					if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); }	
					$this->db->order_by($order_column='id',$order_type='desc');
					$info1 = $this->db->get_where('alamat_kirim',array('cek'=>'0'))->result();
					?>
					<?php $no=0; foreach($info1 as $row ): $no++;?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $this->customer_model->NamaCustomer($row->customer_id);?></td>
							<td><?php echo $row->alamat;?></td>
						<?php if($this->session->userdata('ADMIN') =='1'){ ?>
							<td><?php echo $this->pajak_model->KotaCabang($this->customer_model->WPCustomer($row->customer_id));?></td>
						<?php } ?>
							<td width="70">
								<div class="btn-group-vertical">
									<a title="" href="<?php echo site_url('alamat_kirim/edit/'.$row->id);?>" class="btn btn-success btn-xs" >
									<i class='fa fa-edit'></i> Edit</a>
						<?php if($this->session->userdata('ADMIN') <='2'){ ?>
									<a title="" href="<?php echo base_url();?>index.php/alamat_kirim/hapus/<?php echo $row->id;?>" class="btn btn-danger btn-xs" 
									onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i> Hapus</a>
						<?php } ?>
								</div>
							</td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
			<!-- end Page Content -->