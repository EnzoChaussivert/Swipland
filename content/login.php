<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>FilmIt!</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'><link rel="stylesheet" href="styles/style_login.css">

</head>
<body>
<div class="container right-panel-active" id="container">
	<div class="form-container sign-in-container">
		<form action="connexion.php" method="POST">
			<h2>Connexion</h2>
			<input type="email" name="courriel" placeholder="Email" />
			<input type="password" name="mot_de_passe" placeholder="Mot de passe" />
			<div class="links">
				<a href="#" >Mot de passe oublié ?</a>
				<a href="#" id="signUp">S'inscrire</a>
			</div>
			<button type="submit">Se connecter</button>
		</form>
	</div>
	
	<div class="form-container sign-up-container">
    <form action="inscription.php" method="POST">
        <h2>Créer un compte</h2>
        <input type="text" name="nom" placeholder="Nom d'utilisateur" />
        <input type="email" name="courriel" placeholder="Email" />
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" />
        <div class="links">
            <a href="#" id="signIn">Se connecter</a>
        </div>
        <button type="submit">Sinscrire</button>
    </form>
	</div>
	
	<div class="overlay-container">
		<div class="overlay">

			<div class="overlay-panel overlay-right">
				<img src="images/logo.png" class="logo">
				<h1 class="visible">FilmIt!</h1>
				<p class="visible">Find the film you want to watch now</p>
				<button class="ghost" onclick="window.location.href = 'index.php';">ENTRER</button>
			</div>
			<div class="overlay-panel overlay-left">
				<img src="images/logo.png" class="logo">
				<h1 class="visible">FilmIt!</h1>
				<p class="visible">Find the film you want to watch now</p>
				<button class="ghost" onclick="window.location.href = 'index.php';">ENTRER</button>
			
			</div>
		</div>
	</div>
</div>

<script  src="scripts/script_login.js"></script>

</body>
</html>
