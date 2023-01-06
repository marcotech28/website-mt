// Sélectionnez l'élément de la navbar du bas
var bottomNavbar = document.querySelector('.navbar-bottom');

// Obtenez la position du haut de la navbar du bas par rapport à son parent le plus proche
var navbarTop = bottomNavbar.offsetTop;

// Ajoutez un écouteur d'événement de défilement à la page
window.addEventListener('scroll', function () {
    // Obtenez la position actuelle du défilement de la page
    var scrollPosition = window.pageYOffset;

    // Si la position du haut de la navbar du bas est inférieure à la position actuelle du défilement de la page, ajoutez la classe 'fixed' à l'élément de la navbar pour le fixer en haut de l'écran
    if (navbarTop < scrollPosition) {
        bottomNavbar.classList.add('fixed');
    } else {
        bottomNavbar.classList.remove('fixed');
    }
});