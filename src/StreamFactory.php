<?php

declare(strict_types=1);

namespace PsrMock\Psr17;

use PsrMock\Psr7\Stream;
use Psr\Http\Message\{StreamFactoryInterface, StreamInterface};

final class StreamFactory implements StreamFactoryInterface
{
    public function createStream(string $content = ''): StreamInterface
    {
        return new Stream($content);
    }

    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
        return new Stream(file_get_contents($filename));
    }

    public function createStreamFromResource($resource): StreamInterface
    {
        return new Stream(stream_get_contents($resource));
    }
}
