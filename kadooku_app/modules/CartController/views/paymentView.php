    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?=base_url('kadooku_assets/public/images/banner.jpg');?>);">
		<h2 class="l-text2 t-center">
			Payment Method
		</h2>
	</section>

	<!-- Checkout -->
	<section class="bgwhite p-t-70 p-b-100">
			<div class="container">
                <form method="POST" action="">
				<div class="row">
					<div class="col-md-7 bo9">
						<div class="row">
							<div class="col-md-12">
								<h5 class="judul-box">
									Payment Method
								</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
									<div class="row payment-method isi-box">
                                    <?php foreach($payments as $p) : ?>
										<div class="col-lg-6 col-md-6 col-sm-12">
											<label for="<?=$p->payment_name;?>" class="method">
												<div class="card-logos">
													<img src="<?=base_url('kadooku_assets/public/images/bank/'.strtolower($p->payment_name).'.png');?>"/>
												</div>
												<div class="radio-input">
													<input id="<?=$p->payment_name;?>" type="radio" name="payment_method" value="<?=$p->id;?>">
													Pay with <?=$p->payment_name;?>
												</div>
											</label>
										</div>
                                    <?php endforeach;?>
                                    </div>
								</form>
							</div>
						</div>
					</div>

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
                </div><!-- row -->
                </form>
			</div><!-- container -->
	</section>