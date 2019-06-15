<?php 

$mpdf = new \Mpdf\Mpdf();
$html = 
'
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>


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
';

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








$html.= '</tbody>
      </table> 
    </div>
    </body>
</html>'


// Write some HTML code:
$mpdf->WriteHTML($html);


// Output a PDF file directly to the browser
$mpdf->Output();
?>

    
