<?php
session_start();
$page_title = "Nos Services - Sénégal Phyto";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <main class="services-page">
        <section class="page-header">
            <div class="container">
                <h1>Nos Services</h1>
                <p>Découvrez notre gamme complète de services pour un environnement sain</p>
            </div>
        </section>

        <section class="service-detail" id="desinsectisation">
            <div class="container">
                <div class="service-content">
                    <div class="service-text">
                        <h2>Désinsectisation</h2>
                        <p>Notre service de désinsectisation élimine efficacement tous types d'insectes nuisibles, des cafards aux mouches en passant par les moustiques et les fourmis.</p>
                        <ul>
                            <li>Élimination complète des insectes rampants et volants</li>
                            <li>Traitement préventif pour éviter les réinfestations</li>
                            <li>Produits respectueux de l'environnement</li>
                            <li>Intervention rapide et efficace</li>
                        </ul>
                    </div>
                    <div class="service-image">
                        <img src="assets/images/desinsectisation.jpg" alt="Service de désinsectisation">
                    </div>
                </div>
            </div>
        </section>

        <section class="service-detail" id="desinfection">
            <div class="container">
                <div class="service-content reverse">
                    <div class="service-text">
                        <h2>Désinfection</h2>
                        <p>Nous proposons une désinfection complète des espaces et surfaces pour éliminer virus, bactéries et autres micro-organismes pathogènes.</p>
                        <ul>
                            <li>Désinfection des surfaces et de l'air</li>
                            <li>Utilisation de produits certifiés et efficaces</li>
                            <li>Protocoles adaptés à chaque type d'espace</li>
                            <li>Résultats garantis et durables</li>
                        </ul>
                    </div>
                    <div class="service-image">
                        <img src="assets/images/desinfection.jpg" alt="Service de désinfection">
                    </div>
                </div>
            </div>
        </section>

        <section class="service-detail" id="deratisation">
            <div class="container">
                <div class="service-content">
                    <div class="service-text">
                        <h2>Dératisation</h2>
                        <p>Notre service de dératisation élimine rats, souris et autres rongeurs nuisibles de manière efficace et définitive.</p>
                        <ul>
                            <li>Identification des sources d'infestation</li>
                            <li>Méthodes d'élimination sécurisées</li>
                            <li>Prévention des réinfestations</li>
                            <li>Respect des normes sanitaires</li>
                        </ul>
                    </div>
                    <div class="service-image">
                        <img src="assets/images/deratisation.jpg" alt="Service de dératisation">
                    </div>
                </div>
            </div>
        </section>

        <section class="service-detail" id="fumigation">
            <div class="container">
                <div class="service-content reverse">
                    <div class="service-text">
                        <h2>Fumigation</h2>
                        <p>Nous effectuons la fumigation de lieux et de cargaisons pour éliminer tous types de nuisibles de manière intensive et complète.</p>
                        <ul>
                            <li>Fumigation de locaux commerciaux et industriels</li>
                            <li>Traitement de cargaisons et conteneurs</li>
                            <li>Respect des normes internationales</li>
                            <li>Certificats de traitement délivrés</li>
                        </ul>
                    </div>
                    <div class="service-image">
                        <img src="assets/images/fumigation.jpg" alt="Service de fumigation">
                    </div>
                </div>
            </div>
        </section>

        <section class="why-choose-us">
            <div class="container">
                <h2>Pourquoi choisir Sénégal Phyto?</h2>
                <div class="advantages-grid">
                    <div class="advantage-card">
                        <div class="advantage-icon">✅</div>
                        <h3>Expertise certifiée</h3>
                        <p>Notre équipe dispose de certifications et d'une expérience éprouvée.</p>
                    </div>
                    <div class="advantage-card">
                        <div class="advantage-icon">🚀</div>
                        <h3>Intervention rapide</h3>
                        <p>Nous intervenons rapidement pour résoudre vos problèmes de nuisibles.</p>
                    </div>
                    <div class="advantage-card">
                        <div class="advantage-icon">🌿</div>
                        <h3>Produits écologiques</h3>
                        <p>Nous utilisons des produits respectueux de l'environnement.</p>
                    </div>
                    <div class="advantage-card">
                        <div class="advantage-icon">💰</div>
                        <h3>Prix compétitifs</h3>
                        <p>Des tarifs transparents et compétitifs pour tous nos services.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>