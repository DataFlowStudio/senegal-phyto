// assets/js/contact.js

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const nom = document.getElementById("nom").value;
        const email = document.getElementById("email").value;
        const telephone = document.getElementById("telephone").value;
        const service = document.getElementById("service").value;
        const message = document.getElementById("message").value;

        if (!nom || !email || !message || !service) {
            alert("Veuillez remplir tous les champs obligatoires !");
            return;
        }

        // Affiche un petit loader
        const btn = form.querySelector("button");
        btn.disabled = true;
        btn.textContent = "Envoi en cours...";

        // Envoi via EmailJS
        emailjs.send("service_xxx", "template_xxx", {
            nom: nom,
            email: email,
            telephone: telephone,
            service: service,
            message: message
        })
        .then(() => {
            alert("✅ Votre message a bien été envoyé !");
            form.reset();
            btn.disabled = false;
            btn.textContent = "Envoyer le message";
        })
        .catch((error) => {
            console.error("Erreur EmailJS :", error);
            alert("❌ Une erreur s'est produite. Réessayez plus tard.");
            btn.disabled = false;
            btn.textContent = "Envoyer le message";
        });
    });
});
