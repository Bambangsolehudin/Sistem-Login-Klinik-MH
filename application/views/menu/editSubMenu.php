<!--  -->

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1> 
        <div class="row">

        	<div class="col-lg-6">
             <?php if(validation_errors()) : ?>
              <div class="alert alert-danger" role="alert"> 
              <?= validation_errors();  ?>
              </div>

              <?php endif; ?>

              <?=$this->session->flashdata('message'); ?>

                <div class="card">
                  <div class="card-header">
                    Ubah data
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $edit['id']; ?>">
                        <div class="form-group">
                          <label for='title'>title</label>
                          <input type="text" class="form-control" id="title" name="title" value="<?=$edit['title'];  ?>">
                        </div>

                        <div class="form-group">
                          <label for='menu_id'>menu_id</label>
                          <div class="form-group">
                             <select name="menu_id" id="menu_id" class="form-control">
                                  
                                  <option value="">Select Menu</option>
                                  <?php foreach ($menu as $m) :?>
                                    <option value="<?=$m['id'] ?>"><?=$m['menu'] ?></option>
                                  <?php endforeach; ?>
                             </select>
                            </div>

                        <div class="form-group">
                          <label for='url'>url</label>
                          <input type="text" class="form-control" id="url" name="url" value="<?=$edit['url'];  ?>">
                        </div>

                        <div class="form-group">
                          <label for='icon'>icon</label>
                          <input type="text" class="form-control" id="icon" name="icon" value="<?=$edit['icon'];  ?>">
                        </div>


                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active">
                          <label class="form-check-label" for="defaultCheck1">
                            Active ?
                          </label>
                        </div>


                        <button type="submit" class="btn btn-primary float-right">ubah data</button>

                    </form>


                    
                    
                  </div>
                </div>
                        	     
            </div>
          </div>
          

              








