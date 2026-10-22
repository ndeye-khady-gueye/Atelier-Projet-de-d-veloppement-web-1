<?php
declare(strict_types=1);

namespace nrv\api\middlewares;

use nrv\core\application\exceptions\ServiceAuthException;
use nrv\core\application\exceptions\ServiceConflictException;
use nrv\core\application\exceptions\ServiceForbiddenException;
use nrv\core\application\exceptions\ServiceInvalidDataException;
use nrv\core\application\exceptions\ServiceNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpException;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpUnauthorizedException;

/**
 * Traduit les exceptions du domaine applicatif en erreurs HTTP :
 * données invalides 400, non authentifié 401, interdit 403, introuvable 404, conflit 409.
 */
class ServiceExceptionMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $rq, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($rq);
        } catch (ServiceInvalidDataException $e) {
            throw new HttpBadRequestException($rq, $e->getMessage(), $e);
        } catch (ServiceAuthException $e) {
            throw new HttpUnauthorizedException($rq, $e->getMessage(), $e);
        } catch (ServiceForbiddenException $e) {
            throw new HttpForbiddenException($rq, $e->getMessage(), $e);
        } catch (ServiceNotFoundException $e) {
            throw new HttpNotFoundException($rq, $e->getMessage(), $e);
        } catch (ServiceConflictException $e) {
            $http = new HttpException($rq, $e->getMessage(), 409, $e);
            $http->setTitle('409 Conflict');
            throw $http;
        }
    }
}
