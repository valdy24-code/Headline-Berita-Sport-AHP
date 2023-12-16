  <?= $this->extend('app-master') ?>
  <?= $this->section('content') ?>
  <div class="form-inline">
    <div class="form-group">
      <h3 style="margin-top: 0px;margin-bottom: 15px"><?=$title?></h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="box box-danger">
        <div class="box-body">
          <?php if($_POST):?>
           <?= \Config\Services::validation()->listErrors() ?>
         <?php endif;?>
         <form class="form-horizontal" method="post" action="/kriteria/update/<?=$row['kode_kriteria']?>">
          
          <div class="form-group">
            <label class="control-label col-md-4" style="text-align: left;">Kode Kriteria</label>
            <div class="col-md-8">
              <input type="text" name="kode" class="form-control" value="<?=$row['kode_kriteria']?>" readonly/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4" style="text-align: left;">Nama Kriteria</label>
            <div class="col-md-8">
              <input type="text" name="nama" class="form-control" value="<?=$row['nama_kriteria']?>"/>
            </div>
          </div>

          
          <div class="form-group">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
              <a href="/kriteria/view" class="btn btn-danger btn-block"> Kembali</a>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-success btn-block"> Simpan</button>
            </div>

          </div>


        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>