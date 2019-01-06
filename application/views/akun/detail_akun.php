<script type="text/javascript" src="<?php echo base_url();?>js/group_table.js"></script>
<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4);?>

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
                <div class="box-header with-border">
                  <h3 class="box-title">Trial Balance from : <?php echo $this->jurnal_model->tgl_str($uri3); ?> to: <?php echo $this->jurnal_model->tgl_str($uri4); ?></h3>
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
				<th>Buku Besar</th>
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
						echo '<tr>';
						echo '<td>'.$row->kelompok_akun_id." - ".$row->groups_name.'</td>';
						echo '<td>'.$row->kode.'</td>';
						echo '<td>'.$row->nama.'</td>';
						echo '<td class="text-right">'.number_format(($row->saldo_awal), 0, '', '.').'</br>'.number_format(($SaldoAwal), 0, '', '.').'</td>';						
						echo '<td class="text-right">'.number_format(($SumDebit), 0, '', '.').'</br>'.number_format(($SumDebitTgl), 0, '', '.').'</td>';						
						echo '<td class="text-right">'.number_format(($SumKredit), 0, '', '.').'</br>'.number_format(($SumKreditTgl), 0, '', '.').'</td>';						
						echo '<td class="text-right">'.number_format(($row->saldo_awal+$row->saldo), 0, '', '.').'</br>'.number_format(($SaldoAkhir), 0, '', '.').'</td>';						
						echo '<td class="text-right"><button>'.anchor(site_url()."jurnal/buku_besar/".$row->id, 'Lihat Buku Besar').'</button></td>'; 	
						echo '</tr>';
					}
				}
			?>
		</tbody>
	</table>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

