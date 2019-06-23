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
                 <!-- edit -->
                 <a href="<?=base_url();?>user/editRM/<?=$m['id']; ?>" class="badge badge-success"><i class="fas fa-edit"></i></a> 
                 <!-- delete -->
                 <a href="<?=base_url();?>user/deleteRM/<?=$m['id']; ?>" onclick="return confirm('yakin?'); " ><i class="fas fa-trash-alt" ></i></a> 
                 <a href="<?=base_url();?>user/cetakRM/<?=$m['id']; ?>" ><i class="fas fa-print"></i></a>	
               </td>
             </tr>
             
             <?php $i++; ?>
           <?php endforeach; ?> 
        </tbody>
      </table> 
    </div>
     <div style="" >
      <div class="row">
        <div class="col-md-12">
          <td>jumlah data : <span class="badge badge-primary"><?php echo $count; ?> </span> </td> 
         <!--  <td>| total biaya : <span class="badge-info" style="padding: 1px;"><?php echo $sum; ?></span></td>

          <td>| total biaya tmbh: <span class="badge-info" style="padding: 1px;"><?php echo $sum1; ?></span></td>
          <?php $total = $sum+$sum1; ?>

          <td>| total : <span class="badge-info" style="padding: 1px;"><?php echo $total; ?></span></td> -->
        </div>
      </div>
    </div>
  </div>
</div>      
</div>
</div>






