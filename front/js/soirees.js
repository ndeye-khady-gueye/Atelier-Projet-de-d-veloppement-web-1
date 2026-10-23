// NRV.net - page « Soirées » (soirees.html) : le programme vu par soirée (date, lieu, places restantes)
import { api, template, afficherErreur, dateLisible, heureLisible, majMenu } from './api.js';

const liste = document.getElementById('liste-soirees');
const tplSoirees = template('tpl-soirees');

async function chargerSoirees() {
  liste.setAttribute('aria-busy', 'true');
  try {
    const { soirees } = await api('/soirees');
    liste.innerHTML = tplSoirees({
      soirees: soirees.map(({ soiree }) => ({
        ...soiree,
        dateTexte: dateLisible(soiree.date),
        heureTexte: heureLisible(soiree.horaire),
      })),
    });
  } catch (e) {
    afficherErreur(liste, e.message);
  } finally {
    liste.removeAttribute('aria-busy');
  }
}

majMenu();
chargerSoirees();
