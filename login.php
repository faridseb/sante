<?php
include "connect.php";


    
    if(isset($_POST['ok'])){
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']);


        
        if(!empty($email) AND !empty($mdp)){
            if($email == "seboufarid43@gmail.com" && $_POST['mdp']=='doctor'){
                header("location:loginD.php");
            }
            else if ($email == "seboufarid43@gmail.com" && $_POST['mdp']=='admin') {
                header("location: Admin/");
            } 
            else{
                $requete = $bdd->prepare("SELECT * FROM patient WHERE  email=? AND mdp =?");
            $requete->execute(
                array($email,$mdp)
            );
            $reponse = $requete->rowCount();
            
            if( $reponse > 0){
                $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
                $id = $utilisateur['id_patient'];
                $nom_user  =  $utilisateur['nom_patient'];
                $prenom_user  =  $utilisateur['prenom_patient'];
                $_SESSION['utilisateur'] = [
                "id" => $id,
                "nom" => $nom_user,
                "prenom" => $prenom_user,
                "email" => $email ,
                "mdp" => $mdp
                ];
                $message = 'COMPTE A BIEN ETE TROUVE' ;
                header("location:index.php");
            }
            else{
                // $erreur = 'EMAIL OU MOT DE PASSE INCORRECT';
            }
            }
            
        }
    else{
        $erreur = 'VEUILLEZ REMLIR TOUS LES CHAMPS';
    }
}


?>

<!DOCTYPE html>
<html lang="fre">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');


    *{
        margin: 0;
        padding: 0;
        /* font-family: "Comfortaa", sans-serif;
        */
        /* font-family: "Playwrite IT Moderna", cursive;*/
        font-family: "Montserrat", sans-serif; 
        box-sizing: border-box;
        list-style: none;
        font-weight: 900;
        text-decoration: none;
    }
</style>
<body>
    
    <div class="ensemble">
        <h1><i class="fa-solid fa-right-from-bracket"></i>CONNECTION</h1>
        <div class="contU">
            <div class="cont">
                <img src="doctors.jpg" alt="">
            </div>
            <form action="" method="POST">

            <div class="container">
                
                    <?php
                        if(isset($erreur)){
                            echo '<p style= "backdrop-filter: blur(150px); color:red; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$erreur.'</p>';
                        }

                        if(isset($message)){
                            echo '<p style= "backdrop-filter: blur(150px); box-shadow: 0 1px 5px black; color:green; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$message.'</p>';
                        }

                    ?>
                <div class="box">
                    <label for="">Email :</label>
                    <input type="email" placeholder="Email" name="email" required> 
                    
                </div>
                <div class="box">
                    <label for="">Mot de passe :</label>
                    <input type="password" placeholder="PASSWORD" name="mdp" required>
                </div>
                <div class="box1">
                    <input type="submit" value="Se Connecter" name="ok">
                </div>
                <p><a href="sign.php">Avez vous deja un compte ? Creer un compte</a></p>
            </div>
            </form>
        </div>
    </div>
</body>
</html>