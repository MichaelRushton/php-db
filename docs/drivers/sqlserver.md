## SQLServer Driver

#### Lazily connect to an SQLServer database

```php
use MichaelRushton\DB\Drivers\SQLServerDriver;

$driver = new SQLServerDriver([
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$connection = $driver->connection();
```

#### Settings

```php
$driver->accessToken($access_token);
$driver->app($app);
$driver->applicationIntent($application_intent);
$driver->attachDBFileName($attach_db_file_name);
$driver->authentication($authentication);
$driver->columnEncryption($column_encryption);
$driver->connectionPooling($connection_pooling);
$driver->connectRetryCount($connect_retry_count);
$driver->connectRetryInterval($connect_retry_interval);
$driver->driver($driver);
$driver->encrypt($encrypt);
$driver->failoverPartner($failover_partner);
$driver->keyStoreAuthentication($key_store_authentication);
$driver->keyStorePrincipalId($key_store_principal_id);
$driver->keyStoreSecret($key_store_secret);
$driver->language($language);
$driver->loginTimeout($login_timeout);
$driver->multipleActiveResultSets($multiple_active_result_sets);
$driver->multiSubnetFailover($multi_subnet_failover);
$driver->quotedId($quoted_id);
$driver->scrollable($scrollable);
$driver->server($server);
$driver->traceFile($trace_file);
$driver->traceOn($trace_on);
$driver->transactionIsolation($transaction_isolation);
$driver->transparentNetworkIPResolution($transparent_network_ip_resolution);
$driver->trustServerCertificate($trust_server_certificate);
$driver->wsid($wsid);
```
