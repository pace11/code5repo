<?php 

$get = mysqli_query($conn, "SELECT * FROM tbl_registration WHERE id_reg='$_GET[no_reg]'")
       or die (mysqli_error($conn));

while($datas = mysqli_fetch_array($get)){
    echo "<li><b>No Registrasi :</b> $datas[id_reg]</li>";
    echo "<li><b>Nama Lengkap :</b> $datas[nama]</li>";
    echo "<li><b>Email :</b> $datas[email]</li>";
    echo "<li><b>No HP :</b> $datas[no_hp]</li>";
    echo "<li><b>Tipe :</b> $datas[tipe]</li>";
    echo "<li><b>Deskripsi Tugas Akhir/Skripsi :</b> $datas[desc_ta]</li>";
    echo "<li><b>Deskripsi Metode :</b> $datas[desc_metode]</li>";
}
?>
