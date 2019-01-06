<div class="content-wrapper">
	<section class="content-header no-print">
		<div class="btn-group">
			<button class="btn btn-warning" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
			<a class="btn btn-primary" style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting/photo');?>'">
			<i class="fa fa-picture-o"></i> Edit Photo</a>
			<a class="btn btn-primary" style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting/logo');?>'">
			<i class="fa fa-picture-o"></i> Edit Logo</a>
			<a class="btn btn-primary" style="cursor: pointer;" onclick="location.href='<?php echo site_url('setting/header');?>'">
			<i class="fa fa-picture-o"></i> Edit Header</a>
		</div><!-- /btn-group -->
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content invoice">
		<!-- title row -->
		<div class="row">
			<div class="col-xs-12">
			  <div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="text-center">Setting Aplikasi :</h3>
				</div><!-- /.box-header -->
				<div class="box-body box-profile">
					<?php if($info['logo_2']==''){ ?>
					<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>uploads/setting/photo.png"/>
					<?php }else{ ?>
					<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('/uploads/setting/'.$info['logo_2']);?>"/>
					<?php } ?>
				  <h3 class="profile-username text-center">Photo</h3>

				  <ul class="col-md-8 list-group list-group-unbordered">
					<li class="list-group-item">
						<p class="lead">Data Perusahaan : </p>
						<?php echo $info['nama'];?>
						<table id="table-data" class="table table-striped">
							<tbody id="table-body">
							<?php 
							foreach ($data as $info) {
								echo "<tr data-id='$info[id]'>
										<th>Nama</th><th>:</th><td><span class='span-nama caption' data-id='$info[id]'>$info[nama]</span> <input type='text' class='field-nama form-control editor' value='$info[nama]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>Singkatan</th><th>:</th><td><span class='span-singkatan caption' data-id='$info[id]'>$info[singkatan]</span> <input type='text' class='field-singkatan form-control editor' value='$info[singkatan]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>Alamat</th><th>:</th><td><span class='span-alamat caption' data-id='$info[id]'>$info[alamat]</span> <input type='text' class='field-alamat form-control editor' value='$info[alamat]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>No Telp</th><th>:</th><td><span class='span-telp caption' data-id='$info[id]'>$info[telp]</span> <input type='text' class='field-telp form-control editor' value='$info[telp]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>No Fax</th><th>:</th><td><span class='span-fax caption' data-id='$info[id]'>$info[fax]</span> <input type='text' class='field-fax form-control editor' value='$info[fax]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>Email PO Pusat</th><th>:</th><td><span class='span-web caption' data-id='$info[id]'>$info[web]</span> <input type='text' class='field-web form-control editor' value='$info[web]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>Keterangan</th><th>:</th><td><span class='span-keterangan caption' data-id='$info[id]'>$info[keterangan]</span> <input type='text' class='field-keterangan form-control editor' value='$info[keterangan]' data-id='$info[id]' /></td>
									  </tr>";
							} ?>
							</tbody>
						</table>
					</li>
				  </ul>
				  <ul class="col-md-4 list-group list-group-unbordered">
					<li class="list-group-item">
						<p class="lead">Data Email : </p>
					</li>
					<li class="list-group-item">
						<table id="table-data" class="table table-striped">
							<tbody id="table-body">
							<?php 
							foreach ($data as $info) {
								echo "<tr data-id='$info[id]'>
										<th>Nama</th><th>:</th><td><span class='span-email caption' data-id='$info[id]'>$info[email]</span> <input type='text' class='field-email form-control editor' value='$info[email]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>Password</th><th>:</th><td><span class='span-password caption' data-id='$info[id]'>$info[password]</span> <input type='text' class='field-password form-control editor' value='$info[password]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>Protocol</th><th>:</th><td><span class='span-protocol caption' data-id='$info[id]'>$info[protocol]</span> <input type='text' class='field-protocol form-control editor' value='$info[protocol]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>Host</th><th>:</th><td><span class='span-host caption' data-id='$info[id]'>$info[host]</span> <input type='text' class='field-host form-control editor' value='$info[host]' data-id='$info[id]' /></td>
									  </tr>
									  <tr data-id='$info[id]'>
										<th>Port</th><th>:</th><td><span class='span-port caption' data-id='$info[id]'>$info[port]</span> <input type='text' class='field-port form-control editor' value='$info[port]' data-id='$info[id]' /></td>
									  </tr>";
							}
							?>
							</tbody>
						</table>
					</li>
				  </ul>
				</div><!-- /.box-body -->
			  </div><!-- /.box -->
			</div><!-- /.col -->
		</div>

<?php if($info['header']==''){ $header = 'header.png';  }else{ $header = $info['header']; } ?>
<?php if($info['logo_1']==''){ $logo_1 = 'logo.png';  }else{ $logo_1 = $info['logo_1']; } ?>
		<div class="row">
			<!-- accepted payments column -->
			<div class="col-md-9">
				<p class="lead">Header Surat : </p>
				<table id="table-data" class="text-muted well well-sm no-shadow">
					<td>
						<img class="img-header caption" width="730px" src="<?php echo base_url() .'uploads/setting/'. $header ;?>"/>
						<p class="text-center">Nama File : <?php echo $header;?></p>
						<div class="input-group hidden">
						<input name="header" id="header" value="<?php $info[header]; ?>" type="file" class="field-header form-control editor"/>
						<span class="input-group-btn">
							<a class="btn btn-info btn-flat" id="edit-header"><i class="fa fa-picture-o"></i> Ganti Gambar</a>
						</span>
						</div>
					</td>
				</table>
			</div><!-- /.col -->
			<div class="col-md-3">
				<p class="lead">Logo Usaha : </p>
				<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
					<img width="210px" src="<?php echo base_url() .'uploads/setting/'. $logo_1 ;?>"/>
				</p>
			</div><!-- /.col -->
		</div><!-- /.row -->

	</section><!-- /.content -->
<div class="clearfix"></div>
</div><!-- /.right-side -->

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
			}else if(target.is(".field-singkatan")){ data.modul="singkatan";
			}else if(target.is(".field-alamat")){ data.modul="alamat";
			}else if(target.is(".field-telp")){ data.modul="telp";
			}else if(target.is(".field-fax")){ data.modul="fax";
			}else if(target.is(".field-web")){ data.modul="web";
			}else if(target.is(".field-keterangan")){ data.modul="keterangan";
			}else if(target.is(".field-email")){ data.modul="email";
			}else if(target.is(".field-password")){ data.modul="password";
			}else if(target.is(".field-protocol")){ data.modul="protocol";
			}else if(target.is(".field-host")){ data.modul="host";
			}else if(target.is(".field-port")){ data.modul="port";
			}

			$.ajax({
				data:data,
				url:"<?php echo base_url('index.php/setting/update'); ?>",
				success: function(a){
					target.hide(); target.siblings("span[class~='caption']").html(value).fadeIn();
				}
			})
		}
	});

});

</script>
