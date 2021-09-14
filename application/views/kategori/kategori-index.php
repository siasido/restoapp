<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Kategori</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse <?=validation_errors() ? 'show' : null ?> " id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('kategori/simpan')?>" method="post">
                        <input type="hidden" name="idkategori"></input>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kategori">Nama Kategori</label>
                                    <input class="form-control" name="kategori" value="<?php echo set_value('kategori');?>" id="kategori" required type="text" placeholder="Breakfast, Main Course, etc..">
                                    <label class="invalid-text" for="kategori"><?php echo form_error('kategori'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                                    <label class="invalid-text" for="kategori"><?php echo form_error('keterangan'); ?></label>
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
        <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $key => $data) { ?>
                    <tr>
                        <td><?=$data->kategori?></td>
                        <td><?=$data->keterangan?></td>
                        <td class="text-center">
                            <a href="<?=site_url('kategori/edit/'.$data->idkategori)?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return confirm('apakah anda yakin ingin menghapus data?')" href="<?=site_url('kategori/delete/'.$data->idkategori)?>" class="btn btn-danger btn-sm">
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