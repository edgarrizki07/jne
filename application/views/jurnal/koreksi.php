<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#koreksi_form').submit(function() {
			$("*").removeAttr("disabled");
			return true;
		});
	});
</script>

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
	echo form_open('jurnal/insert', 'id="koreksi_form"');

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

	echo form_hidden('goto', current_url());

	$data['class'] = 'input';
?>	
                <div class="box-header with-border">
                  <h3 class="box-title">Koreksi Jurnal</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
		<tr>
			<th><?php echo form_label('Tanggal *','tanggal'); ?></th>
			<td>
				<?php 
					$data['name'] = 'tanggal';
					$data['id'] = 'datepicker';
					$data['value'] = set_value('tanggal');
					$data['class'] = 'form-control';
					$data['title'] = "Tanggal tidak boleh kosong dan harus diisi dengan format dddd-mm-yy";	
					echo form_input($data);
				?>
			</td>				
		</tr>
		<tr>
			<th><?php echo form_label('Alasan Koreksi *','deskripsi'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'deskripsi';					
					$data['value'] = set_value('deskripsi');
					$data['class'] = 'form-control';
					$data['title'] = "Alasan Koreksi tidak boleh kosong";
					echo form_textarea($data);
				?>
			</td>
		</tr>		
	</table>
                </div><!-- /.box-body -->
                <div class="box-header with-border">
                  <h3 class="box-title">Detail</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
	
	<table id="tblDetail" name="tblDetail" class="data-table table table-bordered table-striped">
		<tr>
			<th>Akun</th>
			<th>Debit</th>
			<th>Kredit</th>																	
		</tr>
		<?php
			$data['disabled'] = TRUE;
			$data['class'] = 'field';
			$i = 1;
			foreach ($journal_data as $row)
			{
				echo '<tr>';
				echo '<td>';
				$akun['id'] = 'akun'.$i;
				$akun['class'] = 'combo form-control';
				$akun['disabled'] = TRUE;
				$selected = $row->akun_id;
				echo form_dropdown('akun[]', $accounts, $selected ,$akun);
				echo '</td>';
				echo '<td>';
				$data['id'] = $data['name'] = 'debit'.$i;
				$data['class'] = 'form-control';
				$data['value'] = (!$row->debit_kredit) ? $row->nilai : '' ;
				echo form_input($data);
				echo '</td>';
				echo '<td>';
				$data['id'] = $data['name'] = 'kredit'.$i;
				$data['class'] = 'form-control';
				$data['value'] = ($row->debit_kredit) ? $row->nilai : '' ;
				echo form_input($data);
				echo '</td>';
				echo '</tr>';
				$i++;
				$f = $row->f_id;
			}
		?>
	</table>
                </div><!-- /.box-body -->

	<div class="box-footer">
		<div class="btn-group">
		<?php 			
			echo form_hidden('f_id', $f);
			echo form_submit('post','Post', "id = 'button-save', class = 'btn btn-info'" );
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
		$('#koreksi_form').validate({
			errorLabelContainer: "#error",
			wrapper: "li",
			rules: 
			{
				nomor: "required",
				tanggal: "required dateISO",
				deskripsi: "required"				
			}
		});
	});
</script>
