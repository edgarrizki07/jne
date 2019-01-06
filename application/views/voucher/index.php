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
								<input name="id" type="text" class="form-control" value="<?php echo $this->db->count_all('voucher');?>" required/>
							</div>

						<div class="row">
							<div class="col-lg-7">
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Nama</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<input name="nama" type="text" class="form-control" value="<?php echo $this->jurnal_model->NamaVoucher($this->uri->segment(3)); ?>" required/>
									</div><!-- /input-group -->
								</div>
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Kode</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<input name="kode" type="text" class="form-control" value="<?php echo $this->jurnal_model->KodeVoucher($this->uri->segment(3)); ?>" required/>
									</div><!-- /input-group -->
								</div>
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Jenis</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<input name="jenis" type="text" class="form-control" value="<?php echo $this->jurnal_model->JenisVoucher($this->uri->segment(3)); ?>" required/>
									</div><!-- /input-group -->
								</div>
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Payment</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
										<input name="pay" type="text" class="form-control" value="<?php echo $this->jurnal_model->PayVoucher($this->uri->segment(3)); ?>" required/>
									</div><!-- /input-group -->
								</div>
							</div><!-- /.col-lg-6 -->
							<div class="col-lg-5">
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Kepada</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<?php $kepada=$this->jurnal_model->ProyekVoucher($this->uri->segment(3));?>
									<select name="client" id="client" class="form-control" required>
										<option value="<?php echo $kepada;?>"><?php if($kepada=='0'){ ?>Lain<?php }else if($kepada=='1'){ ?>Supplier<?php }else if($kepada=='2'){ ?>Customer<?php } ?></option>
										<option value="0">Lain</option>
										<option value="1">Supplier</option>
										<option value="2">Customer</option>
									</select>
									</div><!-- /input-group -->
								</div>
								<div class="form-group">
									<div class="col-xs-3">
									<label><strong>Tempo</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<?php $tempo=$this->jurnal_model->DueVoucher($this->uri->segment(3));?>
									<select name="client" id="client" class="form-control" required>
										<option value="<?php echo $tempo;?>"><?php if($tempo=='0'){ ?>Tidak Ada<?php }else{ ?>Ada<?php } ?></option>
										<option value="0">Tidak Ada</option>
										<option value="1">Ada</option>
									</select>
									</div><!-- /input-group -->
								</div>
							</div><!-- /.col-lg-6 -->
						</div><!-- /.row -->
							<!-- button -->
							<div class="text-center">
								<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
								<a href="<?php echo site_url('voucher');?>" class="btn btn-warning"><i class="fa fa-times"></i> Batal</a>
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
					<div class="box-body table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>												
									<th>No</th>
									<th>Kepada</th>
									<th>Kode</th>
									<th>Jenis</th>
									<th>Nama</th>
									<th>Payment</th>
									<th>Tempo</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $this->db->order_by($order_column='id',$order_type='asc'); $sat = $this->db->get_where('voucher');?>
								<?php $item = $sat->result(); ?>
								<?php $no=0; foreach($item as $row ): $no++;?>
								<tr>
									<td><?php echo $no;?></td>
									<td><?php if($row->proyek=='0'){ ?>Lain<?php }else if($row->proyek=='1'){ ?>Supplier<?php }else if($row->proyek=='2'){ ?>Customer<?php } ?></td>
									<td>
										<span class="span-kode caption" data-id="<?php echo $row->id;?>"><?php echo $row->kode;?></span>
										<input type="text" class="field-kode form-control editor" value="<?php echo $row->kode;?>" data-id="<?php echo $row->id;?>" />
									</td>
									<td>
										<span class="span-jenis caption" data-id="<?php echo $row->id;?>"><?php echo $row->jenis;?></span>
										<input type="text" class="field-jenis form-control editor" value="<?php echo $row->jenis;?>" data-id="<?php echo $row->id;?>" />
									</td>
									<td>
										<span class="span-nama caption" data-id="<?php echo $row->id;?>"><?php echo $row->nama;?></span>
										<input type="text" class="field-nama form-control editor" value="<?php echo $row->nama;?>" data-id="<?php echo $row->id;?>" />
									</td>
									<td>
										<span class="span-pay caption" data-id="<?php echo $row->id;?>"><?php echo $row->pay;?></span>
										<input type="text" class="field-pay form-control editor" value="<?php echo $row->pay;?>" data-id="<?php echo $row->id;?>" />
									</td>
									<td><?php if($row->due=='0'){ ?>Tidak Ada<?php }else{ ?>Ada<?php } ?></td>
									<td width="150">
										<a class="label label-info" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>voucher/lihat/<?php echo $row->id;?>'"> Detail</a>
									<?php if($this->session->userdata('ADMIN') =='1'){ ?>
										<a class="label label-success" style="cursor: pointer;" onclick="location.href='<?php echo base_url();?>voucher/edit/<?php echo $row->id;?>'"> Edit</a>
									<?php } ?>
									</td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
				<!-- general form elements disabled -->
			</div><!--/.col (right) -->
	  </div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
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
			var data={id:id,value:value};
			if(target.is(".field-nama")){ data.modul="nama";
			}else if(target.is(".field-kode")){ data.modul="kode";
			}else if(target.is(".field-jenis")){ data.modul="jenis";
			}else if(target.is(".field-pay")){ data.modul="telp";
			}

			$.ajax({
				data:data,
				url:"<?php echo base_url('index.php/voucher/update'); ?>",
				success: function(a){
					target.hide(); target.siblings("span[class~='caption']").html(value).fadeIn();
				}
			})
		}
	});

});

</script>
