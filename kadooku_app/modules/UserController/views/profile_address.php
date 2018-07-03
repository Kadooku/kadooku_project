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
                        <button type="button" class="btn btn-primary m-b-15" id="add-address"><i class="fa fa-plus"></i>  Tambah Alamat Baru</button>
						
                        <div class="row">
                            <div class="col-md-12" style="overflow-x:auto;">
                                <table class="table" id="address-datatable">
                                    <thead>
                                        <tr class="s-text15">
                                            <th scope="col" width="20%">Penerima</th>
                                            <th scope="col" width="40%">Alamat</th>
                                            <th scope="col" width="15%">No. Telepon</th>
                                            <th scope="col" width="10%"></th>
                                            <th scope="col" width="15%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $temp_id = ""; 
                                    if(count($address) > 0):
                                    foreach($address as $r): 
                                        $temp_id .= ($r->status == 1) ? "<input type='hidden' id='temp_id' value='{$r->id}'>" : ""; 
                                        $geo = "{$r->name} [".uc_words($r->address).", ".uc_words($r->village).", ".uc_words($r->district).", ".uc_words($r->regency).", ".uc_words($r->province)."]"; ?>
                                        <tr data-id="<?=$r->id;?>">
                                            <td class="s-text15" data-id="name-<?=$r->id;?>"><?=ucwords($r->name);?> <?=$r->status == 1 ? '<span id="badges" class="badge badge-pill badge-success">Utama</span>' : '';?></td>
                                            <td>
                                                <p class="s-text15"><?=uc_words($r->address);?></p>
                                                <p class="s-text15"><?=uc_words($r->village);?> - <?=uc_words($r->district);?></p>
                                                <p class="s-text15"><?=uc_words($r->regency);?> - <?=uc_words($r->province);?></p>
                                            </td>
                                            <td class="s-text15"><?=$r->phone;?></td>
                                            <td>
                                                <button type="button" id="set" class="btn btn-outline-secondary s-text15 btn-sm"
                                                    data-user="<?=$r->user_id;?>" data-geo="<?=$geo;?>" <?=$r->status == 2 ? '' : "disabled" ;?> data-rowid="<?=$r->id;?>">Set Utama</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-success btn-sm" id="edit-address" 
                                                    data-id="<?=$r->id;?>" 
                                                    data-user="<?=$r->user_id;?>">
                                                    <i class="fs-15 fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" id="delete-address"
                                                    data-id="<?=$r->id;?>"
                                                    data-user="<?=$r->user_id;?>"
                                                    data-geo="<?=$geo;?>">
                                                    <i class="fs-15 fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach;
                                        endif;?>
                                    </tbody>
                                    <?=$temp_id;?>
                                </table>
                            </div>
						</div>
                    </div>
                </div>
			</div>
		</div> <!-- container -->
	</section>

    <!-- MODAL ADD NEW ADDRESS -->
    <div class="modal fade bd-address-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-l-20 p-r-20 p-b-20">
                <div class="row m-t-20">
                    <div class="col-md-12"><h5 class="m-text15">Add new address</h5></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php if(!empty(validation_errors())):?>
                        <div class="wrap-alert notif">
                            <div class="alert alert-danger" role="alert">
                            <?php echo validation_errors();?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <form id="form-address" action="<?=base_url('user/address/add');?>" method="post">
                <div class="row m-t-20">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <div class="bo4">
                                <input type="text" name="name" class="form-control s-text11" id="inputName" placeholder="Nama Lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nomor Telepon</label>
                            <div class="bo4">
                                <input type="text" name="phone" class="form-control s-text11" id="inputPhone" placeholder="Masukan nomor telepon Anda">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">                                        
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <div class="bo4">
                                <input type="text" name="address" class="form-control s-text11" id="inputAddress" placeholder="Masukan alamat Anda">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Provinsi</label>
                            <div class="form-control bo4 m-r-5">
                                <select name="province_id" id="provinces" class="selection-address">
                                    <option value="0">Silahkan pilih provinsi anda</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Kota</label>
                            <div class="form-control bo4 m-r-5">
                                <select name="regency_id" id="regencies" class="selection-address">
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
                                <select name="district_id" id="districts" class="selection-address">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Kelurahan</label>
                            <div class="form-control bo4 m-r-5">
                                <select name="village_id" id="villages" class="selection-address">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-w flex-sb-m m-t-20">
                    <div class="size13 trans-0-2">
                        <!-- Button -->
                        <input type="hidden" name="user_id" value="<?=$user->id;?>">
                        <button type="submit" class="flex-c-m sizefull bg4 bo-rad-23 hov1 s-text1 trans-0-4 p-l-10 p-r-10">
                            <i class="fa fa-save"></i> &nbsp;<?=lang('save');?>
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>