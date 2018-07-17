<?=$this->load->view('public/layout/slider');?>

<!--  -->

<!-- Our product -->
<section class="bgwhite p-t-45 p-b-58">
	<div class="container">
		<div class="sec-title p-b-22">
			<div class="m-text5 t-center">
				<?=lang('our_product');?>
			</div>
		</div>

		<!-- Tab01 -->
		<div class="tab01">
			
			<!-- Tab panes -->
			<div class="tab-content p-t-35">
				<!-- - -->
				<div class="tab-pane fade show active" role="tabpanel">
					<div class="row" id="list-product">
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="<?=base_url('kadooku_assets/public/');?>images/item-02.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										
										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												<?=lang('add_to_cart');?>
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="<?=base_url('kadooku_assets/public/');?>" class="block2-name dis-block s-text3 p-b-5">
										Lorem ipsum dolor sit amet.
									</a>

									<span class="block2-price m-text6 p-r-5">
										Rp. 0
									</span>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<center>
			<div class="m-text2" id="btn-more"><a class="size1 bg4 bo-rad-23 hov5 s-text1 trans-0-4 p-l-10 p-r-10 p-t-10 p-b-10" href="<?=base_url('product');?>">Lihat Produk Lainnya</a></div>
		</center>

	</div>
</section>
