// NRV.net - page « Panier » : fonctionnalités 7 (contenu, total), 8 (validation)
// et fonctionnalité étendue : modification de la quantité
import {
  api, template, afficherErreur, message, majMenu, exigerConnexion, allerConnexion,
  dateLisible, heureLisible, prixLisible, categorieLisible,
} from './api.js';

const lignes = document.getElementById('panier-lignes');
const nb = document.getElementById('panier-nb');
const total = document.getElementById('panier-total');
const erreur = document.getElementById('erreur-panier');
const boutonValider = document.getElementById('btn-valider');
const tplLignes = template('tpl-lignes');

function afficher(panier) {
  lignes.innerHTML = tplLignes({
    lignes: panier.lignes.map((l) => ({
      ...l,
      dateTexte: dateLisible(l.soiree.date),
      heureTexte: heureLisible(l.soiree.horaire),
      categorieTexte: categorieLisible(l.categorie).toLowerCase(),
      prixTexte: prixLisible(l.prix_unitaire),
      sousTotalTexte: prixLisible(l.sous_total),
    })),
  });
  nb.textContent = panier.nb_billets;
  total.textContent = prixLisible(panier.montant_total);
  boutonValider.disabled = panier.nb_billets === 0;
}

/** Appelle l'API, réaffiche le panier renvoyé, ou affiche l'erreur. */
async function executer(chemin, options) {
  message(erreur, '');
  try {
    const { panier } = await api(chemin, options);
    afficher(panier);
  } catch (e) {
    if (e.code === 401) allerConnexion();
    else message(erreur, e.message);
  }
}

// modification de la quantité (délégation : les lignes sont recréées à chaque affichage)
lignes.addEventListener('change', (evt) => {
  const ligne = evt.target.closest('[data-ligne]');
  if (evt.target.name !== 'quantite' || !ligne) return;
  executer(`/panier/lignes/${ligne.dataset.ligne}`, { methode: 'PATCH', corps: { quantite: Number(evt.target.value) } });
});

lignes.addEventListener('click', (evt) => {
  const id = evt.target.dataset.supprimer;
  if (id) executer(`/panier/lignes/${id}`, { methode: 'DELETE' });
});

// validation : le panier devient une commande, puis paiement
boutonValider.addEventListener('click', async () => {
  message(erreur, '');
  try {
    const { commande } = await api('/panier/valider', { methode: 'POST' });
    window.location.href = `paiement.html?commande=${commande.id}`;
  } catch (e) {
    if (e.code === 401) allerConnexion();
    else message(erreur, e.message);
  }
});

majMenu();
if (exigerConnexion()) {
  api('/panier').then(({ panier }) => afficher(panier)).catch((e) => {
    if (e.code === 401) allerConnexion();
    else afficherErreur(lignes, e.message);
  });
}
