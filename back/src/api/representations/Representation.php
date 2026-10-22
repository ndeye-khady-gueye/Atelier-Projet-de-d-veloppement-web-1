<?php
declare(strict_types=1);

namespace nrv\api\representations;

use nrv\core\application\dto\AuthDTO;
use nrv\core\application\dto\BilletDTO;
use nrv\core\application\dto\CommandeDTO;
use nrv\core\application\dto\PanierDTO;

/** Format JSON (HATEOAS) des ressources de l'achat, partagé par les actions. */
final class Representation
{
    public static function auth(AuthDTO $a): array
    {
        return [
            'type' => 'resource',
            'utilisateur' => $a->toArray(),
            'token' => $a->token,
            'links' => [
                'panier' => ['href' => '/panier'],
                'programme' => ['href' => '/spectacles'],
            ],
        ];
    }

    public static function panier(PanierDTO $p): array
    {
        return [
            'type' => 'resource',
            'panier' => [
                'lignes' => array_map(fn ($l) => $l->toArray() + ['links' => [
                    'self' => ['href' => '/panier/lignes/' . $l->id],
                    'soiree' => ['href' => '/soirees/' . $l->soireeId],
                ]], $p->lignes),
                'nb_billets' => $p->nbBillets,
                'montant_total' => $p->montantTotal,
            ],
            'links' => [
                'self' => ['href' => '/panier'],
                'ajouter' => ['href' => '/panier/lignes', 'method' => 'POST'],
                'ajouter_pass' => ['href' => '/panier/pass', 'method' => 'POST'],
                'valider' => ['href' => '/panier/valider', 'method' => 'POST'],
            ],
        ];
    }

    public static function commande(CommandeDTO $c): array
    {
        $links = ['self' => ['href' => '/commandes/' . $c->id]];
        if ($c->statut === 'en_attente') {
            $links['payer'] = ['href' => '/commandes/' . $c->id . '/paiement', 'method' => 'POST'];
        }
        return [
            'type' => 'resource',
            'commande' => $c->toArray() + [
                'billets' => array_map(fn ($b) => self::billetCourt($b), $c->billets),
            ],
            'links' => $links,
        ];
    }

    public static function billet(BilletDTO $b): array
    {
        return [
            'type' => 'resource',
            'billet' => $b->toArray(),
            'links' => ['self' => ['href' => '/billets/' . $b->token]],
        ];
    }

    private static function billetCourt(BilletDTO $b): array
    {
        return [
            'reference' => $b->reference,
            'soiree' => $b->soiree,
            'date' => $b->date,
            'categorie' => $b->categorie,
            'links' => ['self' => ['href' => '/billets/' . $b->token]],
        ];
    }
}
