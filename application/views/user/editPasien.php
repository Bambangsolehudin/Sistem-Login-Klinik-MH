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
          Edit Data Pasien
        </div>
        <div class="card-body">
          
          <form action="" method="post">
            <input type="hidden" name="id" value="<?= $edit['id']; ?>">
            
           <!--  <div class="form-group">
              <label for='id_pasien'>id_pasien</label>

              <input type="text" class="form-control" id="id_pasien" name="id_pasien" value="<?=$edit['id_pasien'];  ?>">
            </div> -->
            <div class="form-group">
              <label for='nama'>nama</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?=$edit['nama'];  ?>">
            </div>

            <div class="form-group">
              <label for='tanggal_lahir'>Tanggal Lahir</label>
              <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?=$edit['tanggal_lahir'];  ?>">
              <script>
                $('#tanggal_lahir').datepicker({ format: 'dd mmmm yyyy' });
              </script>
            </div>

            <div class="form-group">
              <label for='alamat'>Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="<?=$edit['alamat'];  ?>">
            </div>

            <div class="form-group">
              <label for='telepon'>NO telepon</label>
              <input type="text" class="form-control" id="telepon" name="telepon" value="<?=$edit['telepon'];  ?>">
            </div>

            <div class="form-group">
              <label for='status'>Status</label>
              <select class="form-control" id="status" name="status">
                
                <?php foreach ($status as $v) :?>
                  <?php if($v == $edit['status']) :?>
                    <option value="<?=$v ?>" selected><?=$v ?></option>
                    <?php else: ?>
                      <option value="<?=$v ?>"><?=$v ?></option> 
                    <?php endif; ?>
                    
                  <?php endforeach; ?>
                </select>
                
              </div>

              

              <div class="form-group">
                <label for='pekerjaan'>Pekerjaan</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?=$edit['pekerjaan'];  ?>">
              </div>




             

                <button type="submit" class="btn btn-primary float-right">updated</button>

              </form>   
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
    