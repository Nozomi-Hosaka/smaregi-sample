<?php
declare(strict_types=1);

namespace App\Adapters\Factory;

use App\Models\SmaregiApiToken;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Log;
use Smaregi\Exceptions\SmaregiSpecificationException;
use Smaregi\PosCategory\Models\Entity\PosCategory;
use Smaregi\PosCategory\Models\Factory\PosCategoryFactoryInterface;

class PosCategoryFactory implements PosCategoryFactoryInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var SmaregiApiToken
     */
    private $smaregiApiTokenModel;

    /**
     * PosCategoryFactory constructor.
     *
     * @param Client $client
     * @param SmaregiApiToken $smaregiApiTokenModel
     */
    public function __construct(Client $client, SmaregiApiToken $smaregiApiTokenModel)
    {
        $this->client = $client;
        $this->smaregiApiTokenModel = $smaregiApiTokenModel;
    }

    /**
     * @param string $contractId
     * @param string $name
     * @throws SmaregiSpecificationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return PosCategory
     */
    public function newPosCategory(string $contractId, string $name): PosCategory
    {
        /** @var SmaregiApiToken $smaregiApiToken */
        $smaregiApiToken = $this->smaregiApiTokenModel->newQuery()
            ->where('contract_id', $contractId)
            ->first();

        if ($smaregiApiToken === null) {
            throw new SmaregiSpecificationException("{$contractId} is not found");
        }

        $request = new Request(
            'POST',
            config('smaregi.sandbox.pos.host') . "/{$smaregiApiToken->getAttribute('contract_id')}/pos/categories",
            [
                'Authorization' => $smaregiApiToken->getAttribute('token_type') . ' ' . $smaregiApiToken->getAttribute('access_token'),
                'Content-type' => 'application/json',
            ],
            json_encode([
                'categoryName' => $name,
            ])
        );
        $response = $this->client->send($request);
        $params = json_decode($response->getBody()->getContents(), true);
        return new PosCategory((int)$params['categoryId'], (string)$params['categoryCode'], (string)$params['categoryName']);
    }
}
