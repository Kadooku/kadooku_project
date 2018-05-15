	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="<?=base_url('');?>" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="<?=base_url('product?category='.$result->category_url);?>" class="s-text16">
			<?=$result->category_name;?>
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			<?=$result->product_name;?>
		</span>
	</div>
	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>
					<?php $img = json_decode($result->product_image);?>
					<div class="slick3">
						<?php for($i=0; $i<3; $i++):?>
						<div class="item-slick3" data-thumb="<?=base_url("kadooku_uploads/product/img/{$img[$i]}");?>">
							<div class="wrap-pic-w">
								<img src="<?=base_url('kadooku_assets/public/');?>images/circle.gif" data-original="<?=base_url("kadooku_uploads/product/img/{$img[$i]}");?>" class='lazy' alt="IMG-PRODUCT">
							</div>
						</div>
						<?php endfor;?>
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					<?=$result->product_name;?>
				</h4>

				<span class="m-text17">
					<?php if(($result->discount != 0) && (date('Y-m-d') >= $result->start_discount) && (date('Y-m-d') <= $result->end_discount)):?>
							<?php $newprice = $result->product_price - (($result->discount/100) * $result->product_price);?>
							<span class="block2-oldprice m-text7 p-r-5">
								Rp. <?=number_format((int)$result->product_price, 0, ",", ".");?>
							</span>
							<span class="block2-newprice m-text8 p-r-5">
								<b>Rp. <?=number_format(($result->product_price - (($result->discount/100) * $result->product_price)),0,",",".");?></b>
							</span>
					<?php else: ?>
					<?php $newprice = $result->product_price;?>
						Rp. <?=number_format((int)$result->product_price, 0, ",", ".");?>
					<?php endif;?>
				</span>

				<!--  -->
				<div class="p-t-33 p-b-60">
					
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input id="quantity" class="size8 m-text18 t-center num-product" type="number" min="1" max="<?=$result->product_amount?>" name="num-product" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<button class="add_to_cart flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4"
									data-id="<?=$result->id?>" data-name="<?=$result->product_name?>" data-price="<?=$newprice?>">
									<?=lang('add_to_cart');?>
								</button>
							</div>
						</div>
					</div>
				</div>

				<div class="p-b-45">
					<span class="s-text8 m-r-35"><?=lang('seller');?>: <?=$result->product_seller;?></span>
					<span class="s-text8"><?=lang('categories');?>: <?=$result->category_name;?></span>
				</div>

				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						<?=lang('description');?>
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?=$result->product_description;?>
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						<?=lang('additional_information');?>
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?=$result->product_information;?>
						</p>
					</div>
				</div>

			</div>
		</div>
	</div>