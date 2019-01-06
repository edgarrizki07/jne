<script type="text/javascript">
$(document).ready(function(){

$("#produk").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#angkutan").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });

});	
</script>
<!-- Page Right Column -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo $title;?> Nomor : <?php echo $no;?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>

	<!-- Main content -->
<form class="form" action="" method="post" enctype="multipart/form-data" >
<!-- text input -->
<div class="hidden">
	<label><strong>ID <?php echo $title;?></strong></label>
	<input name="id" type="text" class="form-control" value="ID" required/>
	<label><strong>Kode <?php echo $title;?></strong></label>
	<input name="id_po" type="text" class="form-control" value="<?php echo $no;?>" required/>
</div>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- general form elements disabled -->
				<div class="box box-warning">
					<div class="box-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Customer</strong></label>
									</div>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-user"></i></div>
										<select name="customer_id" class="form-control select2" required>
										<option> - Pilih Customer- </option>
									<?php $byr = $this->db->get_where('customer',array('wp_id'=>$this->session->userdata('SESS_WP_ID')));?>
									<?php $item = $byr->result(); ?>
									<?php $no=0; foreach($item as $row ): $no++;?>
										<option value="<?php echo $row->id;?>"><?php echo $row->id_customer;?> - <?php echo $row->nama;?> up. <?php echo $row->cp;?></option>
									<?php endforeach;?>
										</select>
										<span class="input-group-btn">
										  <a href="<?php echo site_url('customer/add');?>" class="btn btn-info btn-flat" type="button">Tambah Customer Baru</a>
										</span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Jumlah Permintaan</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<input name="jml" type="text" class="form-control" required/>
										<span class="input-group-addon"> Ltr </span>
										<span class="input-group-addon"><b> Harga </b></span>
										<span class="input-group-addon"><input name="cek_harga" value="1" type="checkbox" checked> <b>Include</b></span>
										<span class="input-group-addon"> Rp </span>
									<input name="harga" type="text" class="form-control" required/>
										<span class="input-group-addon"> / Ltr </span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Pajak</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon">
										<input name="ppn" value="1" type="checkbox" checked> <b>PPN</b>
										</span>
										<input name="nppn" type="text" class="form-control" value="10" readonly="readonly"/>
										<span class="input-group-addon"> 10 % </span>
										<span class="input-group-addon">
										<input name="pph" value="1" type="checkbox"> <b>PPH</b>
										</span>
										<input name="npph" type="text" class="form-control" value="0.3" readonly="readonly"/>
										<span class="input-group-addon"> 0,3 % </span>
										<span class="input-group-addon">
										<input name="pbbkb" value="1" type="checkbox"> <b>PBBKB</b>
										</span>
										<input name="npbbkb" type="text" class="form-control" value="<?php echo $this->pajak_model->PbbkbCabang($this->session->userdata('SESS_WP_ID'));?>"  placeholder="Nilai PBBKB "/>
										<span class="input-group-addon"> % </span>
									</div>
									<p align="center"><b>apabila tanpa pajak (PPN/PBBKB/PPH) hilangkan cek diatas ini.</b></p>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Beban Transport */Ltr</strong></label> (dalam invoice)
									</div>
									<div class="input-group">
										<span class="input-group-addon"> Rp </span>
										<input name="ohp" type="text" class="form-control"/>
										<span class="input-group-addon"> / Ltr  +  <input name="ppnohp" value="1" type="checkbox"> PPN 10 % </span>
									</div>
								</div>
								<h2 class="page-header"></h2>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>No Purchase Order</strong></label>
									</div>
									<div class="input-group">
										<input name="nopo" type="text" class="form-control" value="" placeholder="Nomor PO " required/>
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input name="tglpo" id="datepicker" type="text" class="form-control" value="<?php echo $tgl;?>" placeholder="Tanggal PO " required/>
										<span class="input-group-addon"><i class="fa fa-upload"></i></span>
										<input name="filepo" type="file" class="form-control" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Sales</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<input name="sales" type="text" class="form-control" required/>
										<span class="input-group-addon"><b>Carrier</b> </span>
										<select name="carrier" class="form-control" required>
											<option value="LOCO">LOCO</option>
											<option value="FRANKO">FRANKO</option>
										</select>
										<span class="input-group-addon"> <b>Term Payment</b> </span>
									<input name="term" type="text" class="form-control" required/>
										<span class="input-group-addon"> <b>Tempo</b> </span>
									<input name="tempo" id="datepicker-tempo" type="text" class="form-control" value="<?php echo $tgl;?>" required/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-2">
										<label><strong>Terbilang</strong></label>
									</div>
									<div class="input-group">
										<span class="input-group-addon"> : </span>
									<input name="terbilang" type="text" class="form-control" required/>
									</div>
								</div>
							</div>
						</div><!-- /.row -->
					</div><!-- /.box-body -->
					<div class="box-body">
						<div class="row">
							<div class="text-center">
								<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> SIMPAN</button>
								<a href="<?php echo site_url('jual');?>"><button type="button" class="btn btn-primary"><i class="fa fa-undo"></i> BATAL</button></a>
							</div>
						</div><!-- /.row -->
					</div>
				</div><!-- /.box -->
			</div><!--/.col (right) -->
		</div>
	</section><!-- /.content -->
</form>
</aside><!-- /.right-side -->
	<!-- end Page Right Column -->
	<script>
function select2_ajax(e, thisElement) {
$(e).select2({
width: '100%',
minimumInputLength: 1,
placeholder: '' + thisElement.attr('data-placeholder'),
data: [],
ajax: {
	type: "post",
	url: thisElement.attr('data-source') + "/",
	dataType: 'json',
	quietMillis: 100,
	data: function (term, page) {
		return {
			term: term,
			limit: 10
		};
	},
	processResults: function (data) {
		return {
			results: data,
			more: false
		};
	}
}
});
}
$(function () {
$('.select2').select2({width: '100%'});
$(".select2-ajax").each(function () {
var thisElement = $(this);
select2_ajax(this, thisElement);
});
});
</script>				