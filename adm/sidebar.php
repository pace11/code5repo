<ul class="sidebar-menu" data-widget="tree">

  <li class="header">MAIN SIDEBAR</li>

  <li class="<?php if ($_GET['tampil'] == 'beranda'){ echo "active"; }?>">
    <a href="?tampil=dashboard">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>
  
  <li class="<?php if ($_GET['tampil'] == 'registerlist' || $_GET['tampil'] == 'registerlist_tambahpro' ||
                       $_GET['tampil'] == 'registerlist_edit' || $_GET['tampil'] == 'registerlist_editpro' ||
                       $_GET['tampil'] == 'registerlist_hapus'){ echo "active"; }?>">
    <a href="?tampil=registerlist">
      <i class="fa fa-book"></i> <span>Register List</span>
    </a>
  </li>

  <li class="<?php if ($_GET['tampil'] == 'logout'){ echo "active"; }?>">
    <a href="?tampil=logout">
      <i class="fa fa-sign-out"></i> <span>Logout</span>
    </a>
  </li>

</ul>