<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>
	
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content="" />
	<meta name="author" content="Guyub" />
    <title><?php echo $this->setting_model->Nama();?> | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>lte/plugins/iCheck/square/blue.css">

	<script type="text/javascript" charset="utf-8">
		$(function() {
			$('#button-login').button({
				icons: {
					primary: 'ui-icon-person'
				}
			});

			$('#login_form').validate({
				errorLabelContainer: "#error",
				wrapper: "li",
				rules:
				{
					username: "required",
					password: "required"
				}
			});
		});
	</script>
	<title>Halaman Login</title>
</head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
		<?php if(!$this->setting_model->Logo1()==''){ ?>
		<img width="200px" src="<?php echo base_url('/images/'.$this->setting_model->Logo1());?>"/>
		<?php } ?>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">
		<?php if($this->session->userdata('SUCCESSMSG')) { echo "<div class='text-center callout callout-info'>".$this->session->userdata('SUCCESSMSG')." </div>";  $this->session->unset_userdata('SUCCESSMSG'); } ?>
		</p>

        <div class="social-auth-links text-center">
			<?php
				echo form_open('login/login_exec', 'id="login_form"');

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
			?>
<input name="link" type="hidden" class="form-control" value="<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>/<?php echo $this->uri->segment(5);?>"/>
			<?php

					echo '<p>';
					echo form_label('Username','username');
					echo '<br/>';

					$data['name'] = $data['id'] = 'username';
					$data['class'] = 'form-control';
					$data['title'] = "Username harus diisi";
					echo form_input($data);

					echo '</p>';

					echo '<p>';
					echo form_label('Password','password');
					echo '<br/>';

					$data['name'] = $data['id'] = 'password';
					$data['class'] = 'form-control';
					$data['title'] = "Password harus diisi";
					echo form_password($data);

					echo '</p>';

					$submit['name'] = 'submit';
					$submit['id'] = 'button-login';
					$submit['class'] = 'btn btn-primary btn-block btn-flat';
					$submit['type'] = 'submit';
					$submit['content'] = 'Login';
					echo form_button($submit);

				echo form_close();
			?>
        </div><!-- /.social-auth-links -->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>lte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>lte/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>lte/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>

</html>
