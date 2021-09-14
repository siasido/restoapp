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
            <div class="collapse" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('order/simpan')?>" method="post">
                        <input type="hidden" name="orderid"></input>
                        <!-- <div class="row">
                            <div class="col-lg-6">
                                <label for="orderDate">Order Date : <strong><?php echo date('Y-m-d H:i:s') ?></strong></label>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="meja">Meja</label>
                                    <select class="form-control" id="meja" name="idmeja" required>
                                        <option value="">- Select Table -</option>
                                        <?php foreach ($tables as $key => $res) {?> 
                                        <option value="<?=$res->idmeja?>" <?php echo set_select('idmeja', $this->input->post('idmeja')); ?> <?php echo $res->available == 1 ? null : 'disabled' ?>><?=$res->nomorMeja.'-'.($res->available == 1 ? 'Available' : 'Booked') ?></option>
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
                                        <option value="<?=$res->idpelanggan?>" <?php echo set_select('idpelanggan', $this->input->post('idpelanggan')); ?> ><?=$res->nama.' - '.$res->noHP?></option>
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
                                        <tr id="row_1">
                                            <td>
                                                <select class="form-control" data-row-id="row_1" id="item_1" name="items[]" onchange="getDetailItemData(1)" required>
                                                    <option value="">- Select Item -</option>
                                                    <?php foreach ($items as $key => $res) {?> 
                                                    <option value="<?=$res->idmenu?>"><?=$res->namaMenu ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td><input type="number" name="qty[]" id="qty_1" class="form-control" onkeyup="getSubtotal(1)" required></td>
                                            <td>
                                                <input type="text" name="harga[]" id="harga_1" class="form-control" readonly>
                                                <input type="hidden" name="harga_value[]" id="harga_value_1" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="amount[]" id="amount_1" class="form-control" readonly autocomplete="off">
                                                <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" onclick="removeRow('1')" class="btn btn-default"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        
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
                                    <input type="text" class="form-control" id="gross_amount" name="gross_amount" readonly >
                                    <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" >
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
                                    <input type="text" class="form-control" id="tax_charge" name="tax_charge" readonly>
                                    <input type="hidden" class="form-control" id="tax_charge_value" name="tax_charge_value">
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
                                    <input type="text" class="form-control" id="net_amount" name="net_amount" readonly>
                                    <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9"></div>
                            <div class="col-lg-3"><button type="submit" class="btn btn-block btn-primary">Simpan</button></div>
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
            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
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
                        <?php $orderdate = DateTime::createFromFormat('Y-m-d H:i:s', $data->orderdate); ?>
                        <td><?=$orderdate->format('d/m/Y - H:i')?> </td>
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


