<?php
declare(strict_types=1);

namespace Smaregi\SmaregiApiClient\Client\GetToken;

use InvalidArgumentException;

final class GetTokenParams
{
    /**
     * @var array
     */
    private $params;

    /**
     * GetTokenParams constructor.
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        self::validate($params);
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function tokenType(): string
    {
        return (string) $this->params['token_type'];
    }

    /**
     * @return int
     */
    public function expiresIn(): int
    {
        return (int) $this->params['expires_in'];
    }

    /**
     * @return string
     */
    public function accessToken(): string
    {
        return (string) $this->params['access_token'];
    }

    /**
     * @param array $params
     * @return static
     */
    public static function fromArray(array $params): self
    {
        return new self($params);
    }

    public static function validate($params): void
    {
        if (!is_array($params)) {
            throw new InvalidArgumentException('Client params must be array.');
        }
    }
}
