<body>

	<div class="container">
		<div class="row justify-content-center h-100">
			<nav class="navbar bg-body-tertiary bg-secondary fixed-top " style="background-color: rgba(0, 0, 0, 0.4) !important;">
				<div class="container-fluid">
					<div class="navbar-brand">

						<?php
						$image = isset($_SESSION['image']) && ! empty($_SESSION['image']) ? $_SESSION['image'] : 'noProfil.png';
						?>
						<img class="rounded-circle user_img" src="public/image/<?php echo $image ?> ">
						<i class="text-white" style="text-transform: capitalize;"> <?= $_SESSION['pseudo'] ?> </i>
					</div>
					<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon fa-solid fa-burger text-white"></span>
					</button>
					<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
						<div class="offcanvas-header">
							<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<div class="offcanvas-body">
							<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="<?= URL ?>MessageControlleur">Acceuil</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= URL ?>ProfilControlleur">Profil</a>
								</li>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
										Parametres
									</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="#">Action</a></li>
										<li><a class="dropdown-item" href="#">Another action</a></li>
										<li>
											<hr class="dropdown-divider">
										</li>
										<li><a class="dropdown-item" href="#">Something else here</a></li>
									</ul>
								</li>
								<li class="nav-item">
									<a class="nav-link text-danger" href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deconnexion" style="cursor:pointer">Deconnexion</a>
								</li>

							</ul>

						</div>
					</div>
				</div>
			</nav>

		</div>
	</div>

	<div class="modal fade" id="teste" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5 text-success" id="exampleModalLabel">Informations personnelles</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="<?php URL ?>ProfilControlleur/modificationProfil" method="post" enctype="multipart/form-data">
						<input type="hidden" value="<?= $_SESSION['id_connecte'] ?>" name="id">
						<div class=" form-group">
							<label class="form-label" for="image">Image</label>
							<input class="form-control" type="file" name="image" accept="image/*">
						</div>
						<div class=" form-group">
							<label class="form-label" for="pseudo">pseudo</label>
							<input required class="form-control" type="text" value="<?= $_SESSION['pseudo']; ?>" name="pseudo">
						</div>
						<div class=" form-group">
							<label class="form-label" for="email">email</label>
							<input required class="form-control" type="enail" value="<?= $_SESSION['email']; ?>" name="email">
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

					<button class="btn btn-success">Modifier</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deconnexion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Deconnexion</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					vous voulez vraiment deconnecter?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
					<form action="<?= URL ?>MessageControlleur/deconnexion" method="post">
						<button class="btn btn-danger">Deconnecter</button>
					</form>

				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col justify-content-center" style="margin-top: 100px;">
				<div>
					<?php if (isset($_GET['messages'])) {
						# code...
						echo $_GET['messages'];
					} ?>
				</div>
				<div class="contain-profil table-responsive">
					<table class="table text-white">
						<thead>
							<tr>
								<th>Image</th>
								<th>Pseudo</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php
								$image = "";
								if (isset($_SESSION['image']) && $_SESSION['image'] != null) {
									$image = $_SESSION['image'];
								} else {
									$image = "noProfil.png";
								}
								?>
								<td><img class="user_img rounded rounded-pill" src="public/image/<?= $image; ?>" alt=""></td>
								<td style="text-transform: capitalize;"><?= $_SESSION['pseudo']; ?></td>
								<td><?= $_SESSION['email']; ?></td>
								<td><i class="fa fa-edit" style="font-size: 26px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teste"></i></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>