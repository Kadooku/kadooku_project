<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en" class="">
<head>
  <meta charset="utf-8" />
  <title><?=!empty($title) ? $title : "KadooKu - Admin";?></title>
  <meta name="description" content="{desc}" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <link rel="stylesheet" href="<?=base_url('kadooku_assets/admin/');?>libs/assets/animate.css/animate.css" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('kadooku_assets/admin/');?>libs/jquery/bootstrap/dist/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('kadooku_assets/admin/');?>css/bootstrap-treeview.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('kadooku_assets/admin/');?>plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url('kadooku_assets/admin/');?>plugins/sweetalert/sweetalert.css">
  <link rel="stylesheet" href="<?=base_url('kadooku_assets/admin/');?>css/style.css?_=<?=time('YmdGis');?>" type="text/css" />  
  <link rel="stylesheet" href="<?=base_url('kadooku_assets/admin/');?>css/color.palete.css?_=<?=time('YmdGis');?>" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('kadooku_assets/admin/');?>custom/select2/dist/css/select2.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('kadooku_assets/admin/');?>custom//select2/dist/css/select2-bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('kadooku_assets/admin/');?>css/custom.css?_=<?=time('YmdGis');?>" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" type="text/css" />
  <style type="text/css">
    .clearfix-padding{
      padding-top: 10px;
    }
  </style>
</head>


<body>

  <input type="hidden" value="<?php echo base_url()?>" id="base_url">

  <div class="app app-header-fixed">
    <!-- header -->
    <header class="app-header navbar" id="header" role="menu">
      <!-- navbar header -->
      <div class="navbar-header bg-darkred fg-white">
        <button class="pull-left visible-xs dk" ui-toggle-class="off-screen" target=".app-aside" ui-scroll="app" id="menu-mobile">
          <i class="fa fa-align-justify"></i>
        </button>
            <a class="pull-right visible-xs avatar-btn" ui-toggle-class="show" target=".menu-xs-drop">
              <img src="https://www.gravatar.com/avatar/903cc7f2c047407fcd2628d33cfcda85" alt="Foto" class="mini-avatar-round">
            </a>
            <a href="<?php echo base_url()?>" class="navbar-brand text-lt">
              <img src="<?php echo base_url('kadooku_assets/public/images/logo/logo3.jpg'); ?>" alt="">          
            </a>
        <ul class="menu-xs-drop dropdown-menu animated fadeIn w-ml pull-right">
          <li>
            <a href="<?php echo base_url('user/logout'); ?>">
              <i class="fa fa-power-off"></i> Log Out
            </a>
          </li>
        </ul>
        <!-- / brand -->
      </div>
      <!-- / navbar header -->

      <!-- navbar collapse -->
      <div class="collapse pos-rlt navbar-collapse bg-darkred fg-white">
        <!-- nabar right -->
        <a href="<?=base_url();?>" class="navbar-brand text-lt app-logo">
          <img src="<?php echo base_url('kadooku_assets/public/images/logo/logo3.jpg'); ?>" alt="">
        </a>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="bg-none profile-header dropdown-toggle clear" data-toggle="dropdown" style="padding-bottom:17px;">
                    <span class="thumb-sm avatar pull-left m-t-n-sm m-b-n-sm m-r-sm">
                        <img src="https://www.gravatar.com/avatar/903cc7f2c047407fcd2628d33cfcda85" alt="Foto" class="mini-avatar-round">
                    </span>
                    <span class="m-r-sm">
                        <i class="text14 fa fa-caret-down pull-right"></i>
                    </span>
                        <div style="margin-left: 60px;margin-top: -30px;">
                            <b>Administrator</b><br>
                        </div>
                </a>
                <!-- dropdown -->
                <ul class="dropdown-menu animated fadeIn w-ml">       
                  <li>
                    <a href="<?php echo base_url('user/logout'); ?>">
                      <i class="fa fa-power-off"></i> Log Out
                    </a>
                  </li>
                </ul>
                <!-- / dropdown -->
            </li>
        </ul>
        <!-- / navbar right -->
      </div>
      <!-- / navbar collapse -->
  </header>
  <!-- / header -->


  <!-- aside -->
  <aside class="app-aside hidden-xs bg-white" id="aside">
    <?=$this->load->view('backend/layout/sidebar');?>
  </aside>
<!-- / aside -->

<!-- content -->
<div id="content" class="app-content" role="main">
    <!-- <div class="clearfix-padding"></div> -->
    <div class="hbox hbox-auto-xs hbox-auto-sm ng-scope">
        <div class="col">
            <div class="app-content-body">
                    <div class="wrapper-lg bg-light">
                    <?=$contents;?>
                </div>
            </div>
            <!-- App-content-body --> 
        </div>
        <!-- .col -->
    </div>
    <!-- end hbox hbox-auto-xs -->
</div>

<div class="clearfix-padding"></div>
   <!-- footer -->
  <footer id="footer" class="app-footer" role="footer">
    <div class="wrapper-md padder-lg b-t bg-light">
      <span class="pull-right">
        Copyright &copy; <?php echo date('Y'); ?> KadooKu
      </span>
    </div>
  </footer>
  <!-- / footer -->



</div>

</body>

<script src="<?=base_url('kadooku_assets/admin/');?>libs/jquery/jquery/dist/jquery.js"></script>
<script src='<?=base_url('kadooku_assets/admin/');?>custom/fullcalendar/lib/moment.min.js'></script>
<script src='<?=base_url('kadooku_assets/admin/');?>plugins/moment/moment-with-locales.min.js'></script>
<script src="<?=base_url('kadooku_assets/admin/');?>libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<script src="<?=base_url('kadooku_assets/admin/');?>js/bootstrap-treeview.js"></script>
<script src="<?=base_url('kadooku_assets/admin/');?>js/ui-nav.js"></script>
<script src="<?=base_url('kadooku_assets/admin/');?>js/ui-toggle.js"></script>
<script src="<?=base_url('kadooku_assets/admin/');?>custom//select2/dist/js/select2.min.js"></script>
<script src="<?=base_url('kadooku_assets/admin/plugins/');?>tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="<?=base_url('kadooku_assets/admin/plugins/');?>tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?=base_url('kadooku_assets/admin/plugins/');?>sweetalert/sweetalert.min.js"></script>
<script src="<?=base_url('kadooku_assets/admin/');?>libs/jquery/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('kadooku_assets/admin/');?>libs/jquery/plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('kadooku_assets/admin/');?>js/app.js?_=<?=time('YmdGis');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<script src="<?=base_url('kadooku_assets/admin/');?>js/custom.js?_=<?=time('YmdGis');?>"></script>
      

</html>