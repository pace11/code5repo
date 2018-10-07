<?php 

  $bpArr  = array();
  $bpArr1 = array();
  $bpArr2 = array();

  $basispeng  = mysqli_query($conn, "SELECT * FROM tbl_basispengetahuan");
  $hitbasis = mysqli_num_rows($basispeng);
  while ($datas = mysqli_fetch_array($basispeng)) {
    $bp     = explode(" ",$datas['kata_kunci']);
    $bpArr  = array_merge($bpArr,$bp); 
  }
    $bpArr1 = array_unique($bpArr);
    $bpArr2 = array_values($bpArr1);


  $pesan  = mysqli_query($conn, "SELECT * FROM tbl_pesan");
  $hitpesan = mysqli_num_rows($pesan);


  $pesanArr = array();
  $tmp1     = array();
  $tmp2     = array();

  $sql    = mysqli_query($conn, "SELECT * FROM tbl_pesan WHERE id_basispeng <> 1");
  $hitsql = mysqli_num_rows($sql);
  while($data = mysqli_fetch_array($sql)) {
    $isi = array($data['stem']);
    $pesanArr = array_merge($pesanArr,$isi);
  }
  $tmp1 = array_count_values($pesanArr);
  $tmp2 = array_unique($pesanArr);
  $tmp2 = array_values($tmp2);

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
              <div class="small-box bg-red">
                  <div class="inner">
                  <h3><?= $hitbasis ?> | <?= count($bpArr2) ?></h3>

                  <p>Basis Pengetahuan | Term</p>
                  </div>
                  <div class="icon">
                  <i class="fa fa-book"></i>
                  </div>
                  <a href="?tampil=basispeng" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-md-4">
              <div class="small-box bg-green">
                  <div class="inner">
                  <h3><?= $hitpesan ?></h3>

                  <p>Pesan Masuk</p> 
                  </div>
                  <div class="icon">
                  <i class="fa fa-commenting-o"></i>
                  </div>
                  <a href="?tampil=pesan" class="small-box-footer">Lihat <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-md-4">
              <div class="box">
              <div class="box-header">
                <h3 class="box-title"><i class="fa fa-commenting-o"></i> Kata sering ditanya</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Kata Kunci</th>
                        <th>ditanya</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      for ($a=0;$a<count($tmp2);$a++) {
                        echo "<tr>";
                        echo "<td>$no.</td>";
                        echo "<td><span class='badge bg-green'>".$tmp2[$a]."</span></td>";
                        echo "<td><span class='badge bg-red'>".$tmp1[$tmp2[$a]]."</span></td>";
                        echo "</tr>";
                        $no++;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
            </div>

            </div>
        </div>
  
</section>