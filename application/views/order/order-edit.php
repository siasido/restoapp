<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Orders</h1>

<div class="row">
    <div class="col-lg-10">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Add Order</h6>
            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('order/simpan')?>" method="post">
                        <input type="hidden" name="orderid" value="<?=$row->orderid?>"></input>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="orderDate">No.Pesanan : <strong><?php echo $row->nomorbill?></strong></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php $orderdate = DateTime::createFromFormat('Y-m-d H:i:s', $row->orderdate); ?>
                                    
                                    <label for="orderDate">Tgl Pesanan : <strong><?php echo $orderdate->format('d/m/Y - H:i')?></strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="meja">Meja</label>
                                    <select class="form-control" id="meja" name="idmeja" required>
                                        <?php foreach ($tables as $key => $res) {?> 
                                        <option value="<?=$res->idmeja?>" <?php echo $row->idmeja == $res->idmeja ? 'selected' : null ?> <?php echo ($res->available == 0 && $row->idmeja != $res->idmeja) ? 'disabled' : null ?>><?=$res->nomorMeja.'-'.(($res->available == 0 && $row->idmeja != $res->idmeja) ? 'Booked' : 'Available') ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pelanggan">Pelanggan</label>
                                    <select class="form-control" id="pelanggan" name="idpelanggan" required>
                                        <option value="">- Select Member -</option>
                                        <?php foreach ($members as $key => $res) {?> 
                                        <option value="<?=$res->idpelanggan?>" <?php echo $row->idpelanggan == $res->idpelanggan ? 'selected' : null ?>><?=$res->nama.' - '.$res->noHP?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="product_info_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width:40%">Product</th>
                                            <th style="width:10%">Qty</th>
                                            <th style="width:20%">@Harga</th>
                                            <th style="width:20%">Amount</th>
                                            <th style="width:10%" class="text-center"><button type="button" id="add_row" class="btn btn-secondary"><i class="fa fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $x = 1; ?>
                                        <?php foreach ($selected_items as $key => $val) { ?>

                                            <tr id="row_<?=$x?>">
                                                <td>
                                                    <select class="form-control" data-row-id="row_<?=$x?>" id="item_<?=$x?>" name="items[]" onchange="getDetailItemData(<?=$x?>)" required>
                                                        <option value="">- Select Item -</option>
                                                        <?php foreach ($items as $key => $res) {?> 
                                                        <option value="<?=$res->idmenu?>"  <?php echo $val->idmenu == $res->idmenu ? 'selected' : null ?>><?=$res->namaMenu ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td><input type="number" name="qty[]" value="<?=$val->qty?>" id="qty_<?=$x?>" class="form-control" onkeyup="getSubtotal(<?=$x?>)" required></td>
                                                <td>
                                                    <input type="text" name="harga[]" value="<?=$val->harga?>" id="harga_<?=$x?>"  class="form-control" readonly>
                                                    <input type="hidden" name="harga_value[]" value="<?=$val->harga?>" id="harga_value_<?=$x?>" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" name="amount[]" value="<?=$val->amount?>" id="amount_<?=$x?>" class="form-control" readonly autocomplete="off">
                                                    <input type="hidden" name="amount_value[]" value="<?=$val->amount?>" id="amount_value_<?=$x?>" class="form-control" autocomplete="off">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" onclick="removeRow('<?=$x?>')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <?php $x++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-3 text-right" style="margin-right: 0;">
                                <div class="form-group">
                                    <label for="gross_amount" class="control-label">Gross Amount</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="">
                                    <input type="text" class="form-control" id="gross_amount" name="gross_amount" value="<?=$val->gross_amount?>" readonly >
                                    <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?=$val->gross_amount?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-3 text-right" style="margin-right: 0;">
                                <div class="form-group">
                                    <label for="tax_charge" class="control-label">Tax (10%)</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="tax_charge" name="tax_charge" value="<?=$val->tax?>" readonly>
                                    <input type="hidden" class="form-control" id="tax_charge_value" name="tax_charge_value" value="<?=$val->tax?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-3 text-right" style="margin-right: 0;">
                                <div class="form-group">
                                    <label for="net_amount" class="control-label">Net Amount</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="net_amount" name="net_amount" value="<?=$val->net_amount?>" readonly>
                                    <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" value="<?=$val->net_amount?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-3 text-right" style="margin-right: 0;">
                                <div class="form-group">
                                    <label for="totalpayment" class="control-label">Total Payment</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="totalpayment" name="totalpayment" value="<?=$val->totalpayment?>" onkeyup="getSisaKembalian()" >
                                    <input type="hidden" class="form-control" id="totalpayment_value" name="totalpayment_value" value="<?=$val->totalpayment?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-3 text-right" style="margin-right: 0;">
                                <div class="form-group">
                                    <label for="sisakembalian" class="control-label">Sisa Kembalian</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="sisakembalian" name="sisakembalian" value="<?=$val->sisakembalian?>"readonly>
                                    <input type="hidden" class="form-control" id="sisakembalian_value" name="sisakembalian_value" value="<?=$val->sisakembalian?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <a href="<?=site_url('order/cetakReceipt/'.$row->orderid)?>" target="_blank" class="btn btn-flat btn-info btn-sm">Cetak Invoice</a>
                            </div>
                            <div class="col-lg-3"><button id="submit" type="submit" class="btn btn-block btn-primary">Simpan</button></div>
                        </div>
                        
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Tgl Pesanan</th>
                        <th>No. Meja</th>
                        <th>Pelanggan</th>
                        <th>Subtotal</th>
                        <th>Pajak</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $key => $data) { ?>
                    <tr>
                        <td><?=$data->nomorbill?></td>
                        <td><?=$data->orderdate?></td>
                        <td><?=$data->nomorMeja?></td>
                        <td><?=$data->nama?></td>
                        <td><?='Rp'.number_format($data->gross_amount,2,',','.') ?></td>
                        <td><?='Rp'.number_format($data->tax,2,',','.') ?></td>
                        <td><?='Rp'.number_format($data->net_amount,2,',','.') ?></td>
                        <td class="text-center"><?=$data->paidstatus == 1 ? '<span class="btn btn-success">Paid</span>' : '<span class="btn btn-danger">Unpaid</span>' ?></td>
                        <td class="text-center">
                            <a href="<?=site_url('order/edit/'.$data->orderid)?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>