

<div class="wrapper wrapper-connexion">
  <div style="text-align: center;">
    <?php
        if (isset($_GET['message'])) {
          echo $_GET['message'];
        }
    ?>

    <?php if (! empty($message)): ?>
      <?php $safe       = htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
      <?php $alertClass = ($type === 'success') ? 'alert alert-success alert-dismissible fade show' : 'alert alert-danger alert-dismissible fade show'; ?>
      <div id="flash-message" class="<?php echo $alertClass ?>" role="alert"><?php echo $safe ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
  </div>
    <form action="<?php URL ?>InscriptionControlleur/verificationConnexion" method="post">
      <h1>Connexion</h1>
      <div class="input-box">
        <input type="text" placeholder="Pseudo" name="pseudo" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Mot de passe" name="password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox">Se souvient de moi?</label>
        <a href="#">Mot de passe oublie?</a>
      </div>
      <button type="submit" class="btn btn-connecter">Se connecter</button>
      <div class="register-link">
        <p>vous n'avez pas de compte? <a href="#" id="inscrire">S'inscrire</a></p>
      </div>
    </form>
  </div>




  <!-- page d'inscription -->
<div class="wrapper wrapper-inscription d-none">
    <form action="<?php echo URL ?>InscriptionControlleur/insert" method="post" enctype="multipart/form-data">
      <h1>Inscription</h1>
      <div class="input-box">
        <input type="text" placeholder="Pseudo" name="pseudo" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="mail" placeholder="E-mail" name="email" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Mot de passe" name="password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <div class="input-box">
        <input type="file" placeholder="Mot de passe" accept="image/*" name="image">
        <i class='bx bxs-lock-alt' ></i>
      </div>



      <div class="remember-forgot">
        <label><input type="checkbox">Se souvient de moi?</label>
        <a href="#">Mot de passe oublie?</a>
      </div>
      <button type="submit" class="btn btn-inscrire">S'inscrire</button>
      <div class="register-link">
        <p>vous avez deja un compte? <a href="#" class="connecter">Se connecter</a></p>
      </div>
    </form>
  </div>
