<?php
session_start();
require('config.php');
$page_title = "Publicités - Sénégal Phyto";

// Récupération dynamique des publicités
$publicites = $conn->query("SELECT * FROM pubs ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
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

    <!-- <section class="publicites-filters">
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
    </section> -->

    <section class="publicites-grid-section">
        <div class="container">
            <div class="publicites-grid" id="publicitesGrid">
                <?php if (count($publicites) > 0): ?>
                    <?php foreach ($publicites as $pub): ?>
                        <div class="publicite-card" data-category="<?= htmlspecialchars(strtolower($pub['type'])) ?>">
                            <div class="publicite-badge"><?= htmlspecialchars($pub['type']) ?></div>
                            <div class="publicite-image">
                                <?php if ($pub['type'] === 'video'): ?>
                                    <video controls width="100%">
                                        <source src="uploads/<?= htmlspecialchars($pub['media']) ?>" type="video/mp4">
                                        Votre navigateur ne supporte pas la lecture de cette vidéo.
                                    </video>
                                <?php else: ?>
                                    <img src="uploads/<?= htmlspecialchars($pub['media']) ?>" alt="<?= htmlspecialchars($pub['titre']) ?>">
                                <?php endif; ?>
                            </div>
                            <div class="publicite-content">
                                <h3><?= htmlspecialchars($pub['titre']) ?></h3>
                                <div class="publicite-meta">
                                    <span class="publicite-date">Ajouté le <?= date("d/m/Y", strtotime($pub['created_at'])) ?></span>
                                </div>
                                <a href="contact.php" class="btn-primary">En savoir plus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune publicité disponible pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- <section class="cta-section">
        <div class="container">
            <h2>Vous avez un problème de nuisibles ?</h2>
            <p>Contactez-nous pour une solution adaptée à votre situation</p>
            <div class="cta-buttons">
                <a href="contact.php" class="btn-primary">Demander un devis</a>
                <a href="tel:+221331234567" class="btn-secondary">Appeler maintenant</a>
            </div>
        </div>
    </section> -->
</main>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/script.js"></script>
<script src="assets/js/slider.js"></script>
</body>
</html>
