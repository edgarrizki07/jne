<script type="text/javascript" src="<?php echo base_url();?>asset/js/jurnal.js"></script>

<script type="text/javascript" charset="utf-8">

	function cekAkun()
	{
		var tbl = $('#tblDetail');
		var lastRow = tbl.find("tr").length;
		var debitSum = 0;
		var kreditSum = 0;

		for (i=1; i<lastRow; i++) 
		{
			if (typeof($("#debit"+i).val()) != 'undefined') debitSum += parseInt($("#debit"+i).val());
			if (typeof($("#kredit"+i).val()) != 'undefined') kreditSum += parseInt($("#kredit"+i).val());
		}
		if(debitSum != kreditSum) {
			oDialog.html("Jumlah debit harus sama dengan jumlah kredit.");
			oDialog.dialog('open');
			return false;
		} else {
			return true;
		}
	}
	
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
                <div class="box-header with-border">
                  <h3 class="box-title">Pengaturan Saldo Awal</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <div class="nav-tabs-custom">			  
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_0" data-toggle="tab">SEMUA CABANG</a></li>
				<?php $vou = $this->db->get('wp'); $item = $vou->result(); $no=0; foreach($item as $row ): $no++;?>
					<li><a href="#tab_<?php echo $row->id;?>" data-toggle="tab"> <?php echo $row->kota;?></a></li>
				<?php endforeach;?>
                </ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="tab_0">
<?php
	echo form_open('akun/input_saldo_awal', array('id' => 'saldo_awal_form', 'onsubmit' => 'return cekAkun();'));

	if($this->session->userdata('SUCCESSMSG'))
	{
		echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>";
		$this->session->unset_userdata('SUCCESSMSG');
	}

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

	if($account_data)
	{
		echo '<table id="tblDetail" name="tblDetail" class="data-table table table-bordered table-striped" >';
		echo '<thead>';
		echo '<tr>';
		echo '<th>Akun</th>';
		echo '<th>Debit</th>';
		echo '<th>Kredit</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';

		$i = 1;
		foreach ($account_data as $row)
		{			
			if($row->kelompok_akun_id != 4 && $row->kelompok_akun_id != 5)
			{
				$debit = 0;
				$kredit = 0;
				$debit_disable = FALSE;
				$kredit_disable = FALSE;
				
				echo '<tr>';
				echo '<td>';
				echo form_hidden('id[]', $row->id);
				echo $row->groups_name.' - '.$row->nama;
				echo '</td>';

				if ($row->saldo_awal < 0)
				{
					$kredit = -($row->saldo_awal);
					$debit_disable = TRUE;
				}
				elseif ($row->saldo_awal > 0)
				{
					$debit = $row->saldo_awal;
					$kredit_disable = TRUE;
				}
				echo '<td>';
				$data['id'] = 'debit'.$i;
				$data['name'] = 'debit'.$i;
				$data['class'] = 'field form-control';
				$data['value'] = (set_value('debit'.$i)) ? set_value('debit'.$i) : $debit;
				if ($debit_disable) $data['disabled'] = TRUE;
				$data['onBlur'] = "cekDebit($i)";
				$data['title'] = "Debit harus diisi dengan angka";
				echo form_input($data);
				echo '</td>';
				unset($data['disabled']);

				echo '<td>';
				$data['id'] = 'kredit'.$i;
				$data['name'] = 'kredit'.$i;
				$data['value'] = (set_value('kredit'.$i)) ? set_value('kredit'.$i) : $kredit;
				if ($kredit_disable) $data['disabled'] = TRUE;
				$data['onBlur'] = "cekKredit($i)";
				$data['title'] = "Kredit harus diisi dengan angka";
				echo form_input($data);
				echo '</td>';
				unset($data['disabled']);

				echo '</tr>';
				$i++;
			}
			else
			{
				$dis_data['class'] = 'field form-control';
				$dis_data['value'] = 0;
				$dis_data['disabled'] = TRUE;
				echo '<tr>';
				echo '<td>'.$row->groups_name.' - '.$row->nama.'</td>';
				echo '<td>'.form_input($dis_data).'</td>';
				echo '<td>'.form_input($dis_data).'</td>';
				echo '</tr>';
			}
		}
		echo '</tbody>';
		echo '</table>';
		echo '** Saldo Awal yang diinput adalah saldo setelah penutupan. Maka akun pada kelompok Pendapatan dan Beban harus 0';
		echo '<br/><br/>';
		
		echo '<div class="btn-group">';
		echo form_submit('simpan', 'Simpan', "id = 'button-save', class = 'btn btn-info'" );
		echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-primary'" );
		echo '</div>';
	}
	else
	{
		echo '<div class="notice">Anda belum membuat data pada akun</div>';
	}
	echo form_close();
