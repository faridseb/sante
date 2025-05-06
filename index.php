<?php 

include "connect.php" ;

$requete = "SELECT * FROM docteurs ";

$reponse = $bdd->query($requete);

$utilisateurs = $reponse->fetchAll(PDO::FETCH_ASSOC);


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
<body>
    <header data-aos="fade-down">
        <nav class="navbar">
            <a href="index.php" class="logo"><img src="logo.png" alt=""></a>
            <div class="navlinks">
                <ul>
                    <li><a href="">Acceuil</a></li>
                    <li><a href="#conseil">Conseils</a></li>
                    <li><a href="#footer">Contact</a></li>
                    <li class="Parcourir"><a href="#form" >Rendez-vous</a></li>
                    <!--<li class="login"><a href="login.html"><i class="fa-solid fa-user"></i></a></li>-->
                    <?php if(isset($_SESSION['utilisateur'])) { ?>
                    <li><a href="diagnostic.php">Diagnostics</a></li>
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
    <div class="container">
        <div class="cont1">
            <img src="home.png" alt="">
            <div class="anim"></div>
        </div>
        <div class="cont2">
            <h1>BIENVENUE SUR VOTRE SITE DEDIE A LA <br>SANTE</h1>
            <button><a href="#conseil" style="color:black;">ALLER <i class="fa-solid fa-arrow-right"></i></a></button>
        </div>
    </div>
    <div class="populaire">
        <div class="box"><i class="fa-solid fa-user-doctor"></i><br>
            <p style="font-size: 40px;">+ de 100 <br>docteurs</p>
        </div>
        <div class="box"><i class="fa-solid fa-syringe"></i><br>
            
            <p style="font-size: 40px;">+ de 100 <br>patients</p>
        </div>
        <div class="box"><i class="fa-solid fa-hospital"></i> <br>
            
            <p style="font-size: 40px;">+ de 100 <br> Diagnostics</p>
        </div>

    </div>
    <div class="services">
        <h1><span>NOS</span> SERVICE</h1>
        <div class="contain">
            <div class="box"><i class="fa-solid fa-user-doctor"></i><br>
                <p style="font-size: 30px;">Consultation</p>
                <p>Sur notre site, nous vous offrons un accès simple et rapide à des consultations de qualité pour répondre à tous vos besoins en matière de santé</p>
            </div>
            <div class="box"><i class="fa-solid fa-person"></i><br>
                <p style="font-size: 30px;">Conseil sante</p>
                <p>Parce que prendre soin de soi commence par de bonnes habitudes, notre site met à votre disposition une rubrique dédiée aux conseils santé .</p>
            </div>
                
            <div class="box"><i class="fa-solid fa-hospital"></i> <br>
                <p style="font-size: 30px;">Soins</p>
                <p>Nous mettons à votre disposition une gamme de services de soins pour répondre à vos besoins spécifiques et vous accompagner dans votre parcours de santé.</p>
            </div>
        </div>
    </div>
    
    <div class="propos">
        <h1><span>A</span> PROPOS</h1>
        <div class="contain">
            <img src="apr.png" alt="">
            <div class="box2">Nos services sont conçus pour répondre à vos besoins en matière de santé et de bien-être. Que ce soit pour des conseils en nutrition, des programmes de remise en forme, ou des recommandations adaptées à vos objectifs, nous mettons à votre disposition des informations fiables et pratiques. Nous collaborons avec des professionnels de la santé pour garantir des contenus à jour et personnalisés. Notre priorité est de vous accompagner dans votre parcours vers une vie saine et équilibrée, en vous offrant des outils simples et accessibles.</div>
        </div>
    </div>
    <div class="reservation">
        <h1><span>RESERVER</span> MAINTENANT</h1>
        <div class="grand" id="form">
            <form method="POST" id="loginForm">
                
                    

            <div id="containers"></div>

                    <div class="box">
                        <label for="">Nom :</label>
                        <?php if(isset($_SESSION['utilisateur'])) { ?>
                        <input type="text" placeholder="NOM" name="nom" value="<?=$_SESSION['utilisateur']['nom']?>" required readonly>
                        <?php }else {?>
                        <input type="text" placeholder="NOM" name="nom" required >
                        <?php } ?> 
                    </div>
                                        <div class="box">
                        <label for="">Email :</label>
                        <?php if(isset($_SESSION['utilisateur'])) { ?>
                        <input type="email" placeholder="EMAIL" value="<?=$_SESSION['utilisateur']['email']?>" name="email" required readonly>
                        <?php }else {?>
                        <input type="email" placeholder="Email" name="email" required >
                        <?php } ?> 
                    </div>
                    <div class="box">
                        <label for="">Telephone :</label>
                        <input type="tel"  name="tel" placeholder="+228xxxxxxxx" required>
                    </div>

                    <div class="box">
                        <label for="">Date :</label>
                        <input type="date" placeholder="date" name="date"  required>
                    </div>
                    <div class="box">
                        <label for=""> Motif:</label>
                        <select name="motif" id="" required>
                            <option value="Consultation">Consultation</option>
                            <option value="Conseils">Conseils</option>
                            <option value="Soins">Soins</option>
                        </select>
                    </div>
                    <div class="box1">
                    <?php if(isset($_SESSION['utilisateur'])) { ?>
                        <input type="submit" value="Reserver">
                        <?php }else {?>
                        <input type="submit" value="Reserver">
                        <?php } ?> 
                    </div>
                
            </form>
            <div class="box" id="boxes"><img src="rendez vous.svg" alt=""></div>
            
        </div>
    </div>
    <div class="conseil" id="conseil">
        <h1><span>CONSEILS</span> BIEN ETRE GENERALE</h1>
        <div class="BOXES">
            <div class="box">
                
                <p>1. Exercice cardiovasculaire pour la santé du cœur
                    Types d'exercices : Marche rapide, course, vélo, natation, ou même la danse. Ces exercices améliorent la circulation sanguine, réduisent le risque de maladies cardiovasculaires et renforcent le cœur.
                    Durée : Vise au moins 150 minutes d'activité modérée par semaine (ou 75 minutes d’activité intense). Cela peut être réparti sur plusieurs jours.
                </p>
            </div>
            <div class="box">
                <p>2. Renforcement musculaire pour maintenir la masse musculaire
                    Exercices : Utilise des poids libres, des machines de musculation, ou des exercices au poids du corps (pompes, squats, fentes).
                    Avantages : Le renforcement musculaire aide à prévenir la perte musculaire liée à l'âge, améliore la posture, et augmente le métabolisme.
                </p> 
            </div>
            <div class="box">
                <p>
                    3. Flexibilité et étirements pour la mobilité
                    Exercices : Yoga, Pilates, ou des étirements statiques réguliers. Ces pratiques aident à maintenir la souplesse, à améliorer la posture, et à réduire les tensions musculaires.
                    Avantages : L’amélioration de la flexibilité réduit le risque de blessures et permet de mieux exécuter les mouvements quotidiens.
                </p>
            </div>
        </div>
    </div>
    <div class="docteur">
        <h1><span>NOS</span> DOCTEURS</h1>
        <div class="BOXES">
            <?php foreach ($utilisateurs as $utilisateur) {?> 
            <div class="box">
                <img src="photo/<?=$utilisateur['img_doc']?>" alt="">
                <p><?=$utilisateur['prenom_doc']?> <?$utilisateur['prenom_doc']?></p>
                <p style="font-weight: 900;">Specialite <?=$utilisateur['specialite_doc']?></p>
                <ul>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div>
            <?php }?>
            <!-- <div class="box">
                <img src="" alt="">
                <p>FELICIO CHETTE</p>
                <p style="font-weight: 900;">Docteur Consultant</p>
                <ul>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div>
            <div class="box">
                <img src="" alt="">
                <p>CHACI DEFTI</p>
                <p style="font-weight: 900;">Infirmier </p>
                <ul>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div>
            <div class="box">
                <img src="" alt="">
                <p>KING NASIR</p>
                <p style="font-weight: 900;">Grand docteur</p>
                <ul>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div>
            <div class="box">
                <img src="" alt="">
                <p>JOHNY SENS</p>
                <p style="font-weight: 900;">Tres tres bon docteur</p>
                <ul>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div>
            <div class="box">
                <img src="" alt="">
                <p>JONHY SENS</p>
                <p style="font-weight: 900;">Tres tres bon docteur</p>
                <ul>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                </ul>
            </div> -->
        </div>
    </div>
    <footer id="footer">
        <div class="foot">
            <h2>Parcourir</h2>
            <ul>
                <li><a href=""><span>></span> Reserver</a></li>
                <li><a href=""><span>></span> Conseil</a></li>
                <li><a href=""><span>></span> Docteurs</a></li>
            </ul>
        </div>
        <div class="foot">
            <h2>Nos Services</h2>
            <ul>
                <li><a href=""><span>></span> Assistances</a></li>
                <li><a href=""><span>></span> Reservations</a></li>
                <li><a href=""><span>></span> Prise de conseils</a></li>
            </ul>
        </div>
        <div class="foot">
            <h2>Contact infos</h2>
            <ul>
                <li><a href=""><i class="fa-solid fa-phone"></i> +228 90932898</a></li>
                <li><a href=""><i class="fa-solid fa-phone"></i> +228 98727461</a></li>
            </ul>
        </div>
        <div class="foot">
            <h2>Follow Us</h2>
            <ul>
                <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
            </ul>
        </div>
    </footer>


    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            try {
                const formData = new FormData(e.target);
                const response = await fetch('reponse.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                // Afficher la notification
                const notification = `
                <p style= "background-color:${data.success ? 'green' : 'red'}; color:white; margin-top: 10px; padding: 7px; text-align: center;">${data.message}</p>
                `;

                const container = document.getElementById('containers');
                container.innerHTML = notification;
                

                if (data.success && data.redirect) {
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 2000);
                }
            } catch (error) {
                console.error('Erreur:', error);
            }
        });
    </script>
    <script src="script.js"></script>
</body>
</html>