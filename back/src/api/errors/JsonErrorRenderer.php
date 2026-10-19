<?php
declare(strict_types=1);

namespace nrv\api\errors;

use Slim\Exception\HttpException;
use Slim\Interfaces\ErrorRendererInterface;
use Throwable;

/**
 * Toutes les erreurs de l'API ont la même forme :
 * { "type": "error", "code": 404, "message": "..." }
 */
class JsonErrorRenderer implements ErrorRendererInterface
{
    public function __invoke(Throwable $exception, bool $displayErrorDetails): string
    {
        $code = $exception instanceof HttpException ? $exception->getCode() : 500;
        $message = $exception instanceof HttpException || $displayErrorDetails
            ? $exception->getMessage()
            : 'Erreur interne du serveur';

        $data = ['type' => 'error', 'code' => $code, 'message' => $message];
        if ($displayErrorDetails) {
            $data['exception'] = [
                'class' => $exception::class,
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ];
        }
        return (string) json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
