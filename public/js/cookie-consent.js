// Durée de validité des cookies : 6 mois (en millisecondes)
const consentExpiration = 6 * 30 * 24 * 60 * 60 * 1000;

// Vérifier si le consentement est déjà donné au chargement de la page
window.onload = function() {
    const consentData = JSON.parse(localStorage.getItem('cookieConsent'));
    
    // Ne pas afficher la modale si on est sur la page "En savoir plus sur les cookies"
    if (window.location.pathname !== '/cookies') {
        if (!consentData || new Date().getTime() > consentData.expiration) {
            // Afficher la modale si aucun consentement ou si expiré
            window.myModal = new bootstrap.Modal(document.getElementById('cookieConsentModal'), {
                backdrop: 'static',
                keyboard: false
            });
            window.myModal.show();
        }
    }

    // Ajout du gestionnaire d'événement pour le bouton dans le footer
    document.getElementById('modify-cookie-consent').addEventListener('click', function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien

        // Charger l'état du consentement depuis le localStorage
        const consentData = JSON.parse(localStorage.getItem('cookieConsent'));

        // Vérifier si le consentement marketing est déjà donné et ajuster l'état de la case
        if (consentData && consentData.marketing) {
            document.getElementById('marketing').checked = true;
        } else {
            document.getElementById('marketing').checked = false;
        }

        // Afficher la modale de consentement pour modifier les préférences
        window.myModal = new bootstrap.Modal(document.getElementById('cookieConsentModal'), {
            backdrop: 'static',
            keyboard: false
        });
        window.myModal.show();
    });
}

// Fonction pour enregistrer les préférences de cookies dans le localStorage
document.getElementById('acceptCookies').addEventListener('click', function () {
    const marketingChecked = document.getElementById('marketing').checked;

    // Enregistrer les préférences et l'expiration dans le localStorage
    const consentData = {
        necessary: true, // toujours activé
        marketing: marketingChecked,
        expiration: new Date().getTime() + consentExpiration // durée de validité : 6 mois
    };

    localStorage.setItem('cookieConsent', JSON.stringify(consentData));

    // Fermer la modale après avoir enregistré les préférences
    if (window.myModal) {
        window.myModal.hide();
    }
});