<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use MichaelRushton\DB\Connections\SQLServerConnection;
use MichaelRushton\DB\Driver;
use MichaelRushton\DB\Interfaces\Connections\SQLServerConnectionInterface;
use MichaelRushton\DB\Interfaces\Drivers\SQLServerDriverInterface;
use SensitiveParameter;

class SQLServerDriver extends Driver implements SQLServerDriverInterface
{
    public ?string $username = 'sa';

    public ?string $Database = null;
    public ?string $AccessToken = null;
    public ?string $APP = null;
    public ?string $ApplicationIntent = null;
    public ?string $AttachDBFileName = null;
    public ?string $Authentication = null;
    public ?string $ColumnEncryption = null;
    public ?int $ConnectionPooling = null;
    public ?int $ConnectRetryCount = null;
    public ?int $ConnectRetryInterval = null;
    public ?string $Driver = null;
    public ?int $Encrypt = null;
    public ?string $Failover_Partner = null;
    public ?string $KeyStoreAuthentication = null;
    public ?string $KeyStorePrincipalId = null;
    public ?string $KeyStoreSecret = null;
    public ?string $Language = null;
    public ?string $LoginTimeout = null;
    public ?int $MultipleActiveResultSets = null;
    public ?string $MultiSubnetFailover = null;
    public ?int $QuotedId = null;
    public ?string $Scrollable = null;
    public ?string $Server = '';
    public ?string $TraceFile = null;
    public ?int $TraceOn = null;
    public ?string $TransactionIsolation = null;
    public ?string $TransparentNetworkIPResolution = null;
    public ?int $TrustServerCertificate = null;
    public ?string $WSID = null;

    public function username(?string $username): static
    {

        $this->username = $username;

        return $this;

    }

    public function password(#[SensitiveParameter] ?string $password): static
    {

        $this->password = $password;

        return $this;

    }

    public function database(?string $database): static
    {

        $this->Database = $database;

        return $this;

    }

    public function accessToken(#[SensitiveParameter] ?string $access_token): static
    {

        $this->AccessToken = $access_token;

        return $this;

    }

    public function app(?string $app): static
    {

        $this->APP = $app;

        return $this;

    }

    public function applicationIntent(?string $application_intent): static
    {

        $this->ApplicationIntent = $application_intent;

        return $this;

    }

    public function attachDBFileName(?string $attach_db_file_name): static
    {

        $this->AttachDBFileName = $attach_db_file_name;

        return $this;

    }

    public function authentication(?string $authentication): static
    {

        $this->Authentication = $authentication;

        return $this;

    }

    public function columnEncryption(?string $column_encryption): static
    {

        $this->ColumnEncryption = $column_encryption;

        return $this;

    }

    public function connectionPooling(?int $connection_pooling): static
    {

        $this->ConnectionPooling = $connection_pooling;

        return $this;

    }

    public function connectRetryCount(?int $connect_retry_count): static
    {

        $this->ConnectRetryCount = $connect_retry_count;

        return $this;

    }

    public function connectRetryInterval(?int $connect_retry_interval): static
    {

        $this->ConnectRetryInterval = $connect_retry_interval;

        return $this;

    }

    public function driver(?string $driver): static
    {

        $this->Driver = $driver;

        return $this;

    }

    public function encrypt(?int $encrypt): static
    {

        $this->Encrypt = $encrypt;

        return $this;

    }

    public function failoverPartner(?string $failover_partner): static
    {

        $this->Failover_Partner = $failover_partner;

        return $this;

    }

    public function keyStoreAuthentication(?string $key_store_authentication): static
    {

        $this->KeyStoreAuthentication = $key_store_authentication;

        return $this;

    }

    public function keyStorePrincipalId(?string $key_store_principal_id): static
    {

        $this->KeyStorePrincipalId = $key_store_principal_id;

        return $this;

    }

    public function keyStoreSecret(#[SensitiveParameter] ?string $key_store_secret): static
    {

        $this->KeyStoreSecret = $key_store_secret;

        return $this;

    }

    public function language(?string $language): static
    {

        $this->Language = $language;

        return $this;

    }

    public function loginTimeout(?string $login_timeout): static
    {

        $this->LoginTimeout = $login_timeout;

        return $this;

    }

    public function multipleActiveResultSets(?int $multiple_active_result_sets): static
    {

        $this->MultipleActiveResultSets = $multiple_active_result_sets;

        return $this;

    }

    public function multiSubnetFailover(?string $multi_subnet_failover): static
    {

        $this->MultiSubnetFailover = $multi_subnet_failover;

        return $this;

    }

    public function quotedId(?int $quoted_id): static
    {

        $this->QuotedId = $quoted_id;

        return $this;

    }

    public function scrollable(?string $scrollable): static
    {

        $this->Scrollable = $scrollable;

        return $this;

    }

    public function server(?string $server): static
    {

        $this->Server = $server;

        return $this;

    }

    public function traceFile(?string $trace_file): static
    {

        $this->TraceFile = $trace_file;

        return $this;

    }

    public function traceOn(?int $trace_on): static
    {

        $this->TraceOn = $trace_on;

        return $this;

    }

    public function transactionIsolation(?string $transaction_isolation): static
    {

        $this->TransactionIsolation = $transaction_isolation;

        return $this;

    }

    public function transparentNetworkIPResolution(?string $transparent_network_ip_resolution): static
    {

        $this->TransparentNetworkIPResolution = $transparent_network_ip_resolution;

        return $this;

    }

    public function trustServerCertificate(?int $trust_server_certificate): static
    {

        $this->TrustServerCertificate = $trust_server_certificate;

        return $this;

    }

    public function wsid(?string $wsid): static
    {

        $this->WSID = $wsid;

        return $this;

    }

    public function connection(): SQLServerConnectionInterface
    {
        return new SQLServerConnection($this);
    }

    public function dsn(): string
    {

        foreach ([
            'AccessToken',
            'APP',
            'ApplicationIntent',
            'AttachDBFileName',
            'Authentication',
            'ColumnEncryption',
            'ConnectionPooling',
            'ConnectRetryCount',
            'ConnectRetryInterval',
            'Database',
            'Driver',
            'Encrypt',
            'Failover_Partner',
            'KeyStoreAuthentication',
            'KeyStorePrincipalId',
            'KeyStoreSecret',
            'Language',
            'LoginTimeout',
            'MultipleActiveResultSets',
            'MultiSubnetFailover',
            'QuotedId',
            'Scrollable',
            'Server',
            'TraceFile',
            'TraceOn',
            'TransactionIsolation',
            'TransparentNetworkIPResolution',
            'TrustServerCertificate',
            'WSID',
        ] as $key) {

            if (isset($this->$key)) {
                $dsn[] = "$key={$this->$key}";
            }

        }

        return 'sqlsrv:' . implode(';', $dsn);

    }
}
