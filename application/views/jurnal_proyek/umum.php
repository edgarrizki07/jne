<script type="text/javascript" src="<?php echo base_url();?>js/group_table.js"></script>

<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-save').click(function() {
			var bln = $('#bulan').val();
			var thn = $('#tahun').val();
			oTable.fnClearTable();
			$.post('<?php echo site_url().'jurnal_proyek/search_jurnalumum' ?>',
				  { bulan : bln, tahun : thn},
				  function(msg){
					if(msg) {
						msg = eval(msg);
						oTable.fnAddData(msg);
					}
				  }
			  );
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
		<tr>
			<th>
				<?php echo form_label('Bulan','bulan'); ?>
			<td>
				<?php 
					$data['id'] = 'bulan';
					$data['class'] = 'form-control';
					$selected = date("m") ;
					echo form_dropdown('bulan', $months, $selected, $data);
				?>					
			</td>
		</tr>	
		<tr>
			<th>
				<?php echo form_label('Tahun','tahun'); ?>
			<td>
				<?php 
					$data['id'] = 'tahun';
					$data['class'] = 'form-control';
					$selected = date("Y") ;
					echo form_dropdown('tahun', $years, $selected, $data);
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
					<div class="btn-group">
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Tambah Baru</button>
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
				<?php $vou = $this->db->get_where('voucher',array('proyek'=>'0')); $item = $vou->result(); $no=0; foreach($item as $row ): $no++;?>
                        <li><a target="_blank" href="<?php echo site_url('jurnal_proyek/add/'.$row->id);?>"><?php echo $row->jenis;?></a></li>
				<?php endforeach;?>
                      </ul>
					  </div>
				</div>
	
<?php echo form_fieldset_close(); ?>
<?php echo form_close(); ?>

                <div class="box-body">
	<table id="group_table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Bulan</th>
				<th>Tanggal</th>
				<th>Voucher</th>
				<th>Proyek</th>
				<th>No</th>
				<th>Item</th>
				<th>Akun</th>
				<th>Debit</th>
				<th>Kredit</th>
				<th>Jurnal</th>	
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
						if($row->customer_id == 0){ $p=''; }else{ $p='B'; }
						$nomor = $row->no_voucher; 
						$kode=$this->jurnal_model->KodeVoucher($row->voucher_id); 
						$no = $row->id;
						$singkatan=$this->setting_model->singkatan();
						$bln=$this->jurnal_model->getRomawi($this->jurnal_model->ambilBln($row->tgl));
						$thn=$this->jurnal_model->ambilThn($row->tgl); 
						$blnthn=$this->jurnal_model->thn_bln($row->tgl); 
						$j = $this->jurnal_model->FJurnal($row->f_id);
						$v = $this->jurnal_model->JenisVoucher($this->jurnal_model->VoucherId($row->id));
						echo '<tr>';
						echo '<td><b>'.$blnthn.'</b></td>';
						echo '<td>'.$row->tgl.'</td>';
						echo '<td>'.$v.'</td>';	
						echo '<td>'.$row->project_name.'</td>';
						echo '<td>'.$nomor."/".$kode."/".$no."/".$bln."/".$thn.'</td>';
						echo '<td>'.$row->item.'</td>';
						echo '<td>'.$row->account_name.'</td>';
						echo '<td class="text-right">'.$d.'</td>';
						echo '<td class="text-right">'.$k.'</td>';	
						echo '<td>'.$j.' '.$p.'</td>';	
						echo '<td class="text-right"><button>'.anchor(site_url()."jurnal_proyek/view/".$row->id, 'Detail').'</button></td>';	
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
