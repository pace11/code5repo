<?php
  if (isset($_GET['page'])) $page=$_GET['page'];
  else $page="dashboard";

  if ($page == "dashboard") include("page/dashboard.php");

  elseif ($page == "register") include("page/register/register.php");
  elseif ($page == "register_pro") include("page/register/register_pro.php");
  elseif ($page == "register_success") include("page/register/register_success.php");

  elseif ($page == "masuk") include("page/masuk.php");
  elseif ($page == "keluar") include("page/keluar.php");

  else echo"Konten tidak ada";
?>