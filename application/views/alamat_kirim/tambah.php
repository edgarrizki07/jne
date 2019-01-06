<script type="text/javascript">
$(document).ready(function(){

	$("#alamat").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kode").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kota").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#provinsi").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#depo").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#rekening").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
		
});	
</script>
</script>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>Tambah <?php echo $title; ?></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Tambah <?php echo $title; ?></li>
          </ol>
        </section>
		<section class="content-header">
			<div class="input-group-btn">
			</div><!-- /btn-group -->
		</section>

		<!-- Main content -->
		<section class="content">
			<form class="form" action="" method="post" enctype="multipart/form-data" >
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="box box-warning">
						<div class="box-body">
							<div class="hidden">
								<label><strong>ID <?php echo $title;?></strong></label>
								<input name="id" type="text" class="form-control" value="ID" required/>
							</div>
						<?php if($this->uri->segment(3)==""){ ?>
							<div class="form-group">
								<label><strong>Customer</strong></label>
								<select name="customer_id" class="form-control" required>
								<option></option>
							<?php if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); } ?>
							<?php $this->db->order_by($order_column='nama',$order_type='asc'); ?>
							<?php $cust = $this->db->get_where('customer',array('cek'=>'0','wp_id'=>$this->session->userdata('SESS_WP_ID')));?>
							<?php $item = $cust->result(); ?>
							<?php $no=0; foreach($item as $row ): $no++;?>
								<option value="<?php echo $row->id;?>"><?php echo $row->nama;?> (<?php echo $row->cp;?>)</option>
							<?php endforeach;?>
								</select>
							</div>
						<?php }else{ ?>	
								<input name="customer_id" type="hidden" class="form-control" value="<?php echo $this->uri->segment(3);?>" required/>
						<?php } ?>		
							<div class="form-group">
								<label><strong>Alamat Kirim</strong></label>
								<input name="alamat" id="alamat" type="text" class="form-control" value="" required/>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
								<a href="<?php echo base_url();?>alamat_kirim/"><button type="button" name="kembali" id="kembali" class="btn btn-primary">
								<i class="fa fa-undo"></i> KEMBALI</button></a>
							</div>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
				</div><!--/.col (right) -->
			</form>
		</section><!-- /.content -->
      </div>
				<!-- end Page Right Column -->