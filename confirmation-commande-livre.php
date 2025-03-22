<?php
include 'class/PDO-laprieredetarawih.php';
function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
include ("elements/head.php");
?>
<header id="header">
    <a href="index.php">
        <img class="logo" src="assets/images/logo-256.png" alt="logo contre offensive édition">
    </a>
</header>
<body>
<section id="accueil" class="container-fluid">
    <div class="row-accueil">
        <div class="box-container">
            <h1>Confirmation de votre commande du livre Tarawih</h1>
            <p>Nous vous enverrons un message dès l'envoi du livre Tarawih la prière innovée !</p>
            <p>Merci d'avoir commandé le livre !</p>
            <a href="index.php"><button class="primary">Retour à l'accueil</button></a>
        </div>
        <div class="gallery">
            <img src="assets/images/livre-tarawih.png" alt="">
            <img src="assets/images/tarawih-arabe_carre_tn.png" alt="">
            <img src="assets/images/tarawih-english_carre_tn.png" alt="">
            <img src="assets/images/tarawih-turk_tn.png" alt="">
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
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>