<?php
declare(strict_types=1);

namespace Smaregi\PosCategory\Models\Entity;

class PosCategory
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * PosCategory constructor.
     *
     * @param int $id
     * @param string $code
     * @param string $name
     */
    public function __construct(int $id, string $code, string $name)
    {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => (int)$this->id(),
            'name' => (string)$this->name(),
            'code' => (string)$this->code(),
        ];
    }
}
