<section class="content">
<div class="row">

<div class="col-xs-12">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title"><b>BASIS PENGETAHUAN</b> | List</h3>
      <div class="pull-right">
        <a class="btn btn-danger" href="#" data-target="#modal_tambah" data-toggle="modal">
          <span class="fa fa-plus-circle"></span> Tambah Data
        </a>
      </div>
    </div>

    <div class="box-body">
      <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>NO</th>
          <th>KATA KUNCI</th>
          <th>JAWABAN</th>
          <th>AKSI</th>
        </tr>
        </thead>
        <tbody>

          <?php

              $no = 1;
                $sql = mysqli_query($conn, "SELECT * FROM tbl_basispengetahuan WHERE deleted_at IS NULL") 
                or die(mysqli_error($conn));
                while($data = mysqli_fetch_array($sql)){
               
          ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $data['kata_kunci']; ?></td>
              <td><?php echo $data['jawaban']; ?></td>
              <td>
                <a href="?tampil=basispeng_edit&id=<?php echo $data['id_basispeng']; ?>" class="btn btn-primary btn-xs" title="edit">
                        <span class="fa fa-edit" aria-hidden="true"></span></a>
                 <a href="javascript:;" data-id="<?php echo $data['id_basispeng'] ?>" data-toggle="modal" data-target="#basispeng_hapus"
                        class="btn btn-danger btn-xs" title="hapus">
                        <span class="fa fa-trash" aria-hidden="true"></span></a>
              </td>
            </tr>

            <?php
              $no++;
            }
            ?>

        </tbody>
      </table>
    </div>

    <!-- Modal Tambah Data -->
    <div id="modal_tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">
                <i class="fa fa-edit"></i> 
                Input Basis Pengetahuan
            </h4>
            </div>
            <div class="modal-body">
            <form action="?tampil=basispeng_tambahpro" method="POST" name="modal_popup" enctype="multipart/form-data"
            class="form-horizontal">
                  
                <div class="form-group">
                  <label class="label-control col-md-3">KATA KUNCI</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control" name="kata_kunci" placeholder="isikan kata kunci ..." required/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="label-control col-md-3">JAWABAN</label>
                  <div class="col-md-8">
                    <textarea class="form-control" name="jawaban" rows="5" placeholder="isikan jawaban ..."></textarea>
                  </div>
                </div>

                <div class="modal-footer">
                <div class="pull-right">
                  <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                  <button type="reset" class="btn btn-danger btn-reset" data-dismiss="modal" aria-hidden="true">Batal</button>
                  </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- modal Hapus-->
    <div id="basispeng_hapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> <span class="glyphicon glyphicon-exclamation-sign"></span> Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini ?
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-info" id="hapus-basispeng"><i class="glyphicon glyphicon-ok"></i> Ya</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Tidak</button>
            </div>

            </div>
        </div>
    </div>

  </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>

<script src="lib/basispeng.js"></script>
