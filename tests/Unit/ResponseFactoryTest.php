<?php

use PsrMock\Psr17\ResponseFactory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

beforeEach(function () {
    $this->factory = new ResponseFactory();
});

it('should implement the ResponseFactoryInterface', function () {
    expect($this->factory)
        ->toBeInstanceOf(ResponseFactoryInterface::class);
});

it('should create a new response with a status code', function () {
    $response = $this->factory->createResponse(418);

    expect($response)
        ->toBeInstanceOf(ResponseInterface::class);

    expect($response->getStatusCode())
        ->toBe(418);
});

it('should create a new response with headers', function () {
    $headers = ['Content-Type' => 'application/json'];
    $response = $this->factory->createResponse(200)->withHeader('Content-Type', 'application/json');

    expect($response)
        ->toBeInstanceOf(ResponseInterface::class);

    expect($response->getStatusCode())
        ->toBe(200);

    expect($response->getHeader('Content-Type'))
        ->toBe(['application/json']);
});

it('should create a new response with a body', function () {
    $body = 'Hello, world!';
    $response = $this->factory->createResponse(200);
    $response->getBody()->write($body);

    expect($response)
        ->toBeInstanceOf(ResponseInterface::class);

    expect($response->getStatusCode())
        ->toBe(200);

    expect((string) $response->getBody())
        ->toBe($body);
});
