<script type="text/javascript" charset="utf-8">
	$(function() {
		$('#button-view').click(function() {
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			var cabang = $('#cabang').val();
			location.href = '<?php echo site_url();?>laporan_trial/index/'+from+'/'+to+'/'+cabang;
		});
		$('#button-print').click(function() {
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			var cabang = $('#cabang').val();
			window.open('<?php echo site_url();?>laporan_trial/report/'+from+'/'+to+'/'+cabang);
		});
		$('#button-xls').click(function() {
			var from = $('#datepicker-from').val();
			var to = $('#datepicker-to').val();
			var cabang = $('#cabang').val();
			window.open('<?php echo site_url();?>laporan_trial/excel/'+from+'/'+to+'/'+cabang);
		});
		$('#button-reset').click(function() {
			location.href = '<?php echo site_url();?>laporan_trial/index/';
		});
	});
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/group_table.js"></script>
<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);?>

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
	if($this->session->userdata('SUCCESSMSG'))
	{
		echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>";
		$this->session->unset_userdata('SUCCESSMSG');
	}
?>
<?php
	echo form_open('laporan_trial/report', 'id="laporanproyek_form"');
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
?>

                <div class="box-header with-border">
                  <h3 class="box-title">LAPORAN TRIAL BALANCE</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			  
	  <table id="example1" class="table table-bordered table-striped">
	<?php if($this->session->userdata('ADMIN') =='1'){ ?>
		<tr>
			<th><?php echo form_label('Cabang','cabang'); ?></th>
			<td>
				<div class="input-group">
				<select name="cabang" id="cabang" class="form-control" >
					<option value="">- Semua Cabang -</option>
				<?php $cab = $this->db->get_where('wp'); $item = $cab->result(); $no=0; foreach($item as $row ): $no++;?>
					<option value="<?php echo $row->id;?>"><?php echo $row->id;?> - <?php echo $row->kota;?></option>
				<?php endforeach;?>
				</select>
				</div>
			</td>
		</tr>
	<?php }else{ ?><input name="cabang" id="cabang" type="hidden" class="form-control" value="<?php echo $this->session->userdata('SESS_WP_ID');?>" />
	<?php } ?>
		<tr>
			<th><?php echo form_label('Tanggal','from_to'); ?></th>
			<td>
				<?php 
					if($this->uri->segment(4) ==''){$tanggal=date('Y-m-d');}else{ $tanggal=$this->uri->segment(4);}
					$tanggalfrom['name'] = 'from';
					$tanggalfrom['id'] = 'datepicker-from';
					$tanggalfrom['class']='form-control';
					$tanggalfrom['value']= $this->uri->segment(3);
					echo '<div class="input-group">';
					echo form_input($tanggalfrom);
					echo '<span class="input-group-addon"> s/d </span>';
					$tanggalto['name'] = 'to';
					$tanggalto['id'] = 'datepicker-to';										
					$tanggalto['class']='form-control';
					$tanggalto['value'] = $tanggal ;										
					echo form_input($tanggalto);
					echo '</div>';
				?>					
			</td>	
		</tr>	
	</table>
                </div><!-- /.box-body -->

	<div class="box-footer">
		<div class="btn-group">
		<?php
			echo form_button(array('id' => 'button-view', 'class' => 'btn btn-info', 'content' => 'Lihat'));
			echo form_button(array('id' => 'button-print', 'class' => 'btn btn-primary', 'content' => 'Cetak'));
			echo form_button(array('id' => 'button-xls', 'class' => 'btn btn-primary', 'content' => 'Excel'));
			echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-success'" );
		?>
		</div>
	</div>
<?php echo form_close(); ?>

              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
				<?php
					if($this->session->userdata('SUCCESSMSG')) {
						echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')." </div>";
						$this->session->unset_userdata('SUCCESSMSG');
					}
				?>
                <div class="box-header with-border">
                  <h3 class="box-title">Trial Balance </h3> <small class="pull-right"><?php if($uri3==''){ ?>Bulan ini<?php }else{ ?>Date : <?php echo $this->jurnal_model->tgl_indo($uri3); ?> - <?php echo $this->jurnal_model->tgl_indo($uri4); ?><?php } ?></small>
                </div><!-- /.box-header -->
                <div class="box-body">
	  <table id="group_table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Grup</th>
				<th>No Akun</th>
				<th>Akun</th>
				<th>Saldo Awal</th>									
				<th>Mutasi Debit</th>									
				<th>Mutasi Credit</th>									
				<th>Saldo Akhir</th>									
				<th>General Ledger</th>
			</tr>
		</thead>
		<tbody>		
			<?php
				if($account_data)
				{
					foreach ($account_data as $row) 
					{
					$SumDebit = $this->jurnal_model->SumDebit($row->id);
					$SumKredit = $this->jurnal_model->SumKredit($row->id);
					$SumDebitTgl1 = $this->jurnal_model->SumDebitTgl($row->id,$uri3);
					$SumKreditTgl1 = $this->jurnal_model->SumKreditTgl($row->id,$uri3);
					$SumDebitTgl2 = $this->jurnal_model->SumDebitTgl($row->id,$uri4);
					$SumKreditTgl2 = $this->jurnal_model->SumKreditTgl($row->id,$uri4);
					$SumDebitTgl = $SumDebitTgl2-$SumDebitTgl1;
					$SumKreditTgl = $SumKreditTgl2-$SumKreditTgl1;
					$SaldoAwal = $SumDebitTgl1-$SumKreditTgl1+$row->saldo_awal;
					$SaldoAkhir = $SumDebitTgl2-$SumKreditTgl2+$row->saldo_awal;
					if($uri3==''){
						$Debit = $SumDebit; $Kredit = $SumKredit; $Saldo_Awal = $row->saldo_awal; $Saldo_Akhir = $row->saldo_awal+$row->saldo;
					}else{
						$Debit = $SumDebitTgl; $Kredit = $SumKreditTgl; $Saldo_Awal = $SaldoAwal; $Saldo_Akhir = $SaldoAkhir;
					}
						echo '<tr>';
						echo '<td><b>'.$this->pajak_model->KotaCabang($row->wp_id)."</b> ".$row->kelompok_akun_id." - ".$row->groups_name.'</td>';
						echo '<td>'.$row->kelompok_akun_id.' '.$this->akun_model->KodeKategori($row->kategori_akun_id).' '.$this->akun_model->KodeJenis($row->jenis_akun_id).' '.$row->kode.'</td>';
						echo '<td>'.$row->nama.'</td>';
						echo '<td class="text-right">'.number_format(($Saldo_Awal), 0, '', '.').'</td>';						
						echo '<td class="text-right">'.number_format(($Debit), 0, '', '.').'</td>';						
						echo '<td class="text-right">'.number_format(($Kredit), 0, '', '.').'</td>';						
						echo '<td class="text-right">'.number_format(($Saldo_Akhir), 0, '', '.').'</td>';						
						if($uri3==''){
						echo '<td class="text-right"><button>'.anchor(site_url()."laporan_ledger/index/".$row->id, 'Lihat Detail').'</button></td>'; 	
						}else{
						echo '<td class="text-right"><button>'.anchor(site_url()."laporan_ledger/index/".$row->id."/".$uri3."/".$uri4, 'Lihat Detail').'</button></td>'; 	
						}
						echo '</tr>';
					}
				}
			?>
		</tbody>
	  </table>
                </div><!-- /.box -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
