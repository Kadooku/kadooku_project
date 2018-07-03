<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=!empty($title) ? "Kadooku - $title" : "KadooKu - Cari Kado mudah";?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?=base_url('kadooku_assets/public/');?>images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/public/');?>vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
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
	<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />

</head>
<body class="animsition">
	
	<?php if(!in_array($this->uri->segment(2), array('login', 'register'))){
		echo $this->load->view('public/layout/header');
	}?>

	<?=$contents;?>

	<?php if(!in_array($this->uri->segment(2), array('login', 'register'))){
		echo $this->load->view('public/layout/footer');
	}?>

    <input type="hidden" id="base_url" value="<?=base_url();?>">
    <input type="hidden" id="cart" value="<?=lang('add_to_cart');?>">
	<!-- Container Selection -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>


	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/animsition/js/animsition.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>js/slick-custom.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/countdowntime/countdowntime.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/lightbox2/js/lightbox.min.js"></script>
	<script type="text/javascript" src="<?=base_url('kadooku_assets/public/');?>vendor/sweetalert/sweetalert.min.js"></script>
	<script src="<?=base_url('kadooku_assets/public/');?>js/main.js"></script>
	<script src="<?=base_url('kadooku_assets/public/');?>vendor/lazy/lazyload.min.js"></script>
	<script src="<?=base_url('kadooku_assets/public/');?>js/endless-scroll.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
	<script src="<?=base_url('kadooku_assets/public/');?>js/kadooku.js?_=<?php echo time("YmdHis") ?>"></script>

</body>
</html>
