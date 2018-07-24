<center>
    <img src='<?=base_url("kadooku_assets/public/images/circle.gif");?>' class='lazy rounded-circle'
    data-original="<?=(!$user->isSocialLogin) ? $sess['profile_picture'] : 
            ($user->social_login == 'facebook' ? 
            "https://graph.facebook.com/{$user->oauth_uid}/picture?width=480&height=480" : 
            $user->profile_picture);?>" width="200" height="200">
    <h4 class="m-text14 p-b-7">
        <?=$user->full_name;?>
    </h4>
</center>

<nav class="list-group">
    <a href="<?=base_url('user');?>" class="list-group-item list-group-item-action <?=empty($this->uri->segment(2)) ? "active" : "";?>">
        <i class="fa fa-id-card-o"></i> Profile        
    </a>
    <a href="<?=base_url('user/orders');?>" class="list-group-item list-group-item-action <?=$this->uri->segment(2) == 'orders' ? "active" : "";?>">
        <i class="fa fa-shopping-bag"></i> Orders
    </a>
    <a href="<?=base_url('user/address');?>" class="list-group-item list-group-item-action <?=$this->uri->segment(2) == 'address' ? "active" : "";?>">
        <i class="fa fa-home"></i> Addresses
    </a>
    <a href="<?=$sess['isSocialLogin'] ? base_url('social_login/logout') : base_url('user/logout');?>" class="list-group-item list-group-item-action">
        <i class="fa fa-sign-out"></i>Logout
    </a>
</nav>