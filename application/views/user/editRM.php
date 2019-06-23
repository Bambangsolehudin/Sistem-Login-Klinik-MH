<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1> 
  
  
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
        Ubah data
      </div>
      <div class="card-body">
        
        <form action="" method="post">
          <input type="hidden" name="id" value="<?= $edit['id']; ?>">
          
          <div class="form-group">
            <label for='tgl_periksa'>tgl_periksa</label>
            <input type="text" class="form-control" id="tgl_periksa" name="tgl_periksa" value="<?=$edit['tgl_periksa'];  ?>">
            <script>
              $('#tgl_periksa').datepicker({ format: 'dd mmmm yyyy' });
            </script>
          </div>

          <div class="form-group">
            <label for='id_rm'>id_RM</label>
            <input type="text" class="form-control" id="id_rm" name="id_rm" value="<?=$edit['id_rm'];  ?>">
          </div>

          <div class="form-group">
            <label for='id_pasien'>id_pasien</label>
            <input type="text" class="form-control" id="id_pasien" name="id_pasien" value="<?=$edit['id_pasien'];  ?>">
          </div>
          <div class="form-group">
            <label for='nama'>nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?=$edit['nama'];  ?>">
          </div>


          <div class="form-group">
            <label for='visit'>Visit</label>
            <select class="form-control" id="visit" name="visit">
              <?php foreach ($visit as $v) :?>
                <?php if($v == $edit['visit']): ?>
                  <option value="<?=$v; ?>" selected><?=$v ?></option>
                  <?php else: ?>
                    <option value="<?=$v; ?>"><?=$v ?></option>
                  <?php endif; ?>                                      
                <?php endforeach; ?>


              </select>
            </div>                             

            <div class="form-group">
              <label for='anamnesa'>anamnesa</label>
              <input type="text" class="form-control" id="anamnesa" name="anamnesa" value="<?=$edit['anamnesa'];  ?>">
            </div>

            <div class="form-group">
              <label for='diagnosa'>diagnosa</label>
              <input type="text" class="form-control" id="diagnosa" name="diagnosa" value="<?=$edit['diagnosa'];  ?>">
            </div>

            <div class="form-group">
              <label for='keterangan'>keterangan</label>
              <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?=$edit['keterangan'];  ?>">
            </div>

            <div class="form-group">
              <label for='biaya'>biaya</label>
              <select class="form-control" id="biaya" name="biaya">   
                
                <?php foreach ($tindakan as $v) :?>
                  <?php if($v['biaya'] == $edit['biaya']): ?>  
                    <option value="<?=$v['biaya']; ?>" selected><?=$v['nama_tindakan'];?> Rp  <?=$v['biaya'];?></option>
                    <?php else: ?>
                      <option value="<?=$v['biaya']; ?>"><?=$v['nama_tindakan'];?> Rp  <?=$v['biaya']; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
               <div class="form-group">
              <label for='biaya_tambahan'>Biaya Tambahan</label>
              <input type="text" class="form-control" id="biaya_tambahan" name="biaya_tambahan" value="<?=$edit['biaya_tambahan'];  ?>">
            </div>
              



              <button type="submit" class="btn btn-primary float-right">ubah data</button>

            </form>   
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
  