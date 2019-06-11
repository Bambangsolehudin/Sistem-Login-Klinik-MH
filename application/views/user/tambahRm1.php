 <div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>         
  <div class="row">
   <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <?=$this->session->flashdata('message'); ?>
        <?php  if(empty($pasien)) :?>
          <div class="alert alert-danger" role="alert">
            Data Is not Found!
          </div>
        <?php endif; ?>
        <div class="row mt-3">
          <div class="col">
            <form method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukan Id pasien" name="keyword">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" >search</button>
                </div>
              </form>
            </div>
          </div>
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Id Pasien</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Lahir</th>        
                <th scope="col">Action</th>
                
              </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              <?php foreach ($pasien as $m ) :  ?>
                <tr>
                  <th scope="row"><?= $i; ?></th>    
                  <td><?= $m['id_pasien'];?></td>
                  <td><?= $m['nama'];?></td>
                  <td><?= $m['tanggal_lahir'];?></td>
                  <td>
                    <a href="<?=base_url();?>user/detailPasien/<?=$m['id']; ?>" class="badge badge-info">detail</a>
                    <a href="<?=base_url();?>user/tambah_RM/<?=$m['id']; ?>" class="badge badge-success">tambah</a>                
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>