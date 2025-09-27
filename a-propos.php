<?php
session_start();
$page_title = "À Propos - Sénégal Phyto";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    
    <main class="about-page">
        <section class="page-header">
            <div class="container">
                <h1>À Propos de Sénégal Phyto</h1>
                <p>Découvrez notre histoire, notre mission et notre équipe</p>
            </div>
        </section>

        <section class="history-section">
            <div class="container">
                <h2>Notre Histoire</h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-year">2015</div>
                        <div class="timeline-content">
                            <h3>Création de l'entreprise</h3>
                            <p>Fondation de Sénégal Phyto avec une vision claire : offrir des services phytosanitaires de qualité au Sénégal.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2017</div>
                        <div class="timeline-content">
                            <h3>Premières certifications</h3>
                            <p>Obtention des premières certifications qualité et agréments officiels.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2019</div>
                        <div class="timeline-content">
                            <h3>Expansion nationale</h3>
                            <p>Déploiement de nos services sur l'ensemble du territoire sénégalais.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2023</div>
                        <div class="timeline-content">
                            <h3>Innovation continue</h3>
                            <p>Adoption de nouvelles technologies et méthodes écologiques.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mission-section">
            <div class="container">
                <h2>Notre Ethique</h2>
                <div class="mission-grid">
                    <div class="mission-card">
                        <div class="mission-icon">🎯</div>
                        <h3>Notre Mission</h3>
                        <p>Protéger la santé publique et l'environnement grâce à des solutions phytosanitaires innovantes et respectueuses.</p>
                    </div>
                    <div class="mission-card">
                        <div class="mission-icon">👁️</div>
                        <h3>Notre Vision</h3>
                        <p>Devenir le leader des services phytosanitaires en Afrique de l'Ouest, reconnu pour notre excellence et notre engagement écologique.</p>
                    </div>
                    <div class="mission-card">
                        <div class="mission-icon">💎</div>
                        <h3>Nos Valeurs</h3>
                        <p>Qualité, innovation, respect de l'environnement, professionnalisme et satisfaction client.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="team-section">
            <div class="container">
                <h2>Notre Équipe</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="assets/images/team-1.jpg" alt="Directeur Général">
                        </div>
                        <div class="member-info">
                            <h3>M. Abdoulaye Diop</h3>
                            <span>Directeur Général</span>
                            <p>15 ans d'expérience dans le secteur phytosanitaire.</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="assets/images/team-2.jpg" alt="Responsable Technique">
                        </div>
                        <div class="member-info">
                            <h3>M. Alain François</h3>
                            <span>Responsable Technique</span>
                            <p>Expert certifié en gestion des nuisibles.</p>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="member-photo">
                            <img src="assets/images/team-3.jpg" alt="Responsable Qualité">
                        </div>
                        <div class="member-info">
                            <h3>Mme. Aïssatou Ndiaye</h3>
                            <span>Responsable Qualité</span>
                            <p>Garante du respect des normes et procédures.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="engagement-section">
            <div class="container">
                <h2>Nos Engagements</h2>
                <div class="engagement-grid">
                    <div class="engagement-card">
                        <div class="engagement-icon">🌿</div>
                        <h3>Écologie</h3>
                        <p>Utilisation de produits respectueux de l'environnement</p>
                    </div>
                    <div class="engagement-card">
                        <div class="engagement-icon">✅</div>
                        <h3>Qualité</h3>
                        <p>Services certifiés et contrôlés régulièrement</p>
                    </div>
                    <div class="engagement-card">
                        <div class="engagement-icon">🚀</div>
                        <h3>Rapidité</h3>
                        <p>Intervention sous 24h pour les urgences</p>
                    </div>
                    <div class="engagement-card">
                        <div class="engagement-icon">💰</div>
                        <h3>Transparence</h3>
                        <p>Devis détaillés et prix transparents</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="certifications-section">
            <div class="container">
                <h2>Nos Certifications</h2>
                <div class="certifications-grid">
                    <div class="certification-item">
                        <img src="assets/images/certification-iso.jpg" alt="Certification ISO">
                        <h3>ISO 9001:2015</h3>
                        <p>Management de la qualité</p>
                    </div>
                    <div class="certification-item">
                        <img src="assets/images/certification-environnement.jpg" alt="Certification Environnement">
                        <h3>Éco-label</h3>
                        <p>Produits respectueux de l'environnement</p>
                    </div>
                    <div class="certification-item">
                        <img src="assets/images/certification-sante.jpg" alt="Certification Santé">
                        <h3>Agrément Santé</h3>
                        <p>Conformité aux normes sanitaires</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
</body>
</html>