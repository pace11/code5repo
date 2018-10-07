<?php

$user = $_SESSION['username'];
$admin = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username='$user'");
$arr = mysqli_fetch_array($admin);

$role = $arr['title'];

?>
<ul class="nav navbar-nav">

    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">Hey, <b><?php echo strtoupper($user); ?></b></span>
            </a>
    </li>

</ul>