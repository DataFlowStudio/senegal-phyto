<?php
session_start();
$page_title = "Contact - Sénégal Phyto";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/header.php'; ?>
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
                        <form id="contactForm" class="contact-form">
                            <div class="form-group">
                                <label for="nom">Nom complet *</label>
                                <input type="text" id="nom" name="nom" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input type="tel" id="telephone" name="telephone">
                            </div>
                            <div class="form-group">
                                <label for="service">Service concerné *</label>
                                <select id="service" name="service" required>
                                    <option value="">Sélectionnez un service</option>
                                    <option value="desinsectisation">Désinsectisation</option>
                                    <option value="desinfection">Désinfection</option>
                                    <option value="deratisation">Dératisation</option>
                                    <option value="fumigation">Fumigation</option>
                                    <option value="autre">Autre</option>
                                </select>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="message">Message *</label>
                                <textarea id="message" name="message" rows="5" required></textarea>
                                <span class="error-message"></span>
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
                    <!-- Intégration Google Maps -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.527315774243!2d-17.44478728471664!3d14.692277189756952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xec172fe3c5d5d7b%3A0x5e26d2f5e5e5e5e5!2sDakar%2C%20S%C3%A9n%C3%A9gal!5e0!3m2!1sfr!2sfr!4v1620000000000!5m2!1sfr!2sfr" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/contact.js"></script>
</body>
</html>