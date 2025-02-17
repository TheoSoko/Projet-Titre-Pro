<?php
if(!isset($_SESSION)){
    session_start();
}
include 'controllers/logoutCtrl.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/8932c6358b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Birdland</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-costum py-4">
        <a class="navbar-brand" href="index.php">Birdland</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <span class="nav-item px-2"> <a class="nav-link" href="collection.php" id="tst">Collection</a> </span>
            <span class="nav-item px-2"> <a class="nav-link" href="musiciansList.php">Musiciens</a> </span>
            <span class="nav-item px-2"> <a class="nav-link" href="#">Playlists</a> </span>
            <span class="nav-item px-2"> <a class="nav-link" href="articles.php">Articles</a> </span>
            <div class="dropdown nav-item">
                <?php if (isset($_SESSION['id'])){ ?>
                    <span class="nav-link dropBtn">Compte</span>
                <?php } else {?>
                    <span class="nav-link dropBtn">Connexion</span>
                <?php } ?>
                <div class="dropdownContent bg-dark">
                    <?php if (!isset($_SESSION['id'])){ ?>
                        <span class="dropdownItem text-myColor fs-5 px-3" id="loginButton">Connexion</span>
                        <span id="registrationButton"> <a href="./userRegistration.php" class="text-myColor fs-5 text-decoration-none dropdownItem my-1 px-3">S'inscrire</a></span>
                    <?php } ?>
                    <?php if (isset($_SESSION['id'])){ ?>
                        <span class="dropdownItem text-myColor fs-6 fw-bold px-3" id="navUsername"><?= $_SESSION['username'] ?></span>
                        <a class="dropdownItem text-myColor fs-5 px-3 " href="userProfile.php" id="profileButton">Profil</a>
                        <span class="dropdownItem text-myColor fs-5  px-3" id="logoutButton">Déconnexion</span>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'){ ?>
                            <a class="dropdownItem text-myColor fs-5  px-3" href="officeAddTracks.php" id="profileButton">Back-office: Ajout pistes</a>
                        <?php } } ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Formulaire d'inscription-->
    <!--
    <div class="modalForm pt-1 pb-2 my-3 rounded text-center " id="registrationModal">
        <form method="POST" id="registrationForm">
            <div class="d-flex justify-content-end me-3 closeFormModalDiv"><span class="js-close-form closeFormModal fs-1 fw-bold">&times;</span></div>
            <h2 class="h1 text-myColor mb-4 pb-3">Inscription</h2>
            <div class="my-4" id="emailDivRegister">
                <label for="email" class="d-block text-myColor fs-4 my-2">Votre adresse mail : </label>
                <input type="email" name="emailRegistration" id="emailRegistration" class="fs-5">
            </div>
            <div class="my-4"  id="usernameDivRegister">
                <label for="username" class="d-block text-myColor fs-4 my-2">Votre nom d'utilisateur : </label>
                <input type="text" name="usernameRegistration" id="usernameRegistration" class="fs-5">
            </div>
            <div class="my-4" id="passwordDivRegister">
                <label for="password" class="d-block text-myColor fs-4 my-2">Votre mot de passe : </label>
                <input type="password" name="passwordRegistration" id="passwordRegistration" class="fs-5">
            </div>
            <div class="pb-2"><input type="button" class="registrationSubmit btn btn-secondary fw-bold fs-5 my-4" value="Valider l'inscription" name="registrationSubmit" id="registrationSubmit"></div>
        </form>
    </div>
    -->

    <!-- Formulaire de connexion-->
    <div class="modalForm pt-1 pb-2 my-3 rounded text-center " id="loginModal">
        <form action="" method="POST" id="loginForm">
            <div class="d-flex justify-content-end me-3 closeFormModalDiv"><span class="js-close-form closeFormModal fs-1 fw-bold">&times;</span></div>
            <h2 class="h1 text-myColor mb-4 pb-3">Connexion</h2>
            <div class="my-4">
                <label for="username" class="d-block text-myColor fs-4 my-2">Nom d'utilisateur ou mail : </label>
                <input type="text" name="emailOrUsernameLogin" id="emailOrUsernameLogin" class="fs-5">
            </div>
            <div class="my-4" id="loginPasswordDiv">
                <label for="password" class="d-block text-myColor fs-4 my-2">Mot de passe : </label>
                <input type="password" name="passwordLogin" id="passwordLogin" class="fs-5">
            </div>
            <div class="pb-2"><input type="button" class="loginSubmit btn btn-secondary fw-bold fs-5 my-4" value="Se connecter" name="loginSubmit"></div>
        </form>
    </div>

        <!-- Formulaire de Déconnexion-->
        <div class="modalForm pt-1 pb-2 my-3 rounded text-center" id="logoutModal">
        <form method="POST" id="logoutForm">
            <div class="d-flex justify-content-end me-3 closeFormModalDiv"><span class="js-close-form closeFormModal fs-1 fw-bold">&times;</span></div>
            <h2 class="h1 text-myColor mb-4 pb-3">Êtes-vous certain de vouloir vous déconnecter?</h2>
            <div class="pb-2"><input type="submit" action="#" class="btn btn-secondary fw-bold fs-5 my-2 px-3" value="Oui" name="logoutSubmit"></div>
            <div class="pb-2"><input type="button" class="js-close-form closeFormModal btn btn-secondary fw-bold fs-5 my-2 px-3" value="Non" id="cancelLogout"></div>
        </form>
    </div>



<script src="assets/js/loginUser.js"></script>
<script src="assets/js/logout.js"></script>
<script src="assets/js/accountFromNav.js"></script>