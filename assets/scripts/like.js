import axios from 'axios';

export default class Like {
    constructor(likeElements) {
        this.likeElements = likeElements;

        if (this.likeElements) {
            this.init();
        }
    }

    init() {
        this.likeElements.map(element => {
            element.addEventListener('click', this.onClick)
        })
    }

    onClick(event) {
        event.preventDefault();

        // Récupération de l'URL à partir de l'attribut "href" de l'élément cliqué
        const url = this.href;

        // Appel d'une requête GET à l'URL spécifiée à l'aide d'Axios
        axios.get(url).then(res => {
            console.log(res, this);

            // Récupération du nombre de likes depuis la réponse de la requête
            const nb = res.data.nbLike;

            // Mise à jour du nombre de likes affiché dans le span correspondant
            const span = this.querySelector('span');
            this.dataset.nb = nb;
            span.innerHTML = nb + ' J\'aime';

            // Recherche des éléments SVG représentant les icônes de pouce en l'air rempli et non rempli
            const thumbsUpFilled = this.querySelector('svg.filled');
            const thumbsUpUnfilled = this.querySelector('svg.unfilled');

            // Basculement des classes CSS pour afficher ou masquer les icônes appropriées
            thumbsUpFilled.classList.toggle('hidden');
            thumbsUpUnfilled.classList.toggle('hidden');
        })
    }
}