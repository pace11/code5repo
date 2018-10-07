<!-- section untuk input pertanyaan -->
<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><b>INPUT</b> Pertanyaan | Tokenizing - Filtering - Stemming </h3>
        </div>

        <div class="box-body">
          <form name="tambah" action="?tampil=proses" method="post" enctype="multipart/form-data"
            class="form-horizontal">

            <div class="col-md-12">
              <div class="form-group">
                <label class="label-control col-md-2">PERTANYAAN</label>
                <div class="col-md-6">
                  <input name="pertanyaan" class="form-control" rows="5" placeholder="Isikan Pertanyaan ..." required>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label class="label-control col-md-2"></label>
                <div class="col-md-6">
                  <button type="Submit" name="tambah" class="btn btn-primary">
                      <span class="fa fa-refresh"></span> PROSES</button>
                </div>
              </div>
            </div>
          </div>

            <div class="box-footer">
              <?php

                  $tmpArrper = array();

                  if (isset($_POST['pertanyaan'])) {
                      $pertanyaan = $_POST['pertanyaan'];
                      $myfile = fopen("stemming.txt", "w") or die("Unable to open file!");
                      $txt = $_POST['pertanyaan'];
                      fwrite($myfile, $txt);
                      fclose($myfile);
                  }
                  if (isset($pertanyaan)) {
                      echo "Kata Awal : <b>".$pertanyaan."</b>";
                      $output = null;
                      exec("python coba.py", $output, $return);
                      echo "<pre>";
                      print_r($output);
                      echo "</pre>";
                      $arrper     = preg_replace('/[^A-Za-z0-9\ ]/', '', $output[2]);
                      $tmpArrper  = explode(" ",$arrper);
                      echo "<pre>";
                      print_r($tmpArrper);
                      echo "</pre>"; 
                      }
                  
              ?>
            </div>

          </form>
        </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>

<!-- section untuk proses TF IDF -->
<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>PROSES</b> | TF IDF - (WDT = TF.IDF)</h3>
        </div>

        <div class="box-body">
        <?php 

            $arrayData = array();
            $sql = mysqli_query($conn, "SELECT kata_kunci FROM tbl_basispengetahuan")
                    or die(mysqli_error($conn));
            $hitSql = mysqli_num_rows($sql);
            while($data = mysqli_fetch_array($sql)) {

              $isi      = explode(" ", $data['kata_kunci']);
              $arrayData = array_merge($arrayData,$isi);

            }
            $tmp1   = array_unique($arrayData);
            $tmp2   = array_values($tmp1);
            $hitung = count($tmp2);
        ?>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px" rowspan="2">NO</th>
                  <th style="width: 10px" rowspan="2" class="text-center">TERM</th>
                  <th colspan="<?= $hitSql+1 ?>" class="text-center">TF</th>
                  <th rowspan="2">DF</th>
                  <th rowspan="2">IDF</th>
                  <th colspan="<?= $hitSql+1 ?>" class="text-center">WDT = TF.IDF</th>
                </tr>
                <tr>
                  <?php 
                    for($c=1;$c<=$hitSql;$c++) {
                      echo "<th>D".$c."</th>";
                    }
                    echo "<th>Q</th>";
                  ?>
                  <?php 
                    for($c=1;$c<=$hitSql;$c++) {
                      echo "<th>D".$c."</th>";
                    }
                    echo "<th>Q</th>";
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  
                  // Perulangan untuk BARIS ---------------------------
                  for ($a=0;$a<$hitung;$a++) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td><a class='btn btn-primary btn-xs'>".$tmp2[$a]."</a></td>";
                    $DF   = 0;
                    $IDF  = 0;

                    //Perulangan untuk KOLOM --------------------------
                    for ($b=0;$b<$hitSql;$b++) {
                      $bno = $b+1;
                      echo "<td>";
                      $sqlData = mysqli_query($conn, "SELECT kata_kunci FROM tbl_basispengetahuan WHERE id_basispeng=$bno")
                                or die(mysqli_error($conn));
                      $sqldataArray = mysqli_fetch_array($sqlData);
                        $datas  = explode(" ", $sqldataArray['kata_kunci']);
                        $jumD   = 0;
                        
                        // Perulangan untuk MENCARI DATA yang sama antara TERM dan D1-Dn ------------------------
                        for ($d=0;$d<count($datas);$d++) {
                          if($tmp2[$a] == $datas[$d]) {
                            $jumD += 1;
                            $DF += 1;
                          }
                        }
                        if ($jumD == 1) {
                          echo "<a class='btn btn-primary btn-xs'>".$jumD."</a>";
                        } else {
                          echo $jumD;
                        }
                      echo "</td>";
                    }
                    
                    for ($e=0;$e<1;$e++) {
                      echo "<td>";
                      $jumArrPer = 0;
                      for ($f=0;$f<count($tmpArrper);$f++) {
                        if ($tmp2[$a] == $tmpArrper[$f]) {
                          $jumArrPer += 1;
                        }
                      }
                      if ($jumArrPer == 1) {
                        echo "<a class='btn btn-info btn-xs'>".$jumArrPer."</a>";
                      } else {
                        echo $jumArrPer;
                      }
                      echo "</td>";
                    }
                    
                    $DF = $DF + $jumArrPer;
                    
                    $IDF = number_format(log10($hitSql/$DF),3);
                    echo "<td><a class='btn btn-warning btn-xs'>".$DF."</a></td>";
                    echo "<td><a class='btn btn-success btn-xs'>".$IDF."</a></td>";
                    
                    $WDT = 0;
                    for ($b=0;$b<$hitSql;$b++) {
                      $bno = $b+1;
                      echo "<td>";
                      $sqlData = mysqli_query($conn, "SELECT kata_kunci FROM tbl_basispengetahuan WHERE id_basispeng=$bno")
                                or die(mysqli_error($conn));
                      $sqldataArray = mysqli_fetch_array($sqlData);
                        $datas  = explode(" ", $sqldataArray['kata_kunci']);
                        $jumD   = 0;
                        
                        // Perulangan untuk MENCARI DATA yang sama antara TERM dan D1-Dn ------------------------
                        for ($d=0;$d<count($datas);$d++) {
                          if($tmp2[$a] == $datas[$d]) {
                            $jumD += 1;
                            $DF += 1;
                          }
                        }
                        $WDT = $jumD*$IDF;
                        if ($WDT > 0) {
                          echo "<a class='btn btn-danger btn-xs'>".$WDT."</a>";
                        } else {
                          echo $WDT;
                        }
                            
                      echo "</td>";
                    }

                    $QWDT = 0;
                    for ($e=0;$e<1;$e++) {
                      echo "<td>";
                      $jumArrPer = 0;
                      for ($f=0;$f<count($tmpArrper);$f++) {
                        if ($tmp2[$a] == $tmpArrper[$f]) {
                          $jumArrPer += 1;
                        }
                      }
                      $QWDT = $jumArrPer * $IDF; 
                      if ($QWDT > 0) {
                        echo "<a class='btn btn-info btn-xs'>".$QWDT."</a>";
                      } else {
                        echo $QWDT;
                      }
                      echo "</td>";
                    }

                    echo "</tr>";
                    $no++;
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>

    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>

