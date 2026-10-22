// NRV.net - page « Paiement » (paiement.html?commande=...) : fonctionnalité 9, paiement simulé
import { api, message, majMenu, exigerConnexion, allerConnexion, parametre, prixLisible } from './api.js';

const resume = document.getElementById('resume-commande');
const formulaire = document.getElementById('form-paiement');
const erreur = document.getElementById('erreur-paiement');
const bouton = document.getElementById('btn-payer');
const id = parametre('commande');

async function chargerCommande() {
  if (!id || !/^\d+$/.test(id)) {
    resume.textContent = 'Commande introuvable.';
    formulaire.hidden = true;
    return;
  }
  try {
    const { commande } = await api(`/commandes/${id}`);
    if (commande.statut === 'payee') {
      window.location.href = `confirmation.html?commande=${id}`;
      return;
    }
    resume.innerHTML = `Commande n° <strong>${commande.id}</strong> · <strong>${commande.nb_billets}</strong> billet(s)`
      + ` · Total : <strong>${prixLisible(commande.montant)}</strong>`;
    bouton.textContent = `Payer ${prixLisible(commande.montant)}`;
  } catch (e) {
    if (e.code === 401) allerConnexion();
    resume.textContent = e.message;
    formulaire.hidden = true;
  }
}

formulaire.addEventListener('submit', async (evt) => {
  evt.preventDefault();
  message(erreur, '');
  bouton.disabled = true;
  try {
    await api(`/commandes/${id}/paiement`, { methode: 'POST', corps: Object.fromEntries(new FormData(formulaire)) });
    window.location.href = `confirmation.html?commande=${id}`;
  } catch (e) {
    if (e.code === 401) allerConnexion();
    else message(erreur, e.message);
    bouton.disabled = false;
  }
});

majMenu();
if (exigerConnexion()) chargerCommande();
