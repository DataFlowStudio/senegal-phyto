<?php
session_start();
require('config.php');
$page_title = "Témoignages - Sénégal Phyto";

// Récupération des témoignages approuvés
$temoignages = $conn->query("SELECT * FROM temoignages WHERE statut='approuve' ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <!-- Section Statistiques -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number" data-target="95">95%</div>
                    <div class="stat-label">Clients satisfaits</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="500">500+</div>
                    <div class="stat-label">Interventions réalisées</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="98">98%</div>
                    <div class="stat-label">Problèmes résolus</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" data-target="4.9">4.9/5</div>
                    <div class="stat-label">Note moyenne</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Témoignages dynamiques -->
    <section class="temoignages-grid-section">
        <div class="container">
            <h2>Nos clients témoignent</h2>
            <div class="temoignages-grid" id="temoignagesGrid">
                <?php if (count($temoignages) > 0): ?>
                    <?php foreach ($temoignages as $t): ?>
                        <div class="temoignage-card">
                            <div class="temoignage-header">
                                <div class="client-avatar">👤</div>
                                <div class="client-info">
                                    <h3><?= htmlspecialchars($t['nom']) ?></h3>
                                    <span>Client satisfait</span>
                                </div>
                            </div>
                            <div class="temoignage-content">
                                <p>"<?= htmlspecialchars($t['message']) ?>"</p>
                            </div>
                            <div class="temoignage-date"><?= date("d M Y", strtotime($t['created_at'])) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun témoignage pour le moment. Soyez le premier à partager votre expérience !</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Formulaire d'ajout -->
    <section class="add-testimonial-section">
        <div class="container">
            <div class="add-testimonial-form">
                <h2>Ajouter votre témoignage</h2>
                <form id="testimonialForm">
                    <div class="form-group">
                        <label for="clientName">Votre nom *</label>
                        <input type="text" id="clientName" name="clientName" required>
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

<script>
document.getElementById('testimonialForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const form = this;

    // Afficher un loader
    Swal.fire({
        title: 'Envoi en cours...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('ajouter_temoignages.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        Swal.close();
        
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Succès !',
                text: data.message,
                confirmButtonColor: '#006400'
            }).then(() => {
                form.reset();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: data.message,
                confirmButtonColor: '#d33'
            });
        }
    })
});
</script>
</body>
</html>