// NRV.net - page « Billet » (billet.html?token=...) : fonctionnalité 10, billet imprimable
// Billet non nominatif : accessible sans connexion par son lien (token aléatoire).
import {
  api, template, afficherErreur, majMenu, parametre, dateLisible, heureLisible, prixLisible, categorieLisible,
} from './api.js';

const conteneur = document.getElementById('billet');
const tplBillet = template('tpl-billet');

async function charger() {
  const token = parametre('token');
  if (!token || !/^[0-9a-f]{64}$/.test(token)) {
    afficherErreur(conteneur, 'Billet introuvable : lien invalide.');
    return;
  }
  try {
    const { billet } = await api(`/billets/${token}`);
    document.title = `Billet ${billet.reference} – NRV.net`;
    conteneur.innerHTML = tplBillet({
      ...billet,
      dateTexte: dateLisible(billet.soiree.date),
      heureTexte: heureLisible(billet.soiree.horaire),
      categorieTexte: categorieLisible(billet.categorie),
      prixTexte: prixLisible(billet.prix),
    });
    document.getElementById('btn-imprimer').addEventListener('click', () => window.print());
  } catch (e) {
    afficherErreur(conteneur, e.message);
  }
}

majMenu();
charger();
