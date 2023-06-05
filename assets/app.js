
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import 'tw-elements'


// menu hamburger
document.addEventListener('DOMContentLoaded', (event) => {
    const navButton = document.querySelector('[data-te-collapse-init]');
    const navMenu = document.querySelector('#navbarSupportedContentY');

    navButton.addEventListener('click', () => {
        navMenu.classList.toggle('hidden');
        navMenu.classList.toggle('flex');
    });
});

