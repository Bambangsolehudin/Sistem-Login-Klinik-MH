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
               <div class="card-header"> TAMBAH DATA</div>
                 <div class="card-body">
                 
                    <form action="" method="post">    
                       <div class="form-group">
                            <label for='tgl_periksa'>tgl_periksa</label>
                            <?php date_default_timezone_set('Asia/Jakarta');?>
                            <input type="text" class="form-control" id="tgl_periksa" name="tgl_periksa" value="<?=date('d-m-Y '); ?>" readonly>
                            
                       </div>

                      <div class="form-group">
                            <label for='id_rm'>id_rm</label>
                            <input type="text" class="form-control" id="id_rm" name="id_rm" value="RM 0<?= $edit['id'] ?>" readonly>
                       </div>

                       <div class="form-group">
                            <label for='id_pasien'>id_pasien</label>
                            <input type="text" class="form-control" id="id_pasien" name="id_pasien" value="<?=$edit['id'];  ?>" readonly>
                       </div>

                       <div class="form-group">
                          <label for='nama'>nama</label>
                          <input type="text" class="form-control" id="nama" name="nama" value="<?=$edit['nama'];  ?>" readonly>
                       </div>
                      
                       <div class="form-group">
                          <label for='visit'>Visit</label>
                            <select class="form-control" id="visit" name="visit">
                              <option>select menu</option>
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
                                <input type="text" class="form-control" id="anamnesa" name="anamnesa">
                              </div>

                              <div class="form-group">
                                <label for='diagnosa'>diagnosa</label>
                                <input type="text" class="form-control" id="diagnosa" name="diagnosa">
                              </div>

                              <div class="form-group">
                                <label for='keterangan'>keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan">
                              </div>


                               <div class="form-group">
                                <label for='biaya'>Biaya</label>
                                
                                <select class="form-control" id="biaya" name="biaya">
                                 <option value="">select menu</option>
                                  <?php foreach ($tindakan as $v) :?>  
                                      <option value="<?=$v['biaya']; ?>"><?=$v['nama_tindakan'];?>
                                 </option>   
                                  <?php endforeach; ?>
                                </select>
                              </div>


                               <div class="form-group">
                                <label for='biaya_tambahan'>Biaya Tambahan</label>
                                <input type="text" class="form-control" id="biaya_tambahan" name="biaya_tambahan">
                              
                              </div>





                              <button type="submit" class="btn btn-primary float-right">Tambah data</button>

                          </form>   
                          
             </div>
         </div>         
     </div>
  </div>
</div>
        