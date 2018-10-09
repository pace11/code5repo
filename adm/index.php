<?php
    session_start();
    if (!empty($_SESSION['username']) AND !empty($_SESSION['password']))
    {
      include "../lib/connection.php";
      date_default_timezone_set('Asia/Jakarta');
      error_reporting( error_reporting() & ~E_NOTICE )
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CodeFive | Administrasi</title>
  <link rel="icon" href="src/img/icon_dasar.ico" type="image/x-icon">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="src/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="src/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="src/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="src/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="src/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="src/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="src/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="src/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="src/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="src/dist/css/skins/_all-skins.min.css">
  <script type="text/javascript" src="src/bower_components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="src/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="src/bower_components/jquery/src/ajax/script.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet" 
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a class="logo">
      <span class="logo-mini"><i class="fa fa-commenting"></i></span>
      <span class="logo-lg"><i class="fa fa-commenting-o"></i> pa<b>Chat</b> | Admin</span>
    </a>

    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <?php include "navbar.php"; ?>
      </div>
    </nav>
  </header>

  <!-- Sidebar WEB -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <?php include "sidebar.php"; ?>
    </section>
  </aside>
  <!-- Sidebar WEB -->

  <!-- Isi Web -->
  <div class="content-wrapper">
    <?php include "content.php"; ?>
  </div>
  <!-- Isi Web -->

  <f class="main-footer">
    <strong>Copyright &copy; <a href="https://adminlte.io">Admin LTE</a>.</strong>
  </footer>

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="src/bower_components/jquery/dist/jquery.min.js"></script>
<script src="src/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="src/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="src/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="src/bower_components/fastclick/lib/fastclick.js"></script>
<script src="src/dist/js/adminlte.min.js"></script>
<script src="src/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="src/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="src/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="src/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="src/bower_components/chart.js/Chart.js"></script>
<script src="src/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="src/plugins/input-mask/jquery.inputmask.js"></script>
<script src="src/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="src/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="src/bower_components/moment/min/moment.min.js"></script>
<script src="src/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="src/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="src/dist/js/pages/dashboard2.js"></script>
<script src="src/dist/js/demo.js"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>

<script>
  $('[data-mask]').inputmask()
  $(function () {
    $('.select2').select2()
    $('#reservation').daterangepicker()
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'YYYY/MM/DD h:mm A' })

    $('#datepicker').datepicker({
      autoclose: true,
      format: "MM-yyyy",
      startView: "months", 
      minViewMode: "months"
    })
    $('#datepicker1').datepicker({
      autoclose: true,
      format: "MM-yyyy",
      startView: "months", 
      minViewMode: "months"
    })

  })
</script>

</body>
</html>
<?php
}
else { ?>
<div class="col-md-12" align="center">
  <button type="button" name="button" class="btn btn-primary">Login Terlebih dahulu</button>
</div>

<?php echo"<meta http-equiv='refresh' content='1;
url=login.php'>";
} ?>