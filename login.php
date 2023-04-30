<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=crypto_website;charset=utf8;', 'root', 'root');
if(isset($_POST['envoi'])){
    if(!empty($_POST['email']) AND !empty($_POST['mdp'])){
        $email = htmlspecialchars($_POST['email']);
        $mdp = hash('sha3-512' , $_POST['mdp']);

        $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ? and mdp = ?');
        $recupUser->execute(array($email, $mdp));

        if($recupUser->rowCount() > 0){
            $usersInfos = $recupUser->fetch();

            $_SESSION['email'] = $email;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['nom'] = $usersInfos['nom'];
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['prenom'] = $usersInfos['prenom'];

            header('Location: account.php');
            die();

        }else{
            echo "Votre email ou mot de passe est incorrect.";
        }

    }else{
        echo "Veuillez compléter tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <?php include "head.php"; ?>
</head>
<body>

    <form method="POST" action="">

        <input type="text" name="email" autocomplete="off">
        <br/>
        <input type="password" name="mdp" autocomplete="off">

        <br/><br/>

        <input type="submit" name="envoi">

    </form>

</body>
</html>