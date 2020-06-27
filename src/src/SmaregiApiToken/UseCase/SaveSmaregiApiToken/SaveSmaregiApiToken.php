<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\UseCase\SaveSmaregiApiToken;

use Smaregi\Exceptions\SmaregiSpecificationException;
use Smaregi\SmaregiApiClient\Client\Client;
use Smaregi\SmaregiApiClient\Client\Exceptions\UnauthorizedException;
use Smaregi\SmaregiApiClient\Client\GetToken\GetTokenRequest;
use Smaregi\SmaregiApiToken\Models\Factory\SmaregiApiTokenFactoryInterface;
use Smaregi\SmaregiApiToken\Models\Repository\SmaregiApiTokenRepositoryInterface;
use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;
use Throwable;

class SaveSmaregiApiToken implements SaveSmaregiApiTokenInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var SmaregiApiTokenFactoryInterface
     */
    private $smaregiApiTokenFactory;

    /**
     * @var SmaregiApiTokenRepositoryInterface
     */
    private $smaregiApiTokenRepository;

    /**
     * SaveSmaregiApiToken constructor.
     *
     * @param Client $client
     * @param SmaregiApiTokenFactoryInterface $smaregiApiTokenFactory
     * @param SmaregiApiTokenRepositoryInterface $smaregiApiTokenRepository
     */
    public function __construct(
        Client $client,
        SmaregiApiTokenFactoryInterface $smaregiApiTokenFactory,
        SmaregiApiTokenRepositoryInterface $smaregiApiTokenRepository
    ) {
        $this->client = $client;
        $this->smaregiApiTokenFactory = $smaregiApiTokenFactory;
        $this->smaregiApiTokenRepository = $smaregiApiTokenRepository;
    }

    /**
     * @param SaveSmaregiApiTokenInputPort $inputPort
     * @param SaveSmaregiApiTokenOutputPort $outputPort
     * @throws SmaregiSpecificationException
     */
    public function process(
        SaveSmaregiApiTokenInputPort $inputPort,
        SaveSmaregiApiTokenOutputPort $outputPort
    ): void {
        $contractId = new ContractId($inputPort->contractId());

        try {
            $response = $this->client->getApiToken(new GetTokenRequest((string) $contractId));
            $tokenType = $response->params()->tokenType();
            $accessToken = $response->params()->accessToken();
        } catch (UnauthorizedException $e) {
            throw new SmaregiSpecificationException('この契約IDにはアクセスできません。', $e->getCode(), $e);
        } catch (Throwable $e) {
            throw new SmaregiSpecificationException('アクセストークンを取得できませんでした。', $e->getCode(), $e);
        }

        $smaregiApiToken = $this->smaregiApiTokenRepository->findByContractId($contractId);

        if ($smaregiApiToken === null) {
            $smaregiApiToken = $this->smaregiApiTokenFactory->newToken($contractId, $tokenType, $accessToken);
        } else {
            $smaregiApiToken->setTokenType($tokenType);
            $smaregiApiToken->setAccessToken($accessToken);
        }

        try {
            $smaregiApiToken = $this->smaregiApiTokenRepository->save($smaregiApiToken);
        } catch (Throwable $e) {
            throw new SmaregiSpecificationException('サーバーエラーが発生しました。', 500, $e);
        }

        $outputPort->output($smaregiApiToken);
    }
}
