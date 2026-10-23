// NRV.net - page « Soirée » (soiree.html?id=...)
// Fonctionnalité 2 : détail d'une soirée ; fonctionnalité 6 : ajout de billets au panier
import {
  api, template, afficherErreur, message, majMenu, session, allerConnexion, parametre,
  dateLisible, heureLisible, prixLisible, brancherJustificatif,
} from './api.js';

const conteneur = document.getElementById('soiree');
const tplSoiree = template('tpl-soiree');

async function chargerSoiree() {
  const id = parametre('id');
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
      quantiteMax: Math.min(10, soiree.places_restantes),
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

// Ajout au panier : il faut être connecté (le panier est lié au compte)
function brancherFormulaire() {
  const formulaire = document.getElementById('form-panier');
  const erreur = document.getElementById('erreur-ajout');
  const statut = document.getElementById('message-ajout');
  brancherJustificatif(document.getElementById('tarif'));
  formulaire.addEventListener('submit', async (evt) => {
    evt.preventDefault();
    message(erreur, '');
    if (!session()) {
      allerConnexion();
      return;
    }
    const donnees = new FormData(formulaire);
    try {
      const { panier } = await api('/panier/lignes', {
        methode: 'POST',
        corps: {
          soiree: Number(donnees.get('soiree')),
          categorie: donnees.get('categorie'),
          quantite: Number(donnees.get('quantite')),
        },
      });
      statut.innerHTML = `Ajouté au panier (${panier.nb_billets} billet(s), ${prixLisible(panier.montant_total)}). `
        + '<a href="panier.html">Voir le panier</a>';
    } catch (e) {
      if (e.code === 401) allerConnexion();
      else message(erreur, e.message);
    }
  });
}

majMenu();
chargerSoiree();
