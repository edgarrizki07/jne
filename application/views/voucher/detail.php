				<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header no-print">
					<div class="input-group-btn">
                        <a class="btn btn-warning" style="cursor: pointer;" onclick="location.href='<?php echo site_url('voucher');?>'"> Kembali </a>
						<button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                    </div><!-- /btn-group -->
					<ol class="breadcrumb">
						<li><a href="<?php echo site_url('home');?>"><i class="fa fa-home"></i> Home</a></li>
						<li class="active"><?php echo $title; ?></li>
					</ol>
                </section>

                <!-- Main content -->
                <section class="content invoice">
                    <div class="row">
                        <div class="col-xs-4">
                            <p class="lead"><?php echo $title;?>:</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>No</th>
                                        <td>:</td>
                                        <td><?php echo $info['id'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Kode</th>
                                        <td>:</td>
                                        <td><?php echo $info['kode'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Kepada</th>
                                        <td>:</td>
                                        <td><?php if($info['proyek']=='0'){ ?>Lain<?php }else if($info['proyek']=='1'){ ?>Supplier<?php }else if($info['proyek']=='2'){ ?>Customer<?php } ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis</th>
                                        <td>:</td>
                                        <td><?php echo $info['jenis'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td><?php echo $info['nama'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Payment</th>
                                        <td>:</td>
                                        <td><?php echo $info['pay'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Tempo</th>
                                        <td>:</td>
                                        <td><?php if($info['due']=='0'){ ?>Tidak Ada<?php }else{ ?>Ada<?php } ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-8">
                            <p class="lead">Contoh :</p>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			<!-- end Page Content -->