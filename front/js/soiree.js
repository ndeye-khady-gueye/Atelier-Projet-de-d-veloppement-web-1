// NRV.net - page « Soirée » (soiree.html?id=...)
// Fonctionnalité 2 : détail d'une soirée (nom, thématique, date, lieu, tarifs, spectacles)
import { api, template, afficherErreur, dateLisible, heureLisible, prixLisible } from './api.js';

const conteneur = document.getElementById('soiree');
const tplSoiree = template('tpl-soiree');

async function chargerSoiree() {
  const id = new URLSearchParams(window.location.search).get('id');
  if (!id || !/^\d+$/.test(id)) {
    afficherErreur(conteneur, 'Soirée introuvable : aucun identifiant valide dans l\'adresse.');
    return;
  }

  try {
    const { soiree } = await api(`/soirees/${id}`);
    document.title = `${soiree.nom} – NRV.net`;
    conteneur.innerHTML = tplSoiree({
      ...soiree,
      dateTexte: dateLisible(soiree.date),
      heureTexte: heureLisible(soiree.horaire),
      tarifs: Object.fromEntries(Object.entries(soiree.tarifs).map(([cle, prix]) => [cle, prixLisible(prix)])),
      spectacles: soiree.spectacles.map((s) => ({
        ...s,
        image: s.images[0] ?? null,
        heureTexte: heureLisible(s.horaire),
        artistesTexte: s.artistes.join(', '),
      })),
    });
    brancherFormulaire();
  } catch (e) {
    afficherErreur(conteneur, e.message);
  }
}

// L'ajout au panier (fonctionnalité 6) arrive avec l'authentification : en attendant, on l'annonce.
function brancherFormulaire() {
  const formulaire = document.getElementById('form-panier');
  const message = document.getElementById('message-panier');
  formulaire.addEventListener('submit', (evt) => {
    evt.preventDefault();
    message.textContent = 'L\'ajout au panier sera bientôt disponible.';
  });
}

chargerSoiree();
