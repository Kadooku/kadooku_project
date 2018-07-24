<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default bg-lighterBlue fg-white">
            <div class="panel-body">
                <i class="fa fa-2x fa-info-circle fa-lg"></i> Selamat datang <b>Admin</b>, Hari ini <?php echo tanggal_indo(date("Y-m-d G:i:s")); ?> anda login ke Website KadooKu.
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="circle-tile">
                <div class="circle-tile-heading dark-blue">
                    <i class="fa fa-users fa-fw fa-3x"></i>
                </div>
            <div class="circle-tile-content dark-blue">
                <div class="circle-tile-number text-faded">
                    <?=$users;?>
                    <span id="sparklineA"></span>
                </div>
                <div class="circle-tile-description text-faded">
                    Customer
                </div>
                <a href="<?=base_url('adm_kadooku/customer');?>" class="circle-tile-footer">Lihat <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="circle-tile">
                <div class="circle-tile-heading bg-crimson">
                    <i class="fa fa-tags fa-fw fa-3x"></i>
                </div>
            <div class="circle-tile-content bg-crimson">
                <div class="circle-tile-number text-faded">
                    <?=$categories;?>
                </div>
                <div class="circle-tile-description text-faded">
                    Kategori
                </div>
            
                <a href="<?=base_url('adm_kadooku/category');?>" class="circle-tile-footer">Lihat <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="circle-tile">
                <div class="circle-tile-heading blue">
                    <i class="fa fa-gift fa-fw fa-3x"></i>
                </div>
            <div class="circle-tile-content blue">
                <div class="circle-tile-number text-faded">
                    <?=$products;?>
                    <span id="sparklineB"></span>
                </div>
                <div class="circle-tile-description text-faded">
                    Product
                </div>
                
                <a href="<?=base_url('adm_kadooku/product');?>" class="circle-tile-footer">Lihat <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="circle-tile">
                <div class="circle-tile-heading green">
                    <i class="fa fa-money fa-fw fa-3x"></i>
                </div>
            <div class="circle-tile-content green">
                <div class="circle-tile-number text-faded">
                    <?=$transactions;?>
                </div>
                <div class="circle-tile-description text-faded">
                    Transaksi
                </div>
                
                <a href="<?=base_url('adm_kadooku/transaction');?>" class="circle-tile-footer">Lihat <i class="fa fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>