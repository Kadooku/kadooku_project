<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?=base_url('kadooku_assets/public/images/banner.jpg');?>);">
		<h2 class="l-text2 t-center">
			Checkout
		</h2>
	</section>

	<!-- BEGIN address -->
	<section class="bgwhite p-t-70 p-b-100">
		<div class="container">
			<div class="row">
				<div class="col-md-8 m-b-10 col-sm-12">
					<div class="bo9">
						<div class="col-md-12">
                            <h5 class="judul-box m-text15 p-b-20 p-t-20 p-l-10 p-r-10">
                                <?=lang('delivery_information');?>
                            </h5>
							<form action="">
							<div class="bo10 isi-box p-t-10">
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Alamat Email</label>
                                            <div class="bo4">
                                                <input type="text" class="form-control s-text11" id="exampleInputEmail1" placeholder="Masukan email Anda">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nama Lengkap</label>
                                            <div class="bo4">
                                                <input type="text" class="form-control s-text11" id="exampleInputEmail1" placeholder="Nama Lengkap">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nomor Telepon</label>
                                            <div class="bo4">
                                                <input type="text" class="form-control s-text11" id="exampleInputEmail1" placeholder="Masukan nomor telepon Anda">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">                                        
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <div class="bo4">
                                                <input type="text" class="form-control s-text11" id="exampleInputEmail1" placeholder="Masukan alamat Anda">
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
                            
                            <div class="flex-w flex-sb-m p-t-25 p-b-25">
                                <div class="size13 trans-0-2 m-b-10">
                                    &nbsp;
                                </div>

                                <div class="size13 trans-0-2 m-b-10">
                                    <button class="flex-c-m size9 bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                        <?=lang('save');?>
                                    </button>
                                </div>
                            </div>

							</form> 
						</div>
					</div>
				</div>
			<!-- end address -->

            <!-- payment -->
				<div class="col-md-4 col-sm-12">
					<div class="bo9">
						<h5 class="judul-box m-text15 p-b-20 p-t-20 p-l-10 p-r-10">
							<?=lang('order_summary');?>
						</h5>
						<form method="GET" action="payment.html">
						<div class="bo10 isi-box2">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="isi-box2">
                                        <span class="s-text18 w-size19 w-full-sm">
                                            Subtotal
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="isi-box2">
                                        <span class="m-text21 w-size20 w-full-sm text-right" id="subtotal-payment">
                                            <input type="hidden" id="subtotal-py" value="<?=$this->cart->total();?>">
                                            <?=rupiah($this->cart->total());?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="isi-box2">
                                        <span class="s-text18 w-size19 w-full-sm">
                                            <?=lang('shopping_cost');?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="isi-box2">
                                        <span class="m-text21 w-size20 w-full-sm" id="shipping-cost">
                                            <?=rupiah(0);?>
                                        </span>
                                    </div>
                                </div>
                            </div>

							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="isi-box2">
                                        <span class="s-text18 w-size19 w-full-sm">
                                            Total
                                        </span>
                                    </div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="isi-box2">
                                        <span class="m-text21 w-size20 w-full-sm" id="total-payment">
                                            <?=rupiah($this->cart->total());?>
                                        </span>
                                    </div>
								</div>
							</div>
						</div>
                        <div class="isi-box p-t-10 p-b-10">
                        
                            <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 p-b-10 p-t-10">
                                <?=lang('proceed_to_payment');?>
                            </button>
                        
                        </div>
					    </form>
					</div>
						
				</div>
            </div> <!-- row -->
        </div> <!-- container -->
	</section>