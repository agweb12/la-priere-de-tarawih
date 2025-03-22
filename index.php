<?php
include 'class/PDO-laprieredetarawih.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';



    $nomParticulier1Erreur = $prenomParticulier1Erreur = $emailParticulier1Erreur = $indicatifParticulier1Erreur = $telephoneParticulier1Erreur = $adresse1Particulier1Erreur = $adresse2Particulier1Erreur = $codepostalParticulier1Erreur = $villeParticulier1Erreur = $paysParticulier1Erreur = $quantiteParticulier1Erreur =
    $nomParticulier1 = $prenomParticulier1 = $emailParticulier1 = $indicatifParticulier1 = $telephoneParticulier1 = $adresse1Particulier1 = $adresse2Particulier1 = $codepostalParticulier1 = $villeParticulier1 = $paysParticulier1 = $quantiteParticulier1 = "";
    if (!empty($_POST["formParticulierA"]))
    {
        $nomParticulier1                = checkInput($_POST['nom1']);
        $prenomParticulier1             = checkInput($_POST['prenom1']);
        $emailParticulier1               = checkInput($_POST['mail1']);
        $indicatifParticulier1           = checkInput($_POST['indicatif1']);
        $telephoneParticulier1           = checkInput($_POST['telephone1']);
        $adresse1Particulier1            = checkInput($_POST['adresse11']);
        $adresse2Particulier1            = checkInput($_POST['adresse21']);
        $villeParticulier1               = checkInput($_POST['ville1']);
        $codepostalParticulier1          = checkInput($_POST['codepostal1']);
        $paysParticulier1                = checkInput($_POST['pays1']);
        $quantiteParticulier1 = checkInput($_POST['quantiteparticulier1']);
        $estValide                = true;
        $mailCommande = new PHPMailer(true);

        if(empty($nomParticulier1))
        {
            $nomParticulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($prenomParticulier1))
        {
            $prenomParticulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($emailParticulier1))
        {
            $emailParticulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($telephoneParticulier1))
        {
            $indicatifParticulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($indicatifParticulier1))
        {
            $indicatifParticulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($adresse1Particulier1))
        {
            $adresse1Particulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($villeParticulier1))
        {
            $villeParticulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($codepostalParticulier1))
        {
            $codepostalParticulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($paysParticulier1))
        {
            $paysParticulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if(empty($quantiteParticulier1))
        {
            $quantiteParticulier1Erreur = 'Ce champs ne peut être vide';
            $estValide        = false;
        }
        if($estValide)
        {
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO particuliers (nom, prenom, mail, indicatif, telephone, adresse1, adresse2, zipcode, ville, pays, quantite)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $statement->execute(array($nomParticulier1,$prenomParticulier1,$emailParticulier1,$indicatifParticulier1,$telephoneParticulier1,$adresse1Particulier1,$adresse2Particulier1,$codepostalParticulier1,$villeParticulier1,$paysParticulier1,$quantiteParticulier1));
            try {
                //configuration
                $mailCommande->isSMTP();
                //Configuration du SMTP
                $mailCommande->Host         = 'mail03.lwspanel.com';
                $mailCommande->SMTPAuth     = true;
                $mailCommande->Username     = 'contact@laprieredetarawih.com';
                $mailCommande->Password     = 'Metmati121267@';
                $mailCommande->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;
                $mailCommande->Port         = 465;
                //Charset
                $mailCommande->CharSet = 'utf-8';
                // Expéditeur
                $mailCommande->setFrom('contact@laprieredetarawih.com', 'Contre Offensive édition');
                // Destinataires
                $mailCommande->addAddress($emailParticulier1);     //Add a recipient
                $mailCommande->addBCC('metmati12@hotmail.fr');
                //Contenu
                $mailCommande->isHTML(true);                                  //Set email format to HTML
                $mailCommande->Subject = "$prenomParticulier1 Confirmation Commande Tarawih";
                $mailCommande->Body    = "Salam aleykoum <b>$prenomParticulier1</b>!
                <br>Nous confirmons la commande du livre <b>Tarawih la prière innovée</b> de Maamar Metmati !<br>
                Qu'Allah t'en récompense grandement !<br>
                Voici tes informations : <br>
                <ul>
                    <li>Nom : $nomParticulier1 </li>
                    <li>Prénom : $prenomParticulier1 </li>
                    <li>Mail : $emailParticulier1 </li>
                    <li>Téléphone : +$indicatifParticulier1 $telephoneParticulier1 </li>
                    <li>Adresse Complete : $adresse1Particulier1 </li>
                    <li>$adresse2Particulier1</li>
                    <li>Code Postal : $codepostalParticulier1 </li>
                    <li>Ville : $villeParticulier1 </li>
                    <li>Pays : $paysParticulier1 </li>
                </ul>
                Dès lors où ton colis sera envoyé, tu recevras un mail te confirmant son envoi.<br>
                En attendant, tu peux lire le livre Tarawih en PDF.<br>
                ";
                $mailCommande->send();
            } catch (Exception $th) {
                echo "Message non envoyé";
            }
            Database::disconnect();
            header("Location: confirmation-commande-livre.php");
        }
    }

    $nomParticulier2Erreur = $prenomParticulier2Erreur = $emailParticulier2Erreur = $indicatifParticulier2Erreur = $telephoneParticulier2Erreur = $nomBureauParticulier2Erreur = $codeBureauParticulier2Erreur = $villeParticulier2Erreur = $paysParticulier2Erreur = $quantiteParticulier2Erreur =
    $nomParticulier2 = $prenomParticulier2 = $emailParticulier2 = $indicatifParticulier2 = $telephoneParticulier2 = $nomBureauParticulier2 = $codeBureauParticulier2 = $villeParticulier2 = $paysParticulier2 = $quantiteParticulier2 = "";
    if (!empty($_POST["formParticulierB"]))
    {
        $nomParticulier2                = checkInput($_POST['nom2']);
        $prenomParticulier2             = checkInput($_POST['prenom2']);
        $emailParticulier2              = checkInput($_POST['mail2']);
        $indicatifParticulier2          = checkInput($_POST['indicatif2']);
        $telephoneParticulier2          = checkInput($_POST['telephone2']);
        $nomBureauParticulier2          = checkInput($_POST['nombureau2']);
        $codeBureauParticulier2         = checkInput($_POST['codebureau2']);
        $villeParticulier2              = checkInput($_POST['ville2']);
        $paysParticulier2               = checkInput($_POST['pays2']);
        $quantiteParticulier2           = checkInput($_POST['quantiteparticulier2']);
        $estValide2                      = true;
        $mailCommande2 = new PHPMailer(true);

        if(empty($nomParticulier2))
        {
            $nomParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if(empty($prenomParticulier2))
        {
            $prenomParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if(empty($emailParticulier2))
        {
            $emailParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if(empty($telephoneParticulier2))
        {
            $telephoneParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if(empty($indicatifParticulier2))
        {
            $indicatifParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if(empty($nomBureauParticulier2))
        {
            $nomBureauParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if(empty($codeBureauParticulier2))
        {
            $codeBureauParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if(empty($villeParticulier2))
        {
            $villeParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if(empty($paysParticulier2))
        {
            $paysParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if(empty($quantiteParticulier2))
        {
            $quantiteParticulier2Erreur = 'Ce champs ne peut être vide';
            $estValide2        = false;
        }
        if($estValide2)
        {
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO particuliersb (nom, prenom, mail, indicatif, telephone, nombureau, codebureau, ville, pays, quantite)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $statement->execute(array($nomParticulier2,$prenomParticulier2,$emailParticulier2,$indicatifParticulier2,$telephoneParticulier2,$nomBureauParticulier2,$codeBureauParticulier2,$villeParticulier2,$paysParticulier2,$quantiteParticulier2));
            try {
                //configuration
                $mailCommande2->isSMTP();
                //ConfiguratimailCommande2on du SMTP
                $mailCommande2->Host         = 'mail03.lwspanel.com';
                $mailCommande2->SMTPAuth     = true;
                $mailCommande2->Username     = 'contact@laprieredetarawih.com';
                $mailCommande2->Password     = 'Metmati121267@';
                $mailCommande2->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;
                $mailCommande2->Port         = 465;
                //Charset
                $mailCommande2->CharSet = 'utf-8';
                // Expéditeur
                $mailCommande2->setFrom('contact@laprieredetarawih.com', 'Contre Offensive édition');
                // Destinataires
                $mailCommande2->addAddress($emailParticulier2);     //Add a recipient
                $mailCommande2->addBCC('metmati12@hotmail.fr');
                //Contenu
                $mailCommande2->isHTML(true);                                  //Set email format to HTML
                $mailCommande2->Subject = "$prenomParticulier2 Confirmation Commande Tarawih (Sans adresse)";
                $mailCommande2->Body    = "Salam aleykoum <b>$prenomParticulier2</b>!
                <br>Nous confirmons la commande du livre <b>Tarawih la prière innovée</b> de Maamar Metmati !<br>
                Qu'Allah t'en récompense grandement !<br>
                Voici tes informations : <br>
                <ul>
                    <li>Nom : $nomParticulier2 </li>
                    <li>Prénom : $prenomParticulier2 </li>
                    <li>Mail : $emailParticulier2 </li>
                    <li>Téléphone : +$indicatifParticulier2 $telephoneParticulier2 </li>
                    <br><b>Adresse Bureau de Poste</b>
                    <li>Nom du bureau : $nomBureauParticulier2 </li>
                    <li>Code du Bureau : $codeBureauParticulier2</li>
                    <li>Ville : $villeParticulier2 </li>
                    <li>Pays : $paysParticulier2 </li>
                </ul>
                Dès lors où ton colis sera envoyé, tu recevras un mail te confirmant son envoi.<br>
                En attendant, tu peux lire le livre Tarawih en PDF<br>
                ";
                $mailCommande2->send();
            } catch (Exception $th) {
                echo "Message non envoyé";
            }
            Database::disconnect();
            header("Location: confirmation-commande-livre.php");
        }
    }

    $nomProErreur = $mailProErreur = $indicatifProErreur = $telephoneProErreur = $adresseProErreur = $codepostalProErreur = $villeProErreur = $paysProErreur = $quantitePro3Erreur =
    $nomPro = $mailPro = $indicatifPro = $telephonePro = $adressePro = $codepostalPro = $villePro = $paysPro = $quantitePro3 = "";
    if (!empty($_POST["formprofessionnel"]))
    {
        $nomPro                  = checkInput($_POST['nom3']);
        $mailPro                 = checkInput($_POST['mail3']);
        $indicatifPro            = checkInput($_POST['indicatif3']);
        $telephonePro            = checkInput($_POST['telephone3']);
        $adressePro              = checkInput($_POST['adresse3']);
        $codepostalPro           = checkInput($_POST['codepostal3']);
        $villePro                = checkInput($_POST['ville3']);
        $paysPro                 = checkInput($_POST['pays3']);
        $quantitePro3            = checkInput($_POST['quantitepro3']);
        $estValide3              = true;
        $mailCommandePro = new PHPMailer(true);

        if(empty($nomPro))
        {
            $nomProErreur = 'Ce champs ne peut être vide';
            $estValide3        = false;
        }
        if(empty($mailPro))
        {
            $mailProErreur = 'Ce champs ne peut être vide';
            $estValide3        = false;
        }
        if(empty($indicatifPro))
        {
            $indicatifProErreur = 'Ce champs ne peut être vide';
            $estValide3        = false;
        }
        if(empty($telephonePro))
        {
            $telephoneProErreur = 'Ce champs ne peut être vide';
            $estValide3        = false;
        }
        if(empty($adressePro))
        {
            $adresseProErreur = 'Ce champs ne peut être vide';
            $estValide3        = false;
        }
        if(empty($codepostalPro))
        {
            $codepostalProErreur = 'Ce champs ne peut être vide';
            $estValide3        = false;
        }
        if(empty($villePro))
        {
            $villeProErreur = 'Ce champs ne peut être vide';
            $estValide3        = false;
        }
        if(empty($paysPro))
        {
            $paysProErreur = 'Ce champs ne peut être vide';
            $estValide3        = false;
        }
        if(empty($quantitePro3))
        {
            $quantitePro3Erreur = 'Ce champs ne peut être vide';
            $estValide3        = false;
        }
        if($estValide3)
        {
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO professionnels (nomentreprise, mail, indicatif, telephone, adresse, zipcode, ville, pays, quantitelivre)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $statement->execute(array($nomPro,$mailPro,$indicatifPro,$telephonePro,$adressePro,$codepostalPro,$villePro,$paysPro,$quantitePro3));
            try {
                //configuration
                $mailCommandePro->isSMTP();
                //Configuration du SMTP
                $mailCommandePro->Host         = 'mail03.lwspanel.com';
                $mailCommandePro->SMTPAuth     = true;
                $mailCommandePro->Username     = 'contact@laprieredetarawih.com';
                $mailCommandePro->Password     = 'Metmati121267@';
                $mailCommandePro->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;
                $mailCommandePro->Port         = 465;
                //Charset
                $mailCommandePro->CharSet = 'utf-8';
                // Expéditeur
                $mailCommandePro->setFrom('contact@laprieredetarawih.com', 'Contre Offensive édition');
                // Destinataires
                $mailCommandePro->addAddress($mailPro);     //Add a recipient
                $mailCommandePro->addBCC('metmati12@hotmail.fr');
                //Contenu
                $mailCommandePro->isHTML(true);                                  //Set email format to HTML
                $mailCommandePro->Subject = "$nomPro Confirmation Commande Tarawih (Pro)";
                $mailCommandePro->Body    = "Salam aleykoum <b>$nomPro</b>!
                <br>Nous confirmons la commande du livre <b>Tarawih la prière innovée</b> de Maamar Metmati !<br>
                Qu'Allah t'en récompense grandement !<br>
                Voici tes informations : <br>
                <ul>
                    <li>Nom : $nomPro </li>
                    <li>Mail : $mailPro </li>
                    <li>Téléphone : +$indicatifPro $telephonePro </li>
                    <li>Adresse Complete : $adressePro </li>
                    <li>Code Postal : $codepostalPro </li>
                    <li>Ville : $villePro </li>
                    <li>Pays : $paysPro </li>
                </ul>
                Dès lors où ton colis sera envoyé, tu recevras un mail te confirmant son envoi.<br>
                Tu peux dès à présent, si tu le souhaites, lire le livre Tarawih en PDF<br>
                ";
                $mailCommandePro->send();
            } catch (Exception $th) {
                echo "Message non envoyé";
            }
            Database::disconnect();
            header("Location: confirmation-commande-livre.php");
        }
    }

    $emailDownloadErreur = $emailDownload = "";
    if (!empty($_POST["formtelechargement"]))
    {
        $emailDownload                  = checkInput($_POST['maildownload']);
        $estValide5                   = true;
        $mailTelechargement = new PHPMailer(true);

        if(empty($emailDownload))
        {
            $emailDownloadErreur = 'Ce champs ne peut être vide';
            $estValide5        = false;
        }
        if($estValide5)
        {
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO download (mail)
            VALUES (?)');
            $statement->execute(array($emailDownload));
            try {
                //configuration
                $mailTelechargement->isSMTP();
                //Configuration du SMTP
                $mailTelechargement->Host         = 'mail03.lwspanel.com';
                $mailTelechargement->SMTPAuth     = true;
                $mailTelechargement->Username     = 'contact@laprieredetarawih.com';
                $mailTelechargement->Password     = 'Metmati121267@';
                $mailTelechargement->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;
                $mailTelechargement->Port         = 465;
                //Charset
                $mailTelechargement->CharSet = 'utf-8';
                // Expéditeur
                $mailTelechargement->setFrom('contact@laprieredetarawih.com', 'Contre Offensive édition');
                // Destinataires
                $mailTelechargement->addAddress($emailDownload);     //Add a recipient
                $mailTelechargement->addBCC('metmati12@hotmail.fr');
                //Attachments
                //Contenu
                $mailTelechargement->isHTML(true);                                  //Set email format to HTML
                $mailTelechargement->Subject = "Telechargement du livre Tarawih";
                $mailTelechargement->Body    = "Salam aleykoum !
                <br>Qu'Allah te récompense pour avoir téléchargé le livre <b>Tarawih la prière innovée</b> de Maamar Metmati !<br>
                Si tu le souhaites, tu peux commander le livre <b>GRATUITEMENT</b><br>
                Disponible EUROPE et HORS-EUROPE<br>
                ";
                $mailTelechargement->send();
            } catch (Exception $th) {
                echo "Message non envoyé";
            }
            Database::disconnect();
            header("Location: confirmation-telechargement-livre.php");

            }
    }

    $emailMessageErreur = $objetMessageErreur = $messageErreur = $mailMessage = $objetMessage = $message = "";
    if (!empty($_POST["form-message"]))
    {
        $mailMessage                  = checkInput($_POST['mailmessage1']);
        $objetMessage                 = checkInput($_POST['objetmessage1']);
        $message                      = checkInput($_POST['message1']);
        $estValide4                   = true;
        $mailerMessage = new PHPMailer(true);

        if(empty($mailMessage))
        {
            $mailMessageErreur = 'Ce champs ne peut être vide';
            $estValide4        = false;
        }
        if(empty($objetMessage))
        {
            $objetMessageErreur = 'Ce champs ne peut être vide';
            $estValide4        = false;
        }
        if(empty($message))
        {
            $messageErreur = 'Ce champs ne peut être vide';
            $estValide4        = false;
        }
        if($estValide4)
        {
            $db = Database::connect();
            $statement = $db->prepare('INSERT INTO messages (mail,objet,contenu)
            VALUES (?, ?, ?)');
            $statement->execute(array($mailMessage,$objetMessage,$message));
            try {
                //configuration
                $mailerMessage->isSMTP();
                //Configuration du SMTP
                $mailerMessage->Host         = 'mail03.lwspanel.com';
                $mailerMessage->SMTPAuth     = true;
                $mailerMessage->Username     = 'contact@laprieredetarawih.com';
                $mailerMessage->Password     = 'Metmati121267@';
                $mailerMessage->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;
                $mailerMessage->Port         = 465;
                //Charset
                $mailerMessage->CharSet = 'utf-8';
                // Expéditeur
                $mailerMessage->setFrom('contact@laprieredetarawih.com', 'Contre Offensive édition');
                // Destinataires
                $mailerMessage->addAddress('contact@laprieredetarawih.com');     //Add a recipient
                $mailerMessage->addBCC('metmati12@hotmail.fr');
                //Contenu
                $mailerMessage->isHTML(true);                                  //Set email format to HTML
                $mailerMessage->Subject = "$objetMessage";
                $mailerMessage->Body    = "<b>$mailMessage</b> cherche à te contacter.<br>Message : <br>$message";
                $mailerMessage->send();
            } catch (Exception $th) {
                echo "Message non envoyé";
            }
            Database::disconnect();
            $success = '<div class="alert alert-success" role="alert">Votre mail a bien été envoyé ! Nous vous répondrons dès que possible !</div>';
            echo $success;
            }
    }
function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
include ("elements/head.php");
include ("elements/header.php");
?>

<div class="modal fade" id="formulairecommande" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="formulairecommandeLabel">Commande du Livre Tarawih</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#formcommandeParticulierA" aria-expanded="false" aria-controls="formcommandeParticulierA">
    Particulier
        </button>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#formcommandeParticulierB" aria-expanded="false" aria-controls="formcommandeParticulierB">
    Particulier (Sans Adresse Postale)
        </button>
        <div class="collapse" id="formcommandeParticulierA">
            <form action="" method="post" id="formParticulierA">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Nom</span>
                    <input class="form-control" type="text" id="nom1" name="nom1" value="<?php echo $nomParticulier1 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Prénom</span>
                    <input class="form-control" type="text" id="prenom1" name="prenom1" value="<?php echo $prenomParticulier1 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Mail</span>
                    <input class="form-control" type="email" id="mail1" name="mail1" value="<?php echo $emailParticulier1 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Indicatif Pays +</span>
                    <input class="form-control" type="number" id="indicatif1" name="indicatif1" value="<?php echo $indicatifParticulier1 ;?>" required>
                    <span class="input-group-text" id="basic-addon3">Telephone</span>
                    <input class="form-control" type="tel" id="telephone1" name="telephone1" value="<?php echo $telephoneParticulier1 ;?>" pattern="[0-9]{1}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" required>
                    <small>Ne pas mettre le 0 de votre téléphone : L'indicatif remplacera le 0.</small>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Adresse 1</span>
                    <input class="form-control" type="text" id="adresse11" name="adresse11" value="<?php echo $adresse1Particulier1 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Adresse 2 (Complément d'adresse)</span>
                    <input class="form-control" type="text" id="adresse21" name="adresse21" value="<?php echo $adresse2Particulier1 ;?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Code Postal</span>
                    <input class="form-control" type="number" id="codepostal1" name="codepostal1" value="<?php echo $codepostalParticulier1 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Ville</span>
                    <input class="form-control" type="text" id="ville1" name="ville1" value="<?php echo $villeParticulier1 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Pays</span>
                    <input class="form-control" type="text" id="pays1" name="pays1" value="<?php echo $paysParticulier1 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Quantité</span>
                    <?php
                        $db = Database::connect();
                        foreach($db->query('SELECT * FROM quantiteparticulier') as $rowptClient)
                        {
                            echo '<input class="form-control" type="number" id="quantiteparticulier1" name="quantiteparticulier1" value="'. $rowptClient['nblivre'] .'" min="1" max="1" required>';
                        }
                        Database::disconnect();
                    ?>
                </div>
                <button type="submit" form="formParticulierA" name="formParticulierA" value="commande1" class="btn btn-success">Commander</button>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
        <div class="collapse" id="formcommandeParticulierB">
            <form action="" method="post" id="formParticulierB">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Nom</span>
                    <input class="form-control" type="text" id="nom2" name="nom2" value="<?php echo $nomParticulier2 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Prénom</span>
                    <input class="form-control" type="text" id="prenom2" name="prenom2" value="<?php echo $prenomParticulier2 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Mail</span>
                    <input class="form-control" type="email" id="mail2" name="mail2" value="<?php echo $emailParticulier2 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Indicatif Pays +</span>
                    <input class="form-control" type="number" id="indicatif2" name="indicatif2" value="<?php echo $indicatifParticulier2 ;?>" required>
                    <span class="input-group-text" id="basic-addon3">Telephone</span>
                    <input class="form-control" type="tel" id="telephone2" name="telephone2" pattern="[0-9]{1}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" value="<?php echo $telephoneParticulier2 ;?>" required>
                    <small>Ne pas mettre le 0 de votre téléphone : L'indicatif remplacera le 0.</small>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Nom du Bureau de Poste</span>
                    <input class="form-control" type="text" id="nombureau2" name="nombureau2" value="<?php echo $nomBureauParticulier2 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Code du Bureau de Poste</span>
                    <input class="form-control" type="text" id="codebureau2" name="codebureau2" value="<?php echo $codeBureauParticulier2 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Ville</span>
                    <input class="form-control" type="text" id="ville2" name="ville2" value="<?php echo $villeParticulier2 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Pays</span>
                    <input class="form-control" type="text" id="pays2" name="pays2" value="<?php echo $paysParticulier2 ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Quantité</span>
                    <?php
                        $db = Database::connect();
                        foreach($db->query('SELECT * FROM quantiteparticulier') as $rowptClient)
                        {
                            echo '<input class="form-control" type="number" id="quantiteparticulier2" name="quantiteparticulier2" value="'. $rowptClient['nblivre'] .'" min="1" max="1" required>';
                        }
                        Database::disconnect();
                    ?>
                </div>
                <button type="submit" form="formParticulierB" name="formParticulierB" value="commande2" class="btn btn-success">Commander</button>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="formulairecommandepro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="formulairecommandeproLabel">Commande du Livre Tarawih (Pro)</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="formprofessionnelA">
            <form action="" method="post" id="formprofessionnel">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Nom de l'Entreprise/Association</span>
                    <input class="form-control" type="text" id="nom3" name="nom3" value="<?php echo $nomPro ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Mail</span>
                    <input class="form-control" type="email" id="mail3" name="mail3" value="<?php echo $mailPro ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Indicatif Pays +</span>
                    <input class="form-control" type="number" id="indicatif3" name="indicatif3" value="<?php echo $indicatifPro ;?>" required>
                    <span class="input-group-text" id="basic-addon3">Telephone</span>
                    <input class="form-control" type="tel" id="telephone3" name="telephone3" value="<?php echo $telephonePro ;?>" pattern="[0-9]{1}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" required>
                    <small>Ne pas mettre le 0 de votre téléphone : L'indicatif remplacera le 0.</small>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Adresse Postale</span>
                    <input class="form-control" type="text" id="adresse3" name="adresse3" value="<?php echo $adressePro ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Code Postal</span>
                    <input class="form-control" type="number" id="codepostal3" name="codepostal3" value="<?php echo $codepostalPro ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Ville</span>
                    <input class="form-control" type="text" id="ville3" name="ville3" value="<?php echo $villePro ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Pays</span>
                    <input class="form-control" type="text" id="pays3" name="pays3" value="<?php echo $paysPro ;?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Quantité</span>
                    <?php
                        $db = Database::connect();
                        foreach($db->query('SELECT * FROM quantitepro') as $rowptClient)
                        {
                            echo '<input class="form-control" type="number" id="quantitepro3" name="quantitepro3" value="'. $rowptClient['nblivrepro'] .'" min="10" max="10" required>';
                        }
                        Database::disconnect();
                    ?>
                </div>
            </form>
                            <button type="submit" form="formprofessionnel" name="formprofessionnel" value="commande3" class="btn btn-success">Commander</button>

        </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="formulairetelechargement" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="formulairetelechargementLabel">Téléchargement du Livre Tarawih</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="formtelechargementA">
            <form action="" method="post" enctype="multipart/form-data" id="formtelechargement">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Mail</span>
                    <input class="form-control" type="email" id="maildownload" name="maildownload" value="<?php echo $emailDownload ;?>" required>
                </div>
                <div class="input-group mb-3" hidden>
                    <a href="La-priere-de-Tarawih.pdf" target="_blank" download="La prière de tarawih"></a>
                </div>
                    <button type="submit" form="formtelechargement" name="formtelechargement" value="telechargement" class="btn btn-success">Télécharger</button>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section id="accueil" class="container-fluid">
    <div class="row-accueil">
        <div class="box-container">
            <h1><b>Tarawih</b> - Ramadan 2024</h1>
            <p class="paragraphe"><b>La prière de Tarawih</b> est un livre dédié exclusivement à l'étude du Tarawih : une aune à la vérité sur un sujet théologique de l'Islam, notre religion.</p>
            <p class="paragraphe">L'approche de cette ouvrage se veut à la fois de réfuter les arguments que l'on rencontre à ce sujet, sur le net, sur le web, dans des ouvrages, mais aussi de savants contemporains.</p>
            <p class="paragraphe">L'approche se veut impartiale et ne laissera que pantois, ceux et celles parmi nos frères et soeurs musulmans et musulmanes, se faire leurrer par ce que je nomme
                une dissimulation trompeuse.
            </p>
        </div>
        <div class="gallery">
            <img src="assets/images/livre-tarawih.png" alt="">
            <img src="assets/images/tarawih-arabe_carre_tn.png" alt="">
            <img src="assets/images/tarawih-english_carre_tn.png" alt="">
            <img src="assets/images/tarawih-turk_tn.png" alt="">
        </div>
    </div>
</section>
<section id="commande" class="container">
    <div class="row-commande">
        <div class="box-container">
            <h2>
                <span class="material-symbols-rounded">add_shopping_cart</span>
                <span class="material-symbols-rounded">trending_flat</span>
                <span class="material-symbols-rounded">order_approve</span>
                <span class="material-symbols-rounded">trending_flat</span>
                <span class="material-symbols-rounded">local_shipping</span>
                <br>
                Commander le livre Tarawih Version Papier
            </h2>
            <div class="box1">
                <p>Le livre <i>La prière de Tarawih</i> est déjà disponible en version papier.</p>
                <p>Un livre de référence islamique qui vous permettra de comprendre la profondeur du sujet dans 110 pages de vérité sur l'islam, comptant <b>228 références islamiques</b></p>
                <p>Notre approche est objective et impartiale, car elle se veut par le biais de l'étude d'ouvrages sunnites, et notamment à travers 
                    le sahih de Boukhari, le sahih de Mouslim et d'autres ouvrages de savants qui appuyeront notre thèse, se rapprocher du Coran, de la Sunna du Prophète,
                    et au final, d'Allah.
                </p>
                <ul>
                    <li>LIVRE PAPIER GRATUIT</li>
                    <li>LIVRAISON GRATUITE</li>
                    <li>Pour le Tarawih Ramadan 2024, c'est un beau cadeau à offrir à nos frères et soeurs du monde entier</li>
                    <li>Un livre de référence islamique sur la question de la prière de Tarawih</li>
                </ul>
                <button type="button" class="primary" data-bs-toggle="modal" data-bs-target="#formulairecommande">Commander le Livre GRATUIT<span> (pour particulier) </span></button>
            </div>
        </div>
        <div class="box-img">
            <img class="commande" src="assets/images/livre-tarawih.png" alt="">
        </div>
    </div>
</section>
<section id="telechargement" class="container">
    <div class="row-telechargement-fr">
        <div class="box-container">
            <h2>
                <span class="material-symbols-outlined">cloud_download</span>
                <br>
            Télécharger le Livre Tarawih en Français
            </h2>
            <div class="box1">
                <p>Le livre La prière de <b>Tarawih</b> a été écrit en avril 2020 et a été mis à disposition des lecteurs, gratuitement.</p>
                <p>Aujourd'hui, <b>pas moins de 100 000 personnes ont lu notre ouvrage en PDF. Et plus de 30 000 personnes ont le livre</b> entre leur main.</p>
                <p>Notre but étant de mettre fin à cette innovation mondiale qu'est le Tarawih, une prière qui est pourtant pratiquée par la majorité des musulmans.</p>
                <p>Sommes-nous dans le faux ou dans la vérité ? Vous trouverez la réponse dans cet ouvrage impartial.</p>
                <ul>
                    <li>LIVRE GRATUIT EN PDF : La prière de Tarawih</li>
                    <li>Partager sur tous les réseaux sociaux</li>
                    <li>Ramadan 2024, la fin d'une innovation mondiale</li>
                    <li>Un livre de référence islamique sur la question de la prière de Tarawih</li>
                </ul>
                <button class="primary" data-bs-toggle="modal" data-bs-target="#formulairetelechargement">Télécharger le Livre GRATUIT</button>
            </div>
        </div>
        <div class="box-img">
            <img class="telechargement" src="assets/images/livre-tarawih.png" alt="">
        </div>
    </div>
    <div class="row-telechargement-turc">
        <div class="box-img">
            <img class="telechargement" src="assets/images/tarawih-turk_tn.png" alt="">
        </div>
        <div class="box-container">
            <h2>
                <span class="material-symbols-outlined">cloud_download</span>
                <br>
                Télécharger le livre Teravih en Turc
            </h2>
            <div class="box1">
                <p>Le livre La prière de Tarawih a été traduit en turc et est disponible en version PDF.</p>
                <p>Pour ceux et celles qui veulent partager à leur entourage turc, partagez-leur !</p>
                <p>Le dévoilement de cette innovation se fera avec ou sans vous. C'est le dévoilement de l'innovation du Tarawih !</p>
                <ul>
                    <li>LIVRE GRATUIT EN PDF : La prière de Tarawih</li>
                    <li>Partager sur tous les réseaux sociaux</li>
                    <li>Ramadan 2024, la fin d'une innovation mondiale</li>
                    <li>Un livre de référence islamique sur la question de la prière de Tarawih</li>
                </ul>
                <a href="Teravih-Namazı-Türkçe-düzeltilmiş.pdf" target="_blank" download="Teravih Namazı Türkçe düzeltilmiş"><button class="primary">Télécharger le Livre GRATUIT</button></a>
            </div>
        </div>
    </div>
</section>
<section id="reseaux" class="reseaux">
    <h2>
        <ion-icon name="globe"></ion-icon>
        <br>
        Nos Réseaux
    </h2>
    <p class="slogan">"L'un des devoirs du musulman, est de se joindre à ceux qui portent la vérité et de s'enjoindre mutuellement la vérité et l'endurance"</p>
    <div itemscope itemtype="https://schema.org/Organization" class="row-reseaux" >
        <div class="box2-col">
            <div class="box2-row fb">
                <ion-icon name="logo-facebook"></ion-icon>
                <a itemprop="sameAs" href="https://www.facebook.com/MaamarMetmatiOfficiel" target="_blank"><p>S'abonner</p></a>
            </div>
            <p class="logo">Facebook</p>
        </div>
        <div class="box2-col">
            <div class="box2-row youtube">
                <ion-icon name="logo-youtube"></ion-icon>
                <a itemprop="sameAs" href="https://www.youtube.com/c/MaamarMetmatiOfficiel12" target="_blank"><p>S'abonner</p></a>
            </div>
            <p class="logo">Youtube</p>
        </div>
        <div class="box2-col">
            <div class="box2-row twitter">
                <ion-icon name="logo-twitter"></ion-icon>
                <a itemprop="sameAs" href="https://twitter.com/OfficielMaamar" target="_blank"><p>S'abonner</p></a>
            </div>
            <p class="logo">Twitter</p>
        </div>
        <div class="box2-col">
            <div class="box2-row telegram">
                <ion-icon name="Navigate"></ion-icon>
                <a itemprop="sameAs" href="https://t.me/maamarmetmati" target="_blank"><p>S'abonner</p></a>
            </div>
            <p class="logo">Telegram</p>
        </div>
        <div class="box2-col">
            <div class="box2-row soundcloud">
                <ion-icon name="logo-soundcloud"></ion-icon>
                <a itemprop="sameAs" href="https://soundcloud.com/maamarmetmati" target="_blank"><p>S'abonner</p></a>
            </div>
            <p class="logo">Soundcloud</p>
        </div>
        <div class="box2-col">
            <div class="box2-row instagram">
                <ion-icon name="logo-instagram"></ion-icon>
                <a itemprop="sameAs" href="https://www.instagram.com/maamarmetmati/?hl=fr" target="_blank"><p>S'abonner</p></a>
            </div>
            <p class="logo">Instagram</p>
        </div>
    </div>
</section>
<section id="resume" class="resume" itemscope itemtype="http://schema.org/Book">
        <h2>Résumé et Questions-Réponses</h2>
        <div class="box3-row">
            <div class="resume-col">
                <h3><ion-icon name="reader-outline"></ion-icon> Résumé du Livre</h3>
                C’est en 2005 que pour la première fois, le livre La prière de Tarawih a été édité en langue française.<br><br>

                Après trois années d’investigations, il fut, en 2008, réédité, augmenté et traduit en Anglais et en Arabe.<br><br>

                Douze années d'investigations supplémentaires sont passées, pour que voit le jour du 21 août 2020, la réédition du livre La prière de Tarawih en langue Française et Turc.
                <br><br>
                Fin 2023 - Début 2024, soit 3 ans plus tard, nous éditons de nouveau le livre La prière de Tarawih dans une version augmentée et corrigée, en langue Française et Arabe.
                <br><br>
                Cette « aventure » commence un jour de l’année 2005, lorsqu’au cours de mes lectures, je prends connaissance de ce hadith : « Dorénavant, ô fidèles, priez dans vos demeures, car la meilleure prière pour un homme est celle qu’il fait chez lui, à moins qu’il ne s’agisse de la prière canonique [1]». De par son caractère péremptoire, il m’interpella alors vivement.
                <br><br>
                Je m’interrogeais alors profondément. Quelle théorie théologique, quelle réflexion savantissime, pouvait justifier que nous fassions l’exact contraire ?
                <br><br>
                Ce hadith est-il faux ? Mal traduit ? Abrogé ?
                <br><br>
                Depuis ce jour de 2005 à aujourd’hui et probablement jusqu’à la fin de mes jours, je ne cesserai de tirer sur la ficelle, afin que, si Allah me le permet, je puisse enfin connaitre la vérité.
                <br><br>
                Cette vérité qui a été et j’en suis absolument convaincu, incroyablement bien dissimulée par le plus souvent, ceux qui croient que Omar ibn Khattab رضي الله عنه fait partie de la croyance et parfois bien plus que le prophète lui-même !
                <br><br>
                Je sais que je ne connaîtrai jamais toute la vérité, mais à l’heure d’aujourd’hui, j’en sais suffisamment assez pour affirmer que l'on nous a menti.
                <br><br>
                [1] Sahih de l’imam Boukhari et Muslim.
                </p>
            </div>
            <div class="descriptif-col">
                <h3><ion-icon name="list-outline"></ion-icon> Description Technique du Livre</h3>
                <ul>
                    <li itemprop="name"><p><span>Nom : </span>La prière de Tarawih</p><i></i></li>
                    <li><p><span>Auteur : </span><span itemprop="author">Maamar Metmati</span></p><i></i></li>
                    <li><p><span>Editeur : </span><span itemprop="publisher">Contre Offensive édition</span></p><i></i></li>
                    <li><p><span>Langue : </span><span itemprop="inLanguage">Français</span></p><i></i></li>
                    <li><p><span>Nombre de Page : </span><span itemprop="numberOfPages">110</span></p><i></i></li>
                    <li><p><span>Date de Publication : </span><meta itemprop="datePublished" content="2020-08-21">21 Août 2020</p><i></i></li>
                    <li><p><span>Prix : </span><span itemprop="price">GRATUIT</span></p><i></i></li>
                </ul>
            </div>
        </div>
        <div itemscope itemtype="https://schema.org/FAQPage" class="qr-col">
            <h3><ion-icon name="help-circle-outline"></ion-icon> Questions-Réponses</h3>
            <div class="accordion" id="qr">
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="accordion-item">
                    <h4 class="accordion-header" id="qr-titre1">
                    <button itemprop="name" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Pourquoi écrire un livre sur le Tarawih ? #1
                    </button>
                    </h4>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="qr-titre1">
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="accordion-body">
                        <p itemprop="text">
                            Ce n'est que la sincérité et la propagation de la vérité qui m'a animé d'écrire l'ouvrage Tarawih la prière innovée. Pour cette 5ème édition de l'ouvrage, 
                            j'ai tout mis en oeuvre pour faire comprendre que le Tarawih est une innovation. Une innovation interdite, une innovation blamâble, qui rentre en contradiction
                            tant à la fois à l'ordre du Prophète Muhammad, mais aussi aux enseignements et à la vie du Prophète Muhammad.
                            <br><br>
                            Cet ouvrage est là pour mettre fin tant que faire ce peu, à une innovation mondiale. Qui dit innovation, dit forcément déviation de la voie du Prophète. Pourquoi 
                            donc ne pas revenir à la réelle voie du Prophète Muhammad, à savoir de prier à la maison les prières surérogatoires, et de ne plus jamais pratiqué la prière de Tarawih.
                            <br><br>
                            Nous faisons face à de féroces et violentes accusations, mais dans la vérité, nous ne craignons le blâme d'aucun blâmeur.
                            <br><br>
                            Ce n'est qu'un jour de l'année 2005, où j'ai constaté qu'un hadith du Prophète ordonné à la communauté de prier à la maison, en dehors 
                            et pendant le ramadan. Ainsi, ce qu'ordonne le Prophète étant en total opposition avec la pratique du Tarawih, je me suis posé un certain 
                            nombre de question pour en aboutir 17 ans plus tard, à une argumentation impartiale quant au sujet du Tarawih.
                        </p>
                    </div>
                    </div>
                </div>
                <div itemscope itemtype="https://schema.org/Question" class="accordion-item">
                    <h4 class="accordion-header" id="qr-titre2">
                    <button itemprop="name" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        C'est quoi le Tarawih ? #2
                    </button>
                    </h4>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="qr-titre2">
                    <div itemscope itemprop="mainEntity" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="accordion-body">
                        <p itemprop="text">Le Tarawih ou Taraweeh, est une pratique durant le mois du Ramadan où les croyants musulmans se rassemble dans les mosquées
                            pour prier derrière un seul imam, en groupe. Cette pratique fut instituée par Omar ibn al Khattab, deuxième calife de l'Islam. Lui venant une idée,
                            il lui sembla juste de rassembler les fidèles derrière un seul imam, alors qu'il voyait ces mêmes croyants dans la mosquée durant les nuits du ramadan,
                            être soit dispersé, soit seul, à prier.
                            <br><br>
                            Loin de cette question de revivification de la Sunnah du Prophète, Omar ordonna à toutes les cités musulmane de se rassembler derrière un seul, durant les nuits du ramadan, 
                            pour prier dans les mosquées.
                            <br><br>
                            On aurait pu se dire que cette prière fut établi par le Prophète. Ce qui n'est pas du tout le cas, car le Prophète n'a jamais ordonné au gens de prier dans les mosquées, des prières surérogatoires.
                            Au contraire, le Prophète a ordonné aux gens de prier à la maison les prières surérogatoires. Ainsi, le Prophète a institué le Qiyam Lail, dont le Prophète lui-même a suivi 
                            la révélation révélée d'Allah. Et par conséquent, il a suivi les enseignements d'Allah.
                            <br>
                        </p>
                    </div>
                    </div>
                </div>
                <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="accordion-item">
                    <h4 class="accordion-header" id="qr-titre3">
                    <button itemprop="name" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        L'histoire du Tarawih #3
                    </button>
                    </h4>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="qr-titre3">
                    <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="accordion-body">
                        <p itemprop="text">Ce n'est qu'une nuit du Ramadan, où Omar ibn al-Khattab innova la prière de Tarawih. Il lui sembla une bonne idée que 
                            de rassembler les gens derrière un seul imam durant les nuits du Ramadan, pour prier les prières surérogatoires de nuits. Cet acte fut effectué 
                            durant les nuits du Ramadan au début de son Califat. Ainsi, bien après la mort du Prophète Muhammad. Cela fut pour lui une excellente innovation.
                            <br><br>
                            Or, il s'avère que le Prophète Muhammad, n'ayant jamais pratiqué cette prière, la prière de Tarawih revient à une désobéissance au Prophète. 
                            <br><br>
                            Premièrement : Nul ni personnes ne peut innover dans le domaine de la prière au sens religieux, et non pas au sens de la moquette. À moins que vous soyez Prophète ! 
                            Or, Omar ibn al-Khattab n'a ni le droit d'innover dans le domaine de la prière, puisqu'il n'est pas Prophète, et qu'il n'y aura plus de Prophète après le Prophète Muhammad.
                            <br><br>
                            Deuxièmement : Le Prophète a interdit le Tarawih, sans même connaître cette pratique, puisqu'il a ordonné aux gens de prier dans leur demeures, car la meilleure prière est celle faite chez soi 
                            sauf s'il s'agit des prières obligatoires.
                        </p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<section id="livraison" class="livraison">
    <h2><span class="material-symbols-outlined">quiz</span> Livraison</h2>
    <div class="box4-row">
        <div class="livraison-col">
            <div class="box-h3">
                <h3><span class="material-symbols-outlined">dynamic_form</span>Remplir le Formulaire</h3>
            </div>
            <div class="box-list">
                <ul>
                    <li><p><span class="material-symbols-outlined">badge</span>Nom</p></li>
                    <li><p><span class="material-symbols-outlined">badge</span>Prénom</p></li>
                    <li><p><span class="material-symbols-outlined">alternate_email</span>Mail</p></li>
                    <li><p><span class="material-symbols-outlined">call</span>L'indicatif de votre Téléphone</p></li>
                    <li><p><span class="material-symbols-outlined">call</span>Numero de Téléphone</p></li>
                    <li><p><span class="material-symbols-outlined">home</span>Adresse Postale <strong>*</strong></p></li>
                    <li><p><span class="material-symbols-outlined">add_box</span>1 quantité de livre (Particulier)</p></li>
                    <li><p><span class="material-symbols-outlined">add_box</span>10 quantités de livre (Entreprise ou Association)</p></li>
                </ul>
            </div>
        </div>
        <div class="livraison-col">
            <div class="box-h3">
            <h3><span class="material-symbols-outlined">verified</span>Vérification des données</h3>
            </div>
            <div class="box-list">
                <ul>
                    <li><p><span class="material-symbols-outlined">verified_user</span>Vérification du mail</p></li>
                    <li><p><span class="material-symbols-outlined">verified_user</span>Vérification du numéro de téléphone</p></li>
                </ul>
            </div>
        </div>
        <div class="livraison-col">
            <div class="box-h3">
            <h3><span class="material-symbols-outlined">local_shipping</span>Envoi du livre</h3>
            </div>
            <div class="box-list">
                <ul>
                    <li><p><span class="material-symbols-outlined">schedule_send</span>Nous n'avons aucun délai de livraison pour l'envoi du livre</p></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="box-utile">
        <h4>Mentions Obligatoires et Destination Hors Europe</h4>
        <p>Nom, prénom, mail, numéro de téléphone et adresse postale sont des mentions obligatoires</p>
        <p><strong>*</strong> Destination Hors Europe : Si vous n'avez pas d'adresse postale, cliquez sur le bouton "Particulier (sans adresse)", et indiquez le code ET le nom du bureau de poste (Post Office), le plus proche de chez vous.</p>
        <p></p>
        <p></p>
    </div>
</section>
<section id="nousconnaitre" class="nousconnaitre" itemscope itemtype="http://schema.org/Organization">
    <h2>Qui sommes-nous ?</h2>
    <div class="nous-row">
        <span itemprop="url" content="https://www.laprieredetarawih.com"></span><img class="logo" src="assets/images/logo-256.png" alt="" itemprop="logo">
        <div class="nous-col">
            <p itemprop="description">La <strong itemprop="name">Maison Contre Offensive édition</strong> est une maison d'édition dont la gérance est à <span itemprop="founder">Maamar Metmati</span>. Elle se veut de déployer des études et recherches concernant l'Islam et revivifier ainsi la parole d'Allah et de son Noble Prophète Muhammad, au-dessus de tout.
        Nous sommes situés sur <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"> <span itemprop="addressLocality">Paris</span>.</span> Nous ne sommes affiliés à aucun courant de pensée.</p>
        <p>Le livre Tarawih est un ouvrage promotionnel se voulant de délivrer un message précis pour cette génération et les futurs générations, quant à la vérité sur ce sujet.</p>
        </div>
    </div>
</section>
<?php
include ("elements/footer.php");
?>