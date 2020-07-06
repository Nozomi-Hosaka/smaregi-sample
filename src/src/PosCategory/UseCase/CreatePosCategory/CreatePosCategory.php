<?php
declare(strict_types=1);

namespace Smaregi\PosCategory\UseCase\CreatePosCategory;

use Smaregi\PosCategory\Models\Factory\PosCategoryFactoryInterface;

class CreatePosCategory implements CreatePosCategoryInterface
{
    /**
     * @var PosCategoryFactoryInterface
     */
    private $posCategoryFactory;

    /**
     * CreatePosCategory constructor.
     *
     * @param PosCategoryFactoryInterface $posCategoryFactory
     */
    public function __construct(PosCategoryFactoryInterface $posCategoryFactory)
    {
        $this->posCategoryFactory = $posCategoryFactory;
    }

    /**
     * @param CreatePosCategoryInputPort $inputPort
     * @param CreatePosCategoryOutputPort $outputPort
     */
    public function process(CreatePosCategoryInputPort $inputPort, CreatePosCategoryOutputPort $outputPort): void
    {
        $posCategory = $this->posCategoryFactory->newPosCategory($inputPort->name());
        $outputPort->output($posCategory);
    }
}
