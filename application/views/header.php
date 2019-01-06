<?php $user_photo = $this->user_model->PhotoUser($this->session->userdata('SESS_USER_ID')); ?>
<?php if($user_photo==''){ $src_img = 'images/photo.png'; } else { $src_img = 'uploads/user/'.$user_photo;  } ?>
      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><?php echo $this->setting_model->Singkatan();?></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><small><?php echo $this->setting_model->Nama();?></small></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			  <li class="dropdown messages-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-flag-o"></i><span class="label label-danger"><div onload="timer=setTimeout('move()',5000)"id="label_messages" ></div>1</span>
				</a>
				<ul class="dropdown-menu">
					<li class="header">You have 4 messages</li>
					<li>
					<!-- inner menu: contains the actual data -->
						<ul class="menu">
							<li><!-- start message -->
								<a href="#">
									<div class="pull-left">
										<img src="<?php echo base_url();?>lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
									</div>
									<h4>Support Team<small><i class="fa fa-clock-o"></i> 5 mins</small></h4>
									<p>Why not buy a new awesome theme?</p>
								</a>
							</li>
							<!-- end message -->
							<li>
								<a href="#">
									<div class="pull-left">
										<img src="<?php echo base_url();?>lte/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
									</div>
									<h4>AdminLTE Design Team<small><i class="fa fa-clock-o"></i> 2 hours</small></h4>
									<p>Why not buy a new awesome theme?</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="footer"><a href="#">See All Messages</a></li>
				</ul>
			  </li>
			  <li class="dropdown messages-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-envelope-o"></i><span class="label label-success"><div onload="timer=setTimeout('move()',5000)"id="label_messages" ></div>1</span>
				</a>
				<ul class="dropdown-menu">
					<li class="header">You have 4 messages</li>
					<li>
					<!-- inner menu: contains the actual data -->
						<ul class="menu">
							<li><!-- start message -->
								<a href="#">
									<div class="pull-left">
										<img src="<?php echo base_url();?>lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
									</div>
									<h4>Support Team<small><i class="fa fa-clock-o"></i> 5 mins</small></h4>
									<p>Why not buy a new awesome theme?</p>
								</a>
							</li>
							<!-- end message -->
							<li>
								<a href="#">
									<div class="pull-left">
										<img src="<?php echo base_url();?>lte/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
									</div>
									<h4>AdminLTE Design Team<small><i class="fa fa-clock-o"></i> 2 hours</small></h4>
									<p>Why not buy a new awesome theme?</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="footer"><a href="#">See All Messages</a></li>
				</ul>
			  </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <img src="<?php echo base_url() . $src_img ;?>" class="user-image">
                  <span class="hidden-xs"><?php echo $this->user_model->NamaUser($this->session->userdata('SESS_USER_ID')); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
					<img src="<?php echo base_url() . $src_img ;?>" class="img-circle">
                    <p>
                      <?php echo $this->user_model->NamaUser($this->session->userdata('SESS_USER_ID')); ?> - <?php echo $this->user_model->NamaBUser($this->session->userdata('SESS_USER_ID')); ?>
                      <small><?php echo $this->user_model->Level($this->session->userdata('ADMIN'));?> - <?php echo $this->pajak_model->KotaCabang($this->session->userdata('SESS_WP_ID'));?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url();?>profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url();?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>

        </nav>
      </header>