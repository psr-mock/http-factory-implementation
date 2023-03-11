<?php

declare(strict_types=1);

namespace PsrMock\Psr17;

use PsrMock\Psr7\Response;
use Psr\Http\Message\{ResponseFactoryInterface, ResponseInterface, StreamInterface};

final class ResponseFactory implements ResponseFactoryInterface
{
    public static function create(
        int $code = 200,
        string $reasonPhrase = '',
        string $protocolVersion = '1.1',
        array $headers = [],
        ?StreamInterface $body = null
    ): ResponseInterface {
        return Response::create($protocolVersion, $headers, $body)->withStatus($code, $reasonPhrase);
    }

    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return new Response($code, $reasonPhrase);
    }
}
