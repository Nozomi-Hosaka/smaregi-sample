<?php
declare(strict_types=1);

namespace Smaregi\PosCategory\Models\Factory;

use Smaregi\PosCategory\Models\Entity\PosCategory;

interface PosCategoryFactoryInterface
{
    /**
     * @param string $contractId
     * @param string $name
     * @return PosCategory
     */
    public function newPosCategory(string $contractId, string $name): PosCategory;
}
