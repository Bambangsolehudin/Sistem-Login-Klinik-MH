

            <!-- Begin Page Content -->    <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>


         
        <div class="row">
        	<div class="col-lg">
             <div class="card">
              <div class="card-body">
       <?php if(validation_errors()) : ?>
		    <div class="alert alert-danger" role="alert"> 
        <?= validation_errors();  ?>
        </div>

      <?php endif; ?>



  

		<?=$this->session->flashdata('message'); ?>
    <?php  if(empty($menu)) :?>
            <div class="alert alert-danger" role="alert">
                Data Is not Found!
            </div>
          <?php endif; ?>

        	<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal"> Add New Submenu</a>
			 <table class="table table-hover">
         <div class="row mt-3">
              <div class="col">
                  <form method="post">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Search Data Menu" name="keyword">
                      <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" >search</button>
                    </div>
                  </form>
              </div>

      </div>
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Title</th>
			      <th scope="col">Menu</th>
            <th scope="col">Url</th>
            <th scope="col">icon</th>
            <th scope="col">Active</th>
            <th scope="col">Action</th>
			      
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $i=1; ?>

			  	<?php foreach ($submenu as $sm ) :  ?>
			    <tr>

			      <th scope="row"><?= $i; ?></th>
            <td><?= $sm['title'];?></td>
			      <td><?= $sm['menu_id'];?></td>
             <td><?= $sm['url'];?></td>
              <td><?= $sm['icon'];?></td>
               <td><?= $sm['is_active'];?></td>
			      <td>
			     	<a href="<?=base_url();?>Menu/editSubMenu/<?=$sm['id']; ?>" class="badge badge-success">edit</a>
			     	<a href="<?=base_url();?>menu/deleteSubMenu/<?=$sm['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin?')">delete</a> 
			      		<!-- ada dibootsrap cari pill di documentatiton -->
			      </td>
			    </tr>
			    <?php $i++; ?>
			<?php endforeach; ?>


    
				  </tbody>
				</table>
        	</div>

        </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- modal -->

<!--  -->


<!-- cara di bottstrap Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Add New Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('menu/submenu'); ?>" method="post" >
      <div class="modal-body">
      

      <div class="form-group">
	    <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
      
  		</div>

      <div class="form-group">
      <select name="menu_id" id="menu_id" class="form-control">
        
        <option value="">Select Menu</option>
        <?php foreach ($menu as $m) :?>
          <option value="<?=$m['id'] ?>"><?=$m['menu'] ?></option>


        <?php endforeach; ?>

      </select>
      </div>
       <div class="form-group">
      <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
      </div>
       <div class="form-group">
      <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
      </div>
      <div class="form-group">

        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active">
          <label class="form-check-label" for="defaultCheck1">
            Active ?
          </label>
        </div>



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
<!-- edit -->
