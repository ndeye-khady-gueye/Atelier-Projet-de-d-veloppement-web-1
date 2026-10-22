// NRV.net - page « Confirmation » (confirmation.html?commande=...) : billets de la commande payée
import {
  api, template, afficherErreur, majMenu, exigerConnexion, allerConnexion, parametre,
  idDepuisLien, dateLisible, prixLisible,
} from './api.js';

const resume = document.getElementById('resume-commande-payee');
const liste = document.getElementById('liste-billets');
const tplBillets = template('tpl-billets');

async function charger() {
  const id = parametre('commande');
  try {
    const { commande } = await api(`/commandes/${encodeURIComponent(id ?? '')}`);
    resume.innerHTML = `Commande n° <strong>${commande.id}</strong> · Statut : <strong>${commande.statut === 'payee' ? 'payée' : 'en attente de paiement'}</strong>`
      + ` · Total : <strong>${prixLisible(commande.montant)}</strong>`;
    liste.innerHTML = tplBillets({
      billets: commande.billets.map((b) => ({
        ...b,
        token: idDepuisLien(b.links.self.href),
        dateTexte: dateLisible(b.date),
      })),
    });
  } catch (e) {
    if (e.code === 401) allerConnexion();
    else afficherErreur(liste, e.message);
  }
}

majMenu();
if (exigerConnexion()) charger();
