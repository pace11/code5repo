<!-- section untuk input pertanyaan -->
<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>INPUT</b> Pertanyaan | Tokenizing - Filtering - Stemming </h3>
        </div>

        <div class="box-body">
          <form name="tambah" action="?tampil=testing" method="post" enctype="multipart/form-data"
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
                      $tanya = $_POST['pertanyaan'];
                      $pertanyaan = preg_replace('/[^A-Za-z0-9\ ]/', '', $_POST['pertanyaan']);

                      $myfile = fopen("stemming.txt", "w") or die("Unable to open file!");
                      $txt = $pertanyaan;
                      fwrite($myfile, $txt);
                      fclose($myfile);
                  
                  if (isset($pertanyaan)) {
                      echo "Kata Awal : <b>".$tanya."</b>";
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
                
                    $arrayData  = array();
                    $arrayData1 = array();
                    $arrayData2 = array();
                    $arrayData1 = array_merge($arrayData2,$tmpArrper);
                    $push       = array();
                    $sql        = mysqli_query($conn, "SELECT kata_kunci FROM tbl_basispengetahuan")
                                or die(mysqli_error($conn));
                    $hitSql     = mysqli_num_rows($sql);
                    while($data = mysqli_fetch_array($sql)) {
                    
                    $isi        = explode(" ", $data['kata_kunci']);
                    array_push($push,$isi);
                    $arrayData  = array_merge($arrayData,$isi);
    
                    }
                    
                    $arrayData  = array_merge($arrayData,$arrayData1);  
                    $tmp1       = array_unique($arrayData);
                    $tmp2       = array_values($tmp1);
                    $hitung     = count($tmp2);

                    
                        $isitf       = array(array());
                        $isiwdt      = array(array());
                        $isiwd5      = array(array());
                        $isivector   = array(array());
                        $isiqvector  = array();
                        $sumwd5      = array();
                        $sumqvector  = array();
                        $sumvector   = array();
                        $kuadratqvec = array();
                        $kuadratvec  = array();     
                        $isiqtf      = array();
                        $isiqwdt     = array();
                        $df          = array();
                        $idf         = array();
                        $cosine      = array();

    
                        for ($a=0;$a<$hitung;$a++) {
                            $df[$a]          = 0;
                            $idf[$a]         = 0;
                            $isiqtf[$a]      = 0;
                            $cosine[$a]      = 0;
                            $isiqwdt[$a]     = 0;
                            $sumwd5[$a]      = 0;
                            $sumqvector[$a]  = 0;
                            $sumvector[$a]   = 0;
                            $kuadratqvec[$a] = 0;
                            $kuadratvec[$a]  = 0;
                        }
    
                        for ($a=0;$a<$hitung;$a++) {
    
                            for($b=0;$b<1;$b++) {
                                if (in_array($tmp2[$a],$tmpArrper)) {
                                    $isiqtf[$a] = 1;
                                } else {
                                    $isiqtf[$a]= 0;
                                }
                            }
    
                            for ($b=0;$b<count($push);$b++) { 
                                if (in_array($tmp2[$a],$push[$b])) {
                                    $isitf[$a][$b] = 1;
                                    $df[$a] = $df[$a] + $isitf[$a][$b];
                                } else {
                                    $isitf[$a][$b] = 0;
                                }
                            }
                                if ($df[$a] == 0) {
                                    $idf[$a] = 0;
                                } else {
                                    $jum     = count($push);
                                    $idf[$a] = log10($jum/$df[$a]);
                                }
                            
                            for ($b=0;$b<1;$b++) {
                                $isiqwdt[$a] = $isiqtf[$a] * $idf[$a];
                            }
    
    
                            for ($b=0;$b<count($push);$b++) {
                                $isiwdt[$a][$b] = $isitf[$a][$b] * $idf[$a];
                            }
    
                            for ($b=0;$b<count($push);$b++) {
                                $isiwd5[$a][$b] = $isiqwdt[$a] * $isiwdt[$a][$b];
                                $sumwd5[$b] += $isiwd5[$a][$b]; // SUM dari WD5
                            }
    
                            for ($b=0;$b<1;$b++) {
                                $isiqvector[$a] = pow($isiqwdt[$a],2);
                                $sumqvector[$b] += $isiqvector[$a]; // SUM dari Qvector
                                $kuadratqvec[$b] = sqrt($sumqvector[$b]); // Kuadrat dari Qvector 
    
                            }
    
                            for ($b=0;$b<count($push);$b++) {
                                $isivector[$a][$b] = pow($isiwdt[$a][$b],2);
                                $sumvector[$b] += $isivector[$a][$b]; // SUM dari Vector
                                $kuadratvec[$b] = sqrt($sumvector[$b]); // Kuadrat dari vector 
                            }
                            
                        }
                        
                        for ($a=0;$a<count($push);$a++) {
                            $sumwd5[$a]; // tampilkan sum dari WD5
                        }
    
                        for ($a=0;$a<1;$a++) {
                            $sumqvector[$a]; // tampilkan sum dari QVector
                        }
    
                        for ($a=0;$a<1;$a++) {
                            $kuadratqvec[$a]; // tampilkan Kuadrat dari QVector
                        }
    
                        for ($a=0;$a<count($push);$a++) {
                            $sumvector[$a]; // tampilkan sum dari Vector
                        }
    
                        for ($a=0;$a<count($push);$a++) {
                            $kuadratvec[$a]; // tampilkan Kuadrat dari Vector
                        }
                        
                        for ($a=0;$a<count($push);$a++) {
                            if ($kuadratqvec[0] == 0) {
                                $cosine[$a] = 0;
                            } else {
                                $cosine[$a] = ($sumwd5[$a]/($kuadratqvec[0]*$kuadratvec[$a])); // hasil dari Cosine
                            }
                            
                        }
            
                        $max = max($cosine);
                        
                        for ($a=0;$a<count($push);$a++) {
                            if ($max == 0 || $max == $cosine[0]) {
                                $id = 1;
                            } else {
                                $id = array_search($max,$cosine)+1;
                            }
                        }

                        $sqljawab = mysqli_query($conn, "SELECT jawaban FROM tbl_basispengetahuan WHERE id_basispeng=$id");
                        $ambdata  = mysqli_fetch_array($sqljawab);
                        $jawaban  = $ambdata['jawaban'];
                  
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
                        
                        $no = 1;
                        for($j=0;$j<$hitung;$j++) {
                            echo "<tr>";
                            echo "<td>".$no.".</td>";
                            echo "<td><span class='badge bg-yellow'>".$tmp2[$j]."</span></td>";
                            
                            for($k=0;$k<1;$k++) {
                                if ($isiqtf[$j] > 0) {
                                    echo "<td><span class='badge bg-red'>".$isiqtf[$j]."</span></td>";
                                } else {
                                    echo "<td>".$isiqtf[$j]."</td>";
                                }
                            }

                            for ($k=0;$k<count($push);$k++) {
                                if ($isitf[$j][$k] > 0) {
                                    echo "<td><span class='badge bg-light-blue'>".$isitf[$j][$k]."</span></td>";
                                } else {
                                    echo "<td>".$isitf[$j][$k]."</td>";
                                }
                            }

                            for ($k=0;$k<1;$k++) {
                                if ($df[$j] > 0 && $idf[$j] > 0) {
                                    echo "<td><span class='badge bg-green'>".$df[$j]."</span></td>";
                                    echo "<td><span class='badge bg-orange'>".$idf[$j]."</span></td>";
                                } else {
                                    echo "<td>".$df[$j]."</td>";
                                    echo "<td>".$idf[$j]."</td>";
                                }
                            }

                            for ($k=0;$k<1;$k++) {
                                if ($isiqwdt[$j] > 0 ) {
                                    echo "<td><span class='badge bg-red'>".$isiqwdt[$j]."</span></td>";
                                } else {
                                    echo "<td>".$isiqwdt[$j]."</td>";
                                }
                            }

                            for ($k=0;$k<count($push);$k++) {
                                if ($isiwdt[$j][$k] > 0) {
                                    echo "<td><span class='badge bg-light-blue'>".$isiwdt[$j][$k]."</span></td>";
                                } else {
                                    echo "<td>".$isiwdt[$j][$k]."</td>";
                                }
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


<!-- section untuk proses COSINE SIMILARITY -->
<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>PROSES</b> | WD - Panjang Vektor</h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th style="width: 10px" rowspan="2" class="text-center">NO</th>
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
                            echo "<th>Q</th>";
                            for($c=1;$c<=$hitSql;$c++) {
                                echo "<th>D".$c."</th>";
                            }
                        ?>
                        </tr>
                    </thead>
                        <tbody>
                        <?php 
                        
                        $no = 1;
                        for($j=0;$j<$hitung;$j++) {
                            echo "<tr>";
                            echo "<td>".$no.".</td>";
                            
                            for($k=0;$k<1;$k++) {
                                if ($isiqwdt[$j] > 0) {
                                    echo "<td><span class='badge bg-red'>".$isiqwdt[$j]."</span></td>";
                                } else {
                                    echo "<td>".$isiqwdt[$j]."</td>";
                                }
                            }

                            for ($k=0;$k<count($push);$k++) {
                                if ($isiwd5[$j][$k] > 0) {
                                    echo "<td><span class='badge bg-light-blue'>".$isiwd5[$j][$k]."</span></td>";
                                } else {
                                    echo "<td>".$isiwd5[$j][$k]."</td>";
                                }
                            }

                            for ($k=0;$k<1;$k++) {
                                if ($isiqvector[$j] > 0 ) {
                                    echo "<td><span class='badge bg-red'>".$isiqvector[$j]."</span></td>";
                                } else {
                                    echo "<td>".$isiqvector[$j]."</td>";
                                }
                            }

                            for ($k=0;$k<count($push);$k++) {
                                if ($isivector[$j][$k] > 0) {
                                    echo "<td><span class='badge bg-light-blue'>".$isivector[$j][$k]."</span></td>";
                                } else {
                                    echo "<td>".$isivector[$j][$k]."</td>";
                                }
                            }
                            echo "</tr>";
                        $no++;
                        }

                        echo "<tr>";
                        echo "<th rowspan='2' colspan='2'>JUMLAH</th>";
                        for ($a=0;$a<count($push);$a++) {
                            echo "<td rowspan='2'><a class='btn btn-success'>".$sumwd5[$a]."</a></td>";
                        }

                        for ($a=0;$a<1;$a++) {
                            echo "<td><a class='btn btn-warning'>".$sumqvector[$a]."</a></td>";
                        }

                        for ($a=0;$a<count($push);$a++) {
                            echo "<td><a class='btn btn-warning'>".$sumvector[$a]."</a></td>";
                        }
                        echo "</tr>";
                        
                        echo "<tr>";
                        for ($a=0;$a<1;$a++) {
                            echo "<td><a class='btn btn-warning'>".$kuadratqvec[$a]."</a></td>";
                        }
                        
                        for ($a=0;$a<count($push);$a++) {
                            echo "<td><a class='btn btn-warning'>".$kuadratvec[$a]."</a></td>";
                        } 
                        echo "</tr>";

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


<!-- section untuk Hasil Perhitungan Cosine Similarity -->
<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>PROSES</b> | Hasil Perhitungan Cosine Similarity</h3>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th colspan="<?= $hitSql+1 ?>" class="text-center">HASIL PERHITUNGAN TIAP DOKUMEN</th>
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

                        echo "<tr>";
                        for($j=0;$j<count($push);$j++) {
                            if ($cosine[$j] > 0 && $cosine[$j] != $max) {
                                echo "<td><a class='btn btn-primary'>".$cosine[$j]."</a></td>";
                            } else if ($cosine[$j] > 0 && $cosine[$j] == $max) {
                                echo "<td><a class='btn btn-danger'>".$cosine[$j]."</a></td>";
                            } else {
                                echo "<td>".$cosine[$j]."</td>";
                            }
                        }
                        echo "</tr>";
                            
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

<!-- section untuk Hasil Perhitungan Cosine Similarity -->
<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b>HASIL</b> | Jawaban dari pertanyaan</h3>
        </div>

        <div class="box-body">
        <form enctype="multipart/form-data" class="form-horizontal">

            <div class="col-md-12">
              <div class="form-group">
                <label class="label-control col-md-2">PERTANYAAN</label>
                <div class="col-md-4">
                  <p> <?= $tanya ?></p>
                </div>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
                <label class="label-control col-md-2">JAWABAN</label>
                <div class="col-md-8">
                  <div class="callout callout-info">
                  <?= $jawaban ?>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>

    </div>
    <!-- /.box-body -->
    <?php } ?>
  </div>
  <!-- /.box -->
</section>

