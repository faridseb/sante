<?php

include "../connect.php";

    if(isset($_POST['ok'])){


        // $imageName = basename($_FILES['image']['name']); // Récupère uniquement le nom du fichier
        // // Optionnel : Vous pouvez également enregistrer le fichier sur le serveur si nécessaire
        // $uploadDir = '../photo/';
        // $uploadFile = $uploadDir . $imageName;

        // if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        //     echo "<br>Le fichier a également été téléchargé sur le serveur.";
        // } else {
        //     echo "<br>Erreur lors du téléchargement du fichier sur le serveur.";
        // }

        $photoName = 'default-avatar.jpg';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../photo/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            $fileExtension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'jfif', 'webp'];
    
            if (!in_array($fileExtension, $allowedExtensions)) {
                throw new Exception('Format de fichier non autorisé. Utilisez JPG, JPEG ou PNG.');
            }
    
            $photoName = uniqid() . '.' . $fileExtension;
            $fullPath = $uploadDir . $photoName;
    
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $fullPath)) {
                error_log("Erreur upload : " . error_get_last()['message']);
                throw new Exception('Erreur lors de l\'upload de la photo');
            }
        }

    


        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['mdp']) ;
        $motif = $_POST['motif'];

        if(!empty($nom) AND !empty($prenom) AND !empty($email) AND !empty($mdp) AND !empty($motif) ){
                        if($nom == " " or $prenom == " "){
                            $erreur = "LE CHAMP DOIT CONTENIR DES CARACTERE" ;
                        }
                        else{
                            $reqEmail = $bdd->prepare("SELECT * FROM docteurs WHERE email = ?");
                        $reqEmail->execute(
                            array($email)
                        );
                        if($reqEmail->rowCount() == 0 ){
                                if(strlen($_POST['mdp']) < 4){
                                    $erreur = "Le mot de passe doit etre compris entre 4 ET 12 caracteres";
                                }
                                else{
                                    $requete = $bdd->prepare("INSERT INTO docteurs(nom_doc,prenom_doc,specialite_doc,email,mdp,img_doc) VALUES (?,?,?,?,?,?)");
                                    $requete->execute(
                                        array($nom,$prenom,$motif,$email,$mdp,$photoName)
                                    );
                                    
                                    header("location:doc.php");
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
    <link rel="stylesheet" href="sign.css">
    <title>Sign in</title>
</head>
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;0,800;1,200;1,300;1,400;1,600;1,700&display=swap');
 */

/* @import url('https://fonts.googleapis.com/css2?family=Playwrite+IT+Moderna:wght@100..400&display=swap'); */
@import url('https://fonts.googleapis.com/css2?family=Playwrite+IT+Moderna:wght@100..400&display=swap');


*{
    margin: 0;
    padding:0;
    box-sizing: border-box;
    /* font-family: "Playwrite IT Moderna", cursive;
     */
     /* font-family: "Outfit", sans-serif; */
    font-family: "Playwrite IT Moderna", cursive;
    text-decoration: none;
    list-style-type: none;
}

body{
    /*background-image: linear-gradient(to left,rgb(43, 43, 123),rgb(170, 160, 160));*/
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    flex-direction: column;
    
}

.container{
    width: 420px;
    /*box-shadow: 0 1px 5px black;*/
    padding: 10px 50px;
    border-radius: 5px;
    box-shadow:1px 1px 6px black;
}

.container .box{
    margin: 0px 0;
}
.container .box input,select{
    width: 100% ;
    padding: 7px;
    text-align: center;
    border: none;
    border-bottom: 1px solid black;
    outline-color: aqua;
    font-size: 15px;
}

.container .box input::placeholder{
    font-size: 17px;
    color: #bdbdbd;
}

.container .box label{
    color: black;
}
h1
.container h1{
    text-align: center;
    border-bottom: 1px solid black;
    color: black;

}

.container .box1 input{
    width: 100%;
    padding: 7px;
    margin:10px 0;
    cursor: pointer;
    border: none;
    border-radius: 7px;
    background-color: black;
    color: white;
}



.container .box1 input:hover{
    background-color: aqua;
    color: white ;
    scale: 1;
    transition: .1s;
}



.container p{
    margin-top: 10px;
    color: black;
}
.container a{
    color: black;
}

.container a:hover{
    color: red;
}
.erreur{
    backdrop-filter: blur(100px);
    box-shadow: 0 1px 5px black;
    color: black;
    margin-top: 10px;
    padding: 10px;
    text-align: center;
    font-weight: bold;
}

.ensemble{
    display: flex;
    flex-direction: column;
    max-width: 900px;
    
    padding: 70px;
    border-radius: 10px;
}

.ensemble .cont img{
    /* margin-top: 60px; */
    width: 100%;
    height: 100%;
}
.ensemble .contU{
    display: flex;
}

.ensemble h1{
    margin-bottom: 50px;
    border-bottom: 1px solid black;
    text-align: center;
}
.ensemble h1 i {
    margin-right: 10px;
}
@media screen and (max-width : 900px) {
    *{
        font-size: 13px;
    }.container{
        width: 300px;
    }

    .container p{
        font-size: 11px;
    }
    .container .box input::placeholder{
        font-size: 14px;
        color: black;
    }
    .ensemble img{
        display: none;
    }
    .ensemble h1{
        font-size: 25px;
    }
    .ensemble h1 i{
        font-size: 20px ;
    }
    .ensemble form p{
        font-size: 10px;
    }
}

</style>
<body>
    
    <div class="ensemble">
        <div class="contU">
            
            <form action="" method="POST">
                <div class="container">
                <h1>AJOUT DOCTEUR</h1>
                    <?php
                        if(isset($erreur)){
                            echo '<p style= "backdrop-filter: blur(150px); box-shadow: 0 1px 5px black; color:red; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$erreur.'</p>';
                        }

                        if(isset($message)){
                            echo '<p style= "backdrop-filter: blur(150px); box-shadow: 0 1px 5px black; color:green; margin-top: 10px; padding: 7px; text-align: center; font-weight: bold;">'.$message.'</p>';
                        }

                    ?>
                    <div class="box">
                        <label for="">Nom :</label>
                        <input type="text" placeholder="Nom" name="nom" required>
                    </div>
                    <div class="box">
                        <label for="">Prenom :</label>
                        <input type="text" placeholder="Prenom" name="prenom" required>
                    </div>
                    <div class="box">
                        <label for="">Email :</label>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="box">
                        <label for=""> Specialite:</label>
                        <select name="motif" id="" required>
                            <option value="Consultation">Consultation</option>
                            <option value="Conseils">Conseil</option>
                            <option value="Soins">Soins</option>
                        </select>
                    </div>
                    <div class="box">
                        <label for="">Photo</label>
                        <input type="file" placeholder="" name="photo" required>
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
        </div>
    </div>




</body>
</html>
