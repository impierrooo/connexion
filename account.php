<?php 
session_start();
if(!$_SESSION['mdp']){
    header('Location: login.php');
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mon compte</title>
    <?php include "head.php"; ?>
</head>
<body>
    <p>Salut <?php echo $_SESSION['nom']; ?>, j'espère que tu vas bien !</p>
    <p>Mon id c'est : <?php echo $_SESSION['id']; ?></p>
    <p>Mon prénom c'est : <?php echo $_SESSION['prenom']; ?></p>
    <a href="logout.php">
        <button>Se déconnecter</button>
    </a>

</body>
</html>