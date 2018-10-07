<?php

  if (isset($_GET['tampil'])) $tampil=$_GET['tampil'];
  else $tampil="beranda";

  if ($tampil == "beranda") include("beranda.php");
  else if ($tampil == "logout") include("logout.php");
  else if ($tampil == "beranda") include("beranda.php");

  // ------------------------ BASIS PENGETAHUAN ------------------------
  elseif ($tampil == "basispeng") include("page/basispengetahuan/basispeng_list.php");
  elseif ($tampil == "basispeng_tambahpro") include("page/basispengetahuan/basispeng_tambahpro.php");
  elseif ($tampil == "basispeng_edit") include("page/basispengetahuan/basispeng_edit.php");
  elseif ($tampil == "basispeng_editpro") include("page/basispengetahuan/basispeng_editpro.php");
  elseif ($tampil == "basispeng_hapus") include("page/basispengetahuan/basispeng_hapus.php");
  
  // ------------------------ PESAN ------------------------
  elseif ($tampil == "pesan") include("page/pesan/pesan.php");

  // ------------------------ TESTING ------------------------
  elseif ($tampil == "testing") include("page/testing/testing.php");


  // ------------------------ CHAT ------------------------
  elseif ($tampil == "chat") include("page/chat/chat.php");

  
else echo"Konten tidak ada";

?>
