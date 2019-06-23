<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>     
  <div class="row">
   <div class="col-lg-9">
    <?php if(validation_errors()) : ?>
      <div class="alert alert-danger" role="alert"> 
        <?= validation_errors();  ?>
      <?php endif; ?>
    </div> 

    <?=$this->session->flashdata('message'); ?>

    <div class="card" style="width: 500px;">
      <div class="card-header">
        Ubah data
      </div>
      <div class="card-body">

        <form action="" method="post">
          <input type="hidden" name="id" value="<?= $edit['id']; ?>">
          <div class="form-group">
            <label for='nama_tindakan'>nama_tindakan</label>
            <input type="text" class="form-control" id="nama_tindakan" name="nama_tindakan" value="<?=$edit['nama_tindakan'];  ?>">
          </div>
          <div class="form-group">
            <label for='biaya'>biaya</label>
            <input type="text" class="form-control" id="biaya" name="biaya" value="<?=$edit['biaya'];  ?>">
          </div>

          <div class="form-group">
            <label for='tambah_biaya'>Tambah Biaya</label>
            <input type="text" class="form-control" id="tambah_biaya" name="tambah_biaya">
          </div>
          <button type="submit" class="btn btn-primary float-right">update data</button>

        </form>   

      </div>
    </div>

  </div>
</div>
</div>
