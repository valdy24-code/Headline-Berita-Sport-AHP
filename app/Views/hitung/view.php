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

</div>
<div class="box-body">
	<div class="table-responsive">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<div class="box-header">
						<h3 class="panel-title"><b>Mengukur Konsistensi Kriteria</b></h3>
					</div>
					<div class="box_content">
						<div class="box box-danger">
							<div class="box-header">
								<h3 class="panel-title">
									Matriks Perbandingan Kriteria
								</h3>
							</div>
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Kode</th>
											<?php foreach ($KRITERIA as $key => $val) : ?>
												<th><?= $val['nama_kriteria']	 ?></th>
											<?php endforeach ?>
										</tr>
									</thead>
									<?php
                        //echo '<pre>' . print_r($matriks, 1) . '</pre>';
									foreach ($rel_kriteria as $key => $val) : ?>
										<tr>
											<th><?= $key ?></th>
											<?php foreach ($val as $k => $v) : ?>
												<td><?= round($v, 3) ?></td>
											<?php endforeach ?>
										</tr>
									<?php endforeach ?>
									<tr>
										<td>Total</td>
										<?php foreach ($total as $k => $v) : ?>
											<td><?= round($v, 3) ?></td>
										<?php endforeach ?>
									</tr>
								</table>
							</div>
						</div>
						<div class="box box-danger">
							<div class="box-header">
								<h3 class="panel-title">
									<a data-toggle="" href="#c12">
										Matriks Bobot Prioritas Kriteria
									</a>
								</h3>
							</div>
							<div class="table-responsive " id="c12">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Kode</th>
											<?php foreach ($KRITERIA as $key => $val) : ?>
												<th><?= $val['nama_kriteria'] ?></th>
											<?php endforeach ?>
											<th>Prioritas</th>
										</tr>
									</thead>
									<?php foreach ($ahp_normal as $key => $val) : ?>
										<tr>
											<td><?= $key ?></td>
											<?php foreach ($val as $k => $v) : ?>
												<td><?= round($v, 3) ?></td>
											<?php endforeach ?>
											<td><?= round($rata[$key], 3) ?></td>
										</tr>
									<?php endforeach ?>
								</table>
							</div>
						</div>
						<div class="box box-danger">
							<div class="box-header">
								<h3 class="panel-title">
									<a data-toggle="" href="#c13">
										Matriks Konsistensi Kriteria
									</a>
								</h3>
							</div>
							<div class="table-responsive " id="c13">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Kode</th>
											<?php foreach ($KRITERIA as $key => $val) : ?>
												<th><?= $val['nama_kriteria'] ?></th>
											<?php endforeach ?>
											<th>Consistency Measure</th>
										</tr>
									</thead>
									<?php foreach ($ahp_normal as $key => $val) : ?>
										<tr>
											<td><?= $key ?></td>
											<?php foreach ($val as $k => $v) : ?>
												<td><?= round($v, 3) ?></td>
											<?php endforeach ?>
											<td><?= round($cm[$key], 3) ?></td>
										</tr>
									<?php endforeach ?>
								</table>
							</div>
							<div class="box_content">
								Berikut tabel ratio index berdasarkan ordo matriks.
							</div>
							<div class="table-responsive">
								<table class="table table-bordered">
									<tr>
										<th>Ordo matriks</th>
										<?php
										foreach ($nRI as $key => $value) {
											if (count($KRITERIA) == $key)
												echo "<td class='text-primary'>$key</td>";
											else
												echo "<td>$key</td>";
										}
										?>
									</tr>
									<tr>
										<th>Ratio index</th>
										<?php
										foreach ($nRI as $key => $value) {
											if (count($KRITERIA) == $key)
												echo "<td class='text-primary'>$value</td>";
											else
												echo "<td>$value</td>";
										}
										?>
									</tr>
								</table>
							</div>
							<div class="panel-footer">
								<?php
								$CI = ((array_sum($cm) / count($cm)) - count($cm)) / (count($cm) - 1);
								$RI = $nRI[count($KRITERIA)];
								$CR = $CI / $RI;
								echo "<p>Consistency Index: " . round($CI, 3) . "<br />";
								echo "Ratio Index: " . round($RI, 3) . "<br />";
								echo "Consistency Ratio: " . round($CR, 3);
								if ($CR > 0.10) {
									echo " (Tidak konsisten)<br />";
								} else {
									echo " (Konsisten)<br />";
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-danger box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Perhitungan Akhir</h3>

			</div>

			<div class="box-body">
				<div class="box box-danger">
					<div class="box-header">
						<h3 class="panel-title">Matriks Perbandingan Alternatif</h3>
					</div>
					<div class="box_content">
						<?php foreach ($rel_alternatif as $key => $value):?>
							<div class="panel panel-success">
								<div class="box-header">
									<h3 class="panel-title">Matriks Perbandingan Alternatif berdasarkan <strong><?=$KRITERIA[$key]['nama_kriteria']?></strong></h3>
								</div>
								<div class="box_content">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Kode</th>
													<?php foreach ($ALTERNATIF as $k => $v) : ?>
														<th><?= $v['nama_alternatif'] ?></th>
													<?php endforeach ?>
												</tr>
											</thead>
											<?php
                        //echo '<pre>' . print_r($matriks, 1) . '</pre>';
											foreach ($value as $k => $v) : ?>
												<tr>
													<th><?= $k ?></th>
													<?php foreach ($v as $ka => $va) : ?>
														<td><?= round($va, 3) ?></td>
													<?php endforeach ?>
												</tr>
											<?php endforeach ?>
											<tr>
												<td>Total</td>
												<?php foreach ($total_alternatif[$key] as $k => $v) : ?>
													<td><?= round($v, 3) ?></td>
												<?php endforeach ?>
											</tr>
										</table>
									</div>
								</div>
								<div class="box-danger">
									<div class="box-header">
										<h3 class="panel-title">

											Matriks Bobot Prioritas Alternatif berdasarkan <strong><?=$KRITERIA[$key]['nama_kriteria']?>

										</h3>
									</div>
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Kode</th>
													<?php foreach ($ALTERNATIF as $k => $v) : ?>
														<th><?= $v['nama_alternatif'] ?></th>
													<?php endforeach ?>
													<th>Bobot</th>
												</tr>
											</thead>
											<?php foreach ($ahp_normal_alternatif[$key] as $k => $v) : ?>
												<tr>
													<td><?= $k ?></td>
													<?php foreach ($v as $ka => $va) : ?>
														<td><?= round($va, 3) ?></td>
													<?php endforeach ?>
													<td><?= round($rata_alternatif[$key][$k], 3) ?></td>
												</tr>
											<?php endforeach ?>
										</table>
									</div>
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>
				<div class="box_panel tile">
						<div class="box_title">
							<h3 class="panel-title"><b>Hasil Analisa</b></h3>
						</div>
						<div class="box_content">
							<div class="panel panel-success">
								<div class="box_title">
									<h3 class="panel-title">VEKTOR EIGEN ALTERNATIF DAN KRITERIA</h3>
								</div>
								<div class="box_content">
									<div class="table-responsive">
										<table class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Kode</th>
													<?php foreach ($KRITERIA as $k => $v) : ?>
														<th><?= $k ?></th>
													<?php endforeach ?>
													<th>Nilai</th>
													<th>Rank</th>
												</tr>
											</thead>
											<tr>
												<th>&nbsp;</th>
												<?php foreach ($total as $k => $v) : ?>
													<td><?= round($v, 3) ?></td>
												<?php endforeach ?>
											</tr>
											<?php 
											$newdata=array();
											foreach ($rata_alternatif as $key => $value) {
												foreach ($value as $k => $v) {
													$newdata[$k][$key]=$v;
												}
											}
											foreach ($newdata as $key => $value):?>
												<tr>
													<th><?=$key?> - <?=$ALTERNATIF[$key]['nama_alternatif']?></th>
													<?php foreach ($value as $k => $v):?>
														<td><?=$v?></td>
													<?php endforeach;?>
													<th><?=$nilai[$key]?></th>
													<th><?=$rank[$key]?></th>
												</tr>
											<?php endforeach;?>
										</table>
									</div>
								</div>

							</div>
							
						</div>

					</div>
			</div>

		</div>
	</div>
</div>




<?= $this->endSection() ?>