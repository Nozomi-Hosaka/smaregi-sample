<?php
declare(strict_types=1);

namespace App\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Smaregi\SmaregiApiClient\Foundation\Exceptions\HttpClient\NetworkException;
use Smaregi\SmaregiApiClient\Foundation\Exceptions\HttpClient\RequestException;

class ApiGuzzleClient implements ClientInterface
{
    /**
     * @var Client
     */
    private $guzzle;

    public function __construct()
    {
        $this->guzzle = new Client(['http_errors' => false]);
    }

    /**
     * @param RequestInterface $request
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return ResponseInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->guzzle->send($request);
        } catch (ConnectException $e) {
            throw new NetworkException(
                $request,
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            throw new RequestException(
                $request,
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }
}
