<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo $title;?></h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
	<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>"; 
	$this->session->unset_userdata('SUCCESSMSG'); } ?>
		<?php if($this->session->userdata('ADMIN') =='1'){ ?>
		<form class="form" action="" method="post" enctype="multipart/form-data" >
			<div class="col-md-12">
				<!-- general form elements disabled -->
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Tambah/Edit <?php echo $title;?></h3>
					</div>
					<div class="box-body well">
							<!-- text input -->
							<div class="hidden">
								<label><strong>ID <?php echo $title;?></strong></label>
								<input name="id" type="text" class="form-control" value="id" required/>
							</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Sub Kategori</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<?php if($this->uri->segment(3)=='0'){ ?>
										<input name="nama" type="text" class="form-control" value="" required/>
										<?php }else{ ?>
										<input name="nama" type="text" class="form-control" value="<?php echo $this->akun_model->NamaJenis($this->uri->segment(3)); ?>" required/>
										<?php } ?>
									</div><!-- /input-group -->
								</div>
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Kode</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<?php if($this->uri->segment(3)=='0'){ ?>
										<input name="kode" type="text" class="form-control" value="" required/>
										<?php }else{ ?>
										<input name="kode" type="text" class="form-control" value="<?php echo $this->akun_model->KodeJenis($this->uri->segment(3)); ?>" required/>
										<?php } ?>
									</div><!-- /input-group -->
								</div>
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Kategori</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<?php $KategoriId=$this->akun_model->KategoriId($this->uri->segment(3));?>
									<select name="kategori_id" id="kategori_id" class="form-control" required>
									<?php if($this->uri->segment(3) == ''){  ?>
									<?php }else{  ?>
										<option value="<?php echo $KategoriId; ?>"><?php echo $this->akun_model->NamaKategori($KategoriId); ?></option>
									<?php } ?>
								<?php $this->db->order_by($order_column='kelompok_akun_id',$order_type='asc'); $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_kategori',array('id !='=>'0'));?>
								<?php $item = $sat->result(); ?>
								<?php $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $row->kelompok_akun_id;?> - <?php echo $row->nama;?></option>
								<?php endforeach;?>
									</select>
									</div><!-- /input-group -->
								</div>
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Aging</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<?php $aging=$this->akun_model->KategoriAging($this->uri->segment(3));?>
									<select name="aging" id="aging" class="form-control" required>
										<option value="<?php echo $aging;?>"><?php if($aging=='0'){ ?>Tidak Ada<?php }else{ ?>Ada<?php } ?></option>
										<option value="0">Tidak Ada</option>
										<option value="1">Ada</option>
									</select>
									</div><!-- /input-group -->
								</div>
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Aging D/K</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<?php $aging_id=$this->akun_model->KategoriAgingId($this->uri->segment(3));?>
									<select name="aging_id" id="aging_id" class="form-control" >
										<option value="<?php if($aging_id=='1'){ ?>1<?php }else if($aging_id=='2'){ ?>2<?php } ?>"><?php if($aging_id=='1'){ ?>Debit<?php }else if($aging_id=='2'){ ?>Credit<?php } ?></option>
										<option value="1">Debit</option>
										<option value="2">Credit</option>
									</select>
									</div><!-- /input-group -->
								</div>
							</div><!-- /.col-lg-6 -->
						</div><!-- /.row -->
							<!-- button -->
							<div class="text-center">
								<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Tambah/Simpan</button>
								<a href="<?php echo site_url('kategori');?>" class="btn btn-warning"><i class="fa fa-times"></i> Batal</a>
								<a href="<?php echo site_url('kategori/subkategori');?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Kategori</a>
								<a href="<?php echo site_url('akun/add');?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Akun</a>
								<a href="<?php echo site_url('akun');?>" class="btn btn-primary"><i class="fa fa-list"></i> Daftar Akun</a>
								<a href="<?php echo site_url('kategori/standart');?>" class="btn btn-primary"><i class="fa fa-list"></i> Daftar Akun Standart</a>
							</div>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!--/.col (right) -->
		</form>
		<?php } ?>
	  </div><!-- /.row -->
	  <div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Daftar <?php echo $title;?></h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>												
									<th>Kode</th>
									<th>Nama</th>
									<th>Aging</th>
									<th>D/K</th>
									<th>Action</th>
								</tr>
							</thead>
								<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_kelompok',array('id !='=>'0'));?>
								<?php $item = $sat->result(); ?>
								<?php $no=0; foreach($item as $row ): $no++;?>
							<thead>
								<tr>
									<th width="10"><?php echo $row->id;?></th>
									<td>
										<b><span class="span-nama caption" data-id="<?php echo $row->id;?>" data-tabel="akun_kelompok"><?php echo $row->nama;?></span>
										<input id="nama_kelompok" type="text" class="field-nama form-control editor" value="<?php echo $row->nama;?>" data-id="<?php echo $row->id;?>" data-tabel="akun_kelompok"/></b>
									</td>
									<th colspan="3"></th>
								</tr>
							</thead>
									<tbody>
										<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_kategori',array('kelompok_akun_id'=>$row->id));?>
										<?php $item = $sat->result(); ?>
										<?php $nom=0; foreach($item as $row1 ): $nom++;?>
										<tr>
											<td width="10"><?php echo $row->id;?>-<b><?php echo $row1->kode;?></b></td>
											<td>
												<ol><span class="span-nama caption" data-id="<?php echo $row1->id;?>" data-tabel="akun_kategori"><?php echo $row1->nama;?></span>
												<input id="nama_kategori" type="text" class="field-nama form-control editor" value="<?php echo $row1->nama;?>" data-id="<?php echo $row1->id;?>" data-tabel="akun_kategori"/>
											</td>
											<td colspan="2"></td>
											<td width="120">
											<?php if($this->session->userdata('ADMIN') =='1'){ ?>
												<a class="label label-success" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>kategori/editsubkategori/<?php echo $row1->id;?>'"> Edit</a>
											<?php } ?>
											</td>
										</tr>
											<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('akun_jenis',array('kategori_id'=>$row1->id));?>
											<?php $item = $sat->result(); ?>
											<?php $nomer=0; foreach($item as $row2 ): $nomer++;?>
											<tr>
												<td width="10"><?php echo $row->id;?>-<?php echo $row1->kode;?> <b><?php echo $row2->kode;?></b></td>
												<td>
													<ol><ol><span class="span-nama caption" data-id="<?php echo $row2->id;?>" data-tabel="akun_jenis"><?php echo $row2->nama;?></span>
													<input type="text" class="field-nama form-control editor" value="<?php echo $row2->nama;?>" data-id="<?php echo $row2->id;?>" data-tabel="akun_jenis"/>
												</td>
												<td><?php if($row2->aging=='0'){ ?>Tidak Ada<?php }else{ ?>Ada<?php } ?></td>
												<td><?php if($row2->aging_id=='1'){ ?>Debit<?php }elseif($row2->aging_id=='2'){ ?>Credit<?php } ?></td>
												<td width="120">
												<?php if($this->session->userdata('ADMIN') =='1'){ ?>
													<a class="label label-success" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>kategori/edit/<?php echo $row2->id;?>'"> Edit</a>
												<?php } ?>
													<a class="label label-info" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>kategori/akun/<?php echo $row2->id;?>'"> Lihat</a>
												</td>
											</tr>
											<?php endforeach;?>
										<?php endforeach;?>
									</tbody>
								<?php endforeach;?>
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
				<!-- general form elements disabled -->
			</div><!--/.col (right) -->
	  </div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
$(document).ready(function(){ 
	$("#nama_kelompok").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); }); 
	$("#nama_kategori").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); }); 
});
$(function(){
	$.ajaxSetup({ type:"post", cache:false, dataType: "json" })

	$(document).on("click","td",function(){
		$(this).find("span[class~='caption']").hide(); $(this).find("img[class~='caption']").hide(); $(this).find("input[class~='editor']").fadeIn().focus();
	});

	$(document).on("keydown",".editor",function(e){
		if(e.keyCode==13){
			var target=$(e.target);
			var value=target.val();
			var id=target.attr("data-id");
			var tabel=target.attr("data-tabel");
			var data={tabel:tabel,id:id,value:value};
			if(target.is(".field-nama")){ data.modul="nama"; }

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
