<?php
declare(strict_types=1);

namespace Smaregi\PosCategory\UseCase\CreatePosCategory;

interface CreatePosCategoryInputPort
{
    /**
     * @return string
     */
    public function contractId(): string;

    /**
     * @return string
     */
    public function name(): string;
}
