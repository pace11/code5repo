<section class="content">
<div class="row">

  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
          <h3 class="box-title"><b>BASIS PENGETAHUAN</b> | Edit</h3>
      </div>

        <div class="box-body">

    <?php

        $date       = date('Y-m-d H:i:s');
        $kata_kunci = strtolower($_POST['kata_kunci']);

        $input  = mysqli_query($conn, "UPDATE tbl_basispengetahuan SET
                    kata_kunci           = '$kata_kunci',
                    jawaban              = '$_POST[jawaban]',
                    deleted_at           =  NULL,
                    updated_at           = '$date'
                    WHERE id_basispeng   = '$_POST[id_basis]'
                    ") or die (mysqli_error($conn));

    if ($input) { ?>
      <div class="callout callout-success">
        Data berhasil diedit <span class="fa fa-check"></span> 
        <?php echo "<meta http-equiv='refresh' content='1;
        url=?tampil=basispeng'>"; ?>
      </div>
    <?php } ?>

        </div>
      </div>
    </div>
  </div>
</section>
