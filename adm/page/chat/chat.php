<section class="content">
    <div class="box box-warning direct-chat direct-chat-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Direct Chat</h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
            <!-- Message. Default to the left -->
            <div id="isichatgege">

            </div>

            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
    </div>

    <?php 
        if (isset($_POST['nama']) && isset($_POST['isi_pesan'])) {
            $nama       = $_POST['nama'];
            $isi_pesan  = addslashes($_POST['isi_pesan']);
            $date       = date('Y-m-d H:i:s');

            if ($role == 'admin') {
                $role = 1;
            }
        
            $pesan = mysqli_query($conn, "INSERT INTO tbl_pesan SET
                                        nama        = '$nama',
                                        pesan       = '$isi_pesan',
                                        role        = '$role',
                                        date_in     = '$date'")
                                        or die (mysqli_error($conn));
            if ($pesan) {
                echo "<meta http-equiv='refresh' content='1;
                url=?tampil=chat'>";
            }
        }
    ?>

</section>

<script>
  $(document).ready(function() {
    $("#isichatgege").load("page/chat/isi_chat.php");
    var refreshId = setInterval(function() {
        $("#isichatgege").load('page/chat/isi_chat.php');
    }, 9000);
    $.ajaxSetup({ cache: false });
  });
</script>