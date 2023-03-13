<?php

declare(strict_types=1);

namespace PsrMock\Psr17;

use Psr\Http\Message\{StreamFactoryInterface, StreamInterface};
use PsrMock\Psr7\Stream;
use RuntimeException;
use Throwable;

final class StreamFactory implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        return new Stream($content);
    }

    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
        $stream = false;

        try {
            $stream = fopen($filename, $mode);
        } catch (Throwable) {
        }

        if (false === $stream) {
            throw new RuntimeException(sprintf('Could not open file: %s', $filename));
        }

        return new Stream($stream);
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        $stream = false;

        try {
            $stream = stream_get_contents($resource, null, 0);
        } catch (Throwable $e) {
        }

        if (false === $stream) {
            throw new RuntimeException('Could not read from resource');
        }

        return new Stream($stream);
    }
}
