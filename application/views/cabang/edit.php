<script type="text/javascript">
$(document).ready(function(){

	$("#nama").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kode").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kota").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#provinsi").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#namarek").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
		
});	
</script>
      <div class="content-wrapper">
        <section class="content-header">
          <h1>Edit <?php echo $title; ?>  <?php if($info['id'] >'9'){ $nocab = $info['id']  ;}else{ $nocab = '0'.$info['id']  ;} ?>  <?php echo $nocab; ?></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Edit <?php echo $title; ?></li>
          </ol>
        </section>
		<section class="content-header">
			<div class="input-group-btn">
			</div><!-- /btn-group -->
		</section>

		<!-- Main content -->
		<section class="content">
			<form class="form" action="" method="post" enctype="multipart/form-data" >
				<?php echo validation_errors(); echo $message;?>
					<div class="col-md-8">
						<!-- general form elements disabled -->
						<div class="box box-warning">
							<div class="box-body">
								<!-- text input -->
								<div class="hidden">
									<label><strong>ID <?php echo $title;?></strong></label>
									<input name="id" type="text" class="form-control" value="<?php echo $info['id'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Nama</strong></label>
									<input name="nama" id="nama" maxlength="100" type="text" class="form-control" value="<?php echo $info['nama'];?>" required/>
								</div>
								<div class="form-group has-succes">
									<div class="input-group">
									<span class="input-group-addon"> <b>NPWP</b> </span>
									<input name="npwp" type="text" class="form-control" value="<?php echo $info['npwp'];?>" required/>
									<span class="input-group-addon"> <b>Kode</b> </span>
									<input name="kode" id="kode" maxlength="10" type="text" class="form-control" value="<?php echo $info['kode'];?>" required/>
									<span class="input-group-addon"> <b>PBBKB</b> </span>
									<input name="pbbkb" type="text" class="form-control" value="<?php echo $info['pbbkb'];?>" required/>
									</div>
								</div>
								<div class="form-group">
									<label><strong>Alamat</strong></label>
									<input name="alamat" maxlength="80" type="text" class="form-control" value="<?php echo $info['alamat'];?>" required/>
									<input name="alamat1" maxlength="80" type="text" class="form-control" value="<?php echo $info['alamat1'];?>" required/>
								</div>
								<div class="form-group has-succes">
									<div class="input-group">
									<span class="input-group-addon"> <b>Kelurahan</b> </span>
									<input name="kelurahan" maxlength="80" type="text" class="form-control" value="<?php echo $info['kelurahan'];?>" required/>
									<span class="input-group-addon"> <b>Kecamatan</b> </span>
									<input name="kecamatan" maxlength="80" type="text" class="form-control" value="<?php echo $info['kecamatan'];?>" required/>
									</div>
								</div>
								<div class="form-group has-succes">
									<div class="input-group">
									<span class="input-group-addon"> <b>Kota</b> </span>
									<input name="kota" id="kota" maxlength="80" type="text" class="form-control" value="<?php echo $info['kota'];?>" required/>
									<span class="input-group-addon"> <b>Provinsi</b> </span>
									<input name="provinsi" id="provinsi" maxlength="80" type="text" class="form-control" value="<?php echo $info['provinsi'];?>"required/>
									</div>
								</div>
								<div class="form-group">
									<label><strong>Email Utama</strong></label>
									<input name="email" type="text" class="form-control" value="<?php echo $info['email'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Email Pembelian</strong></label>
									<input name="email1" type="text" class="form-control" value="<?php echo $info['email1'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Email Kepala</strong></label>
									<input name="email2" type="text" class="form-control" value="<?php echo $info['email2'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Bank</strong></label>
									<input name="bank" type="text" class="form-control" value="<?php echo $info['bank'];?>" required/>
								</div>
								<div class="form-group has-succes">
									<div class="input-group">
									<span class="input-group-addon"> <b>Nama Rekening</b> </span>
									<input name="namarek" id="namarek" type="text" class="form-control" value="<?php echo $info['namarek'];?>" required/>
									<span class="input-group-addon"> <b>No Rekening</b> </span>
									<input name="rekening" type="text" class="form-control" value="<?php echo $info['rekening'];?>" required/>
									</div>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!--/.col (right) -->
					<div class="col-md-4">
						<!-- general form elements disabled -->
						<div class="box box-warning">
							<div class="box-body">
								<div class="form-group">
									<label><strong>No Telp</strong></label>
									<input name="telp" type="text" class="form-control" value="<?php echo $info['telp'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Fax</strong></label>
									<input name="fax" type="text" class="form-control" value="<?php echo $info['fax'];?>"/>
								</div>
								<div class="form-group">
									<label><strong>Pemilik</strong></label>
									<input name="pemilik" type="text" class="form-control" value="<?php echo $info['pemilik'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Kepala</strong></label>
									<input name="kepala" type="text" class="form-control" value="<?php echo $info['kepala'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Keuangan</strong></label>
									<input name="keuangan" type="text" class="form-control" value="<?php echo $info['keuangan'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Pembelian</strong></label>
									<input name="pembelian" type="text" class="form-control" value="<?php echo $info['pembelian'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Penjualan</strong></label>
									<input name="penjualan" type="text" class="form-control" value="<?php echo $info['penjualan'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Operasional</strong></label>
									<input name="operasional" type="text" class="form-control" value="<?php echo $info['operasional'];?>" required/>
								</div>
								<div class="form-group">
									<label><strong>Pemasaran</strong></label>
									<input name="pemasaran" type="text" class="form-control" value="<?php echo $info['pemasaran'];?>" required/>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!--/.col (right) -->
					<div class="col-md-12">
						<!-- general form elements disabled -->
						<div class="box box-warning">
							<div class="box-body">
								<div class="form-group has-succes">
									<label><strong> Prosedur Penambahan Transaksi Penjualan</strong></label>
									<div class="input-group">
									<span class="input-group-addon"> <b>Melalui</b> </span>
									<select name="accso" id="accso" class="form-control" >
										<?php if($info['accso']=='0'){ $accso = 'Input PO Masuk secara Manual'; }else{ $accso = 'Input PO Masuk dari Marketing -> Input SO dari Keuangan -> ACC SO'; }?>
										<option value="<?php echo $info['accso'];?>"><?php echo $accso;?></option>
										<option value="0">1. Input PO Masuk secara Manual Melalui form Penjualan</option>
										<option value="1">2. Input PO Masuk dari Marketing -> Input SO dari Keuangan -> ACC SO </option>
									</select>
									</div>
								</div>
								<div class="form-group has-succes">
									<label><strong> ACC SO</strong></label>
									<div class="input-group">
									<span class="input-group-addon"> <b>User</b> </span>
									<select name="accsos" id="accsos" class="form-control" >
										<option value="<?php echo $info['accsos'];?>"><?php echo $this->user_model->NamaUser($info['accsos']); ?> - <?php echo $this->user_model->NamaBUser($info['accsos']); ?></option>
									<?php $sup = $this->db->get_where('login',array('wp_id'=>$info['id'],'administrator <'=>'4')); $item = $sup->result(); $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $row->nama_depan;?> - <?php echo $row->nama_belakang;?></option>
									<?php endforeach;?>
									</select>
									<span class="input-group-addon"> <b>Email</b> </span>
									<input name="emailso" maxlength="80" type="text" class="form-control" value="<?php echo $info['emailso'];?>" />
									</div>
								</div>
								<div class="form-group has-succes">
									<label><strong> ACC PO</strong></label>
									<div class="input-group">
									<span class="input-group-addon"> <b>User</b> </span>
									<select name="accpo" id="accpo" class="form-control" >
										<option value="<?php echo $info['accpo'];?>"><?php echo $this->user_model->NamaUser($info['accpo']); ?> - <?php echo $this->user_model->NamaBUser($info['accpo']); ?></option>
									<?php $sup = $this->db->get_where('login',array('wp_id'=>$info['id'],'administrator <'=>'4')); $item = $sup->result(); $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $row->nama_depan;?> - <?php echo $row->nama_belakang;?></option>
									<?php endforeach;?>
									</select>
									<span class="input-group-addon"> <b>Email</b> </span>
									<input name="emailpo" maxlength="80" type="text" class="form-control" value="<?php echo $info['emailpo'];?>" />
									</div>
								</div>
								<div class="form-group has-succes">
									<label><strong> ACC DO</strong></label>
									<div class="input-group">
									<span class="input-group-addon"> <b>User</b> </span>
									<select name="accdo" id="accdo" class="form-control" >
										<option value="<?php echo $info['accdo'];?>"><?php echo $this->user_model->NamaUser($info['accdo']); ?> - <?php echo $this->user_model->NamaBUser($info['accdo']); ?></option>
									<?php $sup = $this->db->get_where('login',array('wp_id'=>$info['id'],'administrator <'=>'4')); $item = $sup->result(); $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $row->nama_depan;?> - <?php echo $row->nama_belakang;?></option>
									<?php endforeach;?>
									</select>
									<span class="input-group-addon"> <b>Email</b> </span>
									<input name="emaildo" maxlength="80" type="text" class="form-control" value="<?php echo $info['emaildo'];?>" />
									</div>
								</div>
								<div class="form-group has-succes">
									<label><strong> ACC INV</strong></label>
									<div class="input-group">
									<span class="input-group-addon"> <b>User</b> </span>
									<select name="accinv" id="accinv" class="form-control" >
										<option value="<?php echo $info['accinv'];?>"><?php echo $this->user_model->NamaUser($info['accinv']); ?> - <?php echo $this->user_model->NamaBUser($info['accinv']); ?></option>
									<?php $sup = $this->db->get_where('login',array('wp_id'=>$info['id'],'administrator <'=>'4')); $item = $sup->result(); $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $row->nama_depan;?> - <?php echo $row->nama_belakang;?></option>
									<?php endforeach;?>
									</select>
									<span class="input-group-addon"> <b>Email</b> </span>
									<input name="emailinv" maxlength="80" type="text" class="form-control" value="<?php echo $info['emailinv'];?>" />
									</div>
								</div>
								<div class="form-group has-succes">
									<label><strong> ACC PAY</strong></label>
									<div class="input-group">
									<span class="input-group-addon"> <b>User</b> </span>
									<select name="accpay" id="accpay" class="form-control" >
										<option value="<?php echo $info['accpay'];?>"><?php echo $this->user_model->NamaUser($info['accpay']); ?> - <?php echo $this->user_model->NamaBUser($info['accpay']); ?></option>
									<?php $sup = $this->db->get_where('login',array('wp_id'=>$info['id'],'administrator <'=>'4')); $item = $sup->result(); $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $row->nama_depan;?> - <?php echo $row->nama_belakang;?></option>
									<?php endforeach;?>
									</select>
									<span class="input-group-addon"> <b>Email</b> </span>
									<input name="emailpay" maxlength="80" type="text" class="form-control" value="<?php echo $info['emailpay'];?>" />
									</div>
								</div>
								<div class="form-group">
									<label><strong>Keterangan</strong></label>
									<input name="keterangan" type="text" class="form-control" value="<?php echo $info['keterangan'];?>" />
								</div>
								<div class="text-center">
									<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
									<a href="<?php echo base_url();?>cabang"><button type="button" name="kembali" id="kembali" class="btn btn-primary">
									<i class="fa fa-undo"></i> KEMBALI</button></a>
								</div>
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div><!--/.col (right) -->
			</form>
                </section><!-- /.content -->
	<div class="clearfix"></div>
      </div>
				<!-- end Page Right Column -->