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
	echo form_open('user/'.$form_act, 'id="user_form"');

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

	if($this->session->userdata('SUCCESSMSG'))
	{
		echo "<div class='success'>".$this->session->userdata('SUCCESSMSG')."</div>";
		$this->session->unset_userdata('SUCCESSMSG');
	}

	$data['class'] = 'input';
	if ($act == 'view') $data['disabled'] = TRUE;
?>
                <div class="box-header with-border">
                  <h3 class="box-title">Data Pengguna</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			  
	  <table id="example1" class="table table-bordered table-striped">
		<tr>
			<th><?php echo form_label('Nama Depan *','fname'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'fname';
					$data['class'] = 'form-control';
					$data['size']='100';		
					$data['value'] = (set_value('fname')) ? set_value('fname') : $user_data['nama_depan'];
					$data['title'] = "Nama Depan tidak boleh kosong dan harus diisi dengan huruf";
					echo form_input($data);
				?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Nama Belakang *','lname'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'lname';
					$data['class'] = 'form-control';
					$data['value'] = (set_value('lname')) ? set_value('lname') : $user_data['nama_belakang'];
					$data['title'] = "Nama Belakang tidak boleh kosong dan harus diisi dengan huruf";
					echo form_input($data);
				?>
			</td>			
		</tr>
		<tr>
			<th><?php echo form_label('Username *','username'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'username';
					$data['class'] = 'form-control';
					$data['value'] = (set_value('username')) ? set_value('username') : $user_data['username'];
					$data['title'] = "Username tidak boleh kosong dan harus diisi dengan huruf, angka, spasi, atau garis bawah";
					echo form_input($data);
				?>
			</td>
		</tr>
	<?php if($this->session->userdata('ADMIN') =='1'){ ?>
		<tr>
			<th><?php echo form_label('Administrator','administrator'); ?></th>
			<td>
				<?php 
					$administrator['id'] = 'administrator';					
					$administrator['class'] = 'input form-control';
					$selected = (set_value('administrator')) ? set_value('administrator') : $user_data['administrator'];
					if ($act == 'view') $administrator['disabled'] = TRUE;
					echo form_dropdown('administrator', $user_groups, $selected ,$administrator);
				?>					
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Cabang','wp_id'); ?></th>
			<td>
				<?php 
					$wp_id['id'] = 'wp_id';					
					$wp_id['class'] = 'input form-control';
					$selected = (set_value('wp_id')) ? set_value('wp_id') : $user_data['wp_id'];
					if ($act == 'view') $wp_id['disabled'] = TRUE;
					echo form_dropdown('wp_id', $wp_groups, $selected ,$wp_id);
				?>					
			</td>
		</tr>
	<?php }	else { ?>
		<tr>
			<th><?php echo form_label('Administrator','administrator'); ?></th>
			<td>
				<?php 
					$administrator['id'] = 'administrator';					
					$administrator['class'] = 'input form-control';
					$selected = (set_value('administrator')) ? set_value('administrator') : $user_data['administrator'];
					if ($act == 'view') $administrator['disabled'] = TRUE;
					echo form_dropdown('administrator', $cabang_groups, $selected ,$administrator);
				?>					
			</td>
		</tr>
		<div class="hidden">
			<input name="wp_id" type="text" class="form-control" value="<?php echo $this->session->userdata('SESS_WP_ID'); ?>" />
		</div>
	<?php } ?>
		<?php if($act!='view') { ?>
		<tr>
			<th>
				<?php
					$password_label = ($act=='add') ? 'Password *' : 'Password';  
					echo form_label($password_label,'password');
				?>
			</th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'password';
					$data['class'] = 'form-control';
					$data['value'] = '';
					if($act=='add') $data['title'] = "Password tidak boleh kosong"; else unset($data['title']);
					echo form_password($data);
				?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Ulangi '.$password_label,'cpassword'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'cpassword';
					$data['class'] = 'form-control';
					$data['value'] = '';
					$data['title'] = "Ulangi Password isinya harus sama dengan Password";
					echo form_password($data);
				?>	
			</td>
		</tr>
		<?php } ?>
	</table>
                </div><!-- /.box-body -->

	<div class="box-footer">
		<div class="btn-group">
		<?php 
			if($act!='view')
			{ 
				echo form_submit('simpan', 'Simpan', "id = 'button-save', class = 'btn btn-info'" );
				echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-primary'" );
				if($this->session->userdata('ADMIN'))
					echo form_button(array('id' => 'button-cancel', 'class' => 'btn btn-warning', 'content' => 'Batal', 'onClick' => "location.href='".site_url()."user'" ));
			}
			else
			{
				echo form_button(array('id' => 'button-cancel', 'class' => 'btn btn-warning', 'content' => 'Kembali', 'onClick' => "location.href='".site_url()."user'" ));
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

<script type='text/javascript'>
	//Validasi di client
	$(document).ready(function()
	{
		$('#user_form').validate({
			errorLabelContainer: "#error",
			wrapper: "li",
			rules: 
			{
				fname: "required lettersonly",
				lname: "required lettersonly",
				username: "required alphanumeric",
				<?php if($act=='add') echo 'password: "required",'; ?>
				cpassword: {
					equalTo: "#password"
				}
			}
		});
	});
</script>
