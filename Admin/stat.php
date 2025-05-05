<?php 

include "../connect.php" ;

if(isset($_POST['okay'])){
    $id = $_SESSION['utilisateur']['id'];
    $nom = $_SESSION['utilisateur']['nom'];
    $prenom = $_SESSION['utilisateur']['prenom'];
    $email = $_SESSION['utilisateur']['email'];

}


$requete6 = "SELECT COUNT(*) AS total FROM patient ";

$reponse = $bdd->query($requete6);

$NBR = $reponse->fetch(PDO::FETCH_ASSOC);


$requete7 = "SELECT COUNT(*) AS total2 FROM docteurs ";

$reponse7 = $bdd->query($requete7);

$NBR2 = $reponse7->fetch(PDO::FETCH_ASSOC);


$requete8 = "SELECT COUNT(*) AS total3 FROM rendez_vous ";

$reponse8 = $bdd->query($requete8);

$NBR3 = $reponse8->fetch(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style.css">
    <title>Sante</title>
</head>
<style>
    .cont aside{
        background-color:black ;
        width:300px;
        height:100vh ;
        position:fixed;
    }
    .cont aside ul li:hover{
        background-color:white;
        padding: 10px 20px;
        transition: .5s;
        color:black;
    }
    .cont aside ul li:hover a{
        color:black;
    }
    .cont aside ul li{
        margin : 40px 10px ; 
    }
    .cont aside ul li a{
        color:white;
    }
    .container{
        display:grid;
        grid-template-columns :repeat(3,1fr);
        width: 700px;
        justify-content:center;
        margin-left:400px;
        gap: 50px;;
    }
    .container .stat{
        text-align :center;
        border:1px solid black;
        padding:35px;
    }

    .container .stat:hover{
        cursor:pointer;
        scale:1.4;
        transition:.7s;
}




</style>
<body>
    <header data-aos="fade-down">
        <nav class="navbar">
            <a href="index.php" class="logo"><img src="../logo.png" alt=""></a>
            <div class="navlinks">
                <ul>
                    <li class="Parcourir"><a href="#form" style="font-size:900; "  >Admin</a></li>
                    <li><a href="../index.php">Se Deconnecter</a></li>
                    
                </ul>
            </div>
            
        <i class="fa-solid fa-bars"></i>
        </nav>
    </header>
    <div class="cont">
        <aside>
            <ul>
                <li><a href="index.php"> <i class="fa-solid fa-house-user"></i> Acceuil</a></li>
                <li><a href="stat.php"><i class="fa-solid fa-chart-simple"></i>Listes des patients</a></li>
                <li><a href="stat.php"><i class="fa-solid fa-chart-simple"></i> Statistiques</a></li>
                <li><a href="doc.php"><i class="fa-solid fa-square-plus"></i>  Ajouter un docteur</a></li>
                <li><a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Retour au site</a></li>
            </ul>
        </aside>

        <div class="container">
            <div class="stat">
                <p><?=$NBR['total']?></p>
                <p>Patients</p>
            </div>
            <div class="stat">
                <p><?=$NBR2['total2']?></p>
                <p>Docteurs</p>

            </div>
            <div class="stat">
                <p><?=$NBR3['total3']?></p>
                <p> Consultations</p>

            </div>
        </div>

    </div>

    <script src="script.js"></script>
</body>
</html>