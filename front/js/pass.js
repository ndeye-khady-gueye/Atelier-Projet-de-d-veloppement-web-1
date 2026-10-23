// NRV.net - page « Pass 3 jours » : 3 soirées différentes, remise de 3 %
import {
  api, template, message, majMenu, exigerConnexion, allerConnexion, dateLisible, brancherJustificatif,
} from './api.js';

const formulaire = document.getElementById('form-pass');
const erreur = document.getElementById('erreur-pass');
const selects = [1, 2, 3].map((i) => document.getElementById(`pass-soiree-${i}`));
const tplOptions = template('tpl-options-soirees');

async function chargerSoirees() {
  try {
    const { soirees } = await api('/soirees');
    const html = tplOptions({
      soirees: soirees.map(({ soiree }) => ({ ...soiree, dateTexte: dateLisible(soiree.date) })),
    });
    selects.forEach((s) => { s.innerHTML = html; });
  } catch (e) {
    message(erreur, e.message);
  }
}

formulaire.addEventListener('submit', async (evt) => {
  evt.preventDefault();
  message(erreur, '');
  const choix = selects.map((s) => s.value);
  if (new Set(choix).size !== 3) {
    message(erreur, 'Choisissez 3 soirées différentes.');
    return;
  }
  try {
    await api('/panier/pass', {
      methode: 'POST',
      corps: { soirees: choix.map(Number), categorie: document.getElementById('pass-categorie').value },
    });
    window.location.href = 'panier.html';
  } catch (e) {
    if (e.code === 401) allerConnexion();
    else message(erreur, e.message);
  }
});

brancherJustificatif(document.getElementById('pass-categorie'));
majMenu();
if (exigerConnexion()) chargerSoirees();
