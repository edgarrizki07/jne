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
                <div class="box-header with-border">
				<?php $uri3 = $this->uri->segment(3); $uri4 = $this->uri->segment(4); $uri5 = $this->uri->segment(5);?>
                  <h3 class="box-title">Akun : <?php echo $account_data['nama']?>  </h3> <?php if($uri4==''){ ?><?php }else{ ?><small class="pull-right">Date : <?php echo $this->jurnal_model->tgl_indo($uri4); ?> - <?php echo $this->jurnal_model->tgl_indo($uri5); ?></small><?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Keterangan</th>
				<th>F</th>									
				<th>Debit</th>
				<th>Kredit</th>
				<th>D/K</th>
				<th>Saldo</th>
			</tr>
		</thead>
<?php 
	$saldo_awal = $this->akun_model->SaldoAwalAkun($uri3);
	$SumDebit = $this->jurnal_model->SumDebit($uri3); 
	$SumKredit = $this->jurnal_model->SumKredit($uri3); 
	$SumAll = $SumDebit-$SumKredit+$saldo_awal;
	$SumDebitTgl1 = $this->jurnal_model->SumDebitTgl($uri3,$uri4);
	$SumKreditTgl1 = $this->jurnal_model->SumKreditTgl($uri3,$uri4);
	$SumDebitTgl2 = $this->jurnal_model->SumDebitTgl($uri3,$uri5);
	$SumKreditTgl2 = $this->jurnal_model->SumKreditTgl($uri3,$uri5);
	$SumDebitTgl = $SumDebitTgl2-$SumDebitTgl1;
	$SumKreditTgl = $SumKreditTgl2-$SumKreditTgl1;
	$SaldoAwal = $SumDebitTgl1-$SumKreditTgl1+$saldo_awal;
	$SaldoAkhir = $SumDebitTgl2-$SumKreditTgl2+$saldo_awal;
?>
		<thead>
		<?php if($uri4==''){ ?>
			<tr>
				<td colspan="3"></td>
				<td class="text-right"><?php echo number_format($SumDebit, 0, '', '.');?></td>
				<td class="text-right"><?php echo number_format($SumKredit, 0, '', '.');?></td>
				<td></td>
				<td class="text-right"><?php echo number_format($SumAll, 0, '', '.');?></td>
			</tr>
		<?php }else{ ?>
			<tr>
				<td colspan="3"></td>
				<td class="text-right"><?php echo number_format($SumDebitTgl, 0, '', '.');?></td>
				<td class="text-right"><?php echo number_format($SumKreditTgl, 0, '', '.');?></td>
				<td></td>
				<td class="text-right"><?php echo number_format($SaldoAkhir, 0, '', '.');?></td>
			</tr>
		<?php } ?>
		</thead>
		<tbody>
			<?php 
				// Saldo Awal
				$sum = 0;
				if ($account_data['saldo_awal'] != 0)
				{
				  if($uri3==''){
					$sum = $account_data['saldo_awal'];
				  }else{
					$sum = $SaldoAwal;
				  }
					if ($sum < 0)
					{
						$d = '';
						$k = number_format(-$sum, 0, '', '.');
						$dk = 'K';
					}
					else
					{
						$d = number_format($sum, 0, '', '.');
						$k = '';
						$dk = 'D';
					}
					echo '<tr>';
					echo '<td></td>';
					echo '<td>Saldo Awal</td>';
					echo '<td></td>';
					echo '<td class="text-right">'.$d.'</td>';
					echo '<td class="text-right">'.$k.'</td>';	
					echo '<td class="text-center">'.$dk.'</td>';
					echo '<td class="text-right">'.number_format(abs($sum), 0, '', '.').'</td>';				
					echo '</tr>';
				}


				
				if($journal_data)
				{
					foreach ($journal_data as $row) 
					{ 
						if($row->debit_kredit == 1)
						{
							$sum += $row->nilai;
							$d = number_format($row->nilai, 0, '', '.');
							$k = '';
						}
						else
						{
							$sum -= $row->nilai;
							$d = '';
							$k = number_format($row->nilai, 0, '', '.');
						}
						$dk = ($sum>=0) ? 'D' : 'K';
						echo '<tr>';
						echo '<td>'.$row->tgl.'</td>';
						echo '<td>'.$row->keterangan.'</td>';
						echo '<td>'.$row->f_name.'</td>';
						echo '<td class="text-right">'.$d.'</td>';
						echo '<td class="text-right">'.$k.'</td>';	
						echo '<td class="text-center">'.$dk.'</td>';
						echo '<td class="text-right">'.number_format(abs($sum), 0, '', '.').'</td>';				
						echo '</tr>';
					}
				}
			?>
		</tbody>
	</table>										
                </div><!-- /.box-body -->
				<div class="box-footer">
					<div class="btn-group">
		<?php
			echo form_button(array('id' => 'button-cancel', 'class' => 'btn btn-warning', 'content' => 'Kembali', 'onClick' => "location.href='".site_url()."akun/detail_akun'" ));
		?>
					</div>
				</div>
						
                </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
