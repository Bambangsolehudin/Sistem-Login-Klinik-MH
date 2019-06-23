<?php 


$mpdf = new \Mpdf\Mpdf();
$html = '
<!DOCTYPE html>
<html>
<head>
  <title></title>
  

</head>
<body>


<h1>Data Pasien</h1>
<table border="1" cellspacing="0">
         
             <tr>
               <th>#</th>
               <th></th>
               <th>ID pasien</th>
               <th>Nama</th>
               <th>Tanggal Lahir</th>
               <th>Alamat</th>
               <th>NO Telp</th>
               <th>Status</th>
               <th>Pekerjaan</th>
              

               
             </tr> 
         
';
// 
$i=1;
 foreach ($pasien as $detail ) {
        $html.='<tr>
        <td>'.$i++.'<td>
        <td>'.$detail["id"].'</td>
        <td>'.$detail["nama"].'</td>
        <td>'.$detail["tanggal_lahir"].'</td>
        <td>'.$detail["alamat"].'</td>
        <td>'.$detail["telepon"].'</td>
        <td>'.$detail["status"].'</td>
        <td>'.$detail["pekerjaan"].'</td>
       
        <tr>';


}








$html.= '
      </table> 
      <p>jumlah data : <span class="badge-info" style="padding: 1px;">'.  $count .' </span> </p> 
      
    </body>
</html>';


// Write some HTML code:
$mpdf->WriteHTML($html);


// Output a PDF file directly to the browser
$mpdf->Output();
?>

    
