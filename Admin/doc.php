<?php 

include "../connect.php" ;



$requete = "SELECT * FROM docteurs ";

$reponse = $bdd->query($requete);

$utilisateurs = $reponse->fetchAll(PDO::FETCH_ASSOC);



if(isset($_POST['okay'])){
    $id = $_SESSION['utilisateur']['id'];
    $nom = $_SESSION['utilisateur']['nom'];
    $prenom = $_SESSION['utilisateur']['prenom'];
    $email = $_SESSION['utilisateur']['email'];









}


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
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        overflow-x:auto;
        width :1200px;
        margin:auto;
    }
    .cont aside{
        background-color:black ;
        width:250px;
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
        margin : 40px 7px ; 
    }
    .cont aside ul li a{
        color:white;
    }

    table{
        margin-top:200px;
        margin-left:240px;
        border-collapse: collapse;
    }
    table tr td {
        padding: 10px 10px;
    }


    .respo{
        color:white;
    }


    table th ,table td {
        /* border-top : 1px solid black ; */
        border: 1px solid black ;
        padding :10px 40px;
        text-align:center;
    }

    table td img{
        width:50px;
        height:50px;
    }

    .cont .container .lien {
    width: 250px;
    padding: 7px;
    margin-top :20px;
    cursor: pointer;
    border: none;
    border-radius: 7px;
    background-color: black;
    color: white;
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
                <li><a href="listePatient.php"><i class="fa-solid fa-chart-simple"></i>Listes des patients</a></li>
                <li><a href="stat.php"><i class="fa-solid fa-chart-simple"></i> Statistiques</a></li>
                <li><a href="doc.php"><i class="fa-solid fa-square-plus"></i>  Ajouter un docteur</a></li>
                <li><a href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Retour au site</a></li>
            </ul>
        </aside>

        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Specialite</th>
                        <th>Email</th>
                        <th>Supprimer</th>
                        
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach($utilisateurs as $utilisateur) { ?>
                    <tr>
                    <td><img src="photo/<?=$utilisateur['img_doc']?>" alt=""></td>
                    <td><?=$utilisateur['nom_doc']?></td>
                    <td><?=$utilisateur['prenom_doc']?></td>
                    <td><?=$utilisateur['specialite_doc']?></td>
                    <td><?=$utilisateur['email']?></td>
                    <td style="font-size:25px;"><a style="color:black;" href="deleteDoc.php?id=<?= $utilisateur['id_doc']?>"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
            <a href="signD.php" class="lien"><i class="fa-solid fa-plus"></i> Ajouter un Docteur</a>
        </div>

    </div>

    <script src="script.js"></script>
</body>
</html>