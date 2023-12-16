<?= $this->extend('app-master') ?>
<?= $this->section('content') ?>
<div class="form-group">
	<h3 style="margin-top: 0px;margin-bottom: 15px"><?=$title?></h3>
</div>
<form class="form-inline">

	<div class="form-group">
		<select class="form-control" name="kode_kriteria" onchange="this.form.submit()">
			<option value="">Pilih Kriteria</option>
			<?php foreach ($rows_kriteria as $row) :
				if(@$_GET['kode_kriteria']==$row['kode_kriteria']):?>
					<option value="<?=$row['kode_kriteria']?>" selected><?=$row['kode_kriteria']?> - <?=$row['nama_kriteria']?></option>
					<?php else:?>
						<option value="<?=$row['kode_kriteria']?>"><?=$row['kode_kriteria']?> - <?=$row['nama_kriteria']?></option>
					<?php endif;?>
				<?php endforeach;?>
			</select>
		</div>
	</form>
	<div class="box box-danger" style="margin-top: 15px;">
		<div class="box-header">
			<?php if($_POST):?>
				<?= \Config\Services::validation()->listErrors() ?>
			<?php endif;?>
			<?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>
			<form class="form-inline" method="post" action="/rel_alternatif/update/<?=@$_GET['kode_kriteria']?>">
				<div class="form-group">
					<select class="form-control" name="kode1" style="margin-right: 10px;">
						<?php foreach ($rows_alternatif as $row) :?>
							<option value="<?=$row['kode_alternatif']?>"><?=$row['kode_alternatif']?> - <?=$row['nama_alternatif']?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control" name="nilai" style="margin-right: 10px;">
						<?=$nilai?>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control" name="kode2" style="margin-right: 10px;">
						<?php foreach ($rows_alternatif as $row) :?>
							<option value="<?=$row['kode_alternatif']?>"><?=$row['kode_alternatif']?> - <?=$row['nama_alternatif']?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i> Ubah</button>
				</div>
			</form>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table class="table  table-hover table-striped">
					<thead class="bg-info">
						<tr>
							<th>Kode</th>
							<?php foreach ($rows_alternatif as $row) :?>
								<th><?=$row['kode_alternatif']?></th>
							<?php endforeach;?>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($rel_alternatif as $key => $value) :?>
							<tr>
								<th><?=$key?></th><?php 
								foreach ($value as $k => $v) :?>
									<td><?=$v?></td>
								<?php endforeach;?>
							</tr>

						<?php endforeach;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#table').DataTable();
		} );

		function reload_table(){
			$('#table').DataTable();
		}
	</script>

	<?= $this->endSection() ?>