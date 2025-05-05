<?php 

include "connect.php" ;


$id = $_SESSION['utilisateur']['id'];


$requete = "SELECT * FROM rendez_vous 
            JOIN patient ON rendez_vous.id_patient = patient.id_patient 
            JOIN diagnostic ON diagnostic.id_rend=rendez_vous.id_rend 
            WHERE rendez_vous.id_patient=$id";


$resultat = $bdd->query($requete);
$rendez = $resultat->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['send'])){
    $diagno = $_POST['diagno'] ;
    $id_patient = $rendez['id_patient'];
    $id_doc = $rendez['id_doc'];
    $requeteS = $bdd->prepare("INSERT INTO diagnostic VALUES (0,?,?,?,?)");
    $requeteS->execute(
        array($diagno,$id,$id_patient,$id_doc)
    );

    header("location:docteurs.php");
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
    height:100vh;
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

.rendez{
    border:1px red solid;
    height:100px;
    width:700px;
    padding:20px;
}
.diagno .box input{
    border :1px black solid;
    height:100px;
    width:700px; 
}

.diagno .box1 input{
    width:700px;
}
.cont{
    text-align:center;
}
.cont h1{
    border-bottom : 1px solid black ;
    
}
</style>
<body>
    <header data-aos="fade-down">
        <nav class="navbar">
            <a href="index.php" class="logo"><img src="logo.png" alt=""></a>
            <div class="navlinks">
                <ul>
                
                    <li><a href="diagnostic.php">Diagnostic</a></li>
                    
                    
                    
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
    <div class="cont">
            <h1>Diagnostic</h1>
            <?php foreach($rendez as $rend) {?>
        <div class="rendez">
        
            <p style="text-align:center; border-bottom:1px black solid; ">RENDEZ VOUS</p>
        <?php 
            
            echo '<span style="font-weight: 900; color: black;">NOM </span>: ' .$rend['nom_patient'] . '<br>' ;
            echo '<span style="font-weight: 900; color: black;">PRENOM </span> : '.$rend['prenom_patient']. '<br>';
            echo '<span style="font-weight: 900;color: black;">DATE
            </span> : '.$rend['date_rend'];
            
        ?>    
            
        </div>

        <div class="diagno">
    
            <form action="" method="POST">
            
                <div class="box">
                    <input type="text" name="diagno" value="<?=$rend['lib_diag']?>" style="text-align:center;" readonly>
                </div>
                
            </form>
        </div>
        <?php } ?>
    </div>
    <script src="script.js"></script>
</body>
</html>