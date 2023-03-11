<?php

declare(strict_types=1);

namespace PsrMock\Psr17;

use PsrMock\Psr7\{Request, Uri};
use Psr\Http\Message\{RequestFactoryInterface, RequestInterface};

final class RequestFactory implements RequestFactoryInterface
{
    public function createRequest(string $method, $uri): RequestInterface
    {
        if (is_string($uri)) {
            $uri = parse_url($uri);

            $uri = new Uri(
                $uri['scheme'] ?? '',
                $uri['host'] ?? '',
                $uri['path'] ?? '',
                $uri['query'] ?? '',
                $uri['fragment'] ?? '',
            );
        }

        return new Request($method, $uri);
    }
}
