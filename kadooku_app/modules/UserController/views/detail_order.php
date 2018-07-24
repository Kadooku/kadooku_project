<!-- BEGIN Profile -->
<section class="bgwhite p-t-70 p-b-100">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-b-25">
					<div class="bo5 p-r-20 p-l-20 p-t-20 p-b-20">
                        <?=$this->load->view('sidebar');?>
						
					</div>
                </div>
                
				<div class="col-md-8">
					<div class="bo5 p-r-20 p-l-20 p-t-20 p-b-20">
						<div class="row">
							<div class="col-md-12 p-b-25">
								<span class="m-text15">INVOICE - <?=$orders[0]->key;?></span>
								<?php if($orders[0]->status == "pending") :?>
									<button type="button" data-key="<?=$orders[0]->key;?>" class="pull-right btn-xs btn btn-info m-b-15" id="button-confirm"><i class="fa fa-check"></i>  Konfirmasi Pembayaran</button>
								<?php endif;?>

								<?php if($orders[0]->status == "paid") :?>
									<span class="s-text8 pull-right" style="color: red;">Menunggu Konfirmasi selama 1x24 jam hari kerja</span>
								<?php endif;?>

								<?php if($orders[0]->status == "canceled") :?>
									<span class="s-text8 pull-right" style="color: red;">Pesanan telah dibatalkan</span>
								<?php endif;?>

								<?php if($orders[0]->status == "verified") :?>
									<span class="s-text8 pull-right" style="color: green;">Pesanan sedang dipersiapkan</span>
								<?php endif;?>

								<?php if($orders[0]->status == "sent") :?>
									<span class="s-text8 pull-right" style="color: green;">Pesanan telah dikirimkan</span>
								<?php endif;?>
							</div>
						</div>
						<div class="row"></div>
							<div class="col-md-12">
							<div class="form-bootstrapWizard p-b-35">
								<ul class="bootstrapWizard form-wizard">
									<li class="active" data-target="#step1">
										<a href="#tab1" data-toggle="tab" class="active"> <span class="step">1</span> <span class="title">Pesanan Diterima</span> </a>
									</li>
									<?php if($orders[0]->status != "canceled") : ?>
									<li data-target="#step2" class="<?=$orders[0]->status == 'paid' || $orders[0]->status == 'verified' || $orders[0]->status == 'sent' ? 'active' : '';?>">
										<a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Pesanan Telah Dibayar</span> </a>
									</li>
									<li data-target="#step3" class="<?=$orders[0]->status == 'verified' || $orders[0]->status == 'sent' ? 'active' : '';?>">
										<a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Pesanan Dikonfirmasi</span> </a>
									</li>
									<li data-target="#step4" class="<?=$orders[0]->status == 'sent' ? 'active' : '';?>">
										<a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Pesanan dikirim</span> </a>
									</li>
									<?php else :?>
									<li data-target="#step2" class="<?=$orders[0]->status == 'canceled' ? 'active' : '';?>">
										<a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Pesanan Telah Dibatalkan</span> </a>
									</li>
									<?php endif;?>
								</ul>
								<div class="clearfix"></div>
							</div>

							<div id="form-confirm" class="p-b-10">
								
							</div>
							
							<?php $stat  = array("pending", "canceled", "paid", "verified", "sent");
								  $color = array("secondary", "danger", "warning", "info", "success"); 
								  $idx = array_search($orders[0]->status, $stat); ?>
								<table class="table s-text10">
									<tr>
										<th>Tanggal Order</th>
										<td><?=tanggal_indo($orders[0]->order_time);?></td>
									</tr>
									<tr>
										<th>Status</th>
										<td><span class="badge badge-pill badge-<?=$color[$idx];?>"><?=uc_words($orders[0]->status);?></span></td>
									</tr>
									<tr>
										<th>Payment Method</th>
										<td><?=$payment->payment_name;?></td>
									</tr>
									<?php if(!empty($orders[0]->tracking_number)) :?>
									<tr>
										<th>Nomor Resi</th>
										<td><a target="_blank" href="https://cekresi.com/cek-jne-express-logistic.php?noresi=<?=$orders[0]->tracking_number;?>">
												<?=$orders[0]->tracking_number;?></a>
										</td>
									</tr>
									<?php endif;?>
								</table>
							</div>

							<div class="col-md-8 p-b-10">
								<p>Dikirim ke :</p>
								<p><b><?=$address[0]->name;?></b></p>
								<p><?=uc_words($address[0]->address).", ".uc_words($address[0]->village).",</p>
								<p>".uc_words($address[0]->district).", ".uc_words($address[0]->regency).", ".uc_words($address[0]->province);?></p>
								<p><?=$address[0]->phone;?></p>
							</div>
							<div class="col-md-4">&nbsp;</div>

							<div class="col-md-12">
								<table class="table" id="address-datatable">
									<thead>
										<tr class="s-text15">
											<th width="5%">No</th>
											<th>Product</th>
											<th>Quantity</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
                                        <?php $selisih = 0; $i=1; foreach($orders as $order) : ?>
										<tr>
											<td><?=$i;?></td>
											<td><?=$order->product_name;?></td>
											<td><?=$order->qty;?></td>
											<td><?=rupiah($order->subtotal);?></td>
                                        </tr>
                                        <?php $selisih += $order->subtotal; $i++; endforeach;?>
									</tbody>
									<tfoot>
										<tr class="s-text15">
											<td></td>
											<td></td>
											<th>Ongkir ke <?=uc_words($address[0]->village);?></th>
											<th><?=rupiah($order->price_total - $selisih - $orders[0]->random_number);?></th>
										</tr>
										<tr class="s-text15">
											<td></td>
											<td></td>
											<th>Random Number</th>
											<th><?=rupiah($orders[0]->random_number);?></th>
										</tr>
										<tr class="s-text15">
											<td></td>
											<td></td>
											<th>Grand Total</th>
											<th><?=rupiah($order->price_total);?></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- container -->
	</section>