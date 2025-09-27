<?php
session_start();
$page_title = "Témoignages - Sénégal Phyto";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <main class="temoignages-page">
        <section class="page-header">
            <div class="container">
                <h1>Témoignages Clients</h1>
                <p>Découvrez ce que nos clients disent de nos services</p>
            </div>
        </section>

        <section class="stats-section">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number" data-target="95">0</div>
                        <div class="stat-label">Clients satisfaits</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" data-target="500">0</div>
                        <div class="stat-label">Interventions réalisées</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" data-target="98">0</div>
                        <div class="stat-label">Problèmes résolus</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" data-target="4.9">0</div>
                        <div class="stat-label">Note moyenne</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="temoignages-grid-section">
            <div class="container">
                <h2>Nos clients témoignent</h2>
                <div class="temoignages-grid" id="temoignagesGrid">
                    <!-- Les témoignages seront chargés dynamiquement -->
                    <div class="temoignage-card">
                        <div class="temoignage-header">
                            <div class="client-avatar">👤</div>
                            <div class="client-info">
                                <h3>M. Diop</h3>
                                <span>Restaurant Le Bon Goût</span>
                            </div>
                        </div>
                        <div class="temoignage-rating">
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                        </div>
                        <div class="temoignage-content">
                            <p>"Intervention rapide et efficace pour notre problème de cafards. L'équipe est professionnelle et les résultats sont excellents. Je recommande!"</p>
                        </div>
                        <div class="temoignage-date">15 Novembre 2023</div>
                    </div>

                    <div class="temoignage-card">
                        <div class="temoignage-header">
                            <div class="client-avatar">👤</div>
                            <div class="client-info">
                                <h3>Mme. Ndiaye</h3>
                                <span>Particulier</span>
                            </div>
                        </div>
                        <div class="temoignage-rating">
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                            <span class="star">★</span>
                        </div>
                        <div class="temoignage-content">
                            <p>"Service de dératisation impeccable. Les techniciens ont été très professionnels et ont résolu notre problème de souris rapidement."</p>
                        </div>
                        <div class="temoignage-date">8 Novembre 2023</div>
                    </div>

                    <div class="temoignage-card">
                        <div class="temoignage-header">
                            <div class="client-avatar">👤</div>
                            <div class="client-info">
                                <h3>Société ABC</h3>
                                <span>Entreprise industrielle</span>
                            </div>
                        </div>
                        <div class="temoignage-rating">
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                            <span class="star filled">★</span>
                        </div>
                        <div class="temoignage-content">
                            <p>"Contrat d'entretien annuel pour notre site industriel. Service fiable et réactif. Très satisfait de la collaboration."</p>
                        </div>
                        <div class="temoignage-date">2 Novembre 2023</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="add-testimonial-section">
            <div class="container">
                <div class="add-testimonial-form">
                    <h2>Ajouter votre témoignage</h2>
                    <form id="testimonialForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="clientName">Votre nom *</label>
                                <input type="text" id="clientName" name="clientName" required>
                            </div>
                            <div class="form-group">
                                <label for="clientEmail">Votre email *</label>
                                <input type="email" id="clientEmail" name="clientEmail" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="clientProfession">Votre profession/établissement</label>
                            <input type="text" id="clientProfession" name="clientProfession">
                        </div>
                        <div class="form-group">
                            <label>Notez notre service</label>
                            <div class="rating-input">
                                <span class="star-input" data-value="1">★</span>
                                <span class="star-input" data-value="2">★</span>
                                <span class="star-input" data-value="3">★</span>
                                <span class="star-input" data-value="4">★</span>
                                <span class="star-input" data-value="5">★</span>
                                <input type="hidden" id="ratingValue" name="rating" value="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="testimonialMessage">Votre témoignage *</label>
                            <textarea id="testimonialMessage" name="testimonialMessage" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Publier le témoignage</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>