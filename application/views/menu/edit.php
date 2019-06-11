

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1> 
        <div class="row">

        	<div class="col-lg-6">
              <?= form_error('menu','<div class="alert alert-danger" role="alert">','</div>') ?> 

              <?=$this->session->flashdata('message'); ?>

                <div class="card">
                  <div class="card-header">
                    Ubah data
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $edit['id']; ?>">
                        <div class="form-group">
                          <label for='menu'>Menu</label>
                          <input type="text" class="form-control" id="menu" name="menu" value="<?=$edit['menu'];  ?>">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">ubah data</button>

                    </form>


                    
                    
                  </div>
                </div>
                        	     
            </div>
          </div>

              








