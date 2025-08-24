<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use SensitiveParameter;

abstract class SQLServer
{
    public static function dsn(#[SensitiveParameter] array $config = []): string
    {

        foreach ([
          "Server",
          "Database",
          "AccessToken",
          "APP",
          "ApplicationIntent",
          "AttachDBFileName",
          "Authentication",
          "ColumnEncryption",
          "ConnectionPooling",
          "ConnectRetryCount",
          "ConnectRetryInterval",
          "Driver",
          "Encrypt",
          "Failover_Partner",
          "KeyStoreAuthentication",
          "KeyStorePrincipalId",
          "KeyStoreSecret",
          "Language",
          "LoginTimeout",
          "MultipleActiveResultSets",
          "MultiSubnetFailover",
          "QuotedId",
          "Scrollable",
          "TraceFile",
          "TraceOn",
          "TransactionIsolation",
          "TransparentNetworkIPResolution",
          "TrustServerCertificate",
          "WSID",
        ] as $key) {

            $config[$key] ??= "";

            $$key = $config[$key] ? "$key={$config[$key]}" : "";

        }

        $dsn = implode(";", array_filter([
          $Server,
          $Database,
          $AccessToken,
          $APP,
          $ApplicationIntent,
          $AttachDBFileName,
          $Authentication,
          $ColumnEncryption,
          $ConnectionPooling,
          $ConnectRetryCount,
          $ConnectRetryInterval,
          $Driver,
          $Encrypt,
          $Failover_Partner,
          $KeyStoreAuthentication,
          $KeyStorePrincipalId,
          $KeyStoreSecret,
          $Language,
          $LoginTimeout,
          $MultipleActiveResultSets,
          $MultiSubnetFailover,
          $QuotedId,
          $Scrollable,
          $TraceFile,
          $TraceOn,
          $TransactionIsolation,
          $TransparentNetworkIPResolution,
          $TrustServerCertificate,
          $WSID,
        ]));

        return "sqlsrv:$dsn";

    }

}
