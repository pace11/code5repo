<?php

$user = $_SESSION['username'];
$admin = mysqli_query($conn, "SELECT * FROM tbl_admin WHERE username='$user'");
$arr = mysqli_fetch_array($admin);


?>
<ul class="nav navbar-nav">
    <li>
    <a href="">Last Login : <b><?= $arr['last_login'] ?></b></a>
    </li>
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <span class="hidden-xs">Hey, <b><?php echo strtoupper($user); ?></b></span>
      </a>
    </li>

</ul>