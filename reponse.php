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
    $rendezVousPris = false; // Initialisation de la variable

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
                    // Ce docteur a déjà 3 rendez-vous, on passe au suivant
                    continue;
                } else {
                    // Ce docteur a moins de 3 rendez-vous, on vérifie si le patient n'a pas déjà un rdv
                    $requeteVerify2 = $bdd->prepare("SELECT * FROM rendez_vous WHERE date_rend =? AND motif=? AND id_patient=? AND id_doc=?");
                    $requeteVerify2->execute(
                        array($date,$motif,$id,$id_doc)
                    );
                    if($requeteVerify2->rowCount() == 0){
                        // Le patient n'a pas déjà de rdv avec ce docteur à cette date, on l'enregistre
                        $requete = $bdd->prepare("INSERT INTO rendez_vous(date_rend,motif,id_patient,id_doc) VALUES (?,?,?,?) ");
                        $requete->execute(
                            array($date,$motif,$id,$id_doc)
                        );

                        // $requeteH = $bdd->prepare("INSERT INTO history  VALUES (0,?,?,?) ");
                        // $requeteH->execute(
                        //     array($date,$motif,$id_doc)
                        // );

                        $requeteTel = $bdd->prepare("UPDATE patient SET tel=? WHERE id_patient=?");
                        $requeteTel->execute(
                            array($tel,$id)
                        );

                        $_SESSION['fiche'] = [
                            "nom" => $nom ,
                            "prenom" => $prenom ,
                            "date" => $date ,
                            "motif" => $motif ,
                            "id_doc" => $id_doc
                        ];

                        $redirectUrl = 'fiche.php' ;
                        echo json_encode([
                            'success' => true,
                            'message' => 'RENDEZ VOUS PLACER AVEC SUCCES',
                            'redirect' => $redirectUrl
                        ]);
                        $rendezVousPris = true;
                        break; // On sort de la boucle car le rdv est pris
                    } else {
                        // Le patient a déjà un rdv identique, on passe au docteur suivant (ou on gère ce cas)
                        continue; // Pour l'instant, on passe au docteur suivant
                    }
                }
            }

            // Si aucun rendez-vous n'a été pris après avoir parcouru tous les docteurs
            if (!$rendezVousPris) {
                echo json_encode([
                    'success' => false,
                    'message' => 'AUCUN DOCTEUR DISPONIBLE POUR CE JOUR ET CETTE SPECIALITE, VEUILLEZ REESAYER ULTERIEUREMENT'
                ]);
                exit();
            }

        } else {
            echo json_encode([
                'success' => false,
                'message' => 'DATE INCOHERANTE !'
            ]);
            exit;
        }
    }
} catch(Exception $e){
    http_response_code(400);
    echo json_encode([
        'succes' => false ,
        'message' => $e->getMessage()
    ]);
    exit();
}
?>