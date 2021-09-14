<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Pelanggan</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Pelanggan</h6>
            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse <?=validation_errors() ? 'show' : null ?> " id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('pelanggan/simpan')?>" method="post">
                        <input type="hidden" name="idpelanggan"></input>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama pelanggan</label>
                                    <input class="form-control" name="nama" value="<?php echo set_value('nama');?>" id="nama" required type="text" placeholder="Nama Pelanggan..">
                                    <label class="invalid-text" for="nama"><?php echo form_error('nama'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                            <div class="form-group">
                                    <label for="noHP">No.HP</label>
                                    <input class="form-control" name="noHP" value="<?php echo set_value('noHP');?>" id="noHP" required type="number" placeholder="0812..">
                                    <label class="invalid-text" for="noHP"><?php echo form_error('noHP'); ?></label>
                                </div>  
                                <button name="submit" class="btn btn-submit btn-primary btn-user btn-block">
                                    Simpan
                                </button>
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
        <h6 class="m-0 font-weight-bold text-primary">Data pelanggan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>No. Handphone</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $key => $data) { ?>
                    <tr>
                        <td><?=$data->nama?></td>
                        <td><?=$data->noHP?></td>
                        <td class="text-center">
                            <a href="<?=site_url('pelanggan/edit/'.$data->idpelanggan)?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return confirm('apakah anda yakin ingin menghapus data?')" href="<?=site_url('pelanggan/delete/'.$data->idpelanggan)?>" class="btn btn-danger btn-sm">
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