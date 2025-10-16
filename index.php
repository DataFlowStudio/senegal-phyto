<?php
session_start();
require('config.php');
$page_title = "Accueil - Sénégal Phyto";

// Récupérer les pubs (images ou vidéos)
$pubs = $conn->query("SELECT * FROM pubs ORDER BY created_at DESC LIMIT 6")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    
    <section class="hero">
        <div class="hero-overlay"></div> 
        <div class="container">
            <div class="hero-content">
                <div class="hero-brand">
                    <h1>SÉNÉGAL PHYTO</h1>
                    <div class="hero-subtitle">Votre partenaire pour un environnement <span class="highlight">sain</span></div>
                </div>
                <a href="contact.php" class="btn-primary">Demander un devis</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-preview">
        <div class="container">
            <h2>Nos Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🐜</div>
                    <h3>Désinsectisation</h3>
                    <p>Du cafard aux mouches, nous éliminons tous types d'insectes.</p>
                    <a href="services.php#desinsectisation" class="btn-secondary">En savoir plus</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">🦠</div>
                    <h3>Désinfection</h3>
                    <p>Désinfection complète des espaces et surfaces.</p>
                    <a href="services.php#desinfection" class="btn-secondary">En savoir plus</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">🐀</div>
                    <h3>Dératisation</h3>
                    <p>Nous éliminons rats, souris et autres nuisibles.</p>
                    <a href="services.php#deratisation" class="btn-secondary">En savoir plus</a>
                </div>
                <div class="service-card">
                    <div class="service-icon">☁️</div>
                    <h3>Fumigation</h3>
                    <p>Nous effectuons la fumigation de lieux et de cargaisons.</p>
                    <a href="services.php#fumigation" class="btn-secondary">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Traitements Section -->
    <section class="traitements-section">
        <div class="container">
            <h2>Traitements</h2>
            <div class="traitements-grid">
                <div class="traitement-card">
                    <div class="traitement-icon">🏠</div>
                    <h3>Maison</h3>
                    <p>Traitements spécialisés pour les habitations résidentielles</p>
                </div>
                <div class="traitement-card">
                    <div class="traitement-icon">🏢</div>
                    <h3>Bureau</h3>
                    <p>Solutions adaptées aux espaces de travail professionnels</p>
                </div>
                <div class="traitement-card">
                    <div class="traitement-icon">🏭</div>
                    <h3>Entrepôt</h3>
                    <p>Traitements pour zones de stockage et industrielles</p>
                </div>
                <div class="traitement-card">
                    <div class="traitement-icon">🏦</div>
                    <h3>Banque</h3>
                    <p>Protection spécialisée pour institutions financières</p>
                </div>
                <div class="traitement-card">
                    <div class="traitement-icon">🌳</div>
                    <h3>Espaces verts</h3>
                    <p>Entretien et protection des zones extérieures</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Produits & Fournitures -->
    <section class="produits-section">
        <div class="container">
            <h2>Produits & Fournitures</h2>
            <div class="produits-grid">
                <div class="produit-card">
                    <div class="produit-icon">🔧</div>
                    <h3>Équipements & Matériel</h3>
                    <p>Matériel professionnel pour tous vos traitements</p>
                </div>
                <div class="produit-card">
                    <div class="produit-icon">🧪</div>
                    <h3>Produits Phytosanitaires</h3>
                    <p>Produits certifiés pour une protection optimale</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Publicités -->
    <section class="publicites-section">
        <div class="container">
            <h2>Nos Offres Spéciales</h2>
            <div class="publicites-grid">
                <?php if (count($pubs) > 0): ?>
                    <?php foreach ($pubs as $pub): ?>
                        <div class="pub-item">
                            <?php
                            $fichier = htmlspecialchars($pub['media']);
                            $extension = strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
                            if (in_array($extension, ['mp4', 'webm', 'avi'])):
                            ?>
                                <video width="300" controls>
                                    <source src="admin/uploads/<?= $fichier ?>" type="video/<?= $extension ?>">
                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                </video>
                            <?php else: ?>
                                <img src="uploads/<?= $fichier ?>" alt="<?= htmlspecialchars($pub['titre']) ?>" width="300">
                            <?php endif; ?>
                            <h3><?= htmlspecialchars($pub['titre']) ?></h3>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune publicité disponible pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <h2>Prêt à protéger votre environnement ?</h2>
            <p>Contactez-nous dès aujourd'hui pour un devis gratuit</p>
            <a href="contact.php" class="btn-primary">Demander un devis</a>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/slider.js"></script>
</body>
</html>
