<h5 class="judul-box m-text15 p-b-20 p-t-20 p-l-10 p-r-10">
    <?=lang('order_summary');?>
</h5>
<div class="bo10 isi-box2">
    <table>
        <?php foreach($products as $item): ?>
        <tr>
            <td width="10%"><span class="badge badge-primary"><?=$item['qty'];?></span></td>
            <td width="60%"><?=$item['name'];?></td>
            <td width="40%" style="text-align:right;position:relative"><?=rupiah($item['subtotal']);?></td>
        </tr>
        <?php endforeach;?>
    </table>
    
    
</div>

<div class="bo10 isi-box2">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="isi-box2">
                <span class="s-text18 w-size19 w-full-sm">
                    Subtotal
                </span>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="isi-box2">
                <span class="m-text21 w-size20 w-full-sm text-right" id="subtotal-payment">
                    <input type="hidden" id="subtotal-py" value="<?=$this->cart->total();?>">
                    <?=rupiah($this->cart->total());?>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="isi-box2">
                <span class="s-text18 w-size19 w-full-sm">
                    <?=lang('shopping_cost');?>
                </span>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="isi-box2">
                <span class="m-text21 w-size20 w-full-sm" id="shipping-cost">
                    <?=rupiah(0);?>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="isi-box2">
                <span class="s-text18 w-size19 w-full-sm">
                    Total
                </span>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="isi-box2">
                <span class="m-text21 w-size20 w-full-sm" id="total-payment">
                    <?=rupiah($this->cart->total());?>                                            
                </span>
            </div>
        </div>
    </div>
</div>