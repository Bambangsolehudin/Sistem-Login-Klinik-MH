

            <!-- Begin Page Content -->    <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>


         
        <div class="row">
        	<div class="col-lg-6">
           <div class="card">
              <div class="card-body">
        

		<?= form_error('menus','<div class="alert alert-danger" role="alert">','
					</div>') ?> 

		<?=$this->session->flashdata('message'); ?>

        	<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal"> Add New Role</a>
			 <table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>

			      <th scope="col">Role</th>
			      <th scope="col">Action</th>
			      <!--  -->
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $i=1; ?>

			  	<?php foreach ($role as $r ) :  ?>
			    <tr>

			      <th scope="row"><?= $i; ?></th>

            
			      <td><?= $r['role'];?></td>
			      <td>
              <a href="<?=base_url('admin/roleaccess/') . $r['id'];?>" class="badge badge-warning">access</a>
            
             <a href="" class="badge badge-success" data-toggle="modal" data-target="#newEditModal">Edit</a>
			     	
            <!-- <a href="<?=base_url();?>Menu/<?=$m['id']; ?>" class="badge badge-success">edit</a>  -->
			     	<a href="" class="badge badge-danger" onclick="return confirm('yakin?');">delete</a> 
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




<!-- cara di bottstrap Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('admin/role'); ?>" method="post" >
      <div class="modal-body">
        <div class="form-group">
	    
	    <input type="text" class="form-control" id="role" name="role" placeholder="Menu name">
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




<!-- MENU EDIT -->

<div class="modal fade" id="newEditModal" tabindex="-1" role="dialog" aria-labelledby="newEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newEditModalLabel">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('menu'); ?>" method="post" >
      <div class="modal-body">
        <div class="form-group">
      
      <input type="text" class="form-control" id="menu" name="menus" placeholder="Edit Menu name">
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>




