<!-- section untuk input pertanyaan -->
<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
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

            $arrayData  = array();
            $arrayData1 = array();
            $arrayData2 = array();
            $arrayData1 = array_merge($arrayData2,$tmpArrper);
            $push       = array();
            $sql = mysqli_query($conn, "SELECT kata_kunci FROM tbl_basispengetahuan")
                    or die(mysqli_error($conn));
            $hitSql = mysqli_num_rows($sql);
            while($data = mysqli_fetch_array($sql)) {
              
              $isi      = explode(" ", $data['kata_kunci']);
              array_push($push,$isi);
              $arrayData = array_merge($arrayData,$isi);

            }
            $arrayData  = array_merge($arrayData,$arrayData1);  
            $tmp1       = array_unique($arrayData);
            $tmp2       = array_values($tmp1);
            $hitung     = count($tmp2);

            echo "<pre>";
            print_r($tmp2);
            echo "</pre>";
        ?>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px" rowspan="2" class="text-center">NO</th>
                  <th style="width: 10px" rowspan="2" class="text-center">TERM</th>
                  <th colspan="<?= $hitSql+1 ?>" class="text-center">TF</th>
                  <th rowspan="2">DF</th>
                  <th rowspan="2">IDF</th>
                  <th colspan="<?= $hitSql+1 ?>" class="text-center">WDT = TF.IDF</th>
                </tr>
                <tr>
                  <?php
                    echo "<th>Q</th>"; 
                    for($c=1;$c<=$hitSql;$c++) {
                      echo "<th>D".$c."</th>";
                    }
                  ?>
                  <?php
                    echo "<th>Q</th>";
                    for($c=1;$c<=$hitSql;$c++) {
                      echo "<th>D".$c."</th>";
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                  
                  $sumBawah = [];

                  for ($c=0;$c<count($push);$c++) {
                    $sumBawah[$c] = 0;
                  }
                  $no = 1;
                  for ($a=0;$a<$hitung;$a++) {
                    echo "<tr>";
                    echo "<td>".$no.".</td>";
                    echo "<td><a class='btn btn-warning btn-flat'>".$tmp2[$a]."</a></td>";
                    $sumNilb  = 0;
                    $isi      = [];
                    
                    // proses TF IDF -----------------------------
                    $df = 0;
                    for($b=0;$b<1;$b++) {
                      echo "<td>";
                      if (in_array($tmp2[$a],$tmpArrper)) {
                        $isi[$a][$b] = 1;
                        $df = $df + $isi[$a][$b];
                        echo "<a class='btn btn-danger btn-xs'>".$isi[$a][$b]."</a>";
                      } else {
                        $isi[$a][$b] = 0;
                        echo $isi[$a][$b];
                      }
                      echo "</td>";
                    }

                    for ($b=0;$b<count($push);$b++) {
                      echo "<td>";
                      if (in_array($tmp2[$a],$push[$b])) {
                        $isi[$a][$b] = 1;
                        $df = $df + $isi[$a][$b];
                        echo "<a class='btn btn-primary btn-xs'>".$isi[$a][$b]."</a>";
                      } else {
                        $isi[$a][$b] = 0;
                        echo $isi[$a][$b];
                      }
                    }
                      $jum = count($push) + 1;
                      $idf = log10($jum/$df);
                    echo "</td>";
                    echo "<td><a class='btn btn-success btn-xs'>".$df."</a></td>";
                    echo "<td><a class='btn btn-info btn-xs'>".$idf."</a></td>";
                    // proses TF IDF -----------------------------

                    // proses TF WDT -----------------------------
                    $wdt = 0;
                    for($b=0;$b<1;$b++) {
                      echo "<td>";
                      if (in_array($tmp2[$a],$tmpArrper)) {
                        $isi[$a][$b] = 1;
                        $wdt = $isi[$a][$b]*$idf;
                        echo "<a class='btn btn-danger btn-xs'>".$wdt."</a>";
                      } else {
                        $isi[$a][$b] = 0;
                        $wdt = $isi[$a][$b]*$idf;
                        echo $wdt;
                      }
                      $wdt = 0;
                      echo "</td>";
                    }

                    for ($b=0;$b<count($push);$b++) {
                      echo "<td>";
                      if (in_array($tmp2[$a],$push[$b])) {
                        $isi[$a][$b] = 1;
                        $wdt = $isi[$a][$b]*$idf;
                        echo "<a class='btn btn-primary btn-xs'>".$wdt."</a>";
                      } else {
                        $isi[$a][$b] = 0;
                        $wdt = $isi[$a][$b]*$idf;
                        echo $wdt;
                      }
                    }
                    echo "</td>";
                    $no++;
                    // proses TF WDT -----------------------------
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


<!-- section untuk proses Cosine Similarity -->
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
                  <th colspan="<?= $hitSql+1 ?>" class="text-center">WD5*WDi</th>
                  <th colspan="<?= $hitSql+1 ?>" class="text-center">PANJANG VEKTOR</th>
                </tr>
                <tr>
                  <?php
                    echo "<th>Q</th>"; 
                    for($c=1;$c<=$hitSql;$c++) {
                      echo "<th>D".$c."</th>";
                    }
                  ?>
                  <?php
                    echo "<th>Q</th>";
                    for($c=1;$c<=$hitSql;$c++) {
                      echo "<th>D".$c."</th>";
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                  
                  $sumWD5   = [];
                  $sumWD6   = [];
                  $sumQ     = [];
                  $kuadratQ = [];
                  $kuadratD = [];
                  $hasilHit = [];

                  for ($c=0;$c<count($push);$c++) {
                    $sumWD5[$c]   = 0;
                    $sumWD6[$c]   = 0;
                    $kuadratD[$c] = 0;
                    $hasilHit[$c] = 0;
                  }
                  for ($i=0;$i<1;$i++) {
                    $sumQ[$i]     = 0;
                    $kuadratQ[$i] = 0;
                  }

                  for ($a=0;$a<$hitung;$a++) {
                    echo "<tr>";
                    $sumNilb  = 0;
                    $isi      = [];
                    
                    // proses TF IDF -----------------------------
                    $df = 0;
                    for($b=0;$b<1;$b++) {
                      if (in_array($tmp2[$a],$tmpArrper)) {
                        $isi[$a][$b] = 1;
                        $df = $df + $isi[$a][$b];
                      } else {
                        $isi[$a][$b] = 0;
                      }
                    }

                    for ($b=0;$b<count($push);$b++) {
                      if (in_array($tmp2[$a],$push[$b])) {
                        $isi[$a][$b] = 1;
                        $df = $df + $isi[$a][$b];
                      } else {
                        $isi[$a][$b] = 0;
                      }
                    }
                      $jum = count($push) + 1;
                      $idf = log10($jum/$df);
                    // proses TF IDF -----------------------------

                    // proses WD5 -----------------------------
                    $wd5 = 0;
                    for($b=0;$b<1;$b++) {
                      echo "<td>";
                      if (in_array($tmp2[$a],$tmpArrper)) {
                        $isi[$a][$b] = 1;
                        $wd5 = $isi[$a][$b]*$idf;
                        echo "<a class='btn btn-danger btn-xs'>".$wd5."</a>";
                      } else {
                        $isi[$a][$b] = 0;
                        $wd5 = $isi[$a][$b]*$idf;
                        echo $wd5;
                      }
                      echo "</td>";
                    }

                    $wdt    = 0;
                    $tmp3   = [];
                    for ($b=0;$b<count($push);$b++) {
                      echo "<td>";
                      if (in_array($tmp2[$a],$push[$b])) {
                        $isi[$a][$b] = 1;
                        $wdt = $isi[$a][$b]*$idf;
                        $tmp3[$a][$b] = $wdt*$wd5;
                        if ($tmp3[$a][$b] > 0) {
                          echo "<a class='btn btn-primary btn-xs'>".$tmp3[$a][$b]."</a>";
                        } else { echo $tmp3[$a][$b]; }
                      } else {
                        $isi[$a][$b] = 0;
                        $wdt = $isi[$a][$b]*$idf;
                        $tmp3[$a][$b] = $wdt*$wd5;
                        echo $tmp3[$a][$b];
                      }
                      $sumWD5[$b] += $tmp3[$a][$b];
                    }
                    echo "</td>";
                    // proses WD5 -----------------------------

                    // proses WD5 -----------------------------
                    $wd5 = 0;
                    $arrWD5 = [];
                    for($b=0;$b<1;$b++) {
                      echo "<td>";
                      if (in_array($tmp2[$a],$tmpArrper)) {
                        $isi[$a][$b] = 1;
                        $wd5 = $isi[$a][$b]*$idf;
                        $arrWD5[$a][$b] = $wd5*$wd5; 
                        echo "<a class='btn btn-danger btn-xs'>".$arrWD5[$a][$b]."</a>";
                      } else {
                        $isi[$a][$b] = 0;
                        $wd5 = $isi[$a][$b]*$idf;
                        $arrWD5[$a][$b] = $wd5*$wd5;
                        echo $arrWD5[$a][$b];
                      }
                      $sumQ[$b] += $arrWD5[$a][$b];
                      echo "</td>";
                    }

                    $wdt    = 0;
                    $tmp3   = [];
                    $tmp4   = [];
                    for ($b=0;$b<count($push);$b++) {
                      echo "<td>";
                      if (in_array($tmp2[$a],$push[$b])) {
                        $isi[$a][$b] = 1;
                        $wdt = $isi[$a][$b]*$idf;
                        $tmp4[$a][$b] = $wdt*$wdt; 
                        if ($tmp4[$a][$b] > 0) {
                          echo "<a class='btn btn-primary btn-xs'>".$tmp4[$a][$b]." asu</a>";
                        } else { echo $tmp4[$a][$b]; }
                      } else {
                        $isi[$a][$b] = 0;
                        $wdt = $isi[$a][$b]*$idf;
                        $tmp4[$a][$b] = $wdt*$wdt;
                        echo $tmp4[$a][$b];
                      }
                      $sumWD6[$b] += $tmp4[$a][$b];
                    }
                    echo "</td>";
                    echo "</tr>";
                    // proses WDT -----------------------------

                  }
                  echo "<tr>";
                  echo "<th rowspan='2'>JUMLAH</th>";
                  for ($c=0;$c<count($push);$c++) {
                    echo "<td><a class='btn btn-success'>".$sumWD5[$c]."</a></td>";
                  }

                  for ($g=0;$g<1;$g++) {
                    echo "<td><a class='btn btn-warning'>".$sumQ[$g]."</a></td>";
                  }

                  for ($h=0;$h<count($push);$h++) {
                    echo "<td><a class='btn btn-warning'>".$sumWD6[$h]."</a></td>";
                  }

                  echo "<tr>";
                  for ($c=0;$c<count($push);$c++) {
                    echo "<td></td>";
                  }
                  for ($i=0;$i<1;$i++) {
                    $kuadratQ[$i] += sqrt($sumQ[$i]);
                    echo "<td><a class='btn btn-warning'>".$kuadratQ[$i]."</a></td>";
                  }

                  for ($j=0;$j<count($push);$j++) {
                    $kuadratD[$j] += sqrt($sumWD6[$j]);
                    echo "<td><a class='btn btn-warning'>".$kuadratD[$j]."</a></td>";
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


<!-- section untuk Rumus Perhitungan Cosine Similarity -->
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
                  <th colspan="<?= $hitSql ?>" class="text-center">PERHITUNGAN TIAP DOKUMEN</th>
                </tr>
                <tr>
                  <?php
                    for($c=1;$c<=$hitSql;$c++) {
                      echo "<th>D".$c."</th>";
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                  
                  $sumWD5   = [];
                  $sumWD6   = [];
                  $sumQ     = [];
                  $kuadratQ = [];
                  $kuadratD = [];
                  $hasilHit = [];

                  for ($c=0;$c<count($push);$c++) {
                    $sumWD5[$c]   = 0;
                    $sumWD6[$c]   = 0;
                    $kuadratD[$c] = 0;
                    $hasilHit[$c] = 0;
                  }
                  for ($i=0;$i<1;$i++) {
                    $sumQ[$i]     = 0;
                    $kuadratQ[$i] = 0;
                  }

                  for ($a=0;$a<$hitung;$a++) {
                    echo "<tr>";
                    $sumNilb  = 0;
                    $isi      = [];
                    
                    // proses TF IDF -----------------------------
                    $df = 0;
                    for($b=0;$b<1;$b++) {
                      if (in_array($tmp2[$a],$tmpArrper)) {
                        $isi[$a][$b] = 1;
                        $df = $df + $isi[$a][$b];
                      } else {
                        $isi[$a][$b] = 0;
                      }
                    }

                    for ($b=0;$b<count($push);$b++) {
                      if (in_array($tmp2[$a],$push[$b])) {
                        $isi[$a][$b] = 1;
                        $df = $df + $isi[$a][$b];
                      } else {
                        $isi[$a][$b] = 0;
                      }
                    }
                      $jum = count($push) + 1;
                      $idf = log10($jum/$df);
                    // proses TF IDF -----------------------------

                    // proses WD5 -----------------------------
                    $wd5 = 0;
                    for($b=0;$b<1;$b++) {
                      if (in_array($tmp2[$a],$tmpArrper)) {
                        $isi[$a][$b] = 1;
                        $wd5 = $isi[$a][$b]*$idf;
                      } else {
                        $isi[$a][$b] = 0;
                        $wd5 = $isi[$a][$b]*$idf;
                      }
                    }

                    $wdt    = 0;
                    $tmp3   = [];
                    for ($b=0;$b<count($push);$b++) {
                      if (in_array($tmp2[$a],$push[$b])) {
                        $isi[$a][$b] = 1;
                        $wdt = $isi[$a][$b]*$idf;
                        $tmp3[$a][$b] = $wdt*$wd5;
                      } else {
                        $isi[$a][$b] = 0;
                        $wdt = $isi[$a][$b]*$idf;
                        $tmp3[$a][$b] = $wdt*$wd5;
                      }
                      $sumWD5[$b] += $tmp3[$a][$b];
                    }
                    // proses WD5 -----------------------------

                    // proses WD5 -----------------------------
                    $wd5 = 0;
                    $arrWD5 = [];
                    for($b=0;$b<1;$b++) {
                      if (in_array($tmp2[$a],$tmpArrper)) {
                        $isi[$a][$b] = 1;
                        $wd5 = $isi[$a][$b]*$idf;
                        $arrWD5[$a][$b] = $wd5*$wd5; 
                      } else {
                        $isi[$a][$b] = 0;
                        $wd5 = $isi[$a][$b]*$idf;
                        $arrWD5[$a][$b] = $wd5*$wd5;
                      }
                      $sumQ[$b] += $arrWD5[$a][$b];
                    }

                    $wdt    = 0;
                    $tmp3   = [];
                    $tmp4   = [];
                    for ($b=0;$b<count($push);$b++) {
                      if (in_array($tmp2[$a],$push[$b])) {
                        $isi[$a][$b] = 1;
                        $wdt = $isi[$a][$b]*$idf;
                        $tmp4[$a][$b] = $wdt*$wdt; 
                      } else {
                        $isi[$a][$b] = 0;
                        $wdt = $isi[$a][$b]*$idf;
                        $tmp4[$a][$b] = $wdt*$wdt; 
                      }
                      $sumWD6[$b] += $tmp4[$a][$b];
                    }
                    // proses WDT -----------------------------

                  }

                  for ($c=0;$c<count($push);$c++) {
                    $sumWD5[$c];
                  }

                  for ($g=0;$g<1;$g++) {
                    $sumQ[$g];
                  }

                  for ($h=0;$h<count($push);$h++) {
                    $sumWD6[$h];
                  }

                  for ($i=0;$i<1;$i++) {
                    $kuadratQ[$i] += sqrt($sumQ[$i]);
                  }

                  for ($j=0;$j<count($push);$j++) {
                    $kuadratD[$j] += sqrt($sumWD6[$j]);
                  }

                  for ($r=0;$r<count($push);$r++) {
                    if ($kuadratQ[0] > 0) {
                      $hasilHit[$r] += $sumWD5[$r]/($kuadratQ[0]*$kuadratD[$r]);
                      if ($hasilHit[$r] > 0) {
                        echo "<td><a class='btn btn-primary'>".$hasilHit[$r]."</a></td>";
                      } else {
                        echo "<td>".$hasilHit[$r]."</td>";
                      }
                    } else {
                      $hasilHit[$r] = 0;
                    }
                    
                  }
                  
                  echo "<pre>";
                  print_r($hasilHit);
                  echo "</pre>";
                  
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
<!-- section untuk Rumus Perhitungan Cosine Similarity -->

