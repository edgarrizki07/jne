<script type="text/javascript" src="<?php echo base_url();?>js/jurnal.js"></script>

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
<?php $uri3=$this->uri->segment(3); $singkatan=$this->setting_model->singkatan(); $nomor_jurnal=$this->db->count_all('jurnal')+1; ?>
<?php $this->db->where('voucher_id', $uri3); $nomor_voucher=$this->db->count_all_results('jurnal')+1; ?>
<?php $jenis=$this->jurnal_model->JenisVoucher($uri3); $kode=$this->jurnal_model->KodeVoucher($uri3); $payment=$this->jurnal_model->PayVoucher($uri3); ?>	
<?php
	echo form_open('jurnal/insert', array('id' => 'jurnal_form', 'onsubmit' => 'return cekData();'));

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

	echo form_hidden('f_id', $f_id);
	echo form_hidden('voucher_id', $uri3);
	echo form_hidden('goto', current_url());

	$data['class'] = 'input';	
?>	
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $jenis; ?> Nomor : <?php echo $nomor_voucher;?>/<?php echo $kode;?>/<?php echo $nomor_jurnal;?>/<?php echo $singkatan;?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			  
	<table id="example1" class="table table-bordered table-striped">
		<tr>
			<th><?php echo form_label( $payment ,'other'); ?></th>
			<td>
				<?php 
					$data['name'] = 'other';
					$data['class'] = 'form-control';
					$data['title'] = "Silahkan diisi saja";	
					echo form_input($data);
				?>
			</td>
			<th><?php echo form_label('Nama Penerima *','penerima'); ?></th>
			<td>
				<div class="input-group">
				<select name="penerima" id="penerima" class="form-control" >
					<option value="<?php echo $this->session->userdata('SESS_USER_ID'); ?>"><?php echo $this->user_model->NamaUser($this->session->userdata('SESS_USER_ID')); ?> - <?php echo $this->user_model->NamaBUser($this->session->userdata('SESS_USER_ID')); ?></option>
				<?php $sup = $this->db->get_where('login',array('external'=>'0','wp_id'=>$this->session->userdata('SESS_WP_ID'))); $item = $sup->result(); $no=0; foreach($item as $row ): $no++;?>
					<option value="<?php echo $row->id;?>"><?php echo $row->nama_depan;?> - <?php echo $row->nama_belakang;?></option>
				<?php endforeach;?>
				</select>
				</div>
			</td>
			<th><?php echo form_label('Tanggal *','tanggal'); ?></th>
			<td>
				<?php 
					$date['name'] = 'tanggal';
					$date['class'] = 'form-control';
					$date['value'] = date('Y-m-d');
					$date['id'] = 'datepicker';
					$date['title'] = "Tanggal tidak boleh kosong dan harus diisi dengan format dddd-mm-yy";	
					echo form_input($date);
				?>
			</td>				 
		<?php if($this->jurnal_model->DueVoucher($uri3)=='1'){ ?>
			<th><?php echo form_label('Tempo *','tempo'); ?></th>
			<td>
				<?php 
					$data['name'] = 'tempo';
					$data['class'] = 'form-control';
					$data['id'] = 'datepicker-tempo';
					$data['title'] = "Tempo tidak boleh kosong dan harus diisi dengan format dddd-mm-yy";	
					echo form_input($data);
				?>				
			</td>	
		<?php } ?>
		</tr>
	</table>
                </div><!-- /.box-body -->
                <div class="box-body">
  
	<table id="tblDetail" name="tblDetail" class="table table-bordered table-striped">
		<tr>
			<th>Akun</th>
			<th>Debit (bertambah)</th>
			<th>Kredit (berkurang)</th>																	
		</tr>
		<?php for ($i = 1; $i <= 2; $i++) { ?>
			<tr>
				<td>
					<?php 
						$akun['id'] = 'akun'.$i;
						$akun['class'] = 'combo form-control';
						echo form_dropdown('akun[]', $accounts, '' ,$akun);
					?>
				</td>
				<td>
					<?php 
						$data['id'] = 'debit'.$i;
						$data['name'] = 'debit'.$i;
						$data['class'] = 'field form-control';
						$data['onBlur'] = "cekDebit($i)";
						$data['title'] = "Debit harus diisi dengan angka";
						echo form_input($data);
					?>
				</td>
				<td>
					<?php 
						$data['id'] = 'kredit'.$i;
						$data['name'] = 'kredit'.$i;
						$data['class'] = 'field form-control';
						$data['onBlur'] = "cekKredit($i)";
						$data['title'] = "Kredit harus diisi dengan angka";
						echo form_input($data);
					?>
				</td>
			</tr>
		<?php } ?>
	</table>
	
	<div class="addRow text-center text-bold"><a href="javascript:addRow();">+ tambah baris</a></div>
	<div class="text-center">(hanya bisa ditambah setelah baris diatas terisi)</div>
	
	<table class="table table-bordered table-striped">
		<tr>
			<th><?php echo form_label('Deskripsi *','deskripsi'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'deskripsi';					
					$data['class'] = 'form-control';
					$data['title'] = "Deskripsi tidak boleh kosong";
					echo form_input($data);
				?>
			</td>
		</tr>	
	</table>
                </div><!-- /.box-body -->
	<div class="box-footer">
		<div class="btn-group">
		<?php
			echo form_submit('post','Simpan', "id = 'button-save', class = 'btn btn-info'" );
			echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-primary'" );
			echo form_button(array('id' => 'button-cancel', 'class' => 'btn btn-warning', 'content' => 'Batal', 'onClick' => "location.href='".site_url()."jurnal'" ));
		?>
		</div>
	</div>
	
<?php echo form_close(); ?>

              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<script type='text/javascript'>
	//Validasi di client
	$(document).ready(function()
	{
		$('#jurnal_form').validate({
			errorLabelContainer: "#error",
			wrapper: "li",
			rules: 
			{
				nomor: "required",
				tanggal: "required dateISO",
				deskripsi: "required",
				debit1: "integer",
				kredit1: "integer",
				debit2: "integer",
				kredit2: "integer"
			}
		});
	});
</script>
