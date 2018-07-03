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
								<h5 class="m-text15">History Orders</h5>
								<p class="s-text13">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, ad.</p>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="overflow-x:auto;">
                                <table class="table" id="address-datatable">
                                    <thead>
                                        <tr class="s-text15">
                                            <th scope="col" width="5%">No</th>
                                            <th scope="col" width="30%">Order Number</th>
                                            <th scope="col" width="25%">Tanggal</th>
                                            <th scope="col" width="20%">Total</th>
                                            <th scope="col" width="10%">Status</th>
                                            <th scope="col" width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(count($orders) > 0):
                                        $stat  = array("pending", "canceled", "paid", "verified", "sent");
                                        $color = array("secondary", "danger", "warning", "info", "success");
                                        $i = 1;
                                    foreach($orders as $r):  
                                        $idx = array_search($r->status, $stat); ?>
                                        <tr data-id="<?=$r->id;?>">
                                            <td class="s-text15"><?=$i;?></td>
                                            <td><a href="<?=base_url("user/orders/detail/{$r->key}");?>" class="s-text15"><b><?=$r->key;?></b></a></td>
                                            <td class="s-text15"><?=tanggal_indo($r->order_time);?></td>
                                            <td class="s-text15"><?=rupiah($r->price_total);?></td>
                                            <td><span class="badge badge-pill badge-<?=$color[$idx];?>"><?=uc_words($r->status);?></span></td>
                                            <td>
                                                <a href="<?=base_url("user/orders/detail/{$r->key}");?>" class="btn btn-success btn-sm fgwhite">
                                                    <i class="fs-15 fa fa-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++; endforeach;
                                        endif;?>
                                    </tbody>
                                </table>
                            </div>
						</div>
                    </div>
                </div>
			</div>
		</div> <!-- container -->
	</section>
