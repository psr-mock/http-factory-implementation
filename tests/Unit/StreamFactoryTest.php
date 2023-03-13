<?php

use PsrMock\Psr17\StreamFactory;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

beforeEach(function () {
    $this->streamFactory = new StreamFactory();
});

it('should implement the StreamFactoryInterface', function () {
    expect($this->streamFactory)->toBeInstanceOf(StreamFactoryInterface::class);
});

it('should create a new stream from a string', function () {
    $string = 'Hello, world!';
    $stream = $this->streamFactory->createStream($string);

    expect($stream)
        ->toBeInstanceOf(StreamInterface::class);

    expect($stream->getContents())
        ->toBe($string);
});

it('should create a new stream from a file', function () {
    $file = __DIR__ . '/StreamFactoryTest.tmp';
    $stream = $this->streamFactory->createStreamFromFile($file, 'w');

    expect($stream)
        ->toBeInstanceOf(StreamInterface::class);

    expect($stream->getMetadata('uri'))
        ->toBe($file);
});

it('should create a new stream from a resource', function () {
    $resource = fopen('php://memory', 'w');
    fwrite($resource, 'Hello, world!');

    $stream = $this->streamFactory->createStreamFromResource($resource);

    expect($stream)
        ->toBeInstanceOf(StreamInterface::class);

    expect((string) $stream)
        ->toBe('Hello, world!');

    fclose($resource);
});
