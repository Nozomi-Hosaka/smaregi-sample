<?php

declare(strict_types=1);

namespace Smaregi\SmaregiApiClient\Foundation;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

class PsrFactories
{
    /** @var \Psr\Http\Message\RequestFactoryInterface */
    private $requestFactory;

    /** @var \Psr\Http\Message\StreamFactoryInterface */
    private $streamFactory;

    /** @var \Psr\Http\Message\ResponseFactoryInterface */
    private $responseFactory;

    /** @var \Psr\Http\Message\UriFactoryInterface */
    private $uriFactory;

    /**
     * constructor.
     * @param \Psr\Http\Message\RequestFactoryInterface $requestFactory
     * @param \Psr\Http\Message\StreamFactoryInterface $streamFactory
     * @param \Psr\Http\Message\ResponseFactoryInterface $responseFactory
     * @param \Psr\Http\Message\UriFactoryInterface $uriFactory
     */
    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        ResponseFactoryInterface $responseFactory,
        UriFactoryInterface $uriFactory
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->responseFactory = $responseFactory;
        $this->uriFactory = $uriFactory;
    }

    /**
     * @return \Psr\Http\Message\RequestFactoryInterface
     */
    public function getRequestFactory(): \Psr\Http\Message\RequestFactoryInterface
    {
        return $this->requestFactory;
    }

    /**
     * @return \Psr\Http\Message\StreamFactoryInterface
     */
    public function getStreamFactory(): \Psr\Http\Message\StreamFactoryInterface
    {
        return $this->streamFactory;
    }

    /**
     * @return \Psr\Http\Message\ResponseFactoryInterface
     */
    public function getResponseFactory(): \Psr\Http\Message\ResponseFactoryInterface
    {
        return $this->responseFactory;
    }

    /**
     * @return \Psr\Http\Message\UriFactoryInterface
     */
    public function getUriFactory(): \Psr\Http\Message\UriFactoryInterface
    {
        return $this->uriFactory;
    }
}
