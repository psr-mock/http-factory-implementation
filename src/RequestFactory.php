<?php

declare(strict_types=1);

namespace PsrMock\Psr17;

use Psr\Http\Message\{RequestFactoryInterface, RequestInterface, UriInterface};

use PsrMock\Psr7\{Request, Uri};
use function is_string;

final class RequestFactory implements RequestFactoryInterface
{
    /**
     * @psalm-suppress RedundantCast
     *
     * @param string|UriInterface $uri
     */
    private function parseUri(UriInterface | string $uri): UriInterface
    {
        if (is_string($uri)) {
            $uri = parse_url($uri);

            $uri = new Uri(
                scheme: $uri['scheme'] ?? '',
                host: $uri['host'] ?? '',
                port: isset($uri['port']) ? (int) $uri['port'] : null,
                user: $uri['user'] ?? '',
                pass: $uri['pass'] ?? '',
                path: $uri['path'] ?? '',
                query: $uri['query'] ?? '',
                fragment: $uri['fragment'] ?? '',
            );
        }

        return $uri;
    }

    public function createRequest(string $method, $uri): RequestInterface
    {
        return new Request($method, $this->parseUri($uri));
    }
}
