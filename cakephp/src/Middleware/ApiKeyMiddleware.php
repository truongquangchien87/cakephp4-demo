<?php
declare(strict_types=1);

namespace App\Middleware;

use Cake\Core\Configure;
use Cake\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;

class ApiKeyMiddleware implements MiddlewareInterface
{
  public function process(
    ServerRequestInterface $request,
    RequestHandlerInterface $handler
  ): ResponseInterface
  {
      $apiKey = $request->getHeader('x-api-key')[0] ?? '';

      if (empty($apiKey) || $apiKey !== Configure::read('ApiKey')) {
        $response = new Response();

        return $response->withStatus(403)->withStringBody(json_encode([
          'message' => 'Invalid API key.'
        ]));
      }

      return $handler->handle($request);
  }
}
