<?php
$title = "Admin";
include("layout/header.php");
$_SESSION['role'] != 1 ? header("Location: /") : "";

if (isset($_POST['simpan_data'])) {
	$target_dir = "img/profile/";
	$temp = explode(".", $_FILES["foto_pjb"]["name"]);
	$newfilename = $id . '.' . end($temp);
	$target_file = $target_dir . $newfilename;

	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	$uploadOk = getimagesize($_FILES["foto_pjb"]["tmp_name"]) !== false ? 1 : 0;
	$uploadOk = $_FILES["foto_pjb"]["size"] <= 10000000 ? 1 : 0;

	file_exists("img/profile/" . $ambil['foto']) ? unlink("img/profile/" . $ambil['foto']) : "";
	if ($uploadOk <> 0) {
		if (move_uploaded_file($_FILES["foto_pjb"]["tmp_name"], $target_file)) {
			$foto = $newfilename;
		}
	}

	$foto_pjb = $foto;
	$nama_pjb = $_POST['nama_pjb'];
	$nip_pjb = $_POST['nip_pjb'];
	$jabatan_pjb = $_POST['jabatan_pjb'];
	$hp_pjb = $_POST['hp_pjb'];
	$alamat_pjb = $_POST['alamat_pjb'];

	$mysqli->query("INSERT INTO pejabat(
		nama,
		nip,
		no_hp,
		alamat,
		jabatan,
		foto
	) VALUES (
		'$nama_pjb',
		'$nip_pjb',
		'$hp_pjb',
		'$alamat_pjb',
		'$jabatan_pjb',
		'$foto_pjb'
	)") ? header("Refresh:0") : "";
}
?>

<style>
	.coba img {
		min-width: 100%;
		width: 100%;
		height: 5rem;
		/* cursor: move; */
	}

	.coba>div {
		overflow: hidden;
	}
</style>

<!-- SECONDARY NAVBAR -->
<div class="nav-scroller bg-light shadow-sm">
	<div class="container">
		<nav class="nav nav-underline py-1" aria-label="Secondary navigation">
			<span class="navbar-brand">Daftar Pengguna</span>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Tambah
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#tambah">Pengguna</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal_bagian_edit">Bagian</a></li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal_subbagian_edit">Sub-Bagian</a></li>
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal_jabatan_edit">Jabatan</a></li>
				</ul>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Pengaturan
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#slider_edit">Slider</a></li>
					<!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#jabatan_edit">Bagian/Sub-bagian/Jabatan</a></li> -->
				</ul>
			</li>
			<a class="nav-link" href="riwayat.php">Riwayat</a>
			<section class="ms-auto">
				<input class="form-control" type="search" placeholder="Cari Pejabat" aria-label="Search">
			</section>
		</nav>
	</div>
</div>

<!-- MODAL SLIDER -->
<div class="modal fade" id="slider_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Gambar Slider</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body text-center">
					<div class="px-3">
						<!-- FORM UPLOAD GAMBAR -->
						<!-- <div class="mb-3 row">
							<form action="" method="post" enctype="multipart/form-data">
								<input class="form-control" type="file" id="formFile" accept="image/*">
								<input class="mt-3 btn btn-primary" type="submit" value="Simpan Gambar" name="submit">
							</form>
						</div> -->
						<!-- THUMBNAIL VIEWER -->
						<div class="mb-1 row d-block text-center coba">
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide1.jpg" alt="">
							</div>
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide2.jpg" alt="">
							</div>
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide3.jpg" alt="">
							</div>
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide4.jpg" alt="">
							</div>
							<div class="col-sm-2 d-inline-block rounded p-0">
								<img class="align-top" src="img/slide5.jpg" alt="">
							</div>
						</div>
						<div class="row d-block text-center">
							<div class="col-sm-2 d-inline-block">
								<button class="btn btn-primary btn-sm">Ganti</button>
							</div>
							<div class="col-sm-2 d-inline-block">
								<button class="btn btn-primary btn-sm">Ganti</button>
							</div>
							<div class="col-sm-2 d-inline-block">
								<button class="btn btn-primary btn-sm">Ganti</button>
							</div>
							<div class="col-sm-2 d-inline-block">
								<button class="btn btn-primary btn-sm">Ganti</button>
							</div>
							<div class="col-sm-2 d-inline-block">
								<button class="btn btn-primary btn-sm">Ganti</button>
							</div>
						</div>
						<i class="text-muted mt-3 d-block">Recommended image ratio: 1625 x 900 pixel (65:36)</i>
					</div>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL TAMBAH PENGGUNA -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
				</div>
				<div class="modal-body">
					<!-- ISI MODAL START HERE -->
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Foto</label>
						<div class="col-sm-10">
							<input name="foto_pjb" type="file" class="form-control" accept="image/*" required>
							<div class="mt-1">
								<small class="text-muted">
									<i>Disarankan menggunakan gambar rasio 1:1 (persegi)</i>
								</small>
							</div>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input name="nama_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">NIP</label>
						<div class="col-sm-10">
							<input name="nip_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Jabatan</label>
						<div class="col-sm-10">
							<input name="jabatan_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">No. HP</label>
						<div class="col-sm-10">
							<input name="hp_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Alamat</label>
						<div class="col-sm-10">
							<input name="alamat_pjb" type="text" class="form-control" required>
						</div>
					</div>
					<!-- ISI MODAL END HERE -->
				</div>
				<div class="modal-footer">
					<button type="submit" name="simpan_data" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL BAGIAN -->
