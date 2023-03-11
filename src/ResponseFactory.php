<?php

declare(strict_types=1);

namespace PsrMock\Psr17;

use PsrMock\Psr7\Response;
use Psr\Http\Message\{ResponseFactoryInterface, ResponseInterface};

final class ResponseFactory implements ResponseFactoryInterface
{
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return new Response($code, $reasonPhrase);
    }
}
