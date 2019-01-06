<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-view').click(function() {
			var detail = $('#detail');
			var tbl = $('#tblDetail');
			$.post('<?php echo site_url().'jurnal/get_details' ?>',
				  function(msg){
					if(msg=='error_laba_rugi')
					{
						oDialog.html("Akun Ikhtisar Laba Rugi tidak ditemukan, mohon dibuat terlebih dahulu.");
						oDialog.dialog('open');
					}
					else if(msg=='error_modal')
					{
						oDialog.html("Akun Modal tidak ditemukan, mohon dibuat terlebih dahulu.");
						oDialog.dialog('open');
					}
					else if(msg!='')
					{
						detail.show();
						tbl.children().html('<tr><th>Akun</th><th>Debit</th><th>Kredit</th></tr>');
						tbl.children().append(msg);
					}
					else
					{
						oDialog.html("Tidak ada untuk dibuat jurnal penutup.");
						oDialog.dialog('open');
					}
				  }
			  );
		});
		$('#penutup_form').submit(function() {
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
	echo form_open('jurnal/insert', 'id="penutup_form"');

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

	echo form_hidden('f_id', 3);
	echo form_hidden('goto', current_url());

	$data['class'] = 'input';	
?>	
	
                <div class="box-header with-border">
                  <h3 class="box-title">Tambah Jurnal Penutup</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
		<tr>
			<th><?php echo form_label('Tanggal *','tanggal'); ?></th>
			<td>
				<?php 
					$data['name'] = 'tanggal';
					$data['class'] = 'form-control';
					$data['id'] = 'datepicker';
					$data['value'] = set_value('tanggal');
					$data['title'] = "Tanggal tidak boleh kosong dan harus diisi dengan format dddd-mm-yy";	
					echo form_input($data);
				?>
			</td>
		</tr>
		<tr>
			<th><?php echo form_label('Deskripsi *','deskripsi'); ?></th>
			<td>
				<?php 
					$data['name'] = $data['id'] = 'deskripsi';					
					$data['value'] = set_value('deskripsi');
					$data['title'] = "Deskripsi tidak boleh kosong";
					echo form_textarea($data);
				?>
			</td>
		</tr>
	</table>
                </div><!-- /.box-body -->
	
	<div class="box-footer">
		<div class="btn-group">
		<?php
			echo form_button('view', 'Lihat Detail', "id = 'button-view', class = 'btn btn-info'" );
			echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-primary'" );
		?>
		</div>
	</div>
	<div class="clearer"></div>

<div id="detail" style="display:none">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
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
		</table>
	</div><!-- /.box-body -->
	<div class="box-footer">
		<div class="btn-group">
			<?php
				echo form_submit('post','Simpan', "id = 'button-save', class = 'btn btn-info'" );
			?>
		</div>
	</div>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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
		$('#penutup_form').validate({
			errorLabelContainer: "#error",
			wrapper: "li",
			rules: 
			{
				tanggal: "required dateISO",
				deskripsi: "required"				
			}
		});
	});
</script>
