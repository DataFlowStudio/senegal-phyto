<?php
session_start();
$page_title = "Publicités - Sénégal Phyto";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <main class="publicites-page">
        <section class="page-header">
            <div class="container">
                <h1>Nos Offres et Traitements</h1>
                <p>Découvrez nos offres spéciales et traitements adaptés à vos besoins</p>
            </div>
        </section>

        <section class="publicites-filters">
            <div class="container">
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="all">Toutes les offres</button>
                    <button class="filter-btn" data-filter="desinsectisation">Désinsectisation</button>
                    <button class="filter-btn" data-filter="desinfection">Désinfection</button>
                    <button class="filter-btn" data-filter="deratisation">Dératisation</button>
                    <button class="filter-btn" data-filter="fumigation">Fumigation</button>
                    <button class="filter-btn" data-filter="promotion">Promotions</button>
                </div>
            </div>
        </section>

        <section class="publicites-grid-section">
            <div class="container">
                <div class="publicites-grid" id="publicitesGrid">
                    <!-- Les publicités seront chargées dynamiquement -->
                    <div class="publicite-card" data-category="promotion">
                        <div class="publicite-badge">Promotion</div>
                        <div class="publicite-image">
                            <img src="assets/images/offre-speciale.jpg" alt="Offre spéciale">
                        </div>
                        <div class="publicite-content">
                            <h3>Première intervention à -20%</h3>
                            <p>Bénéficiez de 20% de réduction sur votre première intervention</p>
                            <div class="publicite-meta">
                                <span class="publicite-date">Valable jusqu'au 30/12/2023</span>
                            </div>
                            <a href="contact.php" class="btn-primary">Profiter de l'offre</a>
                        </div>
                    </div>

                    <div class="publicite-card" data-category="desinsectisation">
                        <div class="publicite-badge">Nouveau</div>
                        <div class="publicite-image">
                            <img src="assets/images/desinsectisation-offre.jpg" alt="Désinsectisation">
                        </div>
                        <div class="publicite-content">
                            <h3>Traitement anti-moustiques</h3>
                            <p>Protégez votre famille contre les moustiques avec notre traitement spécial</p>
                            <div class="publicite-meta">
                                <span class="publicite-date">Disponible toute l'année</span>
                            </div>
                            <a href="contact.php" class="btn-primary">Demander un devis</a>
                        </div>
                    </div>

                    <div class="publicite-card" data-category="desinfection">
                        <div class="publicite-image">
                            <img src="assets/images/desinfection-offre.jpg" alt="Désinfection">
                        </div>
                        <div class="publicite-content">
                            <h3>Désinfection complète</h3>
                            <p>Pour les entreprises et établissements recevant du public</p>
                            <div class="publicite-meta">
                                <span class="publicite-date">Certification délivrée</span>
                            </div>
                            <a href="contact.php" class="btn-primary">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials-section">
            <div class="container">
                <h2>Témoignages clients</h2>
                <div class="testimonials-slider" id="testimonialsSlider">
                    <!-- Les témoignages seront chargés dynamiquement -->
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <h2>Vous avez un problème de nuisibles?</h2>
                <p>Contactez-nous pour une solution adaptée à votre situation</p>
                <div class="cta-buttons">
                    <a href="contact.php" class="btn-primary">Demander un devis</a>
                    <a href="tel:+221331234567" class="btn-secondary">Appeler maintenant</a>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/slider.js"></script>
</body>
</html>