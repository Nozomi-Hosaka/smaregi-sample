<?php
declare(strict_types=1);

namespace Smaregi\Exceptions;

use Exception;
use Throwable;

class SmaregiSpecificationException extends Exception implements SmaregiSpecificationExceptionInterface
{
    /**
     * SmaregiSpecificationException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
