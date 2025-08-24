<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use SensitiveParameter;

abstract class SQLite
{
    public static function dsn(#[SensitiveParameter] array $config = []): string
    {

        $database = $config["database"] ?? "";

        return "sqlite:$database";

    }

}
