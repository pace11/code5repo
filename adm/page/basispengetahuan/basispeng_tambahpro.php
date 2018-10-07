<section class="content">
<div class="row">

  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
          <h3 class="box-title"><b>BASIS PENGETAHUAN</b> | Tambah</h3>
      </div>

        <div class="box-body">

          <?php
            if (isset($_POST['simpan'])) {
              
              $kata_kunci = strtolower($_POST['kata_kunci']);

                $input  = mysqli_query($conn, "INSERT INTO tbl_basispengetahuan SET
                        kata_kunci     = '$kata_kunci',
                        jawaban        = '$_POST[jawaban]'
                        ")  or die (mysqli_error($koneksi));

            if ($input){ ?>
                <div class="callout callout-success">
                  Data berhasil disimpan <span class="fa fa-check"></span>
                  <?php echo "<meta http-equiv='refresh' content='1;
                  url=?tampil=basispeng'>"; ?>
                </div>
            <?php }} ?>
        </div>
      </div>
    </div>
  </div>
</section>
