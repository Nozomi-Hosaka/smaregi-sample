<?php
declare(strict_types=1);

namespace Smaregi\PosCategory\UseCase\CreatePosCategory;

interface CreatePosCategoryInterface
{
    /**
     * @param CreatePosCategoryInputPort $inputPort
     * @param CreatePosCategoryOutputPort $outputPort
     */
    public function process(CreatePosCategoryInputPort $inputPort, CreatePosCategoryOutputPort $outputPort): void;
}
