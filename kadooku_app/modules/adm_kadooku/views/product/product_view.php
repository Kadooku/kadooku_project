<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="row">
<?php if($this->session->flashdata('code') == 1): ?>
    <!-- Menampilkan Pesan -->
    <div class="notif">
         <div class="alert alert-<?php echo $this->session->flashdata('alert'); ?>">
            <i class="fa fa-<?php echo $this->session->flashdata('icon'); ?> "></i> <strong><?php echo $this->session->flashdata('msg') ?> </strong>
         </div>  
    </div>     
<?php endif; ?>

    <div class="col-md-12">
        <div class="panel panel-default">
        <div class="wrapper-lg">
            <h5 class="inline font-semibold text-orange m-n">Management Product</h5>
            <a id="export" href="<?=base_url('adm_kadooku/product/add');?>" class="pull-right btn m-t-n-sm font-semibold btn-success input-xl menu-sasaran" style="margin-right:5px"><span class="fa fa-plus"></span> <?=lang('add_product');?></a>
        </div>
            <div class="panel-body">
                <div style="overflow-x:auto;">
                <table class="table table-bordered" id="ProductTable">
                    <thead>
                        <tr class="bg-lighterGray">
                            <th>ID</th>
                            <th>Product</th>
                            <th>Product Price</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Product Price</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div> 
</div>