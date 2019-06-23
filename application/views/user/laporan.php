<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>     
  <div class="row">
   <div class="col-md-4">
    <div class="card" style="width: 18rem;">
      <img src="https://img.lovepik.com/element/40047/4712.png_860.png" class="card-img-top" >
        <div class="card-body">       
          <a href="<?=base_url();?>user/cetakDP" class="btn btn-primary">Cetak Data Pasien</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
    <div class="card" style="width: 18rem;">
      <img src="https://img.lovepik.com/element/40050/5666.png_1200.png" class="card-img-top" >
        <div class="card-body md-auto">       
          <a href="<?=base_url();?>user/cetakDataRM" class="btn btn-primary">Cetak Data Rekam Medis</a>
        </div>
      </div>
    </div>

  </div>
</div>
