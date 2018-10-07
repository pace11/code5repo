<?php 
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <link rel="icon" href="src/img/icon_dasar.ico" type="image/x-icon">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="component/src/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="component/src/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="component/src/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="component/src/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="component/src/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <div class="login-logo"><i class="fa fa-commenting-o"></i> <b>paChat</b> Administrator</div>

  <div class="login-box-body">
    <p class="login-box-msg">Please Login</p>

    <form action="login.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="USERNAME" name="username" autocomplete="off" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="PASSWORD" name="password" autocomplete="off" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">
          <span class="fa fa-sign-in"></span>
           LOGIN</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

      <p align="center">paChat | <b>Dev</b></p>


      <?php

      if (isset($_POST['username']) && isset($_POST['password'])){
        include "../lib/connection.php";

        $username  = $_POST['username'];
        $password  = md5($_POST['password']);


        $cek1       = mysqli_query($conn, "SELECT * FROM tbl_admin 
                                  WHERE username ='$username' AND password ='$password'");
        $data      = mysqli_fetch_array($cek1);
        $jumlah    = mysqli_num_rows($cek1);

        
        if ($jumlah>0)
        {
          $_SESSION['username'] = $data['username'];
          $_SESSION['password'] = $data['password'];
        ?>
        
        <div class="callout callout-success">
          <p>Login Success <i class="fa fa-check"></i></p>
        </div>

        <?php
        echo"<meta http-equiv='refresh' content='1;
        url=index.php?tampil=beranda'>";
        }
      }
       ?>

  </div>
  <!-- /.login-box-body -->


</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="component/src/bower_components/jquery/dist/jquery.min.js"></script>
<script src="component/src/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="component/src/plugins/iCheck/icheck.min.js"></script>

</body>
</html>
