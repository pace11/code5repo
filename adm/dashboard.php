<?php 

  $regis  = mysqli_query($conn, "SELECT * FROM tbl_registration");
  $hitregis = mysqli_num_rows($regis);


?>
<section class="content-header">
  <h1>
    Dashboard
    <small>Administrator</small>
  </h1>
  <ol class="breadcrumb">
    <li><a><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- isi halaman -->
<section class="content">
  <div class="row">
      <div class="col-md-12">
      </div>
      <!-- ./col -->
      <div class="col-md-4">
        <div class="small-box bg-blue">
            <div class="inner">
            <h3><?= $hitregis ?> <i class="fa fa-user"></i></h3>

            <p>Registration List</p>
            </div>
            <div class="icon">
            <i class="fa fa-pencil"></i>
            </div>
            <a href="?tampil=registerlist" class="small-box-footer">More <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

  </div>
  
</section>