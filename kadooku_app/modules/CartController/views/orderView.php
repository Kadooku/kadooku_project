        <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?=base_url('kadooku_assets/public/images/banner.jpg');?>);">
		<h2 class="l-text2 t-center">
			Confirmation
		</h2>
	</section>

	<!-- Checkout -->
		<section class="bgwhite p-t-70 p-b-100">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-10 bo9">

							<div class="row">
								<div class="col-md-12 t-center">
									<?php if($product->status == "pending" || $product->status == "canceled") :?>
										<h5 class="judul-box">
											<img src="<?=base_url('kadooku_assets/public/images/icons/clock.png');?>" class="p-r-5">
                                            <?php if(strtotime(date('Y-m-d G:i:s')) < strtotime($product->time_late)) : ?>
                                                Waiting Payment
                                            <?php else : ?>
                                                Canceled
                                            <?php endif;?>
										</h5>
									<?php else: ?>
										<h5 class="judul-box" style="color: green">
											<img src="<?=base_url('kadooku_assets/public/images/icons/clock.png');?>" class="p-r-5">
                                            Payment Success
										</h5>
									<?php endif;?>
								<div class="col-md-12 t-center p-b-20 s-text18">
									Your order number : <?=$product->key;?>   <a href="<?=base_url('user/orders/detail/'.$product->key);?>" class="fs-15 p-l-5">  CHECK ORDER STATUS</a>
								</div>
								</div>
							</div>
							<div class="row justify-content-center">
							<div class="col-md-12">
								<div class="bo10">
								<?php if($product->status == "pending" || $product->status == "canceled") :?>
									<div class="s-text23 p-t-30 t-center">
										The payment code will end on :
									</div>
									<div class="p-t-10 p-b-10">
                                    <?php if(strtotime(date('Y-m-d G:i:s')) < strtotime($product->time_late)) : ?>
                                        <h1 id="countdown" data-time="<?php echo (strtotime($product->time_late) - strtotime(date('Y-m-d G:i:s')));?>" class="ordercount">&nbsp;</h1>
                                    <?php else : ?>
                                        <h1 class="ordercount">00:00:00</h1>
                                    <?php endif;?>
									</div>
									<div class="s-text24 p-b-50 t-center">
										Please complete payment before <?=tanggal_indo($product->time_late)?>.
									</div>
								<?php else : ?>
									<div class="s-text23 p-b-30 t-center">
										&nbsp;
									</div>
								<?php endif;?>
									
									<div class="row justify-content-center p-b-50">
										<div class="col-md-6 bo4 p-b-20 p-t-20">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <center><img class="img-thumbnail img-responsive" src="<?=base_url('kadooku_assets/public/images/bank/'.strtolower($product->payment_method).'.png');?>"/></center>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-6 t-left">
                                                                Paymentcode
                                                            </div>
                                                            <div class="col-md-6 t-right">
                                                                <?=$product->random_number;?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 t-left">
                                                                Total Price
                                                            </div>
                                                            <div class="col-md-6 t-right" style="color: #c00500;">
                                                                <?=rupiah($product->price_total);?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
										</div>
									</div>

									<div class="row justify-content-center">
										<div class="col-md-7">
											<div class="col-md-12 t-left p-b-10">
												Payment Guide
											</div>

											<div class="col-md-12 p-b-30">

												<div id="accordion" role="tablist">
												  <div class="card">
												    <div class="card-header" role="tab" id="headingOne">
												      <h5 class="mb-0">
												        <a class="collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
												          ATM
												        </a>
												      </h5>
												</div>
												<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
												      <div class="card-body">
													    <p>1. Masukkan kartu ATM & PIN</p>
														<p>2. Pilih ‘Transaksi Lainnya’</p>
														<p>3. Pilih ‘Transfer’</p>
														<p>4. Pilih ‘ke Rekening bank lain’</p>
														<p>5. Masukkan nomor Rekening <?=$payment->payment_number;?> a.n <?=$payment->holder_name;?></p>
														<p>6. Masukkan jumlah yang akan dibayarkan sesuai dengan tiga digit belakang, tidak boleh kurang dan lebih</p>
														<p>7. Validasi pembayaran Anda</p>
														<p>8. Pembayaran selesai</p>
												      </div>
												</div>
												</div>
												<div class="card">
												    <div class="card-header" role="tab" id="headingTwo">
												      <h5 class="mb-0">
												        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												          Internet Banking (App & Web)
												        </a>
												      </h5>
												</div>
												<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
												      <div class="card-body">
												        <p>1. Login pada aplikasi bank yang sesuai, masukkan user ID & PIN</p>
														<p>2. Pilih "Transfer Dana", kemudian pilih "Transfer ke Bank Lain"</p>
														<p>3. Masukkan no. Rekening <?=$payment->payment_number;?> a.n <?=$payment->holder_name;?> & klik "Lanjutkan"</p>
                                                        <p>4. Isi kolom "Berita" dengan nama Anda & klik "Lanjut"</p>
                                                        <p>5. Masukkan jumlah yang akan dibayarkan sesuai dengan tiga digit belakang, tidak boleh kurang dan lebih</p>
														<p>6. Pastikan data yang dimasukkan sudah benar, dan Input "Respon Key", lalu klik "Kirim"</p>
												      </div>
												</div>
												</div>
												<div class="card">
												    <div class="card-header" role="tab" id="headingThree">
												      <h5 class="mb-0">
												        <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
												          Mobile Banking
												        </a>
												      </h5>
												</div>
												<div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
												      <div class="card-body">
												        <p>1. Lakukan log in pada aplikasi mobile</p>
														<p>2. Pilih ‘m-Bank’ Masukkan kode akses m-Bank</p>
														<p>3. Pilih ‘m-Transfer’</p>
														<p>4. Pilih ‘Bank Lainnya’</p>
														<p>5. Masukkan nomor Rekening <?=$payment->payment_number;?> a.n <?=$payment->holder_name;?></p>
														<p>6. Masukan pin m-Bank</p>
														<p>7. Pembayaran selesai</p>
													   </div>
												</div>
												</div>
													<div class="card">
												    <div class="card-header" role="tab" id="headingFour">
												      <h5 class="mb-0">
												        <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
												          Bank Branch
												        </a>
												      </h5>
												</div>
												<div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
												      <div class="card-body">
												      <p>1. "Ambil formulir setoran, lalu isi formulir dengan data-data sebagai berikut:</p>
														<p>2. No.Rekening: <?=$payment->payment_number;?> a.n <?=$payment->holder_name;?></p>
														<p>3. Nama pemilik rekening: nama pengguna</p>
														<p>4. Berita: diisi dengan nama Anda Isi tanggal, pilih mata uang Rupiah, isi nilai nominal yang disetor</p>
														<p>5. Nama dan alamat penyetor diisi dengan data-data Anda</p>
														<p>6. Serahkan uang & Slip Setor Tunai ke counter bank</p>
														<p>7. Simpan salinan slip setoran tunai sebagai bukti pembayaran pesanan"</p>
													   </div>
												</div>
												</div>
												</div>
											
											</div>
										</div>
										
									</div>
									
							
								</div>	
									<form action="">
									<center>
									<div class="isi-box ">
										<button class="flex-c-m size9 bg1 bo-rad-23 hov1 s-text1 trans-0-4">
										BACK TO SHOP
										</button>
									</div>
									</center>
								</form>
							</div>
							</div>

					</div>
				</div><!-- row -->
			</div><!-- container -->
	    </section>