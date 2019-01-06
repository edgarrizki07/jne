		<div class="row">
			<div class="col-xs-12">
				<div class="col-sm-12">
				<h4 class="text-bold"><?php echo $this->pajak_model->NamaCabang($info['wp_id']);?> <?php echo $this->pajak_model->KotaCabang($info['wp_id']);?></h4>
				<p class="text-bold">
					<?php echo $this->pajak_model->AlamatCabang($info['wp_id']);?>
					<?php echo $this->pajak_model->KotaCabang($info['wp_id']);?> INDONESIA<br>
						<td>Email : <?php echo $this->pajak_model->EmailCabang($info['wp_id']);?></td>
						<td>Phone : <?php echo $this->pajak_model->TelpCabang($info['wp_id']);?></td>
						<td>Fax : <?php echo $this->pajak_model->FaxCabang($info['wp_id']);?> </td>
				</p>
				</div><!-- /.col -->
			</div><!-- /.col -->
		</div></br>
		<!-- info row -->