<div class="modal fade" id="modal_bagian_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Bagian</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Bagian</th>
								<th>Pilihan</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$query = $mysqli->query("SELECT * FROM bagian ORDER BY nama_bagian ASC");
							if (mysqli_num_rows($query) == 0) {
							?>

								<tr>
									<td colspan="3" class="text-center"><i>Tidak ada data!</i></td>
								</tr>

								<?php
							} else {
								$num = 0;
								while ($result = mysqli_fetch_array($query)) {
									$id_bagian = $result['id'];
									$nama_bagian = $result['nama_bagian'];
									$num++;
								?>

									<tr>
										<th><?= $num ?></th>
										<td><?= $nama_bagian ?></td>
										<td>
											<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_bagian_<?= $num ?>" aria-expanded="false" aria-controls="edit_bagian_<?= $num ?>"><i class="bi bi-pencil-square"></i></button>
											<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="collapse" id="edit_bagian_<?= $num ?>">
											<div class="row">
												<div class="col-sm-11">
													<input name="bagian_<?= $id_bagian ?>" type="text" class="form-control" required value="<?= $nama_bagian ?>">
												</div>
												<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
											</div>
										</td>
									</tr>

							<?php
								}
							}
							?>

						</tbody>
					</table>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Tambah Bagian</label>
						<div class="col-sm-8">
							<input name="tambah_bagian" type="text" class="form-control" required>
						</div>
						<button class="col-sm-1 btn btn-success"><i class="bi bi-plus-lg"></i></button>
					</div>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL SUBBAGIAN -->
<div class="modal fade" id="modal_subbagian_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Sub-Bagian</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Sub-Bagian</th>
								<th>Bagian</th>
								<th>Pilihan</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$query = $mysqli->query("SELECT * FROM subbagian INNER JOIN bagian ON subbagian.id_bagian = bagian.id ORDER BY subbagian.id_bagian ASC");
							if (mysqli_num_rows($query) == 0) {
							?>

								<tr>
									<td colspan="4" class="text-center"><i>Tidak ada data!</i></td>
								</tr>

								<?php
							} else {
								$num = 0;
								while ($result = mysqli_fetch_array($query)) {
									$id_subbagian = $result['id'];
									$nama_subbagian = $result['nama_subbagian'];
									$id_bagian = $result['id_bagian'];
									$nama_bagian = $result['nama_bagian'];
									$num++;
								?>

									<tr>
										<th><?= $num ?></th>
										<td><?= $nama_subbagian ?></td>
										<td><?= $nama_bagian ?></td>
										<td>
											<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_subbagian_<?= $num ?>" aria-expanded="false" aria-controls="edit_subbagian_<?= $num ?>"><i class="bi bi-pencil-square"></i></button>
											<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
										</td>
									</tr>
									<tr>
										<td colspan="4" class="collapse" id="edit_subbagian_<?= $num ?>">
											<div class="row">
												<div class="col-sm-7">
													<input name="subbagian_<?= $id_subbagian ?>" type="text" class="form-control" required value="<?= $nama_subbagian ?>">
												</div>
												<div class="col-sm-4">
													<select class="form-select" name="edit_nama_bagian_<?= $id_subbagian ?>">
														<option value="" selected>== Pilih jenis bagian ==</option>
														<?php
														$subquery = $mysqli->query("SELECT * FROM bagian ORDER BY nama_bagian ASC");
														while ($result = mysqli_fetch_array($subquery)) {
															$select_id_bagian = $result['id'];
															$select_nama_bagian = $result['nama_bagian'];
														?>
															<option value="<?= $select_id_bagian ?>" <?= $select_id_bagian == $id_bagian ? 'selected' : '' ?> ><?= $select_nama_bagian ?></option>
														<?php
														}
														?>
													</select>
												</div>
												<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
											</div>
										</td>
									</tr>

							<?php
								}
							}
							?>

						</tbody>
					</table>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Tambah Bagian</label>
						<div class="col-sm-8">
							<input name="tambah_subbagian" type="text" class="form-control" required>
						</div>
						<button class="col-sm-1 btn btn-success"><i class="bi bi-plus-lg"></i></button>
					</div>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL JABATAN -->
