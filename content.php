<?php
  if (isset($_GET['page'])) $page=$_GET['page'];
  else $page="dashboard";

  if ($page == "dashboard") include("page/dashboard.php");

  elseif ($page == "register") include("page/register.php");
  elseif ($page == "masuk") include("page/masuk.php");
  elseif ($page == "keluar") include("page/keluar.php");
  elseif ($page == "livechat") include("page/chat/chat.php");
  elseif ($page == "halo") include("page/halo/halo.php");

  else echo"Konten tidak ada";
?>