<section class="content">
  <div class="row">
    <div class="col-md-12" align="center">
      <div class="callout callout-danger">

    <?php

    $user = $_SESSION['username'];
    $date = date('Y-m-d H:i:s');
    
      mysqli_query($conn, "UPDATE tbl_admin SET
                          last_login  = '$date'
                          WHERE username = '$user'
                          ") or die (mysqli_error($conn));

    session_destroy();
    echo"<strong>Logout Success</strong>";
    echo"<meta http-equiv='refresh' content='1;
        url=../'>";
    ?>
    
    <span class="glyphicon glyphicon-ok"></span>
      </div>
    </div>
  </div>
</section>