<div class="modal fade" id="modal_jabatan_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="m-0 p-0" method="POST" action="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pengaturan Jabatan</h5>
				</div>
				<!-- ISI MODAL START HERE -->
				<div class="modal-body px-4">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Jabatan</th>
								<th>Sub-Bagian</th>
								<th>Bagian</th>
								<th>Pilihan</th>
							</tr>
						</thead>
						<tbody>

							<?php
							$query = $mysqli->query("SELECT jabatan.*, a.nama_subbagian, b.nama_bagian FROM jabatan LEFT JOIN subbagian AS a ON jabatan.id_subbagian = a.id LEFT JOIN bagian AS b ON jabatan.id_bagian = b.id ORDER BY jabatan.nama_jabatan ASC");
							if (mysqli_num_rows($query) == 0) {
							?>

								<tr>
									<td colspan="5" class="text-center"><i>Tidak ada data!</i></td>
								</tr>

								<?php
							} else {
								$num = 0;
								while ($result = mysqli_fetch_array($query)) {
									$id_jabatan = $result['id'];
									$nama_jabatan = $result['nama_jabatan'];

									$id_subbagian = $result['id_subbagian'];
									$nama_subbagian = $result['nama_subbagian'] ?? "-";

									$id_bagian = $result['id_bagian'];
									$nama_bagian = $result['nama_bagian'];
									
									$num++;
								?>

									<tr>
										<th><?= $num ?></th>
										<td><?= $nama_jabatan ?></td>
										<td><?= $nama_subbagian ?></td>
										<td><?= $nama_bagian ?></td>
										<td>
											<button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#edit_jabatan_<?= $num ?>" aria-expanded="false" aria-controls="edit_jabatan_<?= $num ?>"><i class="bi bi-pencil-square"></i></button>
											<button class="btn btn-danger"><i class="bi bi-trash"></i></button>
										</td>
									</tr>
									<tr>
										<td colspan="5" class="collapse" id="edit_jabatan_<?= $num ?>">
											<div class="row">
												<div class="col-sm-5">
													<input name="jabatan_<?= $id_jabatan ?>" type="text" class="form-control" required value="<?= $nama_jabatan ?>">
												</div>
												<div class="col-sm-3">
													<select class="form-select" name="edit_nama_subbagian_<?= $id_jabatan ?>">
														<option value="" selected>== Pilih jenis sub bagian ==</option>
														<?php
														$subquery = $mysqli->query("SELECT * FROM subbagian ORDER BY nama_subbagian ASC");
														while ($result = mysqli_fetch_array($subquery)) {
															$select_id_subbagian = $result['id'];
															$select_nama_subbagian = $result['nama_subbagian'];
														?>
															<option value="<?= $select_id_subbagian ?>" <?= $select_id_subbagian == $id_subbagian ? 'selected' : '' ?> ><?= $select_nama_subbagian ?></option>
														<?php
														}
														?>
													</select>
												</div>
												<div class="col-sm-3">
													<select class="form-select" name="edit_nama_bagian_<?= $id_jabatan ?>">
														<option value="" selected>== Pilih jenis bagian ==</option>
														<?php
														$subquery = $mysqli->query("SELECT * FROM bagian ORDER BY nama_bagian ASC");
														while ($result = mysqli_fetch_array($subquery)) {
															$select_id_bagian = $result['id'];
															$select_nama_bagian = $result['nama_bagian'];
														?>
															<option value="<?= $select_id_bagian ?>" <?= $select_id_bagian == $id_bagian ? 'selected' : '' ?> ><?= $select_nama_bagian ?></option>
														<?php
														}
														?>
													</select>
												</div>
												<button class="col-sm-1 btn btn-success"><i class="bi bi-check-lg"></i></button>
											</div>
										</td>
									</tr>

							<?php
								}
							}
							?>

						</tbody>
					</table>
					<div class="mb-3 row">
						<label class="col-sm-3 col-form-label">Tambah Bagian</label>
						<div class="col-sm-8">
							<input name="tambah_jabatan" type="text" class="form-control" required>
						</div>
						<button class="col-sm-1 btn btn-success"><i class="bi bi-plus-lg"></i></button>
					</div>
				</div>
				<!-- ISI MODAL END HERE -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<main>
	<div class="pt-4 pb-3">
		<div class="container-sm pb-3">
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

				<?php
				$query = $mysqli->query("SELECT * FROM pejabat ORDER BY nama ASC");
				if (mysqli_num_rows($query) == 0) {
					echo "TIDAK ADA DATA";
				} else {
					while ($result = mysqli_fetch_array($query)) {
						$username_pejabat = $result['username_pejabat'];
						$nama = $result['nama'];
						$nip = $result['nip'];
						$no_hp = $result['no_hp'];
						$alamat = $result['alamat'];
						$foto = $result['foto'];
						$id = encrypt_decrypt("e", $username_pejabat);
				?>

						<div class="col">
							<div class="card shadow-sm">
								<div class="card-header warna-dasar">
									<?= $nama ?>
								</div>
								<div style="height: 309px; overflow: hidden;">
									<img style="width: 100%;height: 100%;" src="./img/profile/<?= $foto ?>">
								</div>
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center">
										<div class="btn-group">
											<a href="detail.php?id=<?= $id ?>" type="button" class="btn btn-sm btn-outline-primary">Detail</a>
											<button type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
										</div>
										<small class="text-success">Ada</small>
									</div>
								</div>
							</div>
						</div>

				<?php
					}
				}
				?>

			</div>
		</div>

		<!-- Pagination Mulai -->
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- Pagination Selesai -->

	</div>
</main>

<?php
include("layout/footer.php");
?>