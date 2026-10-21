// NRV.net - accès à l'API et fonctions partagées par les pages

// L'API est sur le même serveur que le front, port 45000
// (localhost en local, docketu.iutnc.univ-lorraine.fr en déploiement).
export const API_URL = `${window.location.protocol}//${window.location.hostname}:45000`;

/**
 * Appelle l'API et renvoie le JSON.
 * Les erreurs de l'API ({type: "error", code, message}) sont transformées en exceptions.
 */
export async function api(chemin) {
  let reponse;
  try {
    reponse = await fetch(API_URL + chemin, { headers: { Accept: 'application/json' } });
  } catch {
    throw new Error("Impossible de contacter le serveur. Vérifiez votre connexion.");
  }
  const donnees = await reponse.json().catch(() => null);
  if (!reponse.ok) {
    throw new Error(donnees?.message ?? `Erreur ${reponse.status}`);
  }
  return donnees;
}

/** Compile un template Handlebars écrit dans la page (<script type="text/x-handlebars-template">). */
export function template(id) {
  return Handlebars.compile(document.getElementById(id).innerHTML);
}

/** Identifiant à la fin d'un lien HATEOAS : "/soirees/3" -> "3". */
export function idDepuisLien(href) {
  return href.split('/').pop();
}

/** Affiche un message d'erreur à la place d'un contenu. */
export function afficherErreur(conteneur, message) {
  conteneur.innerHTML = '';
  const p = document.createElement('p');
  p.className = 'message message--erreur';
  p.setAttribute('role', 'alert');
  p.textContent = message;
  conteneur.append(p);
}

// ---- formatage (français) ----
const formatDate = new Intl.DateTimeFormat('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
const formatPrix = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' });

/** "2027-06-12" -> "12 juin 2027" */
export const dateLisible = (date) => formatDate.format(new Date(`${date}T12:00:00`));
/** "20:30" -> "20h30" */
export const heureLisible = (heure) => heure.replace(':', 'h');
/** 87.3 -> "87,30 €" */
export const prixLisible = (prix) => formatPrix.format(prix);
