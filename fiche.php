<?php

include "connect.php" ;

$id_doc = $_SESSION['fiche']['id_doc'];


$sql = "SELECT * FROM docteurs WHERE id_doc=$id_doc";

$reponse = $bdd->query($sql);

$docteurs = $reponse->fetch(PDO::FETCH_ASSOC);






?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Reponses</title>
</head>

<style>
    /* body{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        
    } */
    
    .containers{
        box-shadow: 1px 1px 3px black;
        width: 900px;
        margin: auto;
        
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 500px;
        flex-direction: column;
    }

    .containers h3{
        width: 300px;
        font-size: 23px;
        margin-top: 10px;
    }
    .containers .element{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .containers .element .user , .doc {
            padding: 30px;
    }
    

    .containers .doc {
        text-align: center;
    }
    .containers .tete {
        display: flex;

    }
    .containers .tete img {
        width: 50%;

    }

    .fa-bars,.fa-xmark{
    position: relative;
    top: 20px;
    font-size: 35px;
    right: 10px;
    cursor: pointer;
    display: none;
}


#separa {
    width: 80%;
    height: 45px;
    margin: 0 30px;
    cursor: pointer;
    border: 1px black solid;
    border-radius: 7px;
    background-color: black;
    color: white;
    padding: 10px;
}

#separa a{
    color:white;
}

#separa:hover{
    background-color:aqua;
}


</style>
<body>
        <header data-aos="fade-down">
        <nav class="navbar">
            <a href="index.php" class="logo"><img src="logo.png" alt=""></a>
            <div class="navlinks">
                <ul>
                    <li><a href="">Acceuil</a></li>
                    <li><a href="#conseil">Conseils</a></li>
                    <li><a href="#footer">Contact</a></li>
                    <li class="Parcourir"><a href="#form" >Rendez-vous</a></li>
                    <!--<li class="login"><a href="login.html"><i class="fa-solid fa-user"></i></a></li>-->
                    <?php if(isset($_SESSION['utilisateur'])) { ?>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <div class="conn" style="background-color: white; padding: 10px;">
                            <p style="color:black; text-align:center;  font-weight:bold; border-bottom:1px solid black;">Profil</p>
                            <div class="conn1" style="color: black;"><?=$_SESSION['utilisateur']['nom']?> <?=$_SESSION['utilisateur']['prenom']?></div>
                            <div class="conn1" style="color: black;"><a href="deconnect.php"><i class="fa-solid fa-right-from-bracket"></i>Deconnecter</a></div>
                        </div>
                    </li>
                    <?php  } else {?>

                        <li>
                        <i class="fa-solid fa-user"></i>
                        <div class="conn" style="background-color: white; padding: 10px;">
                            <p style="color:black; text-align:center;  font-weight:bold; border-bottom:1px solid black;">Profil</p>
                            <div class="conn1" style="color: black;">Pas de profil</div>
                            <div class="conn1" style="color: black;"><a href="login.php"><i class="fa-solid fa-right-from-bracket"></i>Se Connecter</a></div>
                        </div>
                    </li>

                    <?php } ?>
                </ul>
            </div>
            
        <i class="fa-solid fa-bars"></i>
        </nav>
    </header> 
    <div class="containers">
        <div class="tete">
            <a href="index.php" class="logo"><img src="logo.png" alt=""></a>
            <h3>Fiche de rendez-vous</h3>
        </div>
        
        <div class="element">
            <div class="user">
                <p style="font-size: 80px; text-align: center;"><i class="fa-regular fa-user"></i></p>
                <p><span style="font-weight: 800; color: black;">Nom & Prenom : </span><?= $_SESSION['fiche']['nom'] .' '. $_SESSION['fiche']['prenom']?></p>
                <p> <span style="font-weight: 800; color: black ;">Date du Rendez-vous :</span><?= $_SESSION['fiche']['date']?></p>
                <p> <span style="font-weight: 800; color: black;">Motif : </span><?= $_SESSION['fiche']['motif']?></p>
            </div>
            <div class="doc">
                <img src="d1.jpg" alt="" style="width: 70px; border-radius: 50%;">
                <p><span style="font-weight: 800; color: black;">Docteurs : </span> <?= $docteurs['nom_doc']?>  <?= $docteurs['prenom_doc']?></p>
                <p>Specialite <?= $docteurs['specialite_doc']?></p>
                <p><i class="fa-brands fa-instagram"></i> <i class="fa-brands fa-facebook"></i> <i class="fa-brands fa-x-twitter"></i></p>
            </div>
        </div>
        <button id="separa"><a href="index.php">Retour a l'acceuil</a></button>
    </div>
</body>
</html>