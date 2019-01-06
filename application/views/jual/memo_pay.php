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
            <div class="col-md-12">
              <div class="box box-primary">
				<iframe src="<?php echo site_url('lihat/bayar/'.$info['id']);?>" frameborder="0" height="300px" width="100%"></iframe>
                <div class="box-header with-border">
                  <h3 class="box-title">Tulis Memo</h3>
                </div><!-- /.box-header -->
				<form action="" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
					<input type="hidden" name="id" class="form-control" value="id" readonly="readonly"/>
                    <textarea name="pesan" id="compose-textarea" class="form-control" placeholder="Isi Pesan:" style="height: 300px"></textarea>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="form-group pull-left">
                  </div>
                  <div class="pull-right">
                    <button id="kirim" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Kirim</button>
                  </div>
                </div><!-- /.box-footer -->
				</form>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
