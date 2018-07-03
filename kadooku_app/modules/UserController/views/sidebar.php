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