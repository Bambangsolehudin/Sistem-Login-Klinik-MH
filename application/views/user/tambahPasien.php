<div class="container-fluid">
  <div class="row justify-content-md-center">

   <div class="col-md-auto">
    <?php if(validation_errors()) : ?>
      <div class="alert alert-danger" role="alert"> 
        <?= validation_errors();  ?>
      <?php endif; ?>
    </div> 

    <?=$this->session->flashdata('message'); ?>

    <div class="card" style="width: 600px;">
      <div class="card-header">
        TAMBAH DATA PASIEN
      </div>
      <div class="card-body">

        <form action="" method="post">
          <!-- <div class="form-group">
            <label for="id_pasien"> Id Pasien</label>
            <input type="text" class="form-control" id="id_pasien" name="id_pasien" value="">
            <?= form_error('id_pasien','<small class="text-danger" pl-3>','</small>'); ?>
          </div> -->
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama">
            <?= form_error('nama','<small class="text-danger" pl-3>','</small>'); ?>
          </div>
          <div class="form-group">
            <label for="tanggal_lahir"> Tanggal Lahir</label>
            <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
            <script>
              $('#tanggal_lahir').datepicker({ format: 'dd mmmm yyyy' });
            </script>
            <?= form_error('tanggal_lahir','<small class="text-danger" pl-3>','</small>'); ?>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
            <?= form_error('alamat','<small class="text-danger" pl-3>','</small>'); ?>
          </div>

          <div class="form-group">
            <label for="telepon">No Telp</label>
            <input type="text" class="form-control" id="telepon" name="telepon">
            <?= form_error('telepon','<small class="text-danger" pl-3>','</small>'); ?>
          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
              <option value="">Select Menu (Status)</option>
              <?php foreach ($status as $v) :?>
                <option value="<?=$v ?>"><?=$v ?></option>

              <?php endforeach; ?>
            </select>
            <?= form_error('status','<small class="text-danger" pl-3>','</small>'); ?>
          </div>
          <div class="form-group">
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="pekerjaan">
            <?= form_error('pekerjaan','<small class="text-danger" pl-3>','</small>'); ?>
          </div>
          
          <button type="submit" class="btn btn-primary float-right">Tambah data</button>

        </form>   

      </div>
    </div>
  </div>
</div>
</div>
