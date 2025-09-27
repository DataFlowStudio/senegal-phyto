// Validation du formulaire de contact
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                // Simulation d'envoi - À remplacer par un vrai envoi AJAX
                showMessage('Votre message a été envoyé avec succès!', 'success');
                contactForm.reset();
            }
        });
        
        // Validation en temps réel
        const inputs = contactForm.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                clearError(this);
            });
        });
    }
    
    function validateForm() {
        let isValid = true;
        const inputs = contactForm.querySelectorAll('input[required], select[required], textarea[required]');
        
        inputs.forEach(input => {
            if (!validateField(input)) {
                isValid = false;
            }
        });
        
        return isValid;
    }
    
    function validateField(field) {
        const value = field.value.trim();
        const errorElement = field.nextElementSibling;
        
        // Vérifier si le champ est requis
        if (field.hasAttribute('required') && value === '') {
            showError(field, 'Ce champ est obligatoire');
            return false;
        }
        
        // Validation spécifique selon le type de champ
        switch(field.type) {
            case 'email':
                if (!isValidEmail(value)) {
                    showError(field, 'Veuillez entrer une adresse email valide');
                    return false;
                }
                break;
                
            case 'tel':
                if (value && !isValidPhone(value)) {
                    showError(field, 'Veuillez entrer un numéro de téléphone valide');
                    return false;
                }
                break;
        }
        
        clearError(field);
        return true;
    }
    
    function showError(field, message) {
        const errorElement = field.nextElementSibling;
        field.style.borderColor = '#e74c3c';
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
    
    function clearError(field) {
        const errorElement = field.nextElementSibling;
        field.style.borderColor = '#e0e0e0';
        errorElement.textContent = '';
        errorElement.style.display = 'none';
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function isValidPhone(phone) {
        const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
        return phoneRegex.test(phone);
    }
    
    function showMessage(message, type) {
        // Créer un élément de message
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        messageDiv.textContent = message;
        messageDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            z-index: 10000;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `;
        
        if (type === 'success') {
            messageDiv.style.background = '#2b7a2b';
        } else {
            messageDiv.style.background = '#e74c3c';
        }
        
        document.body.appendChild(messageDiv);
        
        // Animation d'entrée
        setTimeout(() => {
            messageDiv.style.transform = 'translateX(0)';
        }, 100);
        
        // Supprimer après 5 secondes
        setTimeout(() => {
            messageDiv.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(messageDiv);
            }, 300);
        }, 5000);
    }
});