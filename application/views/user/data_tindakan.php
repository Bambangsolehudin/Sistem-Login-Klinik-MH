<div class="container-fluid">  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1> 
  <div class="row">
   <div class="col-lg-6">
     <div class="card">
      <div class="card-body">
        <?=$this->session->flashdata('message'); ?>
        <?php  if(empty($tindakan)) :?>
          <div class="alert alert-danger" role="alert">
            Data Is not Found!
          </div>
        <?php endif; ?>
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal"> Tambah Data Tindakan</a>
        <div class="row mt-3">
          <div class="col">
            <form method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search Data by Nama Tindakan" name="keyword">
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

               <th scope="col">Nama Tindakan</th>
               <th scope="col">Biaya</th>
               <th scope="col">Action</th>
               <!--  -->
             </tr>
           </thead>
           <tbody>
            <?php $i=1; ?>

            <?php foreach ($tindakan as $m ) :  ?>
             <tr>
               <th scope="row"><?= $i; ?></th>
               
               <td><?= $m['nama_tindakan'];?></td>
               <td><?= "Rp". number_format($m['biaya']);?></td>                            
               <td>
                 <a href="<?=base_url();?>user/edit_tindakan/<?=$m['id']; ?>" class="badge badge-success"><i class="fas fa-edit"></i></a> 
                 <a href="<?=base_url();?>user/deleteTindakan/<?=$m['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin?');"><i class="fas fa-trash-alt" ></i></a> 
                 
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

<!-- cara di bottstrap Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Add New Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('user/data_tindakan'); ?>" method="post" >
        <div class="modal-body">
         
          <div class="form-group">
            <input type="text" class="form-control" id="nama_tindakan" name="nama_tindakan" placeholder="nama Tindakan">
            <?= form_error('nama_tindakan','<small class="text-danger" pl-3>','</small>'); ?>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="biaya" name="biaya" placeholder="Biaya">
            <?= form_error('biaya','<small class="text-danger" pl-3>','</small>'); ?>
          </div>

          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>




