<?php
session_start();
require('config.php'); // Assure-toi que ce fichier pointe vers la bonne base de données
$page_title = "Galerie - Sénégal Phyto";

// Récupération des images de la galerie
$images = $conn->query("SELECT * FROM galerie ORDER BY created_at DESC")->fetchAll();
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

        <!-- Galerie -->
        <section class="galerie-grid-section">
            <div class="container">
                <div class="galerie-grid" id="galerieGrid">
                    <?php if (count($images) > 0): ?>
                        <?php foreach ($images as $img): ?>
                            <div class="galerie-item" data-category="realisations">
                                <div class="galerie-image">
                                    <img src="uploads/<?= htmlspecialchars($img['image']) ?>" alt="<?= htmlspecialchars($img['titre']) ?>">
                                    <div class="galerie-overlay">
                                        <h3><?= htmlspecialchars($img['titre']) ?></h3>
                                        <p>Ajouté le <?= date("d/m/Y", strtotime($img['created_at'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucune image disponible pour le moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Modal pour l'affichage des images en grand -->
        <div id="imageModal" class="modal">
            <span class="close-modal">&times;</span>
            <img class="modal-content" id="modalImage">
            <div id="modalCaption"></div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>
