<div class="container-fluid">
 <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
 <div class="row">
  <div class="col-lg-10">
    <div class="card">
      <div class="card-body">
        <?=$this->session->flashdata('message'); ?>
        <!-- bila data tidak ada -->
        <?php  if(empty($medis)) :?>
          <div class="alert alert-danger" role="alert">Data Is not Found!</div>
        <?php endif; ?>
        <!-- tambah data RM -->
        <a href="<?=base_url();?>user/tambahRm1" class="btn btn-primary mb-3"> Tambah Data RM</a>
        <!-- search data RM -->
        <div class="row mt-3">
          <div class="col">
            <form method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search Data by ID Pasien or ID RM" name="keyword">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" >search</button>
                </div>
              </form>
            </div>
          </div>
          <!-- tabel data RM -->
          <table class="table table-hover">
           <thead>
             <tr>
               <th scope="col">#</th>

               <th scope="col">Tanggal Periksa</th>
               <th scope="col">Id RM</th>
               <th scope="col">Id Pasien</th>
               <th scope="col">Nama</th>
               <th scope="col">Action</th>
             </tr>
           </thead>
           <tbody>
            <?php $i=1; ?>
            <?php foreach ($medis as $m ) :  ?>
             
              <tr>
               <th scope="row"><?= $i; ?></th>
               <td><?= $m['tgl_periksa'];?></td>
               <td><?= $m['id_rm'];?></td>
               <td><?= $m['id_pasien'];?></td>
               <td><?= $m['nama'];?></td>
               <td>
                 <a href="<?=base_url();?>user/detailRM/<?=$m['id']; ?>" class="badge badge-info">detail</a>
                 <a href="<?=base_url();?>user/editRM/<?=$m['id']; ?>" class="badge badge-success">edit</a> 
                 <a href="<?=base_url();?>user/deleteRM/<?=$m['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin?');">delete</a> 
                 <a href="<?=base_url();?>user/cetakRM/<?=$m['id']; ?>" class="badge badge-info">cetak</a>	
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






