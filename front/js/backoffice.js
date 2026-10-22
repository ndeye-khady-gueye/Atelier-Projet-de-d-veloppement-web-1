// NRV.net - page « Back-office » : fonctionnalité 11, jauge et recette de chaque soirée (gestionnaires)
import {
  api, template, afficherErreur, message, majMenu, exigerConnexion, allerConnexion, dateLisible, prixLisible,
} from './api.js';

const liste = document.getElementById('liste-soirees-admin');
const erreur = document.getElementById('erreur-admin');
const recette = document.getElementById('recette-totale');
const tplJauges = template('tpl-jauges');

async function charger() {
  try {
    const donnees = await api('/admin/soirees');
    recette.textContent = prixLisible(donnees.recette_totale);
    liste.innerHTML = tplJauges({
      soirees: donnees.soirees.map(({ soiree }) => ({
        ...soiree,
        dateTexte: dateLisible(soiree.date),
        recetteTexte: prixLisible(soiree.recette),
      })),
    });
  } catch (e) {
    if (e.code === 401) {
      allerConnexion();
    } else {
      liste.innerHTML = '';
      message(erreur, e.code === 403 ? 'Cette page est réservée aux gestionnaires du festival.' : e.message);
    }
  }
}

majMenu();
if (exigerConnexion()) charger();
