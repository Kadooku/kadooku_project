<style>
    .borderless tr {
        border-top-style: none;
        border-left-style: none;
        border-right-style: none;
        border-bottom-style: none;
    }
</style>
<div class="col-md-12">
    <div class="panel panel-default">
    <div class="wrapper-lg">
        <h5 class="inline font-semibold text-orange m-n">INVOICE - <?=$transaction[0]->key;?></h5>
        <h6 class="font-semibold">Tanggal Pemesanan : <?=tanggal_indo($transaction[0]->order_time);?></h6>
        <h6 class="font-semibold">Payment Method : <?=$payment->payment_name;?></h6>
    </div>
        <div class="panel-body width-seratus">
            <div class="row">
                <div class="col-md-6">
                    <table width="100%">
                        <tr>
                            <td width="15%">Nama</td>
                            <td width="3%">:</td>
                            <td width="82%" class="font-semibold"><?=$transaction[0]->full_name;?></td>
                        </tr>
                        <tr>
                            <td width="15%">Alamat</td>
                            <td width="3%">:</td>
                            <td width="82%"><?=uc_words($address[0]->address).", ".uc_words($address[0]->village).", ".uc_words($address[0]->district).", ".uc_words($address[0]->regency).", ".uc_words($address[0]->province);?>.</td>
                        </tr>
                        <tr>
                            <td width="15%">Telp</td>
                            <td width="3%">:</td>
                            <td width="82%"><?=$address[0]->phone;?></td>
                        </tr>
                        <?php if(!is_null($transaction[0]->tracking_number)) : ?>
                        <tr>
                            <td width="15%">Tracking Number</td>
                            <td width="3%">:</td>
                            <td width="82%"><?=$transaction[0]->tracking_number;?></td>
                        </tr>
                        <?php endif;?>
                    </table>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">

                </div>
            </div>
            <div style="overflow-x:auto;">
            <table class="dataTable table table-up table-striped b-t b-b">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Produk</th>
                        <th  width="10%">Quantity</th>
                        <th  width="25%" class="text-right">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; $selisih = 0; foreach($transaction as $order) : ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$order->product_name;?></td>
                        <td><?=$order->qty;?></td>
                        <td style="text-align:right;"><?=rupiah($order->subtotal);?></td>
                        <?php $selisih += $order->subtotal;?>
                    </tr>
                <?php $i++; endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="font-semibold">Ongkir ke <?=uc_words($address[0]->village);?></td>
                        <td style="text-align:right;"><?=rupiah($order->price_total - $selisih - $transaction[0]->random_number);?></td>
                    </tr>
                    <tr class="fg-lightRed">
                        <td colspan="3" class="font-semibold">Random Number</td>
                        <td style="text-align:right;"><?=rupiah($transaction[0]->random_number);?></td>
                    </tr>
                    <tr class="bg-lighterGray">
                        <th colspan="3" class="font-semibold">Grand Total</th>
                        <th style="text-align:right;"><?=rupiah($order->price_total);?></th>
                    </tr>
                </tfoot>
            </table>
            </div>
            <form action="" method="post">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                    <div class="form-group">
                            <label for="select_status">Ubah Status Transaksi</label>
                            <select name="status" id="select_status" class="form-control">
                                <?php
                                    $statuses = array("pending", "canceled", "paid", "verified", "sent");
                                    foreach($statuses as $status) :?>
                                    <option value="<?=$status;?>" <?=$status == $transaction[0]->status ? 'selected' : '';?>><?=ucwords($status);?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group" id="tracking_number">
                            <label for="select_status">Beri No Resi</label>
                            <input type="text" name="tracking_number"
                            value="<?=$transaction[0]->status == 'sent' ? $transaction[0]->tracking_number : '';?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-block btn-info"><i class="fa fa-disk"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div> 