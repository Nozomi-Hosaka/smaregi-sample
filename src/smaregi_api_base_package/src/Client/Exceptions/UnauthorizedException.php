<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiClient\Client\Exceptions;

use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Smaregi\SmaregiApiClient\Foundation\Exceptions\HttpClient\RequestException;
use Throwable;

class UnauthorizedException extends RequestException implements RequestExceptionInterface
{
    public function __construct(RequestInterface $request, $message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($request, $message, 401, $previous);
    }
}
