
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
document.getElementById('menu-button').addEventListener('click', function() {
    var menu = document.getElementById('menu');
    if (menu.className.indexOf('hidden') !== -1) {
        menu.className = menu.className.replace('hidden', 'block');
    } else {
        menu.className = menu.className.replace('block', 'hidden');
    }
});