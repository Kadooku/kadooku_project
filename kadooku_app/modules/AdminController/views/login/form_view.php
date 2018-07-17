<div class="container">
  <div class="info">
    <h1><!-- <b>Login</b> First --></h1>
  </div>
</div>
<div class="form">
  <!-- <div class="thumbnail"><img src="<?=base_url('kadooku_assets/public/images/logo/logo4.png');?>" style="margin-top: -10px" /></div> -->
  <h5>LOGIN FORM</h5>
  <form class="register-form" action="">
    Jika anda lupa password untuk login, mohon menghubungi Admin Website untuk dapat mengakses member panel, Terimakasih.
    <p class="message">Tidak Lupa? <a href="#">Sign In</a></p>
  </form>
  <form class="login-form" action="" method="POST">
    <p><?php echo validation_errors(); ?></p><br>
    <input type="text" id="username" name="username" value="<?php echo set_value('username') ? set_value('username') : '' ;?>" placeholder="Username"/>
    <input type="password" placeholder="Password" id="password" name="password"/>
    <button>LOGIN</button>
    <!-- <p class="message">Lupa Password? <a href="#">Lupa</a></p> -->
  </form>
</div>

<div class="footer">
  <div class="info">
    <span>Made with <i class="fa fa-heart"></i> in Bandung</a></span>
  </div>
</div>
