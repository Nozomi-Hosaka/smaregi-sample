<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Query\GetSmaregiApiToken;

use Smaregi\SmaregiApiToken\Models\ReadModel\SmaregiApiTokenReadModelInterface;

class GetSmaregiApiToken implements GetSmaregiApiTokenInterface
{
    /**
     * @var SmaregiApiTokenReadModelInterface
     */
    private $smaregiApiTokenRepository;

    /**
     * GetSmaregiApiToken constructor.
     *
     * @param SmaregiApiTokenReadModelInterface $smaregiApiTokenRepository
     */
    public function __construct(SmaregiApiTokenReadModelInterface $smaregiApiTokenRepository)
    {
        $this->smaregiApiTokenRepository = $smaregiApiTokenRepository;
    }

    /**
     * @param GetSmaregiApiTokenInputPort $inputPort
     * @param GetSmaregiApiTokenOutputPort $outputPort
     */
    public function process(GetSmaregiApiTokenInputPort $inputPort, GetSmaregiApiTokenOutputPort $outputPort): void
    {
        $smaregiApiTokens = $this->smaregiApiTokenRepository->findAll();
        $outputPort->output($smaregiApiTokens);
    }
}
