<?php
session_start();
require 'config.php';
$page_title = "Contact - Sénégal Phyto";

$success = $error = "";

// Enregistrement en base de données
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $service = trim($_POST['service']);
    $message = trim($_POST['message']);

    if (!empty($nom) && !empty($email) && !empty($message) && !empty($service)) {
        $stmt = $conn->prepare("INSERT INTO messages (nom, email, telephone, sujet, message, statut, created_at)
                                VALUES (?, ?, ?, ?, ?, 'non_lu', NOW())");
        if ($stmt->execute([$nom, $email, $telephone, $service, $message])) {
            $success = "✅ Message envoyé avec succès !";
        } else {
            $error = "❌ Une erreur est survenue lors de l'envoi du message.";
        }
    } else {
        $error = "⚠️ Veuillez remplir tous les champs obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        (function(){
            // Initialise EmailJS
            emailjs.init("T1kUBZXUypYXqCRX-5"); 
        })();
    </script>
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

                        <?php if ($success): ?>
                            <div class="alert success"><?= $success ?></div>
                        <?php elseif ($error): ?>
                            <div class="alert error"><?= $error ?></div>
                        <?php endif; ?>

                        <form id="contactForm" class="contact-form" method="POST">
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
                                <label for="service">Service concerné *</label>
                                <select id="service" name="service" required>
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
                            <div class="contact-item">
                                <div class="contact-icon">🕒</div>
                                <div class="contact-details">
                                    <h3>Horaires d'ouverture</h3>
                                    <p>Lun - Ven: 8h00 - 18h00<br>Sam: 8h00 - 13h00</p>
                                </div>
                            </div>
                        </div>

                        <div class="social-links">
                            <h3>Suivez-nous</h3>
                            <div class="social-icons">
                                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section">
            <div class="container">
                <h2>Questions fréquentes</h2>
                <div class="faq-accordion">
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Combien de temps dure une intervention?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>La durée varie selon le type d'intervention et la superficie à traiter. En moyenne, une intervention dure entre 1 et 3 heures.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Les produits utilisés sont-ils dangereux?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Nous utilisons des produits homologués et respectueux de l'environnement. Nos techniciens vous donneront toutes les consignes de sécurité.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Proposez-vous des contrats d'entretien?</span>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>Oui, nous proposons des contrats d'entretien annuels adaptés à vos besoins pour une protection continue.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="map-section">
            <div class="container">
                <h2>Notre zone d'intervention</h2>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.527315774243!2d-17.44478728471664!3d14.692277189756952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xec172fe3c5d5d7b%3A0x5e26d2f5e5e5e5e5!2sDakar%2C%20S%C3%A9n%C3%A9gal!5e0!3m2!1sfr!2sfr!4v1620000000000!5m2!1sfr!2sfr" 
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
    <script>
        document.getElementById("contactForm").addEventListener("submit", function(e){
            // Empêche l’envoi double si le backend recharge la page
            e.preventDefault();

            const form = this;

            // Enregistre d'abord dans la base via PHP
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            }).then(response => response.text())
            .then(() => {
                // Envoi du mail via EmailJS
                emailjs.send("service_7e9d5mo", "template_912sw6b", {
                    nom: document.getElementById("nom").value,
                    email: document.getElementById("email").value,
                    telephone: document.getElementById("telephone").value,
                    service: document.getElementById("service").value,
                    message: document.getElementById("message").value
                }).then(() => {
                    alert("✅ Message envoyé et mail transmis avec succès !");
                    form.reset();
                }).catch(err => {
                    alert("❌ Erreur EmailJS : " + JSON.stringify(err));
                });
            });
        });
    </script>

</body>
</html>
