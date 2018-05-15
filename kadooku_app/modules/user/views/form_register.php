<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?=base_url('kadooku_assets/public/images/fix.jpg');?>');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w" action="<?php echo base_url('user/register');?>" method="POST">
						
					<span class="login100-form-title p-b-53">
						<div class="imglogo">
							<a href="<?=base_url();?>"><img src="<?=base_url('kadooku_assets/public/images/logo/logo.png');?>" alt="logo" height="60px"></a>
						</div>
							Sign Up With
					</span>
                    

					<a href="<?=base_url('social_login/fb');?>" class="btn-face m-b-20">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</a>

					<a href="<?=base_url('social_login/google');?>" class="btn-google m-b-20">
						<img src="<?=base_url('kadooku_assets/public/images/icons/icon-google.png');?>" alt="GOOGLE">
						Google
					</a>

					<?php if(!empty(validation_errors())):?>
					<div class="wrap-alert notif">
						<div class="alert alert-danger" role="alert">
						  <?php echo validation_errors();?>
						</div>
					</div>
					<?php endif;?>
					
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Nama Lengkap
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Nama Lengkap is required">
						<input class="input100" type="text" name="full_name" >
						<span class="focus-input100"></span>
					</div>

					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Username
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" >
						<span class="focus-input100"></span>
					</div>

					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Email
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Email is required">
						<input class="input100" type="email" name="email" >
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" >
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Sign Up
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Have account?
						</span>

						<a href="<?=base_url('user/login');?>" class="txt2 bo1">
							Sign in now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>