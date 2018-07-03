<!-- BEGIN Profile -->
<section class="bgwhite p-t-70 p-b-100">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-b-25">
					<div class="bo5 p-r-20 p-l-20 p-t-20 p-b-20">
						<center>
                            <img src="<?=(!$user->isSocialLogin) ? $sess['profile_picture'] : 
                                    ($user->social_login == 'facebook' ? 
                                    "https://graph.facebook.com/{$user->oauth_uid}/picture?width=480&height=480" : 
                                    $user->profile_picture);?>" width="200" height="200" class="rounded-circle">
							<h4 class="m-text14 p-b-7">
								<?=$user->full_name;?>
							</h4>
						</center>

                        <?=$this->load->view('sidebar');?>
						
					</div>
                </div>
                
				<div class="col-md-8">
					<div class="bo5 p-r-20 p-l-20 p-t-20 p-b-20">
						<div class="row">
							<div class="col-md-12 p-b-25">
								<h5 class="m-text15">Product</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<table class="table" id="address-datatable">
									<thead>
										<tr class="s-text15">
											<th>Product</th>
											<th>Quantity</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
                                        <?php foreach($orders as $order) : ?>
										<tr>
											<td><?=$order->product_name;?></td>
											<td><?=$order->qty;?></td>
											<td><?=rupiah($order->subtotal);?></td>
                                        </tr>
                                        <?php endforeach;?>
									</tbody>
									<tfoot>
										<tr>
											<th colspan="2">Total + Ongkir </th>
											<th><?=rupiah($order->price_total);?></th>
										</tr>
									</tfoot>
								</table>
							</div>

							<div class="col-md-12">
								<h6 class="s-text12">Order Detail - KADOKU20180605129384</h6>
								<table class="table table-bordered" id="address-datatable">
									<tbody>
										<tr>
											<th>Tanggal Order</th>
											<td><?=tanggal_indo($orders[0]->order_time);?></td>
										</tr>
										<tr>
											<th>Status</th>
											<td><?=uc_words($orders[0]->status);?></td>
										</tr>
										<tr>
											<th>Payment Method</th>
											<td><?=$payment->payment_name;?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-12">
								<h6 class="s-text12">Detail Pembeli</h6>
								<table class="table table-bordered" id="address-datatable">
									<tbody>
										<tr>
											<th>Penerima</th>
											<td><?=$address[0]->name;?></td>
										</tr>
										<tr>
											<th>Alamat</th>
											<td><?=uc_words($address[0]->address).", ".uc_words($address[0]->village).", ".uc_words($address[0]->district).", ".uc_words($address[0]->regency).", ".uc_words($address[0]->province);?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- container -->
	</section>