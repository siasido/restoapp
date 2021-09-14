<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Menu</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Edit Menu</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('menu/simpan')?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idmenu" value="<?=$this->input->post('idmenu') ?? $row->idmenu ?>"></input>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kategori">Nama Menu</label>
                                    <input class="form-control" name="namaMenu" value="<?=$this->input->post('namaMenu') ?? $row->namaMenu ?>" id="namaMenu" required type="text" placeholder="Item name..">
                                    <label class="invalid-text" for="namaMenu"><?php echo form_error('namaMenu'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" id="kategori" name="idkategori" required>
                                        <option value="-">- Pilih Kategori -</option>
                                        <?php $kategori = $this->input->post('idkategori') ?? $row->idkategori ?>
                                        <?php foreach ($categories as $key => $res) {?> 
                                            <option value="<?=$res->idkategori?>" <?php echo $kategori == $res->idkategori ? 'selected' : null ?>><?=$res->kategori?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input class="form-control" name="harga" value="<?=$this->input->post('harga') ?? $row->harga ?>" id="harga" required type="number" placeholder="Price..">
                                    <label class="invalid-text" for="harga"><?php echo form_error('harga'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"><?=$this->input->post('deskripsi') ?? $row->deskripsi ?></textarea>
                                    <label class="invalid-text" for="deskripsi"><?php echo form_error('deskripsi'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!-- <label for="foto">Foto</label> -->
                                    <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name="foto" class="btn-primary custom-file-input" id="foto">
                                        <label class="custom-file-label" for="foto">Pilih Foto</label>
                                        </div>
                                    </div>
                                        <?php if($row->foto != null) { ?>
                                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 2 MB</div>
                                            <label for="">Current Image:</label>
                                            <div class="text-left" >
                                                <img  width="80" height="80" src="<?=base_url('uploads/menu/'.$row->foto)?>" class="rounded" alt="...">
                                            </div>
                                        <?php } ?> 
                                    
                                </div>
                                
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button name="submit" class="btn btn-submit btn-primary btn-user btn-block">
                                        Simpan
                                    </button>
                                </div>                                
                            </div>
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
        <h6 class="m-0 font-weight-bold text-primary">Data Menu</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $key => $data) { ?>
                    <tr>
                        <td><?=$data->namaMenu?></td>
                        <td><?=$data->kategori?></td>
                        <td><?='Rp'.number_format($data->harga,2,',','.') ?></td>
                        <td><img width="80" height="80" src="<?=base_url('uploads/menu/'.$data->foto)?>"> </td>   
                        <td><?=$data->deskripsi?></td>
                        <td class="text-center">
                            <a href="<?=site_url('menu/edit/'.$data->idmenu)?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return confirm('apakah anda yakin ingin menghapus data?')" href="<?=site_url('menu/delete/'.$data->idmenu)?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
