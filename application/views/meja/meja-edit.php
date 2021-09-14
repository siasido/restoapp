<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Meja</h1>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Edit Meja</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('meja/simpan')?>" method="post">
                        <input type="hidden" name="idmeja" value="<?=$this->input->post('idmeja') ?? $row->idmeja ?>"></input>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="meja">Nomor Meja</label>
                                    <input class="form-control" name="nomorMeja" value="<?=$this->input->post('nomorMeja') ?? $row->nomorMeja ?>" id="meja" required type="text" placeholder="Nomor meja..">
                                    <label class="invalid-text" for="nomorMeja"><?php echo form_error('nomorMeja'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kapasitas">Kapasitas</label>
                                    <input class="form-control" name="kapasitas" value="<?=$this->input->post('kapasitas') ?? $row->kapasitas ?>" id="meja" required type="number" placeholder="Kapasitas">
                                    <label class="invalid-text" for="kapasitas"><?php echo form_error('kapasitas'); ?></label>
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
        <h6 class="m-0 font-weight-bold text-primary">Data meja</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama meja</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $key => $data) { ?>
                    <tr>
                        <td><?=$data->nomorMeja?></td>
                        <td><?=$data->kapasitas?></td>
                        <td class="text-center">
                            <a href="<?=site_url('meja/edit/'.$data->idmeja)?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?=site_url('meja/delete/'.$data->idmeja)?>" class="btn btn-danger btn-sm">
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
