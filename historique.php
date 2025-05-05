<?php 

include "connect.php" ;

$id_doc = $_SESSION['docteurs']['id'] ;

$requete = "SELECT * FROM rendez_vous JOIN patient ON rendez_vous.id_patient = patient.id_patient  WHERE id_doc=$id_doc";
//$requete = "SELECT * FROM rendez_vous JOIN patient ON rendez_vous.id_patient = patient.id_patient JOIN ON diagnostic ON rendez_vous.id_rend=diagnostic.id_rend WHERE id_doc=1";
$resulat = $bdd->query($requete);
$rendez = $resulat->fetchAll(PDO::FETCH_ASSOC);


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
header .navbar .navlinks li a:hover {
    color:aqua;
}
    table th ,table td {
    border-top : 1px solid black ;
    border-bottom : 1px solid black ;
    padding :10px 80px;
}

table td .diagno{
    background-color :black;
    color:white;
    padding: 15px;
}
table td .diagno:hover{
    background-color :aqua;
    
}
.cont{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction:column;
    height:80vh;
    padding:25px;
}
table th {
    background-color : #f2f2f2;
}
table{
    border-collapse: collapse;
}

h1{
    margin-bottom:40px;
    border-bottom : 1px solid black ;
}
table i{
    color:red;
}

</style>
<body>
    <header data-aos="fade-down">
        <nav class="navbar">
            <a href="docteurs.php" class="logo"><img src="logo.png" alt=""></a>
            <div class="navlinks">
                <ul>
                    <li><a href="docteurs.php">Rendez_vous</a></li>
                    <li><a href="">Diagnostic</a></li>
                    <li><a href="historique.php">Historique</a></li>
                    <li style="font-weight:bold;"><?=$_SESSION['docteurs']['nom']?> <?=$_SESSION['docteurs']['prenom']?></li>
                    <!--<li class="login"><a href="login.html"><i class="fa-solid fa-user"></i></a></li>-->
                    <?php if(isset($_SESSION['docteurs'])) { ?>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <div class="conn" style="background-color: white; padding: 10px;">
                            <p style="color:black; text-align:center;  font-weight:bold; border-bottom:1px solid black;">Profil</p>
                            <div class="conn1" style="color: black;"><?=$_SESSION['docteurs']['nom']?> <?=$_SESSION['docteurs']['prenom']?></div>
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
    <div class="cont">
        <h1>HISTORIQUE RENDEZ-VOUS</h1>
        <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Motif</th>
                        
                
                    </tr>
                </thead>
                            <tbody>
                                <?php foreach($rendez as $rende ){ ?>
                                <tr>
                                    <td><?=$rende['nom_patient']?> <?=$rende['prenom_patient']?></td>
                                    <td><?=$rende['date_rend']?></td>
                                    <td><?=$rende['motif']?></td>
                                    
                                </tr>
                                <?php } ?>
                            </tbody>
        </table>
    </div>
    <script src="script.js"></script>
</body>
</html>