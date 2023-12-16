<?= $this->extend('app-master') ?>
<?= $this->section('content') ?>
<div class="form-inline">
	<div class="form-group">
		<h3 style="margin-top: 0px;margin-bottom: 15px"><?=$title?></h3>
	</div>
	<div class="pull-right">
		<a class="btn btn-sm btn-primary" href="/kriteria/add"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
	</div>
	<div class="pull-right" style="margin-right: 10px">
		<a class="btn btn-sm btn-success" onclick="reload_table()"><span class="glyphicon glyphicon-refresh"></span> Perbarui</a>
	</div>
</div>
<div class="box box-danger">
	<div class="box-body">
		<div class="table-responsive">
			<table id="table" class="table  table-hover table-striped">
				<thead class="bg-info">
					<tr>
						<th>No</th>
						<th>Kode Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no=1;
					foreach ($rows as $row):?>
						<tr>
							<td><?=$no++?></td>
							<td><?=$row['kode_kriteria']?></td>
							<td><?=$row['nama_kriteria']?></td>
							<td>  
								<a class="btn btn-xs btn-warning" href="<?= base_url("kriteria/view_edit/".$row['kode_kriteria']); ?>"><span class="fa fa-edit"></span></a>
								<a class="btn btn-xs btn-danger" href="<?= base_url("kriteria/delete/".$row['kode_kriteria']); ?>" onclick="return confirm('Hapus data?')"><span class="fa fa-trash"></span></a></td>
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