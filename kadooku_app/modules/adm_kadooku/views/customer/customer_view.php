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
            <h5 class="inline font-semibold text-orange m-n">Management Transaction</h5>
        </div>
            <div class="panel-body width-seratus">
                <div style="overflow-x:auto;">
                <table class="dataTable table table-up table-bordered b-t b-b" id="CustomerTable">
                    <thead>
                        <tr class="bg-lighterGray">
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div> 
</div>