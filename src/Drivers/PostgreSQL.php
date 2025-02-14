<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use MichaelRushton\DB\Contracts\IsDriver;

abstract class PostgreSQL implements IsDriver
{

  public static function dsn(#[\SensitiveParameter] array $config): string
  {

    foreach ([
      "host",
      "port",
      "dbname",
      "sslmode"
    ] as $key)
    {

      $config[$key] ??= "";

      $$key = $config[$key] ? "$key={$config[$key]}" : "";

    }

    $dsn = implode(";", array_filter([
      $host,
      $port,
      $dbname,
      $sslmode
    ]));

    return "pgsql:$dsn";

  }

}