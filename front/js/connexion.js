// NRV.net - page « Connexion » : connexion et inscription
// Après succès : retour à la page demandée (?retour=...), sinon panier (ou back-office pour un gestionnaire)
import { api, message, ouvrirSession, majMenu, parametre } from './api.js';

function destination(auth) {
  const retour = parametre('retour');
  // uniquement une page du site (pas d'URL externe)
  if (retour && /^[\w-]+\.html(\?[\w=&%-]*)?$/.test(retour)) return retour;
  return auth.utilisateur.role === 'admin' ? 'backoffice.html' : 'panier.html';
}

/** verifier(corps) : contrôle facultatif avant l'envoi ; renvoie un message d'erreur ou ''. */
function brancher(idFormulaire, idErreur, route, verifier) {
  const formulaire = document.getElementById(idFormulaire);
  const erreur = document.getElementById(idErreur);
  formulaire.addEventListener('submit', async (evt) => {
    evt.preventDefault();
    message(erreur, '');
    const corps = Object.fromEntries(new FormData(formulaire));
    const probleme = verifier?.(corps);
    if (probleme) {
      message(erreur, probleme);
      return;
    }
    delete corps.password_confirmation;   // sert seulement à la vérification, pas envoyé à l'API
    try {
      const auth = await api(route, { methode: 'POST', corps });
      ouvrirSession(auth);
      window.location.href = destination(auth);
    } catch (e) {
      message(erreur, e.message);
    }
  });
}

brancher('form-connexion', 'erreur-connexion', '/auth/signin');
brancher('form-inscription', 'erreur-inscription', '/auth/register',
  (c) => (c.password !== c.password_confirmation ? 'Les deux mots de passe ne sont pas identiques.' : ''));
majMenu();
