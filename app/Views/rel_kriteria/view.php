<?= $this->extend('app-master') ?>
<?= $this->section('content') ?>
<div class="form-group">
	<h3 style="margin-top: 0px;margin-bottom: 15px"><?=$title?></h3>
</div>

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
			<form class="form-inline" method="post" action="/rel_kriteria/update">
				<div class="form-group">
					<select class="form-control" name="kode1" style="margin-right: 10px;">
						<?php foreach ($rows_kriteria as $row) :?>
							<option value="<?=$row['kode_kriteria']?>"><?=$row['kode_kriteria']?> - <?=$row['nama_kriteria']?></option>
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
						<?php foreach ($rows_kriteria as $row) :?>
							<option value="<?=$row['kode_kriteria']?>"><?=$row['kode_kriteria']?> - <?=$row['nama_kriteria']?></option>
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
							<?php foreach ($rows_kriteria as $row) :?>
								<th><?=$row['kode_kriteria']?></th>
							<?php endforeach;?>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($rel_kriteria as $key => $value) :?>
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


	<?= $this->endSection() ?>