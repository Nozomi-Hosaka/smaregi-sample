<?php

declare(strict_types=1);

namespace Smaregi\SmaregiApiClient\Foundation\Json;

final class Decoder
{
    /**
     * @param string $json JSON文字列
     * @param bool $assoc
     * @throws \JsonException
     * @return mixed
     */
    public static function decode($json, $assoc = false)
    {
        return json_decode($json, $assoc, 512, JSON_THROW_ON_ERROR);
    }
}
