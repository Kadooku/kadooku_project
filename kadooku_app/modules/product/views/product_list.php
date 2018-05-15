    <!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(<?=base_url('kadooku_assets/public/images/banner.jpg');?>);">
		<h2 class="l-text2 t-center">
			Product
		</h2>
		<p class="m-text13 t-center">
			List Product
		</p>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<div class="search-product pos-relative bo4 of-hidden">
							<form action="" method="GET">
								<?php if(!empty($this->input->get('category'))) : ?>
									<input type="hidden" name="category" value="<?=$this->input->get('category');?>">
								<?php endif;?>
								<?php if(!empty($this->input->get('sort'))) : ?>
									<input type="hidden" name="sort" value="<?=$this->input->get('sort');?>">
								<?php endif;?>
								<?php if(!empty($this->input->get('minPrice'))) : ?>
									<input type="hidden" name="minPrice" value="<?=$this->input->get('minPrice');?>">
								<?php endif;?>
								<?php if(!empty($this->input->get('maxPrice'))) : ?>
									<input type="hidden" name="maxPrice" value="<?=$this->input->get('maxPrice');?>">
								<?php endif;?>
								<input class="s-text7 size1 p-l-23 p-r-50" type="text" name="q" 
										value="<?=empty($this->input->get('q')) ? '' : $this->input->get('q');?>" 
										placeholder="Search Products...">

								<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
									<i class="fs-12 fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
                        </div>

						<!-- List Category -->
						<br>
						<h4 class="m-text14 p-b-7" style="border-bottom:1px dotted #eee">
							<?=lang('categories');?>
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="<?=base_url('product');?>" class="s-text13">
									Semua
								</a>
							</li>
						<?php foreach($categories as $c): ?>
							<?php if($c->parent_id == 0) :?>
							<li class="p-t-4">
								<b><?=$c->category_name;?></b>
							</li>
							<?php else :?>
							<li class="p-l-15 p-t-4">
								<?=($this->input->get('category') == $c->category_url) ? 
									$c->category_name : '<a href="'.base_url('product?category='.$c->category_url).'">'.$c->category_name.'</a>';?>
							</li>
							<?php endif;?>
						<?php endforeach;?>
						</ul>

						<!-- Filter -->
						<span class="s-text13"><b>Filter Harga</b></span>						
						<form action="" method="GET">
							<div class="row">
								<?php if(!empty($this->input->get('category'))) : ?>
									<input type="hidden" name="category" value="<?=$this->input->get('category');?>">
								<?php endif;?>
								<?php if(!empty($this->input->get('sort'))) : ?>
									<input type="hidden" name="sort" value="<?=$this->input->get('sort');?>">
								<?php endif;?>
								<?php if(!empty($this->input->get('q'))) : ?>
									<input type="hidden" name="q" value="<?=$this->input->get('q');?>">
								<?php endif;?>
								<div class="col-md-6">
									<div class="bo4 of-hidden">
										<input type="text" name="minPrice" class="s-text7 size1 p-l-10 p-r-10"
												value="<?=empty($this->input->get('minPrice')) ? '' : $this->input->get('minPrice');?>" 
												placeholder="RP MIN">
									</div>
								</div>
								<div class="col-md-6">
									<div class="bo4 of-hidden">
										<input type="text" name="maxPrice" class="s-text7 size1 p-l-10 p-r-10" 
												value="<?=empty($this->input->get('maxPrice')) ? '' : $this->input->get('maxPrice');?>"
												placeholder="RP MAX">
									</div>
								</div>
								<div class="col-md-12">
									<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 m-t-10">
										Terapkan
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 s-text7 m-t-5 m-b-5 m-r-10">
								<select class="selection-2 size1 p-l-23 p-r-50" name="sorting">
									<option>Urutkan</option>
									<option value="ASC" 
										<?=($this->input->get('sort') == 'ASC') ? 'selected' : ''?>>
										Harga: Rendah ke Tinggi</option>
									<option value="DESC"
										<?=($this->input->get('sort') == 'DESC') ? 'selected' : ''?>
										>Harga: Tinggi ke Rendah</option>
								</select>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div id="prod_list">
					<div class="row" id="list-product">
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
									<img src="<?=base_url('kadooku_assets/public/');?>images/item-02.jpg" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
												Add to Cart
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="product-detail.html" class="block2-name dis-block s-text3 p-b-5">
										Herschel supply co 25l
									</a>

									<span class="block2-price m-text6 p-r-5">
										$75.00
									</span>
								</div>
							</div>
						</div>
					</div>
					</div>

					<!-- Pagination -->
					<div class="ajax-load text-center" style="display:none">
						<img src="<?=base_url('kadooku_assets/public/images/circle.gif');?>">
						<p class="m-text2">Memuat</p>
					</div>
					<!-- <div class="pagination flex-m flex-w p-t-26" id="pagination-product"></div> -->
				</div>
			</div>
		</div>
	</section>