<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?=base_url('kadooku_assets/public/images/banner.jpg');?>);">
		<h2 class="l-text2 t-center">
			Checkout
		</h2>
	</section>

	<!-- BEGIN address -->
	<section class="bgwhite p-t-70 p-b-100">
        <form action="" method="post">
        <input type="hidden" id="totalpayment" name="totalpayment" value="<?=$this->cart->total();?>">  
		<div class="container">
			<div class="row">
				<div class="col-md-7 m-b-10 col-sm-12">
					<div class="bo9">
						<div class="col-md-12">
                            <h5 class="judul-box m-text15 p-b-20 p-t-20 p-l-10 p-r-10">
                                <?=lang('delivery_information');?>
                            </h5>
                            <?php if($sess['login_status']) : ?>
                            <input type="radio" id="old_address" name="address" value="old" <?=(count($address) > 0) ? "checked" : "";?>> 
                            <label for="old_address"> Gunakan Alamat yang ada</label>
                            <div class="bo10 isi-box p-t-10" id="old-address">
                            <?php if(count($address) > 0):?>
                                <select name="address_id" id="address_id" class="selection-3">
                                    <?php foreach($address as $add) : 
                                        $geo = "<b>{$add->name} {$add->phone}</b> [".uc_words($add->address).", ".uc_words($add->village).", ".uc_words($add->district).", ".uc_words($add->regency).", ".uc_words($add->province)."]";?>
                                        <option value="<?=$add->id;?>" <?=($add->status == 1) ? "selected" : "";?>><?=$geo;?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php else:?>
                                <div class="alert alert-warning">Belum ada alamat tersimpan</div>
                            <?php endif;?>
                            </div>
                            <br>
                            <input type="radio" id="new_address" name="address" value="new" <?=(count($address) == 0) ? "checked" : "";?>> 
                            <label for="new_address"> Gunakan alamat baru</label>
                            <?php endif;?>
							<div class="bo10 isi-box p-t-10" <?=$sess['login_status'] ? 'id="new-address"' : '';?>>
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Alamat Email</label>
                                            <div class="bo4">
                                                <input type="text" class="form-control s-text11" id="email" name="email" placeholder="Masukan email Anda">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama Lengkap</label>
                                            <div class="bo4">
                                                <input type="text" class="form-control s-text11" id="name" name="name" placeholder="Nama Lengkap">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Nomor Telepon</label>
                                            <div class="bo4">
                                                <input type="text" class="form-control s-text11" id="phone" name="phone" placeholder="Masukan nomor telepon Anda">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                        
                                        <div class="form-group">
                                            <label for="fulladdress">Alamat</label>
                                            <div class="bo4">
                                                <input type="text" class="form-control s-text11" id="fulladdress" name="fulladdress" placeholder="Masukan alamat Anda">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Provinsi</label>
                                            <div class="form-control bo4 m-r-5">
                                                <select name="province_id" id="provinces" class="selection-1">
                                                    <option value="0">Silahkan pilih provinsi anda</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Kota</label>
                                            <div class="form-control bo4 m-r-5">
                                                <select name="regency_id" id="regencies" class="selection-1">
                                                    <option value="0">Silahkan pilih kota/kabupaten anda</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Kecamatan</label>
                                            <div class="form-control bo4 m-r-5">
                                                <select name="district_id" id="districts" class="selection-1">
                                                    <option value="0">Silahkan pilih kecamatan anda</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Kelurahan</label>
                                            <div class="form-control bo4 m-r-5">
                                                <select name="village_id" id="villages" class="selection-1">
                                                    <option value="0">Silahkan pilih kelurahan/desa anda</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Kurir</label>
                                            <div class="form-control bo4 m-r-5">
                                                <select name="logistic_id" id="logistics" class="selection-1">
                                                    <option value="0">Silahkan pilih kurir anda</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
							</div>
                            
                            <!-- <div class="flex-w flex-sb-m p-t-25 p-b-25">
                                <div class="size13 trans-0-2 m-b-10">
                                    &nbsp;
                                </div>

                                <div class="size13 trans-0-2 m-b-10">
                                    <button class="flex-c-m size9 bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                        <?=lang('save');?>
                                    </button>
                                </div>
                            </div> -->
						</div>
					</div>
				</div>
			<!-- end address -->

            <!-- payment -->
				<div class="col-md-5 col-sm-12">
					<div class="bo9">
                        <?=$this->load->view('payment_layout');?>
                        <div class="isi-box p-t-10 p-b-10">
                            <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 p-b-10 p-t-10">
                                <?=lang('proceed_to_payment');?>
                            </button>
                        
                        </div>
					</div>
						
				</div>
            </div> <!-- row -->
        </div> <!-- container -->
        </form>
	</section>