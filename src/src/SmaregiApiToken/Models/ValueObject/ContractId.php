<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Models\ValueObject;

use InvalidArgumentException;

class ContractId
{
    /**
     * @var string
     */
    private $contractId;

    /**
     * ContractId constructor.
     *
     * @param string $contractId
     */
    public function __construct(string $contractId)
    {
        $this->validate($contractId);
        $this->contractId = $contractId;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->contractId;
    }

    /**
     * @param string $contractId
     */
    public function validate(string $contractId): void
    {
        if (mb_strlen($contractId) === 0) {
            throw new InvalidArgumentException('契約IDは必須です。');
        }
    }
}
