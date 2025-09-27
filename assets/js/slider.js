// Slider pour les publicités
document.addEventListener('DOMContentLoaded', function() {
    // Slider Publicités
    const publicitesSlider = document.getElementById('publicitesSlider');
    
    if (publicitesSlider) {
        // Données simulées - À remplacer par des données réelles de la base
        const publicites = [
            {
                titre: "Offre Spéciale Été",
                image: "assets/images/pub-1.jpg",
                description: "Profitez de -15% sur tous nos services pendant l'été",
                lien: "contact.php",
                badge: "Promotion"
            },
            {
                titre: "Nouveau Traitement Écologique",
                image: "assets/images/pub-2.jpg",
                description: "Découvrez notre nouvelle gamme de produits respectueux de l'environnement",
                lien: "galerie.php",
                badge: "Nouveau"
            },
            {
                titre: "Contrat d'Entretien Annuel",
                image: "assets/images/pub-3.jpg",
                description: "Souscrivez à notre contrat d'entretien et bénéficiez d'avantages exclusifs",
                lien: "services.php",
                badge: "Économie"
            }
        ];
        
        let currentPubIndex = 0;
        
        function showPublicite(index) {
            const pub = publicites[index];
            publicitesSlider.innerHTML = `
                <div class="publicite-slide">
                    ${pub.badge ? `<div class="publicite-badge">${pub.badge}</div>` : ''}
                    <div class="slide-content">
                        <div class="slide-text">
                            <h3>${pub.titre}</h3>
                            <p>${pub.description}</p>
                            <a href="${pub.lien}" class="btn-primary">En savoir plus</a>
                        </div>
                        <div class="slide-image">
                            <img src="${pub.image}" alt="${pub.titre}">
                        </div>
                    </div>
                </div>
            `;
        }
        
        function nextPublicite() {
            currentPubIndex = (currentPubIndex + 1) % publicites.length;
            showPublicite(currentPubIndex);
        }
        
        // Afficher la première publicité
        showPublicite(currentPubIndex);
        
        // Changer de publicité toutes les 5 secondes
        setInterval(nextPublicite, 5000);
    }
    
    // Slider Témoignages
    const testimonialsSlider = document.getElementById('testimonialsSlider');
    
    if (testimonialsSlider) {
        const temoignages = [
            {
                nom: "M. Diop",
                entreprise: "Restaurant Le Bon Goût",
                message: "Intervention rapide et efficace pour notre problème de cafards. L'équipe est professionnelle et les résultats sont excellents. Je recommande!",
                rating: 5,
                date: "15 Novembre 2023"
            },
            {
                nom: "Mme. Ndiaye",
                entreprise: "Particulier",
                message: "Service de dératisation impeccable. Les techniciens ont été très professionnels et ont résolu notre problème de souris rapidement.",
                rating: 4,
                date: "8 Novembre 2023"
            },
            {
                nom: "Société ABC",
                entreprise: "Entreprise industrielle",
                message: "Contrat d'entretien annuel pour notre site industriel. Service fiable et réactif. Très satisfait de la collaboration.",
                rating: 5,
                date: "2 Novembre 2023"
            }
        ];
        
        let currentTestimonialIndex = 0;
        
        function showTestimonial(index) {
            const temoignage = temoignages[index];
            const stars = '★'.repeat(temoignage.rating) + '☆'.repeat(5 - temoignage.rating);
            
            testimonialsSlider.innerHTML = `
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <div class="testimonial-rating">
                            ${stars.split('').map(star => `<span class="star ${star === '★' ? 'filled' : ''}">${star}</span>`).join('')}
                        </div>
                        <p class="testimonial-text">"${temoignage.message}"</p>
                        <div class="testimonial-author">
                            <strong>${temoignage.nom}</strong> - ${temoignage.entreprise}
                        </div>
                        <div class="testimonial-date">${temoignage.date}</div>
                    </div>
                </div>
            `;
        }
        
        function nextTestimonial() {
            currentTestimonialIndex = (currentTestimonialIndex + 1) % temoignages.length;
            showTestimonial(currentTestimonialIndex);
        }
        
        // Afficher le premier témoignage
        showTestimonial(currentTestimonialIndex);
        
        // Changer de témoignage toutes les 7 secondes
        setInterval(nextTestimonial, 7000);
    }
});