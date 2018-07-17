
<div class="col-md-12">
<?php if($this->session->flashdata('code') == 1): ?>
    <!-- Menampilkan Pesan -->
    <div class="notif">
         <div class="alert alert-<?php echo $this->session->flashdata('alert'); ?>">
            <i class="fa fa-<?php echo $this->session->flashdata('icon'); ?> "></i> <strong><?php echo $this->session->flashdata('msg') ?> </strong>
         </div>  
    </div>     
<?php endif; ?>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="wrapper-lg">
            <h5 class="inline font-semibold text-orange m-n">MANAJEMEN KATEGORI</h5>
            <a id="export" href="<?=base_url('adm_kadooku/category/add');?>" class="pull-right btn m-t-n-sm font-semibold btn-success input-xl menu-sasaran" style="margin-right:5px"><span class="fa fa-plus"></span> Tambah Kategori</a>
        </div>
        
        <div class="panel-body width-seratus">
            <div style="overflow-x:auto;">
            <table id="category" class="table table-up table-striped b-t b-b">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th>Deskripsi</th>
                        <th>Slug Url</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?=$kategori;?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>