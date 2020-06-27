<?php

namespace Smaregi\SmaregiApiClient\Foundation\Exceptions\HttpClient;

use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;
use RuntimeException;
use Smaregi\SmaregiApiClient\Foundation\Exceptions\SmaregiApiClientException;
use Throwable;

class RequestException extends RuntimeException implements RequestExceptionInterface, SmaregiApiClientException
{
    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(RequestInterface $request, $message = '', $code = 0, Throwable $previous = null)
    {
        $this->request = $request;
        parent::__construct($message, $code, $previous);
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
