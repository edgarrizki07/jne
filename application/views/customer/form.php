<script type="text/javascript">
$(document).ready(function(){

	$("#nama").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kode").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#kota").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#provinsi").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#alamat_kirim").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
	$("#rekening").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
		
});	
</script>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?> <?php if($this->uri->segment(3)==''){ echo ': C-'.$no_customer; }else{} ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
<?php
	echo form_open('customer/'.$form_act, 'id="klien_form"');
	echo "<div id='error' class='alert alert-warning alert-dismissable' ";
	if($this->session->userdata('ERRMSG_ARR'))
	{ echo ">"; echo $this->session->userdata('ERRMSG_ARR'); $this->session->unset_userdata('ERRMSG_ARR'); }
	else
	{ echo "style='display:none'>"; }
	echo "</div>";
	$data['class'] = 'input';
	if ($act == 'view') $data['disabled'] = TRUE;
?>
	<div class="box-header with-border">
	  <h3 class="box-title">Bagian I Identitas Perusahaan</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
	  <table class="table table-bordered table-striped">
		<tr>
			<th class="col-xs-2"><?php echo form_label('Nama Perusahaan*','nama');  ?></th>
			<td>
				<div class="input-group">
				<span class="input-group-addon"> : </span>
				<select name="bu" id="bu" class="form-control" >
					<option value="PT">PT</option>
					<option value="CV">CV</option>
					<option value="UD">UD</option>
					<option value="Firma">Firma</option>
				</select>
				<span class="input-group-addon"> . </span>
				<?php 
					$data['name'] = $data['id'] = 'nama';
					$data['maxlength']='80';
					$data['class']='form-control';
					$data['value'] = (set_value('nama')) ? set_value('nama') : $client_data['nama'];
					$data['title'] = "Nama tidak boleh kosong";
					echo form_input($data);
				?>
				</div>
			</td>
		</tr>	
		<tr>
			<th><?php echo form_label('Alamat Perusahaan','alamat'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'alamat';
					$data['maxlength']='80';
					$data['value'] = (set_value('alamat')) ? set_value('alamat') : $client_data['alamat'];
					$data['title'] = "Alamat tidak boleh kosong";						
					echo form_input($data);
				?>
			</td>
		</tr>									
		<tr>
			<th></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'alamat1';
					$data['maxlength']='80';
					$data['value'] = (set_value('alamat1')) ? set_value('alamat1') : $client_data['alamat1'];
					$data['title'] = "Alamat Tambahan";						
					echo form_input($data);
				?>
			</td>
		</tr>									
		<tr>
			<th><?php echo form_label('Kota / Kabupaten *','kota'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'kota';
					$data['maxlength']='80';
					$data['value'] = (set_value('kota')) ? set_value('kota') : $client_data['kota'];
					$data['title'] = "Kota tidak boleh kosong";						
					echo form_input($data);
				?>
			</td>
		</tr>									
		<tr>
			<th><?php echo form_label('Provinsi *','provinsi'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'provinsi';
					$data['maxlength']='80';
					$data['value'] = (set_value('provinsi')) ? set_value('provinsi') : $client_data['provinsi'];
					$data['title'] = "Provinsi tidak boleh kosong";						
					echo form_input($data);
				?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Kode Pos','kodepos'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'kodepos';
					$data['maxlength']='80';
					$data['value'] = (set_value('kodepos')) ? set_value('kodepos') : $client_data['kodepos'];
					$data['title'] = "Kodepos tidak boleh kosong";						
					echo form_input($data);
				?>
			</td>
		</tr>									
		<tr>
			<th><?php echo form_label('Telpon *','telpon'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'telpon';
					$data['maxlength']='30';
					$data['value'] = (set_value('telpon')) ? set_value('telpon') : $client_data['telpon_1'];
					$data['title'] = "Telpon tidak boleh kosong";
					echo form_input($data);
				?>
			</td>
		</tr>		
		<tr>
			<th><?php echo form_label('Fax','fax'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'fax';
					$data['maxlength']='20';
					$data['value'] = (set_value('fax')) ? set_value('fax') : $client_data['fax'];
					unset($data['title']);
					echo form_input($data);
				?>
			</td>
		</tr>	
		<tr>
			<th><?php echo form_label('Status Perusahaan','status_usaha'); ?></th>
			<td>
				<div class="input-group">
				<span class="input-group-addon"> : </span>
				<select name="status_usaha" id="status_usaha" class="form-control" >
					<option value="Pusat">Pusat</option>
					<option value="Cabang">Cabang</option>
					<option value="Lainnya">Lainnya</option>
				</select>
				</div>
			</td>
		</tr>		
		<tr>
			<th><?php echo form_label('Email','email'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'email';
					$data['maxlength']='50';
					$data['value'] = (set_value('email')) ? set_value('email') : $client_data['email'];
					$data['title'] = "Email harus diisi dengan format email yang benar. Contoh : keuangan@guyub.co.id";			
					echo form_input($data);
				?>
			</td>
		</tr>		
		<tr>
			<th><?php echo form_label('NPWP','npwp'); ?></th>
			<td>
				<div class="form-group">
					<div class="input-group">
				<?php 
					$nomor['title'] = "NPWP harus diisi dengan angka";	
					if ($act == 'view') $nomor['disabled'] = TRUE;

					$nomor['name'] = $nomor['id'] = 'npwp';
					$nomor['maxlength']='2';
					$nomor['size']='4';
					$nomor['class']='form-control';
					$nomor['value'] = (set_value('npwp')) ? set_value('npwp') : substr($client_data['npwp'], 0, 2);
					echo form_input($nomor);
					echo "<span class='input-group-addon'> &nbsp;. </span>";

					$nomor['name'] = $nomor['id'] = 'npwp1';
					$nomor['maxlength']='3';
					$nomor['size']='5';
					$nomor['class']='form-control';
					$nomor['value'] = (set_value('npwp1')) ? set_value('npwp1') : substr($client_data['npwp'], 2, 3);
					echo form_input($nomor);

					echo "<span class='input-group-addon'> &nbsp;. </span>";

					$nomor['name'] = $nomor['id'] = 'npwp2';
					$nomor['maxlength']='3';
					$nomor['size']='5';
					$nomor['class']='form-control';
					$nomor['value'] = (set_value('npwp2')) ? set_value('npwp2') : substr($client_data['npwp'], 5, 3);
					echo form_input($nomor);

					echo "<span class='input-group-addon'> &nbsp;. </span>";

					$nomor['name'] = $nomor['id'] = 'npwp3';
					$nomor['maxlength']='1';
					$nomor['size']='2';
					$nomor['class']='form-control';
					$nomor['value'] = (set_value('npwp3')) ? set_value('npwp3') : substr($client_data['npwp'], 8, 1);
					echo form_input($nomor);

					echo "<span class='input-group-addon'> &nbsp;- </span>";

					$nomor['name'] = $nomor['id'] = 'npwp4';
					$nomor['maxlength']='3';
					$nomor['size']='5';
					$nomor['class']='form-control';
					$nomor['value'] = (set_value('npwp4')) ? set_value('npwp4') : substr($client_data['npwp'], 9, 3);
					echo form_input($nomor);

					echo "<span class='input-group-addon'> &nbsp;. </span>";

					$nomor['name'] = $nomor['id'] = 'npwp5';
					$nomor['maxlength']='3';
					$nomor['size']='5';
					$nomor['class']='form-control';
					$nomor['value'] = (set_value('npwp5')) ? set_value('npwp5') : substr($client_data['npwp'], 12, 3);
					echo form_input($nomor);
				?>
					</div>
				</div>
			</td>
		</tr>						
		<tr>
			<th><?php echo form_label('Tanda Daftar Perusahaan (TDP)','tdp'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'tdp';
					$data['maxlength']='50';
					$data['value'] = (set_value('tdp')) ? set_value('tdp') : $client_data['bidang_usaha'];
					$data['title'] = "Tanda Daftar Perusahaan (TDP) tidak boleh kosong";			
					echo form_input($data);
				?>
			</td>
		</tr>		
		<tr>
			<th><?php echo form_label('Bidang Usaha','bidang_usaha'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'bidang_usaha';
					$data['maxlength']='50';
					$data['value'] = (set_value('bidang_usaha')) ? set_value('bidang_usaha') : $client_data['bidang_usaha'];
					$data['title'] = "Bidang Usaha tidak boleh kosong";			
					echo form_input($data);
				?>
			</td>
		</tr>		
		<tr>
			<th><?php echo form_label('Kebutuhan HSD','kebutuhan_hsd'); ?></th>
			<td>
				<div class="input-group">
				<?php 
					$data['name'] = $data['id'] = 'kebutuhan_hsd';
					$data['maxlength']='50';
					$data['value'] = (set_value('kebutuhan_hsd')) ? set_value('kebutuhan_hsd') : $client_data['kebutuhan_hsd'];
					$data['title'] = "Kebutuhan HSD tidak boleh kosong";			
					echo form_input($data);
				?>
				<span class="input-group-addon"> Liter </span>
				<select name="kebutuhan_per" id="kebutuhan_per" class="form-control" >
					<option value="/ Hari">/ Hari</option>
					<option value="/ Minggu">/ Minggu</option>
					<option value="/ Bulan">/ Bulan</option>
				</select>
				</div>
			</td>
		</tr>
	  </table>
	</div><!-- /.box-body -->
	<div class="box-header with-border">
	  <h3 class="box-title">Bagian II Direktur Utama</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
	  <table class="table table-bordered table-striped">
		<tr>
			<th class="col-xs-2"><?php echo form_label('Nama Lengkap','nama_dirut'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'nama_dirut'; $data['value'] = (set_value('nama_dirut')) ? set_value('nama_dirut') : $client_data['nama_dirut']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('No. KTP','ktp_dirut'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'ktp_dirut'; $data['value'] = (set_value('ktp_dirut')) ? set_value('ktp_dirut') : $client_data['ktp_dirut']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Alamat','alamat_dirut'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'alamat_dirut'; $data['value'] = (set_value('alamat_dirut')) ? set_value('alamat_dirut') : $client_data['alamat_dirut']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
		<tr>
			<th></th>
			<td><?php $data['name'] = $data['id'] = 'alamat1_dirut'; $data['value'] = (set_value('alamat1_dirut')) ? set_value('alamat1_dirut') : $client_data['alamat1_dirut']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Jabatan','jabatan_dirut'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'jabatan_dirut'; $data['value'] = (set_value('jabatan_dirut')) ? set_value('jabatan_dirut') : $client_data['jabatan_dirut']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('No Telp','telp'); ?></th>
			<td>
				<div class="input-group">
				<?php $data['name'] = $data['id'] = 'telp_dirut'; $data['value'] = (set_value('telp_dirut')) ? set_value('telp_dirut') : $client_data['telp_dirut']; unset($data['title']); echo form_input($data); ?>
				<span class="input-group-addon"> No HP </span>
				<?php $data['name'] = $data['id'] = 'hp_dirut'; $data['value'] = (set_value('hp_dirut')) ? set_value('hp_dirut') : $client_data['hp_dirut']; unset($data['title']); echo form_input($data); ?>
				</div>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Email','email_dirut'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'email_dirut'; $data['value'] = (set_value('email_dirut')) ? set_value('email_dirut') : $client_data['email_dirut']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
	  </table>
	</div><!-- /.box-body -->

	<div class="box-header with-border">
	  <h3 class="box-title">Bagian III Devisi Keuangan</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
	  <table class="table table-bordered table-striped">
		<tr>
			<th class="col-xs-2"><?php echo form_label('Nama Lengkap','nama_keuangan'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'nama_keuangan'; $data['value'] = (set_value('nama_keuangan')) ? set_value('nama_keuangan') : $client_data['nama_keuangan']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Jabatan','jabatan_keuangan'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'jabatan_keuangan'; $data['value'] = (set_value('jabatan_keuangan')) ? set_value('jabatan_keuangan') : $client_data['jabatan_keuangan']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('No Telp','telp'); ?></th>
			<td>
				<div class="input-group">
				<?php $data['name'] = $data['id'] = 'telp_keuangan'; $data['value'] = (set_value('telp_keuangan')) ? set_value('telp_keuangan') : $client_data['telp_keuangan']; unset($data['title']); echo form_input($data); ?>
				<span class="input-group-addon"> No HP </span>
				<?php $data['name'] = $data['id'] = 'hp_keuangan'; $data['value'] = (set_value('hp_keuangan')) ? set_value('hp_keuangan') : $client_data['hp_keuangan']; unset($data['title']); echo form_input($data); ?>
				</div>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Email','email_keuangan'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'email_keuangan'; $data['value'] = (set_value('email_keuangan')) ? set_value('email_keuangan') : $client_data['email_keuangan']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
	  </table>
	</div><!-- /.box-body -->

	<div class="box-header with-border">
	  <h3 class="box-title">Bagian IV Devisi Pembelian</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
	  <table class="table table-bordered table-striped">
		<tr>
			<th class="col-xs-2"><?php echo form_label('Nama Lengkap','nama_pembelian'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'nama_pembelian'; $data['value'] = (set_value('nama_pembelian')) ? set_value('nama_pembelian') : $client_data['nama_pembelian']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Jabatan','jabatan_pembelian'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'jabatan_pembelian'; $data['value'] = (set_value('jabatan_pembelian')) ? set_value('jabatan_pembelian') : $client_data['jabatan_pembelian']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('No Telp','telp'); ?></th>
			<td>
				<div class="input-group">
				<?php $data['name'] = $data['id'] = 'telp_pembelian'; $data['value'] = (set_value('telp_pembelian')) ? set_value('telp_pembelian') : $client_data['telp_pembelian']; unset($data['title']); echo form_input($data); ?>
				<span class="input-group-addon"> No HP </span>
				<?php $data['name'] = $data['id'] = 'hp_pembelian'; $data['value'] = (set_value('hp_pembelian')) ? set_value('hp_pembelian') : $client_data['hp_pembelian']; unset($data['title']); echo form_input($data); ?>
				</div>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Email','email_pembelian'); ?></th>
			<td><?php $data['name'] = $data['id'] = 'email_pembelian'; $data['value'] = (set_value('email_pembelian')) ? set_value('email_pembelian') : $client_data['email_pembelian']; unset($data['title']); echo form_input($data); ?>
			</td>
		</tr>
	  </table>
	</div><!-- /.box-body -->

	<div class="box-footer">
		<div class="btn-group">
		<?php 
			if($act!='view')
			{ 
				echo form_submit('simpan','Simpan', "id = 'button-save', class = 'btn btn-warning'" );
				echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-success'" );
				echo form_button(array('id' => 'button-cancel', 'class' => 'btn btn-primary', 'content' => 'Batal', 'onClick' => "location.href='".site_url()."customer'" ));
			}
			else
			{
				echo form_button(array('id' => 'button-cancel', 'class' => 'btn btn-primary', 'content' => 'Kembali', 'onClick' => "location.href='".site_url()."customer'" ));
			}
		?>				
		</div>
	</div>


<?php echo form_close(); ?>

              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

