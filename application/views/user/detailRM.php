<div class="container-fluid">
   <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>
      <div class="row">
        <div class="col-lg-6" >
          <div class="card">
            <div class="card-body ">
            
            <p >Tanggal Periksa :<span class="badge badge-info"> <?=$detail['tgl_periksa'] ?></span></p>
            <p>Id RM : <span class="badge badge-info"><?=$detail['id_rm'];?></p>
            <p>Id Pasien : <span class="badge badge-info"><?=$detail['id_pasien'] ?></p>
            <p>Nama : <span class="badge badge-info"><?=$detail['nama'] ?></p>
            <p>Visit : <span class="badge badge-info"><?=$detail['visit'] ?></p>
            <p>Anamnesa : <span class="badge badge-info"><?=$detail['anamnesa'] ?></p>
            <p>Diagnosa : <span class="badge badge-info"><?=$detail['diagnosa'] ?></p>
            <p>Keterangan : <span class="badge badge-info"><?=$detail['keterangan'] ?></p>
            <p>Biaya : <span class="badge badge-info"><?="Rp". number_format($detail['biaya']) ?></p>
            <p>Biaya Tambahan :<span class="badge badge-info"> <?="Rp". number_format($detail['biaya_tambahan']) ?></p>
           <!--  <p>total : <?=$total ?></p> -->
            <?php  $biaya = $detail['biaya'];
                   $biaya_tambahan = $detail['biaya_tambahan'];
                   $total = $biaya + $biaya_tambahan;
            ?>
            <p>Total Biaya: <span class="badge badge-info"><?="Rp " . number_format($total); ?></p>
                 
      </div>
    </div>
  </div>
</div>
    


