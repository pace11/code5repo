<?php

  $tampil = mysqli_query($conn, "SELECT * FROM tbl_basispengetahuan WHERE id_basispeng='$_GET[id]'")
            or die (mysqli_error($conn));
  $data   = mysqli_fetch_array($tampil);
 ?>

<section class="content">
<div class="row">

  <div class="col-xs-12">
    <div class="box box-danger">
      <div class="box-header with-border">
          <h3 class="box-title"><b>BASIS PENGETAHUAN </b> | Edit</h3>
      </div>

        <div class="box-body">

          <form name="tambah" action="?tampil=basispeng_editpro" method="post" enctype="multipart/form-data"
          class="form-horizontal">

          <div class="col-md-12">

            <div class="form-group">
              <label class="label-control col-md-2">KATA KUNCI</label>
              <div class="col-md-8">
                <input type="hidden" name="id_basis" value="<?= $data['id_basispeng'] ?>">
                <input value="<?= $data['kata_kunci']; ?>" type="text" name="kata_kunci" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <label class="label-control col-md-2">JAWABAN</label>
              <div class="col-md-8">
                <textarea name="jawaban" class="form-control" rows="5" required><?= $data['jawaban'] ?></textarea>
              </div>
            </div>

          </div>
        </div>

          <div class="box-footer">
            <div class="form-group">
              <label class="col-md-2"></label>
              <div class="col-md-4">
                <button type="Submit" name="tambah" class="btn btn-primary">
                  <span class="fa fa-edit"></span> Edit</button>
                <a href="?tampil=basispeng" class="btn btn-danger"><span class="fa fa-remove"></span> Tutup</a>
              </div>
            </div>
          </div>

          </form>

        </div>
    </div>
  </div>


</div>
</section>
