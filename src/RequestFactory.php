<?php

declare(strict_types=1);

namespace PsrMock\Psr17;

use PsrMock\Psr7\{Request, Uri};
use Psr\Http\Message\{RequestFactoryInterface, RequestInterface, StreamInterface, UriInterface};

final class RequestFactory implements RequestFactoryInterface
{
    public function createRequest(string $method, $uri): RequestInterface
    {
        return new Request($method, $this::parseUri($uri));
    }

    private static function parseUri(UriInterface|string $uri): UriInterface
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

        return $uri;
    }
}
