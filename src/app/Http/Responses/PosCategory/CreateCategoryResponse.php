<?php
declare(strict_types=1);

namespace App\Http\Responses\PosCategory;

use Smaregi\PosCategory\Models\Entity\PosCategory;
use Smaregi\PosCategory\UseCase\CreatePosCategory\CreatePosCategoryOutputPort;

class CreateCategoryResponse implements CreatePosCategoryOutputPort
{
    /**
     * @var PosCategory
     */
    private $posCategory;

    public function output(PosCategory $posCategory): void
    {
        $this->posCategory = $posCategory;
    }

    /**
     * @return PosCategory
     */
    public function posCategory(): PosCategory
    {
        return $this->posCategory;
    }
}
