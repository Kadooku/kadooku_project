<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="aside-wrap">
  <div class="navi-wrap navi-wrap-menus">
   <!-- nav -->
    <nav class="navi white-navi clearfix">
        <ul class="nav sidebar-menu">
          <li class="hidden-folded m-t-lg m-b-sm text-heading font-semibold text-xs padding-l-r-lg fg-red" style="border-bottom: 1.5px solid #eee;padding-bottom: 15px">
                <span><b>MENU</b></span>
          </li>
          <li>
            <a href="<?php echo base_url('adm_kadooku'); ?>" class="auto padding-l-r-lg font-semibold "><i class="fa fa-home fa-2x"></i>Home</a>
          </li>
          <li>
            <a href="<?php echo base_url('adm_kadooku/customer'); ?>" class="auto padding-l-r-lg font-semibold "><i class="fa fa-users fa-2x"></i>Management Customer</a>
          </li>
          <li>
            <a href="<?php echo base_url('adm_kadooku/product'); ?>" class="auto padding-l-r-lg font-semibold "><i class="fa fa-gift fa-2x"></i>Management Product</a>
          </li>
          <li>
            <a href="<?php echo base_url('adm_kadooku/category'); ?>" class="auto padding-l-r-lg font-semibold "><i class="fa fa-tags fa-2x"></i>Management Category</a>
          </li>
          <li>
            <a href="<?php echo base_url('adm_kadooku/transaction'); ?>" class="auto padding-l-r-lg font-semibold "><i class="fa fa-shopping-cart fa-2x"></i>Management Transaksi</a>
          </li>
        </ul>
    </nav>
    <!-- nav -->
  </div>
  <div class="navi-wrap navi-footer navi-footer-white">
    <nav class="navi clearfix">
      <ul class="nav">
        <li class="hidden-folded text-heading text-xs"><span>Made with <i class="fa fa-heart text-xs text-danger"></i> in Bandung</span></li>
      </ul>
    </nav>
  </div>
</div>