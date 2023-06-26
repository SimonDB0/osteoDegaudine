
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import 'tw-elements'
import Like from './scripts/like';


// menu hamburger

const menuToggle = document.getElementById('menu-toggle');
const menuLinks = document.querySelector('.md\\:flex > .flex-col');

menuToggle.addEventListener('click', () => {
    menuLinks.classList.toggle('hidden');
});

// JavaScript pour activer le dropdown
document.addEventListener("DOMContentLoaded", function() {
    var dropdownToggle = document.getElementById("admin-dropdown-toggle");
    var dropdownMenu = document.getElementById("admin-dropdown");

    dropdownToggle.addEventListener("click", function() {
        dropdownMenu.classList.toggle("hidden");
    });
});

//like

document.addEventListener('DOMContentLoaded', () => {
    console.log('Webpack Encore is working !');

    // Like's system
    const likeElements = [].slice.call(document.querySelectorAll('a[data-action="like"]'));
    if (likeElements) {
        new Like(likeElements);
    }
})

