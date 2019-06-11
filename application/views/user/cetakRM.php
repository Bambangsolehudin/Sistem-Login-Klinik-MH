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


<p> Daftar Tagihan</p>
<table>
<tr>
        <td>
            <p>tgl_periksa :</p>        
            <p>Id_RM : </p>
            <p>id_pasien : </p>
            <p>Nama :</p>
            <p>Visit : </p>
            <p>Anamnesa : </p>
            <p>diagnosa : </p>
            <p>Keterangan :</p>
            <p>Biaya : </p>
        </td>
        <td>
';

$tgl_periksa = $detail['tgl_periksa'];
$id_rm = $detail['id_rm'];
$id_pasien = $detail['id_pasien'];
$nama = $detail['nama'];
$visit = $detail['visit'];
$anamnesa = $detail['anamnesa'];
$diagnosa = $detail['diagnosa'];
$keterangan = $detail['keterangan'];
$Biaya = $detail['biaya'];

$html.='
<p>'.$tgl_periksa.'</p>
<p>'.$id_rm.'</p>
<p>'.$id_pasien.'</p>
<p>'.$nama.'</p>
<p>'.$visit.'</p>
<p>'.$anamnesa.'</p>
<p>'.$diagnosa.'</p>
<p>'.$keterangan.'</p>
<p>'.$Biaya.'</p>
';

$html.='
</td>
</tr>
</table>
</body>
</html>';


// Write some HTML code:
$mpdf->WriteHTML($html);


// Output a PDF file directly to the browser
$mpdf->Output();
?>

    
