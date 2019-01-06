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
		<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>";
		$this->session->unset_userdata('SUCCESSMSG'); } ?>
	<?php if($this->session->userdata('ADMIN') =='1'){ ?>
		<div class="box-header">
			<div class="btn-group">
				<a target="_blank"href="<?php echo site_url('cabang/add');?>" class="btn btn-success"><i class="fa fa-plus"></i><b> Tambah <?php echo $title;?></b></a>
			</div>
		</div><!-- /.box-header -->
	<?php } ?>
		<div class="box-body">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Provinsi</th>
					<th>Kota</th>
					<th>Telp</th>
					<th>Email</th>
					<th>Kepala</th>
					<th>Action</th>
				</tr>
			</thead>						
			<tbody>
			<?php $this->db->order_by($order_column='id',$order_type='asc'); $cab = $this->db->get('wp');?>
			<?php $info = $cab->result(); ?>
			<?php $no=0; foreach($info as $row ): $no++;?>
				<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $row->provinsi;?></td>
					<td>
						<span class="span-kota caption" data-id="<?php echo $row->id;?>"><?php echo $row->kota;?></span>
						<input type="text" class="field-kota form-control editor" value="<?php echo $row->kota;?>" data-id="<?php echo $row->id;?>" />
					</td>
					<td>
						<span class="span-telp caption" data-id="<?php echo $row->id;?>"><?php echo $row->telp;?></span>
						<input type="text" class="field-telp form-control editor" value="<?php echo $row->telp;?>" data-id="<?php echo $row->id;?>" />
					</td>
					<td>
						<span class="span-email caption" data-id="<?php echo $row->id;?>"><?php echo $row->email;?></span>
						<input type="text" class="field-email form-control editor" value="<?php echo $row->email;?>" data-id="<?php echo $row->id;?>" />
					</td>
					<td>
						<span class="span-kepala caption" data-id="<?php echo $row->id;?>"><?php echo $row->kepala;?></span>
						<input type="text" class="field-kepala form-control editor" value="<?php echo $row->kepala;?>" data-id="<?php echo $row->id;?>" />
					</td>
					<td width="70">
						<div class="btn-group-vertical">
							<a title="" href="<?php echo site_url('cabang/view/'.$row->id);?>" class="btn btn-info btn-xs" >
							<i class='fa fa-file'></i> Lihat</a>
							<a title="" href="<?php echo site_url('cabang/edit/'.$row->id);?>" class="btn btn-success btn-xs" >
							<i class='fa fa-edit'></i> Edit</a>
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
			var tabel='wp';
			var data={tabel:tabel,id:id,value:value};
			if(target.is(".field-kota")){ data.modul="kota";
			}else if(target.is(".field-telp")){ data.modul="telp";
			}else if(target.is(".field-email")){ data.modul="email";
			}else if(target.is(".field-kepala")){ data.modul="kepala";
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
