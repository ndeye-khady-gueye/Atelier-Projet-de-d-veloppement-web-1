// NRV.net - page « Programme » (index.html)
// Fonctionnalités 1 (liste), 3 (lien vers la soirée), 4 (filtre date), 5 (filtre style) + pagination
import {
  api, template, idDepuisLien, afficherErreur, dateLisible, heureLisible, majMenu, message, parametre,
} from './api.js';

const liste = document.getElementById('liste-spectacles');
const pagination = document.getElementById('pagination');
const formulaire = document.getElementById('filtres');
const champDate = document.getElementById('filtre-date');
const champStyle = document.getElementById('filtre-style');

const tplSpectacles = template('tpl-spectacles');
const tplPagination = template('tpl-pagination');
const tplStyles = template('tpl-styles');

/** Les filtres sont gardés dans l'URL (?date=&style=&page=) : la page peut être rechargée ou partagée. */
function lireFiltres() {
  const p = new URLSearchParams(window.location.search);
  return { date: p.get('date') ?? '', style: p.get('style') ?? '', page: p.get('page') ?? '1' };
}

function requete({ date, style, page }) {
  const p = new URLSearchParams();
  if (date) p.set('date', date);
  if (style) p.set('style', style);
  if (page && page !== '1') p.set('page', page);
  return p.toString();
}

/** Les liens HATEOAS de l'API (/spectacles?page=2) deviennent des liens de la page (?page=2). */
const versPage = (lien) => (lien ? `index.html${lien.href.slice(lien.href.indexOf('?'))}` : null);

async function chargerStyles(styleChoisi) {
  try {
    const { styles } = await api('/styles');
    champStyle.innerHTML = tplStyles({
      styles: styles.map(({ style }) => ({ ...style, choisi: String(style.id) === styleChoisi })),
    });
  } catch {
    // sans la liste des styles, le filtre par date reste utilisable
    champStyle.disabled = true;
  }
}

async function chargerSpectacles(filtres) {
  liste.setAttribute('aria-busy', 'true');
  try {
    const donnees = await api(`/spectacles?${requete(filtres)}`);
    liste.innerHTML = tplSpectacles({
      spectacles: donnees.spectacles.map(({ spectacle, links }) => ({
        ...spectacle,
        soireeId: idDepuisLien(links.soiree.href),
        dateTexte: dateLisible(spectacle.date),
        heureTexte: heureLisible(spectacle.horaire),
      })),
    });
    pagination.innerHTML = donnees.pages > 1
      ? tplPagination({
          page: donnees.page,
          pages: donnees.pages,
          precedent: versPage(donnees.links.prev),
          suivant: versPage(donnees.links.next),
        })
      : '';
  } catch (e) {
    afficherErreur(liste, e.message);
    pagination.innerHTML = '';
  } finally {
    liste.removeAttribute('aria-busy');
  }
}

// Filtrer = recharger la page avec les filtres dans l'URL (retour à la page 1)
formulaire.addEventListener('submit', (evt) => {
  evt.preventDefault();
  const q = requete({ date: champDate.value, style: champStyle.value });
  window.location.href = q ? `index.html?${q}` : 'index.html';
});

majMenu();
if (parametre('deconnecte')) {
  message(document.getElementById('message-deconnexion'), 'Vous avez été déconnecté.');
  // on retire ?deconnecte=1 de l'adresse pour que le message ne revienne pas au rechargement
  window.history.replaceState(null, '', window.location.pathname);
}
const filtres = lireFiltres();
champDate.value = filtres.date;
chargerStyles(filtres.style);
chargerSpectacles(filtres);
