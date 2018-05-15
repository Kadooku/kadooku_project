    <!-- Header -->
	<header class="header1">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="topbar">
				<!-- <div class="topbar-social">
					<a href="#" class="topbar-social-item fa fa-facebook"></a>
					<a href="#" class="topbar-social-item fa fa-instagram"></a>
					<a href="#" class="topbar-social-item fa fa-pinterest-p"></a>
					<a href="#" class="topbar-social-item fa fa-snapchat-ghost"></a>
					<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
				</div>

				<span class="topbar-child1">
					Free shipping for standard order over $100
				</span> -->

				<div class="topbar-child2">
					<span class="topbar-email">
						me@kadooku.com
					</span>

					<div class="topbar-language rs1-select2">
						<select class="selection-1" name="time">
							<option>ID</option>
							<option>EN</option>
						</select>
					</div>
				</div>
			</div>

			<div class="wrap_header">
				<!-- Logo -->
				<a href="<?=base_url();?>" class="logo">
					<img src="<?=base_url('kadooku_assets/public/');?>images/icons/logo.jpg" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu">
					<nav class="menu">
						<ul class="main_menu">
							<li>
								<a href="<?=base_url();?>">Home</a>
							</li>
							<?php $cat = $this->db->get_where('categories', array('parent_id' => 0))->result();?>
						<?php foreach($cat as $c): ?>
							<?php $sub_menu = $this->db->get_where('categories', array('parent_id' => $c->id));
							if($sub_menu->num_rows() > 0) :?>
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false"><?=$c->category_name;?></a>
								<ul class="header-cat dropdown-menu dropdown-menu-left">
									<?php foreach($sub_menu->result() as $sub) : ?>
									<li><a href="<?=base_url('product?category='.$sub->category_url);?>"><?=$sub->category_name;?></a></li>
									<?php endforeach;?>
								</ul>
								</li>
							<?php else :?>
								<li><a href="<?=base_url('product?category='.$c->category_url);?>"><?=$c->category_name;?></a></li>
							<?php endif;?>
						<?php endforeach;?>
						</ul>
					</nav>
				</div>

				<!-- Header Icon -->
				<div class="header-icons">
				<?php $user = $this->session->userdata('userData');
					if($user['login_status'] == TRUE):?>
					<div class="header-wrapicon2">
						<a href="#" class="dropdown-toggle header-wrapicon1 dis-block js-show-header-dropdown" style="color:#fff;">
							<img src="<?=base_url('kadooku_assets/public/');?>images/icons/user-icon.png" class="header-icon1" alt="ICON">
							<?php echo $user['username'];?>
						</a>
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="<?php echo $user['profile_picture'];?>" width="50" height="50" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<?php echo $user['full_name'];?>

										<span class="header-cart-item-info">
											<a href="<?=$user['isSocialLogin'] ? base_url('social_login/logout') : base_url('user/logout');?>">Logout</a>
										</span>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<span class="linedivide1"></span>
				<?php else:?>
					<a href="<?=base_url('user/login');?>" class="header-wrapicon1 dis-block" style="color:#fff;">
						Login/Register
					</a>
					<span class="linedivide1"></span>
				<?php endif;?>
					<div class="header-wrapicon2">
						<a href="<?=base_url('cart');?>">
							<img src="<?=base_url('kadooku_assets/public/');?>images/icons/shopping-cart-24.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						</a>
						<span class="header-icons-noti"><?=$this->cart->total_items();?></span>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="<?=base_url();?>" class="logo-mobile">
				<img src="<?=base_url('kadooku_assets/public/');?>images/icons/logo.jpg" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
				<?php $user = $this->session->userdata('userData');
					if($user['login_status'] == TRUE):?>
					<div class="header-wrapicon2">
						<div class="header-wrapicon1 dis-block js-show-header-dropdown" style="color:#fff;">
							<img src="<?=base_url('kadooku_assets/public/');?>images/icons/user-icon.png" class="header-icon1" alt="ICON">
						</div>
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="<?php echo $user['profile_picture'];?>" width="50" height="50" alt="IMG">
									</div>

									<div class="header-cart-item-txt">
										<?php echo $user['full_name'];?>

										<span class="header-cart-item-info">
											<a href="<?=$user['isSocialLogin'] ? base_url('social_login/logout') : base_url('user/logout');?>">Logout</a>
										</span>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<span class="linedivide1"></span>
				<?php endif;?>
					<div class="header-wrapicon2">
						<a href="<?=base_url('cart');?>">
							<img src="<?=base_url('kadooku_assets/public/');?>images/icons/shopping-cart-24.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						</a>
						<span class="header-icons-noti"><?=$this->cart->total_items();?></span>
					</div>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">

					<li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
						<div class="topbar-child2-mobile">
							<span class="topbar-email">
								me@kadooku.com
							</span>

							<div class="topbar-language rs1-select2">
								<select class="selection-1" name="time">
									<option>ID</option>
									<option>EN</option>
								</select>
							</div>
						</div>
					</li>
					<?php if($user['login_status'] == FALSE):?>
						<li class="item-menu-mobile">
							<a href="<?=base_url('user/login');?>">Login/Register</a>
						</li>
					<?php endif;?>
					<li class="item-menu-mobile">
						<a href="<?=base_url();?>">Home</a>
					</li>
					<?php $cat = $this->db->get_where('categories', array('parent_id' => 0))->result();?>
						<?php foreach($cat as $c): ?>
							<?php $sub_menu = $this->db->get_where('categories', array('parent_id' => $c->id));
							if($sub_menu->num_rows() > 0) :?>
								<li class="dropdown item-menu-mobile">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="false"><?=$c->category_name;?></a>
								<ul class="header-cat dropdown-menu dropdown-menu-left">
									<?php foreach($sub_menu->result() as $sub) : ?>
									<li><a href="<?=base_url('product?category='.$sub->category_url);?>"><?=$sub->category_name;?></a></li>
									<?php endforeach;?>
								</ul>
								</li>
							<?php else :?>
								<li class="item-menu-mobile"><a href="<?=base_url('product?category='.$c->category_url);?>"><?=$c->category_name;?></a></li>
							<?php endif;?>
						<?php endforeach;?>
				</ul>
			</nav>
		</div>
	</header>