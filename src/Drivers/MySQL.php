<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use MichaelRushton\DB\Contracts\IsDriver;

abstract class MySQL implements IsDriver
{

  public static function dsn(#[\SensitiveParameter] array $config): string
  {

    foreach ([
      "host",
      "port",
      "dbname",
      "unix_socket",
      "charset"
    ] as $key)
    {

      $config[$key] ??= "";

      $$key = $config[$key] ? "$key={$config[$key]}" : "";

    }

    $dsn = implode(";", array_filter([
      $unix_socket ?: $host,
      $unix_socket ? "" : $port,
      $dbname,
      $charset
    ]));

    return "mysql:$dsn";

  }

}