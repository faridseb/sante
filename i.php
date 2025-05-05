


<?php 

include "connect.php" ;



if(isset($_POST['okay'])){
    $id = $_SESSION['utilisateur']['id'];
    $nom = $_SESSION['utilisateur']['nom'];
    $prenom = $_SESSION['utilisateur']['prenom'];
    $email = $_SESSION['utilisateur']['email'];
    $tel = $_POST['tel'];
    $date = $_POST['date'];
    $motif = $_POST['motif'] ;
    $today = new DateTime();

    if(!empty($tel)  AND !empty($motif)){
    
        $requeteDocteur = $bdd->prepare("SELECT * FROM docteurs WHERE specialite_doc=?");
        $requeteDocteur->execute(
            array($motif)
        );
        $resultats = $requeteDocteur->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultats as $resultat){
            $id_doc = $resultat['id_doc'];
            $requeteVerify = $bdd->prepare("SELECT * FROM rendez_vous WHERE id_doc=?");
            $requeteVerify->execute(
                array($id_doc)
            );
            
            
            if($requeteVerify->rowCount() > 2){
                $erreur = "Docteurs indisponible ";
                /* select where consultation est inferieur a 3*/
                /* redirige vers une autre page et affiche le recu a imprimer*/
                $requeteRed = $bdd->prepare("SELECT * FROM rendez_vous WHERE id_doc=?");
                $requeteRed->execute(
                    array($id_doc)
                );
                if($requeteRed->rowCount() <3){
                    $requete = $bdd->prepare("INSERT INTO rendez_vous(date_rend,motif,id_patient,id_doc) VALUES (?,?,?,?) ");
                $requete->execute(
                array($date,$motif,$id,$id_doc)
                );

                $requeteTel = $bdd->prepare("UPDATE patient SET tel=? WHERE id_patient=?");
                $requeteTel->execute(
                    array($tel,$id)
                );
                    
                }
            }
            else{   
                
                $requeteVerify2 = $bdd->prepare("SELECT * FROM rendez_vous WHERE date_rend = ? AND motif=? AND id_patient=?");
                $requeteVerify2->execute(
                    array($date,$motif,$id)
                );
                if($requeteVerify2->rowCount() == 0){
                $requete = $bdd->prepare("INSERT INTO rendez_vous(date_rend,motif,id_patient,id_doc) VALUES (?,?,?,?) ");
                $requete->execute(
                array($date,$motif,$id,$id_doc)
                );

                $requeteTel = $bdd->prepare("UPDATE patient SET tel=? WHERE id_patient=?");
                $requeteTel->execute(
                    array($tel,$id)
                );
                }
                else{
                    
                }

            }
        }

        
        
    }
    
    
    
}

                /* redirige vers une autre page et affiche le recu a imprimer*/


?>