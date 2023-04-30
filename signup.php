<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=crypto_website;charset=utf8;', 'root', 'root');
if(isset($_POST['envoi'])){
    if(!empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['nom']) AND !empty($_POST['prenom'])){
        $email = htmlspecialchars($_POST['email']);
        $mdp = hash('sha3-512' , $_POST['mdp']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);

        $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ? and mdp = ?');
        $recupUser->execute(array($email, $mdp));

        if($recupUser->rowCount() < 1){
            $insertUser = $bdd->prepare('INSERT INTO utilisateurs(email, mdp, nom, prenom)VALUES(?, ?, ?, ?)');
            $insertUser->execute(array($email, $mdp, $nom, $prenom));
            
            $recupUser2 = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ? and mdp = ?');
            $recupUser2->execute(array($email, $mdp));

            if($recupUser2->rowCount() > 0){
                $usersInfos = $recupUser2->fetch();

                $_SESSION['email'] = $email;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $usersInfos['id'];
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;

                header('Location: account.php');
                die();

            }

        }else{
            echo "L'adresse mail que vous venez de renseigner possède déja un compte.";
        }

    }else{
        echo "Veuillez compléter tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <?php include "head.php"; ?>
</head>
<body>

    <form method="POST" action="">

        <input type="text" name="email" autocomplete="off">
        <br/>
        <input type="password" name="mdp" autocomplete="off">
        <br/>
        <input type="text" name="nom" autocomplete="off">
        <br/>
        <input type="text" name="prenom" autocomplete="off">

        <br/><br/>

        <input type="submit" name="envoi">

    </form>

</body>
</html>