<script type="text/javascript" src="<?php echo base_url();?>js/group_table.js"></script>

<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-save').click(function() {
			var proyekID = $('#proyekID').val();
			var jenis = $('#jenis').val();
			oTable.fnClearTable();
			$.post('<?php echo site_url().'jurnal_proyek/search' ?>',
				  { id : proyekID, jenis : jenis},
				  function(msg){
					if(msg) {
						msg = eval(msg);
						oTable.fnAddData(msg);
					}
				  }
			  );
		});
		$('#button-print').click(function() {
			var proyekID = $('#proyekID').val();
			var cabang = $('#cabang').val();
			var jenis = $('#jenis').val();
			window.open('<?php echo site_url();?>jurnal/report/'+bln+'/'+thn+'/'+cabang);
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
					if($this->session->userdata('SUCCESSMSG')) {
						echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>";
						$this->session->unset_userdata('SUCCESSMSG');
					}
				?>
	<div id="dialog-form"></div>
	<div class="clearer"></div>

<?php
	$data['class'] = 'input';	

	echo form_open();

?>
                <div class="box-header with-border">
                  <h3 class="box-title">Pencarian Jurnal</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
	<?php if($this->session->userdata('ADMIN') =='1'){ ?>
	<?php }else{ ?><input name="cabang" id="cabang" type="hidden" class="form-control" value="<?php echo $this->session->userdata('SESS_WP_ID');?>" />
	<?php } ?>
		<tr>
			<th><?php echo form_label('Nama Customer','proyek'); ?></th>
			<td>
				<div class="input-group">
				<select name="proyek" id="proyekID" class="form-control" >
					<option value="">Semua</option>
				<?php $cab = $this->db->get_where('customer'); $item = $cab->result(); $no=0; foreach($item as $row ): $no++;?>
					<option value="<?php echo $row->id;?>"><?php echo $row->id;?> - <?php echo $row->nama;?></option>
				<?php endforeach;?>
				</select>
				</div>
			</td>
				
		</tr>
		<tr>
			<th><?php echo form_label('Jenis','jenis'); ?></th>
			<td>
				<?php 
					unset($data['name']);
					$data['id'] = 'jenis';
					$data['class'] = 'form-control';
					$selected = 0 ;
					$options = array( 0 => 'Semua',
									 4 => 'Customer',
									 5 => 'Supplier' );
					echo form_dropdown('jenis', $options, $selected, $data);
				?>
			</td>
		</tr>
	</table>
                </div><!-- /.box-body -->

				<div class="box-footer">
					<div class="btn-group">
					<?php
						echo form_button('cari', 'Cari', "id = 'button-save', class = 'btn btn-info'" );
						echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-primary'" );
					?>
					  </div>
				</div>
	
<?php echo form_fieldset_close(); ?>
<?php echo form_close(); ?>

                <div class="box-body">
	<table id="group_table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Customer</th>
				<th>Tanggal</th>
				<th>No</th>
			<?php if($this->session->userdata('ADMIN') =='1'){ ?>
				<th>Cabang</th>
			<?php } ?>
				<th>Item</th>
				<th>Akun</th>
				<th>Debit</th>
				<th>Kredit</th>
				<th>Voucher</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php			
				if($journal_data)
				{
					$i = 0;
					foreach ($journal_data as $row)
					{
						if($row->debit_kredit == 1)
						{
							$d = number_format(($row->nilai), 0, '', '.');
							$k = '';
						}
						else
						{
							$d = '';
							$k = number_format(($row->nilai), 0, '', '.');
						}
						$customer = $this->customer_model->NamaCustomer($row->customer_id); 
						$nomor = $row->no_voucher; 
						$kode=$this->jurnal_model->KodeVoucher($row->voucher_id); 
						$cab = $this->pajak_model->KodeCabang($row->wp_id);
						$cabang = $this->pajak_model->KotaCabang($row->wp_id); 
						$no = $row->id;
						$singkatan=$this->setting_model->singkatan();
						$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl));
						$thn=$this->jurnal_model->ambilThn($row->tgl); 
						$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
						echo '<tr>';
						echo '<td>'.$customer." - ".$row->project_name.'</td>';
						echo '<td>'.$row->tgl.'</td>';
						echo '<td>'.$nomor."/".$kode."/".$no."/".$cab."/".$bln."/".$thn.'</td>';
						if($this->session->userdata('ADMIN') =='1'){
						echo '<td>'.$cabang.'</td>';	
						}
						echo '<td>'.$row->item.'</td>';
						echo '<td>'.$row->account_name.'</td>';
						echo '<td class="text-right">'.$d.'</td>';
						echo '<td class="text-right">'.$k.'</td>';	
						echo '<td>'.$v.'</td>';	
						echo '<td class="text-right">'.anchor(site_url()."jurnal_proyek/view/".$row->id, 'Detail').'</td>';	
						echo '</tr>';
						$i++;
					}
				}
			?>		
		</tbody>	
	</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
