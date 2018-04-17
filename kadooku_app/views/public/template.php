<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?=base_url('kadooku_assets/public/');?>images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>fonts/themify/themify-icons.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>fonts/elegant-font/html-css/style.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>vendor/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>vendor/lightbox2/css/lightbox.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>css/main.css?_=<?php echo time("YmdHis") ?>">

</head>
<body class="animsition">

	<?=$this->load->view('public/layout/header');?>

	<?=$contents;?>

	<!-- Shipping -->
	<section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					<?=lang('shipping_to');?>
				</h4>

				<span class="s-text11 t-center">
					<?=lang('desc_shipping_to');?>
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					<?=lang('shipping_time');?>
				</h4>

				<span class="s-text11 t-center">
					<?=lang('desc_shipping_time');?>
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					<?=lang('price_sell');?>
				</h4>

				<span class="s-text11 t-center">
					<?=lang('desc_price_sell');?>
				</span>
			</div>
		</div>
	</section>


	<?=$this->load->view('public/layout/footer');?>
    <input type="hidden" id="base_url" value="<?=base_url();?>">
    <input type="hidden" id="cart" value="<?=lang('add_to_cart');?>">

	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/animsition/js/animsition.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>js/slick-custom.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/countdowntime/countdowntime.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/lightbox2/js/lightbox.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/sweetalert/sweetalert.min.js"></script>
	<script src="<?=base_url('kadooku_assets/public/');?>js/main.js"></script>
	<script src="<?=base_url('kadooku_assets/public/');?>vendor/lazy/lazyload.min.js"></script>
	<script src="<?=base_url('kadooku_assets/public/');?>js/endless-scroll.js"></script>
	<script src="<?=base_url('kadooku_assets/public/');?>js/kadooku.js?_=<?php echo time("YmdHis") ?>"></script>

</body>
</html>
