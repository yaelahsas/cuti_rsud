<div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jabatan <?php echo $button ?></h6>
            </div>
            <div class="card-body">
                <form action="<?php echo $action; ?>" method="post">
                    <div class="form-group">
                        <label for="varchar">Nama Jabatan <?php echo form_error('nama_jabatan') ?></label>
                        <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" placeholder="Nama Jabatan" value="<?php echo $nama_jabatan; ?>" />
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url('jabatan') ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
