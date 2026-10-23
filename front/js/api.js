// NRV.net - accès à l'API, session de l'utilisateur et fonctions partagées par les pages

// L'API est sur le même serveur que le front, port 45000
// (localhost en local, docketu.iutnc.univ-lorraine.fr en déploiement).
export const API_URL = `${window.location.protocol}//${window.location.hostname}:45000`;

/** Erreur renvoyée par l'API : on garde le code HTTP pour réagir (401 -> connexion, 403...). */
export class ErreurApi extends Error {
  constructor(message, code) {
    super(message);
    this.code = code;
  }
}

// ---- session : jeton JWT reçu à la connexion, gardé dans le navigateur ----
const CLE_SESSION = 'nrv.session';

/** { token, nom, email, role } ou null si personne n'est connecté. */
export function session() {
  try {
    return JSON.parse(localStorage.getItem(CLE_SESSION));
  } catch {
    return null;
  }
}

export function ouvrirSession(auth) {
  localStorage.setItem(CLE_SESSION, JSON.stringify({ token: auth.token, ...auth.utilisateur }));
}

export function fermerSession() {
  localStorage.removeItem(CLE_SESSION);
}

/** Page réservée aux utilisateurs connectés : sinon, redirection vers la connexion puis retour ici. */
export function exigerConnexion() {
  if (!session()) {
    allerConnexion();
    return false;
  }
  return true;
}

export function allerConnexion() {
  const retour = window.location.pathname.split('/').pop() + window.location.search;
  window.location.href = `connexion.html?retour=${encodeURIComponent(retour)}`;
}

/**
 * Appelle l'API et renvoie le JSON. Ajoute le jeton si l'utilisateur est connecté.
 * Les erreurs de l'API ({type: "error", code, message}) deviennent des ErreurApi.
 * Un 401 (jeton absent ou expiré) ferme la session.
 */
export async function api(chemin, { methode = 'GET', corps } = {}) {
  const entetes = { Accept: 'application/json' };
  if (corps !== undefined) entetes['Content-Type'] = 'application/json';
  const s = session();
  if (s) entetes.Authorization = `Bearer ${s.token}`;

  let reponse;
  try {
    reponse = await fetch(API_URL + chemin, {
      method: methode,
      headers: entetes,
      body: corps === undefined ? undefined : JSON.stringify(corps),
    });
  } catch {
    throw new ErreurApi('Impossible de contacter le serveur. Vérifiez votre connexion.', 0);
  }
  const donnees = await reponse.json().catch(() => null);
  if (!reponse.ok) {
    if (reponse.status === 401) fermerSession();
    throw new ErreurApi(donnees?.message ?? `Erreur ${reponse.status}`, reponse.status);
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

/** Paramètre de l'adresse de la page (?id=3 -> "3"). */
export const parametre = (nom) => new URLSearchParams(window.location.search).get(nom);

/** Affiche un message d'erreur à la place d'un contenu. */
export function afficherErreur(conteneur, message) {
  conteneur.innerHTML = '';
  const p = document.createElement('p');
  p.className = 'message message--erreur';
  p.setAttribute('role', 'alert');
  p.textContent = message;
  conteneur.append(p);
}

/** Affiche (ou cache, si texte vide) un message dans un élément <p hidden> de la page. */
export function message(element, texte) {
  element.textContent = texte;
  element.hidden = !texte;
}

/**
 * Menu selon la session : « Connexion » devient « Déconnexion (nom) »,
 * et un lien « Back-office » apparaît pour les gestionnaires.
 */
export function majMenu() {
  const s = session();
  const lien = document.querySelector('.menu a[href="connexion.html"]');
  if (!s || !lien) return;
  lien.textContent = `Déconnexion (${s.nom.split(' ')[0]})`;
  lien.removeAttribute('aria-current');
  lien.addEventListener('click', (evt) => {
    evt.preventDefault();
    fermerSession();
    window.location.href = 'index.html?deconnecte=1';
  });
  if (s.role === 'admin' && !document.querySelector('.menu a[href="backoffice.html"]')) {
    const li = document.createElement('li');
    li.innerHTML = '<a href="backoffice.html">Back-office</a>';
    if (window.location.pathname.endsWith('backoffice.html')) li.firstChild.setAttribute('aria-current', 'page');
    lien.parentElement.before(li);
  }
}

/**
 * Case « justificatif » du tarif réduit (soirée et pass) : visible et obligatoire
 * seulement quand « Réduit » est choisi. Simple déclaration : elle n'est pas envoyée à l'API.
 */
export function brancherJustificatif(selectTarif) {
  const bloc = document.getElementById('bloc-justificatif');
  const caseJustificatif = document.getElementById('justificatif-reduit');
  if (!selectTarif || !bloc) return;
  const maj = () => {
    const reduit = selectTarif.value === 'reduit' && !selectTarif.disabled;
    bloc.hidden = !reduit;
    caseJustificatif.required = reduit;   // un required caché bloquerait l'envoi sans message
    if (!reduit) caseJustificatif.checked = false;
  };
  selectTarif.addEventListener('change', maj);
  maj();
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
/** "reduit" -> "Réduit" */
export const categorieLisible = (c) => (c === 'reduit' ? 'Réduit' : 'Normal');
