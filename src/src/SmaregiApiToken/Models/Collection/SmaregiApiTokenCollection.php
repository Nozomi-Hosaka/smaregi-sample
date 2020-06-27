<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiToken\Models\Collection;

use InvalidArgumentException;
use Smaregi\Foundation\Collection;
use Smaregi\SmaregiApiToken\Models\Entity\SmaregiApiToken;
use Smaregi\SmaregiApiToken\Models\ValueObject\ContractId;

class SmaregiApiTokenCollection extends Collection
{
    /**
     * SmaregiApiTokenCollection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        /** @var SmaregiApiToken $item */
        foreach ($this->items as $item) {
            $array[] = $item->toArray();
        }
        return $array;
    }

    /**
     * @param array $items
     * @return static
     */
    public static function fromArray(array $items): self
    {
        $collection = [];
        foreach ($items as $item) {
            $collection[] = new SmaregiApiToken(
                (string) $item['id'],
                new ContractId((string) $item['contract_id']),
                (string) $item['token_type'],
                (string) $item['access_token']
            );
        }
        return new self($collection);
    }

    protected function validate(): void
    {
        foreach ($this->items as $item) {
            if (!$item instanceof SmaregiApiToken) {
                throw new InvalidArgumentException('SmaregiApiTokenCollection must be SmaregiApiToken type.');
            }
        }
    }
}
