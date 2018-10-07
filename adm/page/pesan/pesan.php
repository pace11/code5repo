<section class="content">
<div class="row">

<div class="col-xs-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><b>PESAN TERJAWAB</b> | List</h3>
    </div>

    <div class="box-body">
      <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>NO</th>
          <th>NAMA</th>
          <th>PERTANYAAN</th>
          <th>JAWABAN</th>
          <th>TANGGAL</th>
        </tr>
        </thead>
        <tbody>

          <?php

              $no = 1;
              $sql = mysqli_query($conn, "SELECT * FROM tbl_pesan
                                          JOIN tbl_basispengetahuan ON tbl_pesan.id_basispeng=tbl_basispengetahuan.id_basispeng
                                          WHERE tbl_pesan.id_basispeng <> 1
                                          ORDER BY date_in DESC")
              or die(mysqli_error($conn));
              while($data = mysqli_fetch_array($sql)){
               
          ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $data['nama']; ?></td>
              <td>
              <?php
                echo "<div class='callout callout-success'>";
                echo $data['pesan'];
                echo "</div>";
              ?>
              </td>
              <td>
              <?php
                echo "<div class='callout callout-success'>";
                echo $data['jawaban'];
                echo "</div>";
              ?>
              </td>
              <td><?php echo $data['date_in']; ?></td>
            </tr>

            <?php
              $no++;
            }
            ?>

        </tbody>
      </table>
    </div>

  </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>


<section class="content">
<div class="row">

<div class="col-xs-12">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title"><b>PESAN TIDAK TERJAWAB</b> | List</h3>
    </div>

    <div class="box-body">
      <div class="table-responsive">
      <table id="example2" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>NO</th>
          <th>NAMA</th>
          <th>PERTANYAAN</th>
          <th>JAWABAN</th>
          <th>TANGGAL</th>
        </tr>
        </thead>
        <tbody>

          <?php

            $no = 1;
            $sql = mysqli_query($conn, "SELECT * FROM tbl_pesan
                                        JOIN tbl_basispengetahuan ON tbl_pesan.id_basispeng=tbl_basispengetahuan.id_basispeng
                                        WHERE tbl_pesan.id_basispeng = 1
                                        ORDER BY date_in DESC")
            or die(mysqli_error($conn));
            while($data = mysqli_fetch_array($sql)){
            
            ?>
              <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $data['nama']; ?></td>
              <td>
              <?php
                echo "<div class='callout callout-danger'>";
                echo $data['pesan'];
                echo "</div>";
              ?>
              </td>
              <td>
              <?php
                echo "<div class='callout callout-danger'>";
                echo $data['jawaban'];
                echo "</div>";
              ?>
              </td>
              <td><?php echo $data['date_in']; ?></td>
              </tr>

            <?php
            $no++;
            }
            ?>

        </tbody>
      </table>
    </div>

  </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>

