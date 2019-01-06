      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
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
	echo form_open('akun/'.$form_act, 'id="akun_form"');

	echo "<div id='error' class='alert alert-warning alert-dismissable' ";

	if($this->session->userdata('ERRMSG_ARR'))
	{
		echo ">";
		echo $this->session->userdata('ERRMSG_ARR');
		$this->session->unset_userdata('ERRMSG_ARR');
	}
	else
	{
		echo "style='display:none'>";
	}
	
	echo "</div>";
	
	$data['class'] = 'input';
	if ($act == 'view') $data['disabled'] = TRUE;
?>
                <div class="box-header with-border">
                  <h3 class="box-title">Data Akun</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			  
	  <table class="table table-bordered table-striped">
		<tr>
			<th><?php echo form_label('Nama *','nama'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'nama';
					$data['class'] = 'form-control';
					$data['value'] = (set_value('nama')) ? set_value('nama') : $account_data['nama'];
					$data['title'] = "Nama Akun tidak boleh kosong dan harus diisi dengan maksimal 30 karakter";
					echo form_input($data);
				?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Kode *','kode'); ?></th>
			<td>
				<div class="input-group">
				<span class="input-group-addon"> Kategori </span>
				<?php 
					$jenis['id'] = 'jenis';					
					$jenis['class'] = 'input form-control';
					$selected = (set_value('jenis')) ? set_value('jenis') : $account_data['jenis_akun_id'];
					if ($act == 'view') $jenis['disabled'] = TRUE;
					echo form_dropdown('jenis', $jenis_account_groups, $selected ,$jenis);
				?>					
				<span class="input-group-btn">
				  <a href="<?php echo site_url('kategori');?>" class="btn btn-info btn-flat" title="Tambah Kategori Akun" ><i class="fa fa-plus"></i> Kategori Akun</a>
				</span>
				<span class="input-group-addon"> Kode </span>
				<?php 
					$data['name'] = $data['id'] = 'kode';
					$data['class'] = 'form-control';
					// added by Adhe on 19.05.2010
					$data['maxlength'] = '5';
					// end
					$data['value'] = (set_value('kode')) ? set_value('kode') : $account_data['kode'];
					$data['title'] = "Kode Akun tidak boleh kosong dan harus diisi dengan 4 angka";					
					echo form_input($data);
				?>
				</div>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Cabang','wp_id'); ?></th>
			<td>
				<?php 
					$wp_id['id'] = 'wp_id';					
					$wp_id['class'] = 'input form-control';
					$selected = (set_value('wp_id')) ? set_value('wp_id') : $account_data['wp_id'];
					if ($act == 'view') $wp_id['disabled'] = TRUE;
					echo form_dropdown('wp_id', $wp_groups, $selected ,$wp_id);
				?>					
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Keterangan','keterangan'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'keterangan';
					$data['class'] = 'form-control';
					$data['value'] = (set_value('keterangan')) ? set_value('keterangan') : $account_data['keterangan'];
					unset($data['title']);
					unset($data['maxlength']);
					echo form_input($data);
				?>													
			</td>
		</tr>															
	</table>
                </div><!-- /.box-body -->

	<div class="box-footer">
		<div class="btn-group">
		<?php 
			if($act!='view')
			{ 
				echo form_submit('simpan','Simpan', "id = 'button-save', class = 'btn btn-info'" );
				echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-primary'" );
				echo form_button(array('id' => 'button-cancel', 'class' => 'btn btn-warning', 'content' => 'Batal', 'onClick' => "location.href='".site_url()."akun'" ));
			}
			else
			{
				echo form_button(array('id' => 'button-cancel', 'class' => 'btn btn-warning', 'content' => 'Kembali', 'onClick' => "location.href='".site_url()."akun'" ));
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

