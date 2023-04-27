<!DOCTYPE html>
<html>
<head>
	<title>Créer un compte</title>
</head>
<body>
	<h2>Créer un compte</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>Email :</label>
		<input type="email" name="email"><br><br>
		<label>Mot de passe :</label>
		<input type="password" name="password"><br><br>
		<label>Pseudo :</label>
		<input type="text" name="pseudo"><br><br>
		<input type="submit" name="submit" value="Créer le compte">
	</form>
	<?php
	if(isset($_POST['submit'])) {
		// Récupération des données du formulaire
		$email = $_POST['email'];
		$password = $_POST['password'];
		$pseudo = $_POST['pseudo'];

		// Connexion à la base de données
		$servername = "sql7.freemysqlhosting.net";
		$username = "sql7614599";
		$dbpassword = "r1uCzMl7tH";
		$dbname = "sql7614599";
		$conn = new mysqli($servername, $username, $dbpassword, $dbname);

		// Vérification de la connexion
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Requête pour insérer les données dans la table "connexion"
		$sql = "INSERT INTO connexion (connexion_email, connexion_mdp, connexion_pseudo)
		VALUES ('$email', '$password', '$pseudo')";

		if ($conn->query($sql) === TRUE) {
			echo "<p>Votre compte a été créé avec succès !</p>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		// Fermeture de la connexion
		$conn->close();
	}
	?>
</body>
</html>