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
								<h5 class="m-text15">Account Settings</h5>
								<p class="s-text13">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, ad.</p>
							</div>
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
                        <form action="<?=base_url('user/update');?>" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Username</label>
									<div class="bo4">
										<input type="text" name="username" readonly class="form-control s-text11" id="exampleInputEmail1" value="<?=$user->username;?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Nama Lengkap</label>
									<div class="bo4">
										<input type="text" name="full_name" class="form-control s-text11" id="exampleInputEmail1" placeholder="Nama Lengkap" value="<?=$user->full_name;?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Email Address</label>
									<div class="bo4">
										<input type="text" readonly class="form-control s-text11" id="exampleInputEmail1" value="<?=$user->email;?>">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">No Telephone</label>
									<div class="bo4">
										<input type="text" name="phone" class="form-control s-text11" id="exampleInputEmail1" placeholder="No. Telepon" value="<?=$user->phone;?>">
									</div>
								</div>
							</div>
                        </div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Jenis Kelamin</label>
									<div>
										<label class="radio-inline"><input type="radio" name="gender" value="male" 
											<?=($user->gender) == "male" ? "checked" : "";?>> Laki - Laki</label>
										<label class="radio-inline"><input type="radio" name="gender" value="female" 
											<?=($user->gender) == "female" ? "checked" : "";?>> Perempuan</label>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Tanggal Lahir</label>
									<div class="bo4">
										<input type="text" name="birthday" class="form-control s-text11" id="datepicker" placeholder="Tanggal Lahir" value="<?=date('d F Y', strtotime($user->birthday));?>">
									</div>
								</div>
							</div>
                        </div>
                        <?php if(!$user->isSocialLogin) : ?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Current Password</label>
									<div class="bo4">
										<input type="password" name="current_password" class="form-control s-text11" id="exampleInputEmail1" placeholder="Masukan Password lama">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">New Password</label>
									<div class="bo4">
										<input type="password" name="new_password" class="form-control s-text11" id="exampleInputEmail1" placeholder="Masukkan Password Baru">
									</div>
								</div>
							</div>
                        </div>
                        <?php endif;?>

						<div class="flex-w flex-sb-m">
							<div class="size13 trans-0-2 m-b-10">
								Subscribe to Newsletter
								<label class="switch">
									<input name="enableNewsLetter" type="checkbox" <?=($user->enableNewsLetter) ? "checked" : "";?>>
									<span class="slider round"></span>
								</label>
							</div>

							<div class="size13 trans-0-2">
								<!-- Button -->
                                <button type="submit" class="flex-c-m sizefull bg4 bo-rad-23 hov1 s-text1 trans-0-4 p-l-10 p-r-10">
                                    Update Profile
                                </button>
							</div>
                        </div>
                        
                    </form>
					</div>
                </div>
			</div>
		</div> <!-- container -->
	</section>