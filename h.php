<?php 
include "connect.php" ;

try{

    $id = $_SESSION['utilisateur']['id'];
    $nom = $_SESSION['utilisateur']['nom'];
    $prenom = $_SESSION['utilisateur']['prenom'];
    $email = $_SESSION['utilisateur']['email'];
    $tel = $_POST['tel'];
    $date = $_POST['date'];
    $motif = $_POST['motif'] ;
    $today = date('Y-m-d');

    if(!empty($tel)  AND !empty($motif)){

        if($date >= $today){
                    $requeteDocteur = $bdd->prepare("SELECT * FROM docteurs WHERE specialite_doc=?");
                    $requeteDocteur->execute(
                        array($motif)
                    );
                    $resultats = $requeteDocteur->fetchAll(PDO::FETCH_ASSOC);
                    foreach($resultats as $resultat){
                        $id_doc = $resultat['id_doc'];
                        $requeteVerify = $bdd->prepare("SELECT * FROM rendez_vous WHERE id_doc=? AND date_rend=?");
                        $requeteVerify->execute(
                            array($id_doc,$date)
                        );

                        if($requeteVerify->rowCount() > 2){
                                // $requeteRed = $bdd->prepare("SELECT * FROM rendez_vous WHERE id_doc=?");
                                // $requeteRed->execute(
                                //         array($id_doc)
                                // );
                                // if($requeteRed->rowCount() <3){
                                //     $requete = $bdd->prepare("INSERT INTO rendez_vous(date_rend,motif,id_patient,id_doc) VALUES (?,?,?,?) ");
                                // $requete->execute(
                                // array($date,$motif,$id,$id_doc)
                                // );

                                // $requeteH = $bdd->prepare("INSERT INTO history  VALUES (0,?,?,?) ");
                                // $requeteH->execute(
                                // array($date,$motif,$id_doc)
                                // );

                                // $requeteTel = $bdd->prepare("UPDATE patient SET tel=? WHERE id_patient=?");
                                // $requeteTel->execute(
                                //     array($tel,$id)
                                // );


                                // // $erreur = "RENDEZ VOUS PLACER AVEC SUCCES";
                                // // $_SESSION['message'] = ["message" => $erreur] ;
                                // // header("location:reponse.php");


                                // $_SESSION['fiche'] = [
                                //     "nom" => $nom ,
                                //     "prenom" => $prenom ,
                                //     "date" => $date ,
                                //     "motif" => $motif ,
                                //     "id_doc" => $id_doc
                                // ] ;

                                // $redirectUrl = 'fiche.php' ;
                                // echo json_encode([
                                //     'success' => true,
                                //     'message' => 'RENDEZ VOUS PLACER AVEC SUCCES',
                                //     'redirect' => $redirectUrl
                                // ]);
                                // exit();
                                // }
                                // else{
                                    // $erreur = "DOCTEURS INDISPONIBLE VEUILLEZ REESAYER ULTERIEUREMENT";
                                    // $_SESSION['message'] = ["message" => $erreur] ;
                                    // header("location:reponse.php");

                                    
                                    echo json_encode([
                                        'success' => false,
                                        'message' => 'DOCTEURS INDISPONIBLE POUR CE JOUR , VEUILLEZ REESAYER ULTERIEUREMENT'
                                    ]);
                                    exit();
                                // }
                                
                        }

                        else{   
                                    
                            $requeteVerify2 = $bdd->prepare("SELECT * FROM rendez_vous WHERE date_rend =? AND motif=? AND id_patient=? AND id_doc=?");
                            $requeteVerify2->execute(
                                array($date,$motif,$id,$id_doc)
                            );
                            if($requeteVerify2->rowCount() == 0){
                            $requete = $bdd->prepare("INSERT INTO rendez_vous(date_rend,motif,id_patient,id_doc) VALUES (?,?,?,?) ");
                            $requete->execute(
                            array($date,$motif,$id,$id_doc)
                            );

                            $requeteH = $bdd->prepare("INSERT INTO history  VALUES (0,?,?,?) ");
                                $requeteH->execute(
                                array($date,$motif,$id_doc)
                            );
                            
                            $requeteTel = $bdd->prepare("UPDATE patient SET tel=? WHERE id_patient=?");
                            $requeteTel->execute(
                                array($tel,$id)
                            );
                            // $erreur = "RENDEZ VOUS PLACER AVEC SUCCES";
                            // $_SESSION['message'] = ["message" => $erreur] ;
                            // header("location:reponse.php");
                            $_SESSION['fiche'] = [
                                "nom" => $nom ,
                                "prenom" => $prenom ,
                                "date" => $date ,
                                "motif" => $motif ,
                                "id_doc" => $id_doc
                            ] ;

                            $redirectUrl = 'fiche.php' ;
                            echo json_encode([
                                'success' => true,
                                'message' => 'RENDEZ VOUS PLACER AVEC SUCCES',
                                'redirect' => $redirectUrl
                            ]);
                            exit();

                            }

                            else{
                                // $erreur = "DOCTEURS INDISPONIBLE VEUILLEZ REESAYER ULTERIEUREMENT";
                                // $_SESSION['message'] = ["message" => $erreur] ;
                                // header("location:reponse.php");

                                echo json_encode([
                                    'success' => false,
                                    'message' => 'DOCTEURS INDISPONIBLE POURVEUILLEZ REESAYER ULTERIEUREMENT'
                                ]);
                                exit();
                            }

                        }
                    }

        }else{
            // $erreur = "DATE INCOHERANTE !";
            // $_SESSION['message'] = ["message" => $erreur] ;
            // header("location: reponse.php");

            echo json_encode([
                'success' => false,
                'message' => 'DATE INCOHERANTE !'
            ]);
            exit;
        }
        
        

}


}


catch(Exception $e){
    http_response_code(400);
    echo json_decode([
        'succes' => false ,
        'message' => $e->getMessage()
    ]);
    exit();
}












?>
