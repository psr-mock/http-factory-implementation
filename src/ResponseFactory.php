<?php

declare(strict_types=1);

namespace PsrMock\Psr17;

use Psr\Http\Message\{ResponseFactoryInterface, ResponseInterface};
use PsrMock\Psr7\Response;

final class ResponseFactory implements ResponseFactoryInterface
{
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return new Response($code, $reasonPhrase);
    }
}
