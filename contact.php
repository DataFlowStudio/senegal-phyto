<?php
session_start();
require 'config.php';
$page_title = "Contact - Sénégal Phyto";

$success = $error = "";

// Traitement du POST (insertion en base)
// Quand insertion OK on stocke temporairement les données dans $_SESSION['last_message']
// puis on REDIRIGE (PRG) vers contact.php?sent=1 pour éviter le re-post au refresh.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telephone = trim($_POST['telephone'] ?? '');
    $service = trim($_POST['sujet'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!empty($nom) && !empty($email) && !empty($message) && !empty($service)) {
        $stmt = $conn->prepare("INSERT INTO messages (nom, email, telephone, sujet, message, statut, created_at)
                                VALUES (?, ?, ?, ?, ?, 'non_lu', NOW())");
        if ($stmt->execute([$nom, $email, $telephone, $service, $message])) {
            // Stocke temporairement les données à envoyer par EmailJS
            $_SESSION['last_message'] = [
                'nom' => $nom,
                'email' => $email,
                'telephone' => $telephone,
                'sujet' => $service,
                'message' => $message
            ];
            // redirect (PRG)
            header('Location: contact.php?sent=1');
            exit;
        } else {
            $error = "❌ Une erreur est survenue lors de l'envoi du message.";
        }
    } else {
        $error = "⚠️ Veuillez remplir tous les champs obligatoires.";
    }
}
// Si on arrive en GET, on affiche le formulaire.
// Si ?sent=1 est présent et $_SESSION['last_message'] existe, le JS client s'en chargera.
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main class="contact-page">
        <section class="page-header">
            <div class="container">
                <h1>Contactez-nous</h1>
                <p>N'hésitez pas à nous contacter pour toute demande d'information ou de devis</p>
            </div>
        </section>

        <section class="contact-content">
            <div class="container">
                <div class="contact-grid">
                    <div class="contact-form-section">
                        <h2>Demandez un devis gratuit</h2>

                        <?php if (!empty($error)): ?>
                            <div class="alert error"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>

                        <form id="contactForm" class="contact-form" method="POST" action="contact.php">
                            <div class="form-group">
                                <label for="nom">Nom complet *</label>
                                <input type="text" id="nom" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input type="tel" id="telephone" name="telephone">
                            </div>
                            <div class="form-group">
                                <label for="sujet">Service concerné *</label>
                                <select id="sujet" name="sujet" required>
                                    <option value="">Sélectionnez un service</option>
                                    <option value="Désinsectisation">Désinsectisation</option>
                                    <option value="Désinfection">Désinfection</option>
                                    <option value="Dératisation">Dératisation</option>
                                    <option value="Fumigation">Fumigation</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn-primary">Envoyer le message</button>
                        </form>
                    </div>

                    <div class="contact-info-section">
                        <h2>Nos coordonnées</h2>
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="contact-icon">📞</div>
                                <div class="contact-details">
                                    <h3>Téléphone</h3>
                                    <p>+221 33 123 45 67</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">📧</div>
                                <div class="contact-details">
                                    <h3>Email</h3>
                                    <p>contact@senegalphyto.sn</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">📍</div>
                                <div class="contact-details">
                                    <h3>Adresse</h3>
                                    <p>Dakar, Sénégal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // ====== Remplace par ta clé publique EmailJS ======
        emailjs.init("tevLp9FBLNQB3FLet");

        // Si l'URL contient ?sent=1, on tente d'envoyer via EmailJS une seule fois
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('sent') === '1') {
            // Appel server pour récupérer la session last_message (renvoie JSON)
            fetch('get_last_message.php')
                .then(r => r.json())
                .then(data => {
                    if (data && data.nom) {
                        // Envoi EmailJS
                        emailjs.send("service_7e9d5mo", "template_912sw6b", {
                            nom: data.nom,
                            email: data.email,
                            telephone: data.telephone,
                            sujet: data.sujet,
                            message: data.message
                        })
                        .then(() => {
                            console.log("✅ Email envoyé via EmailJS");
                            // Supprime côté serveur la session last_message
                            return fetch('reset_session.php', { method: 'POST' });
                        })
                        .then(() => {
                            // Enlève le paramètre ?sent=1 de l'URL pour éviter renvoi sur refresh
                            history.replaceState(null, '', 'contact.php');
                            // Optionnel : afficher un toast / notification côté client
                            alert('✅ Message envoyé. Nous vous répondrons bientôt.');
                        })
                        .catch(err => {
                            console.error("❌ Erreur EmailJS :", err);
                        });
                    } else {
                        // Pas de données : éventuellement déja reset ; on nettoie l'URL
                        history.replaceState(null, '', 'contact.php');
                    }
                })
                .catch(err => {
                    console.error("Erreur fetch get_last_message:", err);
                    history.replaceState(null, '', 'contact.php');
                });
        }
    });
    </script>
</body>
</html>
