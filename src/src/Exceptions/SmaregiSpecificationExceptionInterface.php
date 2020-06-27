<?php
declare(strict_types=1);

namespace Smaregi\Exceptions;

use Throwable;

interface SmaregiSpecificationExceptionInterface extends Throwable
{
    /**
     * SmaregiSpecificationException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 500, Throwable $previous = null);
}
