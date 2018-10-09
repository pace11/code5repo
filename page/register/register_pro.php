<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php';
// $mail = new PHPMailer(true);

$id_reg      = $_POST['id_registrasi'];
$nama        = $_POST['nama_lengkap'];
$email       = $_POST['email'];
$no_hp       = $_POST['no_hp'];
$ops_apps    = $_POST['ops_apps'];
$desc_ta     = addslashes($_POST['deskripsi_ta']);
$desc_metode = addslashes($_POST['deskripsi_metode']);


    $input = mysqli_query($conn, "INSERT INTO tbl_registration SET
            id_reg      = '$id_reg',
            nama        = '$nama',
            email       = '$email',
            no_hp       = '$no_hp',
            tipe        = '$ops_apps',
            desc_ta     = '$desc_ta',
            desc_metode = '$desc_metode'
            ") or die (mysqli_error($conn));

    $regis = mysqli_query($conn, "SELECT * FROM tbl_registration");
    $hitregis = mysqli_num_rows($regis);    

    if ($input) {
        
        
        // $isi = "Hay Admin.. ada pendaftar baru, silahkan cek Dashboard admin";

        // $url = 'https://rest.nexmo.com/sms/json?api_key=f3e21de8&api_secret=HTKQFUZO1WZ80uHI&to=6282248080870&from="NEXMO"&text='.$isi."'";

        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec($ch);

        // try {

        //     $abx = 'Y29kZWZpdmU2NUBnbWFpbC5jb20=';
        //     $bxx = 'UGFjZTE5OTY=';

        //     $mail->isSMTP();                                      
        //     $mail->Host = 'smtp.gmail.com';  
        //     $mail->SMTPAuth = true;                               
        //     $mail->Username = base64_decode($abx);                 
        //     $mail->Password = base64_decode($bxx);                           
        //     $mail->SMTPSecure = 'tls';                            
        //     $mail->Port = 587;                                    

        //     //Recipients
        //     $mail->setFrom(base64_decode($abx), 'Code5');
        //     $mail->AddAddress($email);

        //     //Content
        //     $mail->isHTML(true);
        //     $mail->AddEmbeddedImage('img/email_header.jpg', 'fb');
        //     $bodyContent = "<img src='cid:fb' width='500'><br/>";
        //     $bodyContent .= "<p>Data Anda Adalah:</p>";
        //     $bodyContent .= "<p><ul>";
        //     $bodyContent .= "<li><b>ID Registrasi<b> : $id_reg</li>";
        //     $bodyContent .= "<li><b>Nama<b> : $nama</li>";
        //     $bodyContent .= "<li><b>Email<b> : $email</li>";
        //     $bodyContent .= "<li><b>No. Hp<b> : $no_hp</li>";
        //     $bodyContent .= "<li><b>Tipe<b> : $ops_apps</li>";
        //     $bodyContent .= "<li><b>Deskripsi TA<b> : $desc_ta</li>";
        //     $bodyContent .= "<li><b>Deskripsi Metode<b> : $desc_metode</li>";
        //     $bodyContent .= "<ul></p><br/>";
        //     $bodyContent .= "<hr><br>";
        //     $bodyContent .= "<p>Untuk Informasi bisa menghubungi di 082248080870 atau melalui Website kami di <a href='https://www.pacegege.com'>CODE5</a></p>";
                            
            
        //     $mail->Subject = '[Registrasi | Code5]';
        //     $mail->Body    = $bodyContent;

        //     $mail->send();
        // } catch (Exception $e) {
        //     echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        // }

        echo "<div style='margin-top:200px;' class='col-md-12 text-center'>";
        echo "<p>Pendaftaran Sedang Diproses</p>";
        echo "<img src='img/loading.gif' width='100'>";
        echo "</div>";
        echo "<meta http-equiv='refresh' content='2;
        url=?page=register_success&no_reg=$id_reg'>";
    }


?>