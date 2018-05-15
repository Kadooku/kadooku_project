<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(<?=base_url('kadooku_assets/public/images/banner.jpg');?>);">
		<h2 class="l-text2 t-center">
			<?=$title;?>
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
            <?php if($this->cart->total_items() > 0) : ?>
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							<th class="column-4">Quantity</th>
							<th class="column-5">Subtotal</th>
							<th class="column-6"></th>
                        </tr>
                        <?php foreach($products as $item): ?>
                        <tr class="table-row" data-id="<?=$item['rowid'];?>">
                            <?php $getItem = $this->Cart_model->getProductItem($item['id']);?>
							<td class="column-1">
                                <a href="<?=base_url('product_detail/'.$getItem['slug']);?>">
                                    <div class="cart-img-product b-rad-4 o-f-hidden">
                                        <img src="<?=base_url('kadooku_uploads/product/img/'.$getItem['image'][0]);?>" alt="IMG-PRODUCT">
                                    </div>
                                </a>
							</td>
							<td class="column-2"><a href="<?=base_url('product_detail/'.$getItem['slug']);?>"><?=$item['name'];?></a></td>
							<td class="column-3"><?=rupiah($item['price']);?></td>
							<td class="column-4">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" id="count-product" data-id="<?=$item['rowid'];?>">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center num-product" type="number" readonly name="num-product2" id="numproduct-<?=$item['rowid'];?>" value="<?=$item['qty'];?>">

									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" id="count-product" data-id="<?=$item['rowid'];?>">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
                            <td class="column-5"><span id="sub-total-<?=$item['rowid'];?>"><?=rupiah($item['subtotal']);?></span></td>
                            <td class"column-6">
                                <button class="bg0 bo-rad-23 hov5 s-text1 trans-0-4 p-l-5 p-r-5 p-b-5 p-t-5" id="hapus-cart" data-id="<?=$item['rowid'];?>" data-name="<?=$item['name'];?>">
                                    <i class="fs-15 fa fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        <?php endforeach;?>
					</table>
				</div>
			</div>

			<!-- <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					&nbsp;
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Update Cart
					</button>
				</div>
            </div> -->
            
            <div class="flex-w flex-sb-m p-t-15 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 m-r-5">
                        <span class="s-text18 w-size19 w-full-sm">
                            &nbsp;
                        </span>
					</div>
				</div>

				<div class="size13 trans-0-2">
					<span class="s-text18 w-size19 w-full-sm">
						Total : &nbsp;
					</span>

					<span class="m-text21 w-size20 w-full-sm" id="total-cart">
						<?=rupiah($total);?>
					</span>
                </div>
            </div>

			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="size13 trans-0-2 m-b-10">
					<!-- Button -->
					<a href="<?=base_url('product');?>">
						<button class="flex-c-m sizefull bg0 bo-rad-23 hov1 s-text1 trans-0-4 p-l-10 p-r-10">
							<?=lang('continue_shopping');?>
						</button>
					</a>
                </div>

				<div class="size13 trans-0-2 m-b-10">
					<!-- Button -->
					<a href="<?=base_url('cart/checkout');?>">
						<button class="flex-c-m sizefull bg4 bo-rad-23 hov1 s-text1 trans-0-4 p-l-10 p-r-10">
							<?=lang('proceed_to_checkout');?>
						</button>
					</a>
                </div>
            </div>
            <?php else:?>
            <div class="wrap-alert bo4">
                <div class="alert alert-info p-b-10 p-t-10 p-l-10 p-r-10" role="alert">
                    Belum ada item yang dibeli
				</div>
				<div class="flex-w flex-sb-m p-t-25 p-b-25 p-l-35 p-r-60 p-lr-15-sm">
					<div class="size13 trans-0-2 m-b-10">
						<!-- Button -->
						<a href="<?=base_url('product');?>">
							<button class="flex-c-m sizefull bg0 bo-rad-23 hov1 s-text1 trans-0-4 p-l-10 p-r-10">
								<?=lang('continue_shopping');?>
							</button>
						</a>
					</div>
				</div>
			</div>
            <?php endif;?>
		</div>
    </section>