<!-- bouton modal bootstrap -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deconnexion">
  Launch demo modal
</button> -->

<!-- Modal -->
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

<div class="container-fluid h-100">

	<h1 class="d-none id_connecte"> <?php echo $_SESSION['id_connecte'] ?> </h1>
	<h1 class="d-none id_receiver"></h1>
	<h1 class="d-none img-receiver"></h1>


	<div class="row row-cols-1 justify-content-center  h-100">
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
								<a class="nav-link active" aria-current="page" href="#">Acceuil</a>
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




		<div class="col-md-4 col-xl-3 chat chat1">
			<div class="card mb-sm-3 mb-md-0 contacts_card">
				<div class="card-header">
					<div class="list-user">
						<a href="#teste"><i class="fa-solid fa-arrow-right"></i></a>

						<?php if (count($allUsers) > 0): ?>

							<?php foreach ($allUsers as $key => $value): ?>

								<?php if ($value['pseudo'] !== $_SESSION['pseudo']): ?>

									<a href="#teste" data-image="<?php echo isset($value['image']) && ! empty($value['image']) ? $value['image'] : 'noProfil.png'; ?>" data-id="<?php echo $value['idUsers'] ?>" data-pseudo="<?php echo $value['pseudo'] ?>" style="cursor:pointer" class="d-flex flex-column justify-content-center align-items-center pseudo-allUsers">
										<?php
										$img     = isset($value['image']) && ! empty($value['image']) ? $value['image'] : 'noProfil.png';
										$safeImg = htmlspecialchars($img, ENT_QUOTES, 'UTF-8');
										?>
										<img src="<?php echo URL ?>public/image/<?php echo $safeImg ?>" alt="<?php echo htmlspecialchars($value['pseudo'], ENT_QUOTES, 'UTF-8') ?>" class="rounded-circle user_img" onerror="this.onerror=null;this.src='<?php echo URL ?>public/image/default.png';">
										<i class="text-white text-capitalize "><?php echo htmlspecialchars($value['pseudo'], ENT_QUOTES, 'UTF-8') ?></i>
								</a>

								<?php endif; ?>

							<?php endforeach; ?>

						<?php else: ?>
							<p class="text-danger text-capitalize text-center">Aucun utilisateur trouvé.</p>
						<?php endif; ?>



					</div>
					<div class="input-group">
						<input type="text" placeholder="Search..." name="" class="form-control search">
						<div class="input-group-prepend">
							<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
						</div>
					</div>
				</div>

				<!-- liste conversations recentes -->
				<div class="card-body contacts_body">
					<ul class="contacts">
						<!-- <li class="active">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Khalid Charif</span>
									<p>Online</p>
								</div>
							</div>
						</li> -->

					</ul>
				</div>
				<div class="card-footer">
					<small class="text-secondary"> <--- copyright by manoyfinaritra @2025 </small>
				</div>
			</div>
		</div>

		<!-- liste de conversation -->
		<div class="col-md-8 col-xl-6 chat chat2 d-none d-md-block" id="teste">
			<div class="card">
				<div class="card-header msg_head">
					<div class="d-flex bd-highlight">
						<div class="img_cont">
							<img class="rounded-circle user_img imgTosendMessage">
							<span class="online_icon"></span>
						</div>


						<div class="user_info">
							<span class="nomUserstoSendMessage" style="text-transform: capitalize;">Personne</span>
							<p class="totalMessage">1767 Messages</p>
						</div>
						
					</div>
					<span id="action_menu_btn"><i class="troisPoints fas fa-ellipsis-v"></i></span>
					<span id="action_menu_btn2" style="display: none;"><i class="fa-solid fa-arrow-right"></i></span>
					<div class="action_menu">
						<ul>
							<li><i class="fas fa-user-circle"></i><a style="text-decoration:none; color:white" href="<?= URL ?>ProfilControlleur"> Voir le profil</a></li>
							<li><i class="fas fa-plus"></i> Ajouter dans groupe</li>
							<li><i class="fas fa-ban"></i> Bloquer</li>
						</ul>
					</div>
				</div>
				<div class="card-body msg_card_body">

					<!-- <div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
									Hi, how are you samim?
									<span class="msg_time">8:40 AM, Today</span>
								</div>
							</div>

							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
									Hi Khalid i am good tnx how about you?
									<span class="msg_time_send">8:55 AM, Today</span>
								</div>
								<div class="img_cont_msg">
										<img src="https://avatars.hsoubcdn.com/ed57f9e6329993084a436b89498b6088?s=256" class="rounded-circle user_img_msg">
								</div>
							</div> -->


				</div>

				<div class="card-footer">
					<form class="input-group" method="post">
						<div class="input-group-append">
							<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
						</div>

						<textarea class="form-control type_msg" placeholder="Ecrire votre message ici..." name="contenu"></textarea>

						<div class="input-group-append">
							<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
</div>