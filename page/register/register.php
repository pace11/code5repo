<?php 
    $carikode = mysqli_query($conn, "SELECT id_reg FROM tbl_registration") or die (mysqli_error($conn));
    $datakode = mysqli_fetch_array($carikode);
    $jumlah_data = mysqli_num_rows($carikode);
        if ($datakode) {
            $nilaikode = substr($jumlah_data[0], 1);
            $kode = (int) $nilaikode;
            $kode = $jumlah_data + 1;
            $kode_otomatis = "CODEREG".str_pad($kode, 4, "0", STR_PAD_LEFT);
        } else {
            $kode_otomatis = "CODEREG0001";
        }
?>

<section>
    <div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto text-center">
        <h2 class="section-heading">Daftarkan diri anda</h2>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-12 text-center">
            <form action="?page=register_pro" method="post">
                <div class="form-group">
                    <input type="hidden" name="id_registrasi" value="<?= $kode_otomatis ?>">
                    <input type="text" class="valid form-control" name="nama_lengkap" autocomplete="off" placeholder="isikan nama ..." required/>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" autocomplete="off" placeholder="isikan alamat email ..." required/>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="no_hp" autocomplete="off" placeholder="isikan no hp ..." maxlength="3" required/>
                </div>
                <div class="form-group">
                    <select name="ops_apps" class="form-control">
                        <option value="Embeeded Apps (Alat)">Embeeded Apps (Alat)</option>
                        <option value="Mobile Apps (Android)">Mobile Apps (Android)</option>
                        <option value="Web Apps (PHP)">Web Apps (PHP)</option>
                        <option value="Desktop Apps(VB.net,C#)">Desktop Apps(VB.net,C#)</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="deskripsi_ta" rows="3" placeholder="isikan deskripsi mengenai judul tugas akhir ..."></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="deskripsi_metode" rows="3" placeholder="isikan metode yang digunakan ... ex : Naive Bayes, VSM, Cosine Similarity dll "></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="simpan" value="Daftar Sekarang">
                </div>
            </form>
            </div>
            
        </div>
        </div>
    </div>
    </div>
</section>