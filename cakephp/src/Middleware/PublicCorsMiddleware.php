<?php
declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;

class PublicCorsMiddleware implements MiddlewareInterface
{
  public function process(
    ServerRequestInterface $request,
    RequestHandlerInterface $handler
  ): ResponseInterface
  {
      $response = $handler->handle($request);

      $response = $this->addHeaders($request, $response);

      return $response;
  }

  public function addHeaders(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
  {
      $response = $response
          ->withHeader('Access-Control-Allow-Origin', '*')
          ->withHeader('Access-Control-Allow-Credentials', 'true')
          ->withHeader('Access-Control-Max-Age', '300');

      if (strtoupper($request->getMethod()) === 'OPTIONS') {
          $response = $response
              ->withHeader('Access-Control-Expose-Headers', ['Link'])
              ->withHeader('Access-Control-Allow-Headers', ['X-CSRF-Token'])
              ->withHeader('Access-Control-Allow-Methods', ['GET', 'POST', 'OPTIONS']);
      }

      return $response;
  }
}
