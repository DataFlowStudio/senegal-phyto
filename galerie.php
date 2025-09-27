<?php
session_start();
$page_title = "Galerie - Sénégal Phyto";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <main class="galerie-page">
        <section class="page-header">
            <div class="container">
                <h1>Galerie & Produits</h1>
                <p>Découvrez nos réalisations et notre gamme de produits</p>
            </div>
        </section>

        <section class="galerie-filters">
            <div class="container">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Tout voir</button>
                    <button class="filter-btn" data-filter="realisations">Nos réalisations</button>
                    <button class="filter-btn" data-filter="produits">Nos produits</button>
                    <button class="filter-btn" data-filter="equipements">Équipements</button>
                    <button class="filter-btn" data-filter="certifications">Certifications</button>
                </div>
            </div>
        </section>

        <section class="galerie-grid-section">
            <div class="container">
                <div class="galerie-grid" id="galerieGrid">
                    <!-- Les images seront chargées dynamiquement -->
                    <div class="galerie-item" data-category="realisations">
                        <div class="galerie-image">
                            <img src="assets/images/realisation-1.jpg" alt="Réalisation 1">
                            <div class="galerie-overlay">
                                <h3>Intervention restaurant</h3>
                                <p>Désinsectisation complète d'un établissement de restauration</p>
                            </div>
                        </div>
                    </div>

                    <div class="galerie-item" data-category="produits">
                        <div class="galerie-image">
                            <img src="assets/images/produit-1.jpg" alt="Produit 1">
                            <div class="galerie-overlay">
                                <h3>Insecticide écologique</h3>
                                <p>Produit respectueux de l'environnement</p>
                            </div>
                        </div>
                    </div>

                    <div class="galerie-item" data-category="equipements">
                        <div class="galerie-image">
                            <img src="assets/images/equipement-1.jpg" alt="Équipement 1">
                            <div class="galerie-overlay">
                                <h3>Pulvérisateur professionnel</h3>
                                <p>Équipement haute performance</p>
                            </div>
                        </div>
                    </div>

                    <div class="galerie-item" data-category="certifications">
                        <div class="galerie-image">
                            <img src="assets/images/certification-1.jpg" alt="Certification 1">
                            <div class="galerie-overlay">
                                <h3>Certification qualité</h3>
                                <p>Normes internationales respectées</p>
                            </div>
                        </div>
                    </div>

                    <div class="galerie-item" data-category="realisations">
                        <div class="galerie-image">
                            <img src="assets/images/realisation-2.jpg" alt="Réalisation 2">
                            <div class="galerie-overlay">
                                <h3>Dératisation industrielle</h3>
                                <p>Intervention dans un site industriel</p>
                            </div>
                        </div>
                    </div>

                    <div class="galerie-item" data-category="produits">
                        <div class="galerie-image">
                            <img src="assets/images/produit-2.jpg" alt="Produit 2">
                            <div class="galerie-overlay">
                                <h3>Raticide sécurisé</h3>
                                <p>Produit efficace et sécuritaire</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal pour l'affichage des images en grand -->
        <div id="imageModal" class="modal">
            <span class="close-modal">&times;</span>
            <img class="modal-content" id="modalImage">
            <div id="modalCaption"></div>
        </div>

        <section class="produits-vedettes">
            <div class="container">
                <h2>Produits vedettes</h2>
                <div class="produits-grid">
                    <div class="produit-card">
                        <div class="produit-image">
                            <img src="assets/images/produit-vedette-1.jpg" alt="Produit vedette 1">
                        </div>
                        <div class="produit-content">
                            <h3>Insecticide longue durée</h3>
                            <p>Protection jusqu'à 3 mois contre les insectes rampants et volants</p>
                            <div class="produit-features">
                                <span>✅ Écologique</span>
                                <span>✅ Haute efficacité</span>
                                <span>✅ Sans danger</span>
                            </div>
                        </div>
                    </div>

                    <div class="produit-card">
                        <div class="produit-image">
                            <img src="assets/images/produit-vedette-2.jpg" alt="Produit vedette 2">
                        </div>
                        <div class="produit-content">
                            <h3>Désinfectant professionnel</h3>
                            <p>Élimine 99.9% des bactéries et virus sur toutes surfaces</p>
                            <div class="produit-features">
                                <span>✅ Action rapide</span>
                                <span>✅ Sans rinçage</span>
                                <span>✅ Agréé santé</span>
                            </div>
                        </div>
                    </div>

                    <div class="produit-card">
                        <div class="produit-image">
                            <img src="assets/images/produit-vedette-3.jpg" alt="Produit vedette 3">
                        </div>
                        <div class="produit-content">
                            <h3>Piège à rongeurs intelligent</h3>
                            <p>Système de capture humane et efficace pour rongeurs</p>
                            <div class="produit-features">
                                <span>✅ Réutilisable</span>
                                <span>✅ Sans produit chimique</span>
                                <span>✅ Facile à utiliser</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>