<!-- section untuk Cosine Similarity -->
<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>PROSES</b> | Cosine Similarity</h3>
        </div>

        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px" rowspan="2">NO</th>
                  <th colspan="<?= $hitSql+1 ?>" class="text-center">WD5*WDi</th>
                  <th colspan="<?= $hitSql+1 ?>" class="text-center">Panjang Vektor</th>
                </tr>
                <tr>
                  <?php
                    echo "<th>Q</th>";
                    for($c=1;$c<=$hitSql;$c++) {
                      echo "<th>D".$c."</th>";
                    }
                  ?>
                  <?php 
                    for($c=1;$c<=$hitSql;$c++) {
                      echo "<th>D".$c."</th>";
                    }
                    echo "<th>Q</th>";
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php

                  $no = 1;
                  for ($a=0;$a<$hitung;$a++) {
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    $DF   = 0;
                    $IDF  = 0;

                    //Perulangan untuk KOLOM --------------------------
                    for ($b=0;$b<$hitSql;$b++) {
                      $bno = $b+1;
                      $sqlData = mysqli_query($conn, "SELECT kata_kunci FROM tbl_basispengetahuan WHERE id_basispeng=$bno")
                                or die(mysqli_error($conn));
                      $sqldataArray = mysqli_fetch_array($sqlData);
                        $datas  = explode(" ", $sqldataArray['kata_kunci']);
                        $jumD   = 0;
                        
                        // Perulangan untuk MENCARI DATA yang sama antara TERM dan D1-Dn ------------------------
                        for ($d=0;$d<count($datas);$d++) {
                          if($tmp2[$a] == $datas[$d]) {
                            $jumD += 1;
                            $DF += 1;
                          }
                        }
                    }
                    
                    $DF = $DF + $jumArrPer;
                    $IDF = number_format(log10($hitSql/$DF),3);

                    $QWDT = 0;
                    for ($e=0;$e<1;$e++) {
                      echo "<td>";
                      $jumArrPer = 0;
                      for ($f=0;$f<count($tmpArrper);$f++) {
                        if ($tmp2[$a] == $tmpArrper[$f]) {
                          $jumArrPer += 1;
                        }
                      }
                      $QWDT = $jumArrPer * $IDF; 
                      if ($QWDT > 0) {
                        echo "<a class='btn btn-info btn-xs'>".$QWDT."</a>";
                      } else {
                        echo $QWDT;
                      }
                      echo "</td>";
                    }
                    
                    
                    $sumOne = 0;
                    $gege = 0;
                    $sumgege = 0;
                    $WDT = 0;
                    for ($b=0;$b<$hitSql;$b++) {
                      
                      $bno = $b+1;
                      echo "<td>";
                      $sqlData = mysqli_query($conn, "SELECT kata_kunci FROM tbl_basispengetahuan WHERE id_basispeng=$bno")
                                or die(mysqli_error($conn));
                      $sqldataArray = mysqli_fetch_array($sqlData);
                        $datas  = explode(" ", $sqldataArray['kata_kunci']);
                        $jumD   = 0;
                        
                        // Perulangan untuk MENCARI DATA yang sama antara TERM dan D1-Dn ------------------------
                        for ($d=0;$d<count($datas);$d++) {
                          if($tmp2[$a] == $datas[$d]) {
                            $jumD += 1;
                            $DF += 1;
                          }
                        }
                        $WDT = $jumD*$IDF;
                        $sumOne = $QWDT * $WDT;
                        $gege = $gege + $sumOne;
                        if ($sumOne > 0) {
                          echo "<a class='btn btn-danger btn-xs'>".$sumOne."</a>";
                        } else {
                          echo $sumOne;
                        } 
                      echo "</td>";
                    }
                    echo "</tr>";
                    $no++;
                  }

                ?>
              </tbody>
            </table>
          </div>
        </div>

    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>

