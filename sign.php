<?php

include "connect.php";

    if(isset($_POST['ok'])){
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']) ;
        $sexe = $_POST['sexe'];

        if(!empty($nom) AND !empty($prenom) AND !empty($email) AND !empty($mdp) AND !empty($sexe) ){
                        if($nom == " " or $prenom == " "){
                            $erreur = "LE CHAMP DOIT CONTENIR DES CARACTERE" ;
                        }
                        else{
                            $reqEmail = $bdd->prepare("SELECT * FROM patient WHERE email = ?");
                        $reqEmail->execute(
                            array($email)
                        );
                        if($reqEmail->rowCount() == 0 ){
                                if(strlen($_POST['mdp']) < 4){
                                    $erreur = "Le mot de passe doit etre compris entre 4 ET 12 caracteres";
                                }
                                else{
                                    $requete = $bdd->prepare("INSERT INTO patient(nom_patient,prenom_patient,sexe,email,mdp) VALUES (?,?,?,?,?)");
                                    $requete->execute(
                                        array($nom,$prenom,$sexe,$email,$mdp)
                                    );
                                    $message = 'INSCRIPTION REUSSI' ;
                                    header("location:login.php");
                                }
                            
                        }
                        else{
                            $erreur = 'CET EMAIL EXISTE DEJA';
                        }
                        }
                        
                    }

    else{
        $erreur = 'VEUILLER REMPLIR TOUS LES CHAMPS' ;
    }

    }



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="login.css">
    <title>Sign in</title>
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
        <h1> <i class="fa-solid fa-user"></i>INSCRIPTION</h1>
        <div class="contU">
            
            <form action="" method="POST">
                <div class="container">
                    
                    <?php
                        if(isset($erreur)){
                            echo '<p style= "backdrop-filter: blur(150px); box-shadow: 0 1px 5px black; color:red; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$erreur.'</p>';
                        }

                        if(isset($message)){
                            echo '<p style= "backdrop-filter: blur(150px); box-shadow: 0 1px 5px black; color:green; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$message.'</p>';
                        }

                    ?>
                    <div class="box">
                        <label for="">NOM :</label>
                        <input type="text" placeholder="NAME" name="nom" required>
                    </div>
                    <div class="box">
                        <label for="">Prenom :</label>
                        <input type="text" placeholder="PRENOM" name="prenom" required>
                    </div>
                    <div class="box">
                        <label for="">Email :</label>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="box">
                        <label for="">  Sexe:</label>
                        <select name="sexe" id="">
                            <option value="M">Masculin</option>
                            <option value=" F">Feminin</option>
                        </select>
                    </div>
                    <div class="box">
                        <label for="">Mot de passe :</label>
                        <input type="password" placeholder="PASSWORD" name="mdp" required>
                    </div>
                    
                    <div class="box1">
                        <input type="submit" value="Créer un Compte" name="ok">
                    </div>
                </div>
                
            </form>
            <div class="cont">
                <img src="Login.png" alt="" style="width: 100%;">
            </div>
        </div>
    </div>




</body>
</html>
