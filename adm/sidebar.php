<ul class="sidebar-menu" data-widget="tree">

  <li class="header">MAIN SIDEBAR</li>

  <li class="<?php if ($_GET['tampil'] == 'beranda'){ echo "active"; }?>">
    <a href="?tampil=beranda">
      <i class="fa fa-dashboard"></i> <span>Beranda</span>
    </a>
  </li>
  
  <li class="<?php if ($_GET['tampil'] == 'basispeng' || $_GET['tampil'] == 'basispeng_tambahpro' ||
                       $_GET['tampil'] == 'basispeng_edit' || $_GET['tampil'] == 'basispeng_editpro' ||
                       $_GET['tampil'] == 'basispeng_hapus'){ echo "active"; }?>">
    <a href="?tampil=basispeng">
      <i class="fa fa-book"></i> <span>Basis Pengetahuan</span>
    </a>
  </li>

  <li class="<?php if ($_GET['tampil'] == 'testing'){ echo "active"; }?>">
    <a href="?tampil=testing">
      <i class="fa fa-refresh"></i> <span>Testing</span>
    </a>
  </li>

  <li class="<?php if ($_GET['tampil'] == 'pesan'){ echo "active"; }?>">
    <a href="?tampil=pesan">
      <i class="fa fa-commenting-o"></i> <span>Pesan</span>
    </a>
  </li>

  <li class="<?php if ($_GET['tampil'] == 'logout'){ echo "active"; }?>">
    <a href="?tampil=logout">
      <i class="fa fa-sign-out"></i> <span>Keluar</span>
    </a>
  </li>

</ul>