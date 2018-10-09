<?php

  if (isset($_GET['tampil'])) $tampil=$_GET['tampil'];
  else $tampil="beranda";

  if ($tampil == "beranda") include("beranda.php");
  else if ($tampil == "logout") include("logout.php");
  else if ($tampil == "dashboard") include("dashboard.php");

  // ------------------------ BASIS PENGETAHUAN ------------------------
  elseif ($tampil == "registerlist") include("page/registerlist/registerlist_list.php");
  elseif ($tampil == "registerlist_tambahpro") include("page/registerlist/registerlist_tambahpro.php");
  elseif ($tampil == "registerlist_edit") include("page/registerlist/registerlist_edit.php");
  elseif ($tampil == "registerlist_editpro") include("page/registerlist/registerlist_editpro.php");
  elseif ($tampil == "registerlist_hapus") include("page/registerlist/registerlist_hapus.php");
  

  
else echo"Konten tidak ada";

?>
