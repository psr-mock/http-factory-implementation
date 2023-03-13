<?php

declare(strict_types=1);

namespace PsrMock\Psr17;

use Psr\Http\Message\{StreamFactoryInterface, StreamInterface};
use PsrMock\Psr7\Stream;
use RuntimeException;

final class StreamFactory implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        return new Stream($content);
    }

    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
        $resource = fopen($filename, $mode);

        if (false === $resource) {
            throw new RuntimeException(sprintf('Could not open file: %s', $filename));
        }

        return new Stream($resource);
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        $resource = stream_get_contents($resource, null, 0);

        if (false === $resource) {
            throw new RuntimeException('Could not read from resource');
        }

        return new Stream($resource);
    }
}
