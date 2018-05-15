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

    <?php echo form_open_multipart($action) ?>
        <div class="col-md-12">
            <div class="panel panel-default">
            <div class="wrapper-lg panel-heading"><h5 class="inline font-semibold text-orange m-n">Fitur Image</h5></div>
                <div class="panel-body">
                    <div class="row">
                    <?php for ($i=1; $i <=3 ; $i++) :?>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group text-center">
                                <div id="upload-<?=$i;?>">
                                    <div id="thumbnail-<?=$i;?>">
                                        <img class="img-responsive img-rounded img-thumbnail" width="180" height="240" src="<?php echo base_url('kadooku_uploads/product/img/'.$images[$i-1]);?>"/>
                                    </div>
                                </div>
                                <div class="input-group" style="margin-top:5px">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file">
                                        Browse
                                        <input type="file" id="upload-image-<?=$i;?>" name="featured_image<?php echo $i;?>" multiple="multiple">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endfor;?>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select id="category" name="category_id" class="form-control">
                            <option value="0">-- SELECT --</option>
                            <?php foreach ($categories as $c) :
                                $sub_menu = $this->ProductModel->get_categories(array('parent_id' => $c->id));
                                if($sub_menu->num_rows() > 0):?>
                                    <optgroup label='<?=$c->category_name;?>'>
                                        <?php foreach($sub_menu->result() as $sub):?>
                                            <option value='<?=$sub->id;?>' <?=($sub->id === $product->category_id) ? "selected" : "";?>><?=$sub->category_name;?></option>
                                        <?php endforeach;?>
                                    </optgroup>
                                <?php else: ?>
                                    <option value='<?=$c->id;?>' <?=($c->id === $product->category_id) ? "selected" : "";?>><?=$c->category_name;?></option>
                                <?php endif;?>
                            <?php endforeach;?> 
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Nama Product</label>
                        <input type="text" name="product_name" class="form-control" value="<?=$product->product_name;?>" placeholder="Nama Product">
                    </div>

                    <div class="form-group">
                        <label for="content">Deskripsi Product</label>
                        <textarea name="product_description" id="text-area" cols="30" rows="12" class="form-control" placeholder="Deskripsi Product"><?=$product->product_description;?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="content">Informasi Tambahan</label>
                        <textarea name="product_information" id="textarea" cols="30" rows="12" class="form-control" placeholder="Informasi Tambahan"><?=$product->product_information;?></textarea>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Harga Product</label>
                                <input type="number" name="product_price" min="0" class="form-control" value="<?=$product->product_price;?>" placeholder="Harga Product">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Jumlah Product</label>
                                <input type="number" name="product_amount" min="1" class="form-control" value="<?=$product->product_amount;?>" placeholder="Jumlah Product">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Estimasi Pembuatan</label>
                                <div class="input-group">
                                    <input type="number" name="arrival_date" min="1" class="form-control" value="<?=$product->arrival_date;?>" placeholder="Per Hari" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2">Hari</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Diskon Product</label>
                                <div class="input-group">
                                    <input type="number" name="discount" min="0" class="form-control" value="<?=($product->discount);?>" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2">%</span>
                                </div><br>
                                <label for="title">Start Discount</label>
                                <input type="date" name="start_discount" class="form-control" value="<?=$product->start_discount;?>" placeholder="Mulai Diskon"/><br>
                                <label for="title">End Discount</label>
                                <input type="date" name="end_discount" class="form-control" value="<?=$product->end_discount;?>" placeholder="Selesai Diskon"/>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control" name="tags" data-role="tagsinput" value="">
                        <br>
                        <i><sub>* Pisahkan menggunakan koma (,)</sub></i>
                    </div> -->
                    <input type="hidden" name="id" value="<?=$product->id;?>">
                    <button class="btn btn-success btn-block" type="submit"><?=lang('edit_product');?></button>
                </div>

            </div>
        </div>
    </form> 

</div>