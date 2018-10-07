<section class="content">
  <div class="row">
    <div class="col-md-12" align="center">
      <div class="callout callout-danger">

<?php
  session_destroy();
  echo"<strong>Anda Telah Keluar </strong>";
  echo"<meta http-equiv='refresh' content='1;
      url=login_admin.php'>";
?>
      <span class="glyphicon glyphicon-ok"></span>
      </div>
    </div>
  </div>
</section>
