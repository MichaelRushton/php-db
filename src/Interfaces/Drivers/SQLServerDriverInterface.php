<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\Drivers;

use MichaelRushton\DB\Interfaces\Connections\SQLServerConnectionInterface;
use MichaelRushton\DB\Interfaces\DriverInterface;

interface SQLServerDriverInterface extends DriverInterface
{
    public function username(?string $username): static;

    public function password(?string $password): static;

    public function database(?string $database): static;

    public function accessToken(?string $access_token): static;

    public function app(?string $app): static;

    public function applicationIntent(?string $application_intent): static;

    public function attachDBFileName(?string $attach_db_file_name): static;

    public function authentication(?string $authentication): static;

    public function columnEncryption(?string $column_encryption): static;

    public function connectionPooling(?int $connection_pooling): static;

    public function connectRetryCount(?int $connect_retry_count): static;

    public function connectRetryInterval(?int $connect_retry_interval): static;

    public function driver(?string $driver): static;

    public function encrypt(?int $encrypt): static;

    public function failoverPartner(?string $failover_partner): static;

    public function keyStoreAuthentication(?string $key_store_authentication): static;

    public function keyStorePrincipalId(?string $key_store_principal_id): static;

    public function keyStoreSecret(?string $key_store_secret): static;

    public function language(?string $language): static;

    public function loginTimeout(?string $login_timeout): static;

    public function multipleActiveResultSets(?int $multiple_active_result_sets): static;

    public function multiSubnetFailover(?string $multi_subnet_failover): static;

    public function quotedId(?int $quoted_id): static;

    public function scrollable(?string $scrollable): static;

    public function server(?string $server): static;

    public function traceFile(?string $trace_file): static;

    public function traceOn(?int $trace_on): static;

    public function transactionIsolation(?string $transaction_isolation): static;

    public function transparentNetworkIPResolution(?string $transparent_network_ip_resolution): static;

    public function trustServerCertificate(?int $trust_server_certificate): static;

    public function wsid(?string $wsid): static;

    public function connection(): SQLServerConnectionInterface;
}