?>
			  </div><!-- /.tab-pane -->
			<?php $vou = $this->db->get('wp'); $item = $vou->result(); $no=0; foreach($item as $rows ): $no++;?>
			  <div class="tab-pane" id="tab_<?php echo $rows->id;?>">
<?php
	echo form_open('akun/input_saldo_awal', array('id' => 'saldo_awal_form', 'onsubmit' => 'return cekAkun();'));

	if($this->session->userdata('SUCCESSMSG'))
	{
		echo "<div class='text-center alert-success'>".$this->session->userdata('SUCCESSMSG')."</div>";
		$this->session->unset_userdata('SUCCESSMSG');
	}

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

	if($account_data)
	{
		echo '<table id="tblDetail" name="tblDetail" class="data-table table table-bordered table-striped" >';
		echo '<thead>';
		echo '<tr>';
		echo '<th>Akun</th>';
		echo '<th>Debit</th>';
		echo '<th>Kredit</th>';
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';

		$i = 1;
		foreach ($account_data as $row)
		{			
		  if($row->wp_id == $rows->id) {
			if($row->kelompok_akun_id != 4 && $row->kelompok_akun_id != 5)
			{
				$debit = 0;
				$kredit = 0;
				$debit_disable = FALSE;
				$kredit_disable = FALSE;
				
				echo '<tr>';
				echo '<td>';
				echo form_hidden('id[]', $row->id);
				echo $row->groups_name.' - '.$row->nama;
				echo '</td>';

				if ($row->saldo_awal < 0)
				{
					$kredit = -($row->saldo_awal);
					$debit_disable = TRUE;
				}
				elseif ($row->saldo_awal > 0)
				{
					$debit = $row->saldo_awal;
					$kredit_disable = TRUE;
				}
				echo '<td>';
				$data['id'] = 'debit'.$i;
				$data['name'] = 'debit'.$i;
				$data['class'] = 'field form-control';
				$data['value'] = (set_value('debit'.$i)) ? set_value('debit'.$i) : $debit;
				if ($debit_disable) $data['disabled'] = TRUE;
				$data['onBlur'] = "cekDebit($i)";
				$data['title'] = "Debit harus diisi dengan angka";
				echo form_input($data);
				echo '</td>';
				unset($data['disabled']);

				echo '<td>';
				$data['id'] = 'kredit'.$i;
				$data['name'] = 'kredit'.$i;
				$data['value'] = (set_value('kredit'.$i)) ? set_value('kredit'.$i) : $kredit;
				if ($kredit_disable) $data['disabled'] = TRUE;
				$data['onBlur'] = "cekKredit($i)";
				$data['title'] = "Kredit harus diisi dengan angka";
				echo form_input($data);
				echo '</td>';
				unset($data['disabled']);

				echo '</tr>';
				$i++;
			}
			else
			{
				$dis_data['class'] = 'field form-control';
				$dis_data['value'] = 0;
				$dis_data['disabled'] = TRUE;
				echo '<tr>';
				echo '<td>'.$row->groups_name.' - '.$row->nama.'</td>';
				echo '<td>'.form_input($dis_data).'</td>';
				echo '<td>'.form_input($dis_data).'</td>';
				echo '</tr>';
			}
		  }
		}
		echo '</tbody>';
		echo '</table>';
		echo '** Saldo Awal yang diinput adalah saldo setelah penutupan. Maka akun pada kelompok Pendapatan dan Beban harus 0';
		echo '<br/><br/>';
		
		echo '<div class="btn-group">';
		echo form_submit('simpan', 'Simpan', "id = 'button-save', class = 'btn btn-info'" );
		echo form_reset('reset','Reset', "id = 'button-reset', class = 'btn btn-primary'" );
		echo '</div>';
	}
	else
	{
		echo '<div class="notice">Anda belum membuat data pada akun</div>';
	}
	echo form_close();
?>
			  </div><!-- /.tab-pane -->
			<?php endforeach;?>
			</div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<script type='text/javascript'>
	//Validasi di client
	$(document).ready(function()
	{
		$('#saldo_awal_form').validate({
			errorLabelContainer: "#error",
			wrapper: "li",
			rules:
			{
				<?php 
					for ($j = 1; $j < $i; $j++) 
					{
						echo 'debit'.$j.': "integer",';
						echo 'kredit'.$j.': "integer",';
					}
				?>
			}
		});
	});
</script>
