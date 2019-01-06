				<!-- Page Right Column -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header no-print">
					<div class="input-group-btn">
                        <a class="btn btn-warning" style="cursor: pointer;" onclick="location.href='<?php echo site_url('kategori');?>'"> Kembali </a>
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
                        </div><!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>No</th>
                                        <td>:</td>
                                        <td><?php echo $info['id'];?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-3">
							<table class="table">
								<tr>
									<th>Nama</th>
									<td>:</td>
									<td><?php echo $info['nama'];?></td>
								</tr>
							</table>
                        </div><!-- /.col -->
                        <div class="col-xs-3">
							<table class="table">
								<tr>
									<th>Aging</th>
									<td>:</td>
									<td><?php if($info['aging']=='0'){ ?>Tidak Ada<?php }else{ ?>Ada<?php } ?></td>
								</tr>
							</table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			<!-- end Page Content -->