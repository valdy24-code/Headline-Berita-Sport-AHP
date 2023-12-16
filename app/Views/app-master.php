
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AHP</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url('/')?>assets/adminlte/bower/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url('/')?>assets/adminlte/bower/datatables/css/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?=base_url('/')?>assets/adminlte/bower/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url('/')?>assets/adminlte/bower/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=base_url('/')?>assets/adminlte/bower/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url('/')?>assets/adminlte/bower/morris.js/morris.css">
  <link rel="stylesheet" href="<?=base_url('/')?>assets/adminlte/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url('/')?>assets/adminlte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?=base_url('/')?>assets/adminlte/bower/jquery/jquery-2.1.4.min.js"></script>
  <script src="<?=base_url('/')?>assets/adminlte/bower/morris.js/morris.js"></script>
  <script src="<?=base_url('/')?>assets/adminlte/bower/raphael/raphael.min.js"></script>

</head>
<body class="hold-transition skin-red-light sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="index2.html" class="logo">
        <span class="logo-mini"><b>AHP CI </b></span>
        <span class="logo-lg"><b>AHP CI 4</b></span>
      </a>

      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
           <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url('/')?>assets/adminlte/dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><b></b></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?=base_url('/')?>assets/adminlte/dist/img/avatar5.png" style="margin-bottom: 30px;" class="img-circle" alt="User Image">

                <p>
                  <?=session()->get('username')?>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="/login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url('/')?>assets/adminlte/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?=session()->get('username')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> 
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN MENU</li>
      
        <li><a href="/"><i class="text-info fa fa-home"></i><span> Dashboard</span></a></li>
        <li><a href="/alternatif/view"><i class="text-info fa fa-id-card"></i><span> Alternatif </span></a>
          <li><a href="/kriteria/view"><i class="text-info fa fa-cogs"></i><span> Kriteria</span></a></li>
          <li><a href="/rel_alternatif/view"><i class="text-info fa fa-check-square-o"></i><span> Nilai Alternatif</span></a></li>
          <li><a href="/rel_kriteria/view"><i class="text-info fa fa-id-card-o"></i><span> Nilai Kriteria</span></a></li>
          <li><a href="/hitung/view"><i class="text-info fa fa-list"></i><span> Perhitungan</span></a></li>
         
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content container-fluid">  
     <?= $this->renderSection('content') ?>
   </section>
 </div>

 <footer class="main-footer">

  <strong>Copyright &copy; 2023 <b>AhzafaniMedia.Com </b>.</strong> 
</footer>

<aside class="control-sidebar control-sidebar-dark">
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul>
</aside>
<div class="control-sidebar-bg"></div>
</div>
<script>
  $(function () {
    $('.select2').select2()
  });
</script>
<script src="<?=base_url('/')?>assets/adminlte/bower/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url('/')?>assets/adminlte/bower/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('/')?>assets/adminlte/dist/js/jquery.number.js"></script>
<script src="<?=base_url('/')?>assets/adminlte/bower/datatables/js/dataTables.bootstrap.js"></script>
<script src="<?=base_url('/')?>assets/adminlte/bower/fastclick/lib/fastclick.js"></script>
<script src="<?=base_url('/')?>assets/adminlte/bower/chart.js/Chart.js"></script>
<script src="<?=base_url('/')?>assets/adminlte/bower/select2/dist/js/select2.full.min.js"></script>
<script src="<?=base_url('/')?>assets/adminlte/dist/js/adminlte.min.js"></script>

<script src="<?=base_url('/')?>assets/adminlte/dist/js/demo.js"></script>
