<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use MichaelRushton\DB\Contracts\IsDriver;

abstract class SQLite implements IsDriver
{

  public static function dsn(#[\SensitiveParameter] array $config): string
  {

    $database = $config["database"] ?? "";

    return "sqlite:$database";

  }

}