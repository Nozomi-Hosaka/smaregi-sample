<?php
declare(strict_types=1);

namespace Smaregi\PosCategory\UseCase\CreatePosCategory;

use Smaregi\PosCategory\Models\Entity\PosCategory;

interface CreatePosCategoryOutputPort
{
    /**
     * @param PosCategory $posCategory
     */
    public function output(PosCategory $posCategory): void;
}
