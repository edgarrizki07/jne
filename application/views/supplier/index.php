<div class="content-wrapper">
<section class="content-header">
  <h1><?php echo $title; ?></h1>
  <ol class="breadcrumb">
	<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
	<li class="active"><?php echo $title; ?></li>
  </ol>
</section>

<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<?php if($this->session->userdata('SUCCESSMSG')){echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>"; $this->session->unset_userdata('SUCCESSMSG');} ?>
		<div class="box-header">
			<div class="btn-group">
				<a class="btn btn-success edit" id="edit"><i class="fa fa-plus"></i> Tambah <?php echo $title;?></a>
				<a class="btn btn-info" id="reload"><i class="fa fa-refresh"></i> <span>Reload</span></a>
			<?php if($this->session->userdata('ADMIN') <='5'){ ?>
				<a class="btn btn-primary" href="<?php echo site_url();?>beli/add"><i class="fa fa-edit"></i> Tambah Pembelian</a>
			<?php } ?>
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">
			<div id="tabel"></div>
		</div>
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->
</div>

<div class="modal fade" id="m-view-" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"> Tambah <?php echo $title;?></h4>
			</div>
			<div class="modal-body">
			<table id="table-data" class="table table-striped">
				<tr>
					<th>Nama Perusahaan</th><th>:</th>
					<td>
						<input type="text" class="field-nama form-control" />
					</td>
				</tr>
				<tr>
					<th>Kode</th><th>:</th>
					<td>
						<input type="text" class="field-kode form-control" />
					</td>
				</tr>
				<tr>
					<th>Status</th><th>:</th>
					<td>
						<select name="status" class="field-status form-control" >
							<option value="Cabang">Cabang</option>
							<option value="Pusat">Pusat</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>NPWP</th><th>:</th>
					<td>
						<input type="text" class="field-npwp form-control"/>
					</td>
				</tr>
				<tr>
					<th>Alamat</th><th>:</th>
					<td>
						<input type="text" class="field-alamat form-control"/>
					</td>
				</tr>
				<tr>
					<th>Kota</th><th>:</th>
					<td>
						<input type="text" class="field-kota form-control"/>
					</td>
				</tr>
				<tr>
					<th>Provinsi</th><th>:</th>
					<td>
						<input type="text" class="field-provinsi form-control"/>
					</td>
				</tr>
				<tr>
					<th>Email</th><th>:</th>
					<td>
						<input type="text" class="field-email form-control"/>
					</td>
				</tr>
				<tr>
					<th>No Telp</th><th>:</th>
					<td>
						<input type="text" class="field-telp form-control"/>
					</td>
				</tr>
				<tr>
					<th>No Fax</th><th>:</th>
					<td>
						<input type="text" class="field-fax form-control"/>
					</td>
				</tr>
				<tr>
					<th>Kontak Person</th><th>:</th>
					<td>
						<input type="text" class="field-cp form-control"/>
					</td>
				</tr>
				<tr>
					<th>HP</th><th>:</th>
					<td>
						<input type="text" class="field-hp form-control"/>
					</td>
				</tr>
				<tr>
					<th>Alamat Depo</th><th>:</th>
					<td>
						<input type="text" class="field-depo form-control"/>
					</td>
				</tr>
				<tr>
					<th>Rekening</th><th>:</th>
					<td>
						<input type="text" class="field-rekening form-control"/>
					</td>
				</tr>
				<tr>
					<th>Keterangan</th><th>:</th>
					<td>
						<input type="text" class="field-keterangan form-control"/>
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

<?php $supp = $this->db->get_where('supplier',array('cek'=>'0')); $item = $supp->result(); foreach($item as $sup ):?>
<div class="modal fade" id="m-view-<?php echo $sup->id;?>" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<?php $this->db->where('id',$sup->id); $cek=$this->db->get('supplier'); $view=$cek->row_array();?>
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
					<th>Status</th><th>:</th>
					<td>
						<span class="span-status caption" data-id="<?php echo $view['id'];?>"><?php echo $view['status'];?></span>
						<select name="status" class="field-status form-control editor" data-id="<?php echo $view['id'];?>">
							<option value="<?php echo $view['status'];?>"><?php echo $view['status'];?></option>
							<option value="Cabang">Cabang</option>
							<option value="Pusat">Pusat</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>NPWP</th><th>:</th>
					<td>
						<span class="span-npwp caption" data-id="<?php echo $view['id'];?>"><?php echo $view['npwp'];?></span>
						<input type="text" class="field-npwp form-control editor" value="<?php echo $view['npwp'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Alamat</th><th>:</th>
					<td>
						<span class="span-alamat caption" data-id="<?php echo $view['id'];?>"><?php echo $view['alamat'];?></span>
						<input type="text" class="field-alamat form-control editor" value="<?php echo $view['alamat'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Kota</th><th>:</th>
					<td>
						<span class="span-kota caption" data-id="<?php echo $view['id'];?>"><?php echo $view['kota'];?></span>
						<input type="text" class="field-kota form-control editor" value="<?php echo $view['kota'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Provinsi</th><th>:</th>
					<td>
						<span class="span-provinsi caption" data-id="<?php echo $view['id'];?>"><?php echo $view['provinsi'];?></span>
						<input type="text" class="field-provinsi form-control editor" value="<?php echo $view['provinsi'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Email</th><th>:</th>
					<td>
						<span class="span-email caption" data-id="<?php echo $view['id'];?>"><?php echo $view['email'];?></span>
						<input type="text" class="field-email form-control editor" value="<?php echo $view['email'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>No Telp</th><th>:</th>
					<td>
						<span class="span-telp caption" data-id="<?php echo $view['id'];?>"><?php echo $view['telp'];?></span>
						<input type="text" class="field-telp form-control editor" value="<?php echo $view['telp'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>No Fax</th><th>:</th>
					<td>
						<span class="span-fax caption" data-id="<?php echo $view['id'];?>"><?php echo $view['fax'];?></span>
						<input type="text" class="field-fax form-control editor" value="<?php echo $view['fax'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Kontak Person</th><th>:</th>
					<td>
						<span class="span-cp caption" data-id="<?php echo $view['id'];?>"><?php echo $view['cp'];?></span>
						<input type="text" class="field-cp form-control editor" value="<?php echo $view['cp'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>HP</th><th>:</th>
					<td>
						<span class="span-hp caption" data-id="<?php echo $view['id'];?>"><?php echo $view['hp'];?></span>
						<input type="text" class="field-hp form-control editor" value="<?php echo $view['hp'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Alamat Depo</th><th>:</th>
					<td>
						<span class="span-depo caption" data-id="<?php echo $view['id'];?>"><?php echo $view['depo'];?></span>
						<input type="text" class="field-depo form-control editor" value="<?php echo $view['depo'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Rekening</th><th>:</th>
					<td>
						<span class="span-rekening caption" data-id="<?php echo $view['id'];?>"><?php echo $view['rekening'];?></span>
						<input type="text" class="field-rekening form-control editor" value="<?php echo $view['rekening'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
				<tr>
					<th>Keterangan</th><th>:</th>
					<td>
						<span class="span-keterangan caption" data-id="<?php echo $view['id'];?>"><?php echo $view['keterangan'];?></span>
						<input type="text" class="field-keterangan form-control editor" value="<?php echo $view['keterangan'];?>" data-id="<?php echo $view['id'];?>" />
					</td>
				</tr>
			</table>
			</div>
			<div class="modal-footer">
				<button type="button" id="reload" class="btn btn-info pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>
<script type="text/javascript">
$(function(){
//Load
	function loadData(args) {  $("#tabel").load("<?php echo site_url("supplier/read"); ?>"); }
	loadData();

	$("#reload").click(function(){ loadData(); })

	$.ajaxSetup({ type:"post", cache:false, dataType: "json" })

	$(document).on("click","td",function(){
		$(this).find("span[class~='caption']").hide(); $(this).find("img[class~='caption']").hide(); 
		$(this).find("input[class~='editor']").fadeIn().focus(); $(this).find("select[class~='editor']").fadeIn().focus();
	});

	$(document).on("click",".edit",function(){
		$(this).find("tbody[class~='tabel_view']").hide(); 
	});

	$(document).on("keydown",".editor",function(e){
		if(e.keyCode==13){
			var target=$(e.target);
			var value=target.val();
			var id=target.attr("data-id");
			var tabel='supplier';
			var data={tabel:tabel,id:id,value:value};
			if(target.is(".field-nama")){ data.modul="nama";
			}else if(target.is(".field-kode")){ data.modul="kode";
			}else if(target.is(".field-npwp")){ data.modul="npwp";
			}else if(target.is(".field-status")){ data.modul="status";
			}else if(target.is(".field-alamat")){ data.modul="alamat";
			}else if(target.is(".field-kota")){ data.modul="kota";
			}else if(target.is(".field-provinsi")){ data.modul="provinsi";
			}else if(target.is(".field-telp")){ data.modul="telp";
			}else if(target.is(".field-email")){ data.modul="email";
			}else if(target.is(".field-cp")){ data.modul="cp";
			}else if(target.is(".field-hp")){ data.modul="hp";
			}else if(target.is(".field-fax")){ data.modul="fax";
			}else if(target.is(".field-depo")){ data.modul="depo";
			}else if(target.is(".field-rekening")){ data.modul="rekening";
			}else if(target.is(".field-keterangan")){ data.modul="keterangan";
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
