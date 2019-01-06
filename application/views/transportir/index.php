<div class="content-wrapper">
<section class="content-header">
  <h1><?php echo $title; ?></h1>
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
				<a target="_blank"href="<?php echo site_url('transportir/tambah');?>" class="btn btn-success"><i class="fa fa-plus"></i><b> Tambah <?php echo $title;?></b></a>
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Alamat</th>
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<th>Cabang</th>
				<?php } ?>
					<th>Action</th>
				</tr>
			</thead>						
			<tbody>
			<?php if($this->session->userdata('ADMIN')>='2'){ $this->db->where('wp_id', $this->session->userdata('SESS_WP_ID')); } ?>
			<?php $this->db->order_by($order_column='id',$order_type='desc'); ?>
			<?php $data = $this->db->get_where('transportir',array('cek'=>'0'))->result(); $no=0; foreach($data as $row ): $no++;?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->kode;?></td>
					<td><a data-toggle="modal" href="#m-view-<?php echo $row->id;?>" ><b><?php echo $row->nama;?></b></a></td>
					<td><?php echo $row->alamat;?></td>
				<?php if($this->session->userdata('ADMIN') =='1'){ ?>
					<td><?php echo $this->pajak_model->KotaCabang($row->wp_id);?></td>
				<?php } ?>
					<td width="70">
						<div class="btn-group-vertical">
				<?php if($this->session->userdata('ADMIN') <='2'){ ?>
							<a href="<?php echo base_url();?>index.php/transportir/hapus/<?php echo $row->id;?>" class="btn btn-danger btn-xs" onClick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class='fa fa-trash-o'></i> Hapus</a>
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

<?php $tran = $this->db->get_where('transportir',array('cek'=>'0')); $item = $tran->result(); foreach($item as $sup ):?>
<div class="modal fade" id="m-view-<?php echo $sup->id;?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<?php $this->db->where('id',$sup->id); $cek=$this->db->get('transportir'); $view=$cek->row_array();?>
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $title;?></h4>
			</div>
			<div class="modal-body">
				<p>* klik untuk edit, kemudian tekan enter untuk simpan</p>
			<table id="table-data" class="table table-striped">
				<tr>
					<th>Nama Perusahaan</th><th>:</th>
					<td>
						<span class="span-nama caption" data-id="<?php echo $view['id'];?>"><?php echo $view['nama'];?></span>
						<input type="text" class="field-nama form-control editor" value="<?php echo $view['nama'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Kode</th><th>:</th>
					<td>
						<span class="span-kode caption" data-id="<?php echo $view['id'];?>"><?php echo $view['kode'];?></span>
						<input type="text" class="field-kode form-control editor" value="<?php echo $view['kode'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Alamat</th><th>:</th>
					<td>
						<span class="span-alamat caption" data-id="<?php echo $view['id'];?>"><?php echo $view['alamat'];?></span>
						<input type="text" class="field-alamat form-control editor" value="<?php echo $view['alamat'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
			</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>
<script type="text/javascript">
$(function(){
	$.ajaxSetup({ type:"post", cache:false, dataType: "json" })

	$(document).on("click","td",function(){
		$(this).find("span[class~='caption']").hide(); $(this).find("img[class~='caption']").hide(); 
		$(this).find("input[class~='editor']").fadeIn().focus(); $(this).find("select[class~='editor']").fadeIn().focus();
	});

	$(document).on("keydown",".editor",function(e){
		if(e.keyCode==13){
			var target=$(e.target);
			var value=target.val();
			var id=target.attr("data-id");
			var tabel='transportir';
			var data={tabel:tabel,id:id,value:value};
			if(target.is(".field-nama")){ data.modul="nama";
			}else if(target.is(".field-kode")){ data.modul="kode";
			}else if(target.is(".field-alamat")){ data.modul="alamat";
			}

			$.ajax({
				data:data,
				url:"<?php echo site_url('home/update'); ?>",
				success: function(a){
					target.hide(); target.siblings("span[class~='caption']").html(value).fadeIn();
				}
			})
		}
	});

});

</script>
