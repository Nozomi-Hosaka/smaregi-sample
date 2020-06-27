<?php

namespace Smaregi\SmaregiApiClient\Foundation\Exceptions\HttpClient;

use Psr\Http\Message\RequestInterface;
use Smaregi\SmaregiApiClient\Foundation\Exceptions\SmaregiApiClientException;
use Throwable;

class NetworkException extends \RuntimeException implements \Psr\Http\Client\NetworkExceptionInterface, SmaregiApiClientException
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
