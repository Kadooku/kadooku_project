<div class="col-md-12">
    <div class="panel panel-default">
    <div class="wrapper-lg">
        <h5 class="inline font-semibold text-orange m-n">Ubah Customer </h5>
    </div>
        <div class="panel-body width-seratus">
            <div class="row">
                <div class="col-md-2">
                    <img src="<?=$user->profile_picture == "default.jpg" ?
                         'https://www.gravatar.com/avatar/903cc7f2c047407fcd2628d33cfcda85' : 
                         ($user->social_login == 'facebook' ? 
                        "https://graph.facebook.com/{$user->oauth_uid}/picture?width=480&height=480" : 
                        $user->profile_picture);?>" alt="" class="img-responsive img-thumbnail">
                </div>
                <div class="col-md-10">
                    <table width="100%">
                        <tr>
                            <td width="15%">Nama Lengkap</td>
                            <td width="3%">:</td>
                            <td><?=$user->full_name;?></td>
                        </tr>
                        <tr>
                            <td width="15%">Username</td>
                            <td width="3%">:</td>
                            <td><?=$user->username;?></td>
                        </tr>
                        <tr>
                            <td width="15%">Alamat Email</td>
                            <td width="3%">:</td>
                            <td><?=$user->email;?></td>
                        </tr>
                        <tr>
                            <td width="15%">No. Telepon</td>
                            <td width="3%">:</td>
                            <td><?=$user->phone;?></td>
                        </tr>
                        <tr>
                            <td width="15%">Jenis Kelamin</td>
                            <td width="3%">:</td>
                            <td><?=$user->gender == "male" ? "Laki-laki" : ($user->gender == "female" ? "Perempuan" : "Lainnya");?></td>
                        </tr>
                        <tr>
                            <td width="15%">Tanggal Lahir</td>
                            <td width="3%">:</td>
                            <td><?=tanggalindo($user->birthday);?></td>
                        </tr>
                        <tr>
                            <td width="15%">Login Via</td>
                            <td width="3%">:</td>
                            <td><?=$user->social_login != null ? ucwords($user->social_login) : "Website";?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>