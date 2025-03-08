<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use MichaelRushton\DB\Contracts\IsDriver;

abstract class SQLServer implements IsDriver
{

  public static function dsn(#[\SensitiveParameter] array $config): string
  {

    foreach ([
      "Server",
      "Database",
      "APP",
      "ConnectionPooling",
      "Encrypt",
      "Failover_Partner",
      "LoginTimeout",
      "MultipleActiveResultSets",
      "QuotedId",
      "TraceFile",
      "TraceOn",
      "TransactionIsolation",
      "TrustServerCertificate",
      "WSID",
    ] as $key)
    {

      $config[$key] ??= "";

      $$key = $config[$key] ? "$key={$config[$key]}" : "";

    }

    $dsn = implode(";", array_filter([
      $Server,
      $Database,
      $APP,
      $ConnectionPooling,
      $Encrypt,
      $Failover_Partner,
      $LoginTimeout,
      $MultipleActiveResultSets,
      $QuotedId,
      $TraceFile,
      $TraceOn,
      $TransactionIsolation,
      $TrustServerCertificate,
      $WSID,
    ]));

    return "sqlsrv:$dsn";

  }

}