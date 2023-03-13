<?php

use PsrMock\Psr17\RequestFactory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

beforeEach(function () {
    $this->factory = new RequestFactory();
});

it('should implement the RequestFactoryInterface', function () {
    expect($this->factory)
        ->toBeInstanceOf(RequestFactoryInterface::class);
});

it('should create a new request using a UriInterface', function () {
    $uri = $this->createMock(UriInterface::class);
    $request = $this->factory->createRequest('GET', $uri);

    expect($request)
        ->toBeInstanceOf(RequestInterface::class);

    expect($request->getMethod())
        ->toBe('GET');

    expect($request->getUri())
        ->toBe($uri);
});

it('should create a new request with a string', function () {
    $uri = 'https://example.com';
    $request = $this->factory->createRequest('GET', $uri);

    expect($request)
        ->toBeInstanceOf(RequestInterface::class);

    expect($request->getMethod())
        ->toBe('GET');

    expect((string) $request->getUri())
        ->toBe($uri);
});

it('should create a new request with headers', function () {
    $uri = $this->createMock(UriInterface::class);

    $request = $this->factory->createRequest('POST', $uri)
        ->withHeader('Content-Type', 'application/json');

    expect($request->getMethod())
        ->toBe('POST');

    expect($request->getUri())
        ->toBe($uri);

    expect($request->getHeaderLine('Content-Type'))
        ->toBe('application/json');
});

it('should return an instance of UriInterface', function () {
    $uri = $this->factory->createRequest('GET', 'https://www.example.com');
    expect($uri->getUri())->toBeInstanceOf(UriInterface::class);
});

it('should parse the scheme', function () {
    $uri = $this->factory->createRequest('GET', 'https://www.example.com');
    expect($uri->getUri()->getScheme())->toBe('https');
});

it('should parse the authentication', function () {
    $uri = $this->factory->createRequest('GET', 'https://user:pass@example.com');
    expect($uri->getUri()->getUserInfo())->toBe('user:pass');
});

it('should parse the host', function () {
    $uri = $this->factory->createRequest('GET', 'https://www.example.com');
    expect($uri->getUri()->getHost())->toBe('www.example.com');
});

it('should parse the port', function () {
    $uri = $this->factory->createRequest('GET', 'https://www.example.com:8080');
    expect($uri->getUri()->getPort())->toBe(8080);
});

it('should parse the path', function () {
    $uri = $this->factory->createRequest('GET', 'https://www.example.com/path/to/resource');
    expect($uri->getUri()->getPath())->toBe('/path/to/resource');
});

it('should parse the query', function () {
    $uri = $this->factory->createRequest('GET', 'https://www.example.com?foo=bar&baz=qux');
    expect($uri->getUri()->getQuery())->toBe('foo=bar&baz=qux');
});

it('should parse the fragment', function () {
    $uri = $this->factory->createRequest('GET', 'https://www.example.com#top');
    expect($uri->getUri()->getFragment())->toBe('top');
});
