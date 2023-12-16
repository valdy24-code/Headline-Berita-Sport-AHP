<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AHP CI 4</title>
  
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

<body class="skin-green layout-top-nav" style="height: auto; min-height: 100%;">
  <div class="wrapper" style="height: auto; min-height: 100%;">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="#" class="navbar-brand"><b> AHP CODEIGNITIER 4</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
          </div>


          <div class="navbar-custom-menu">
           <ul class="nav navbar-nav">
           </ul>
         </div>

       </div>

     </nav>
   </header>

   <div class="content-wrapper" style="min-height: 556px;">
    <div class="container">

      <section class="content">
        <div class="row">
          <div class="col-md-3">
            
          </div>
          <div class="col-md-6">


           <div class="form-inline">
            <div class="form-group">
              <h3 style="margin-top: 0px;margin-bottom: 15px;text-align: center;"><?=$title?></h3>
            </div>
          </div>
          <div class="box box-success">
            <div class="box-body">
             <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>

             <form class="form-horizontal" method="post" action="/login/cek_login">
              <div class="form-group">
                <label class="control-label col-md-4" style="text-align: left;">Username</label>
                <div class="col-md-8">
                  <input type="text" name="username" class="form-control"/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-4" style="text-align: left;">Password</label>
                <div class="col-md-8">
                  <input type="password" name="password" class="form-control"/>
                </div>
              </div>


              


              <div class="form-group">

                <div class="col-md-12">
                  <button type="submit" class="btn btn-success btn-block"> Login</button>
                </div>

              </div>


            </form>
          </div>
        </div>

      </div>
       <div class="col-md-3">
            
          </div>

    </div>

  </section>

</div>

</div>

<footer class="main-footer">
  <div class="container">
    <div class="pull-right hidden-xs">

    </div>
    <strong>Copyright © 2023 AhzafaniMedia.Com
    </div>

  </footer>
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


</body></html>