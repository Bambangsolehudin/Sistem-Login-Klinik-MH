<?php 


$mpdf = new \Mpdf\Mpdf();
$html = '
<!DOCTYPE html>
<html>
<head>
  <title></title>
  

</head>
<body>


<h1>Data Rekam Medis</h1>
<table border="1" cellspacing="0">
         
             <tr>
               <th>#</th>
               <th></th>
               <th>Tanggal Periksa</th>
               <th>Id RM</th>
               <th>Id Pasien</th>
               <th>Nama</th>
               <th>Visit</th>
               <th>Anamnesa</th>
               <th>diagnosa</th>
               <th>Keterangan</th>
               <th>Biaya</th>

               
             </tr> 
         
';
// 
$i=1;
foreach ($medis as $detail ) {
        $html.='<tr>
        <td>'.$i++.'<td>
        <td>'.$detail["tgl_periksa"].'</td>
        <td>'.$detail["id_rm"].'</td>
        <td>'.$detail["id_pasien"].'</td>
        <td>'.$detail["nama"].'</td>
        <td>'.$detail["visit"].'</td>
        <td>'.$detail["anamnesa"].'</td>
        <td>'.$detail["diagnosa"].'</td>
        <td>'.$detail["keterangan"].'</td>
        <td>'.$detail["biaya"].'</td>
        <tr>';


}




$total = $sum + $sum1;



$html.= '
      </table> 
      <p>jumlah data : <span class="badge-info" style="padding: 1px;">'.  $count .' </span> </p> 
      <p> total biaya : Rp <span class="badge-info" style="padding: 1px;">'.  number_format($sum ).'</span></p>
       <p> total Biaya Tambahan : Rp. <span class="badge-info" style="padding: 1px;">'.  number_format($sum1) .'</span></p>
      <p> total Pemasukan : Rp.<span class="badge-info" style="padding: 1px;">'.  number_format($total) .'</span></p>


  
    </body>
</html>';


// Write some HTML code:
$mpdf->WriteHTML($html);


// Output a PDF file directly to the browser
$mpdf->Output();
?>

    
