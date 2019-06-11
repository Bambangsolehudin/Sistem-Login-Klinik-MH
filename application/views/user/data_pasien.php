<div class="container-fluid">
 <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
 <div class="row">
  <div class="col-lg-10">
    <div class="card">
      <div class="card-body">
        <div class="col-md-auto">    
          <!-- Flash data pada search empty  -->
          <?=$this->session->flashdata('message'); ?>
          <?php  if(empty($pasien)) :?>
            <div class="alert alert-danger" role="alert">Data Is not Found!</div>
          <?php endif; ?>      
          <!-- button tambah data -->
          <a href="<?=base_url();?>user/tambahPasien" class="btn btn-primary mb-3"> Tambah Data Pasien</a>                
          <!-- search data pasien -->
          <div class="row mt-3">
            <div class="col">
              <form method="post">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search Data by ID Pasien" name="keyword">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" >search</button>
                  </div>
                </form>
              </div>
              
              <!-- tabel data pasien -->
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
                    <a href="<?=base_url();?>user/editPasien/<?=$m['id']; ?>" class="badge badge-success">edit</a> 
                    <a href="<?=base_url();?>user/deletePasien/<?=$m['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin?');">delete</a>    		
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














