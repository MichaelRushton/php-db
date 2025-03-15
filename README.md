# PHP-DB

A PHP library to extend https://github.com/MichaelRushton/php-sql with a PDO wrapper.

## Installation
```bash
composer require michaelrushton/db
```

## Documentation

### MariaDB
See https://www.php.net/manual/en/ref.pdo-mysql.connection.php.
```php
use MichaelRushton\DB\Driver;

$connection = Driver::MariaDB->connect([
  "username" => $username,
  "password" => $password,
  "host" => $host,
  "port" => $port,
  "dbname" => $dbname,
  "unix_socket" => $unix_socket,
  "charset" => $charset,
  "options" => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ],
]);
```

### MySQL
See https://www.php.net/manual/en/ref.pdo-mysql.connection.php.
```php
use MichaelRushton\DB\Driver;

$connection = Driver::MySQL->connect([
  "username" => $username,
  "password" => $password,
  "host" => $host,
  "port" => $port,
  "dbname" => $dbname,
  "unix_socket" => $unix_socket,
  "charset" => $charset,
  "options" => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ],
]);
```

### PostgreSQL
See https://www.php.net/manual/en/ref.pdo-pgsql.connection.php.
```php
use MichaelRushton\DB\Driver;

$connection = Driver::PostgreSQL->connect([
  "username" => $username,
  "password" => $password,
  "host" => $host,
  "port" => $port,
  "dbname" => $dbname,
  "sslmode" => $sslmode,
  "options" => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ],
]);
```

### SQLite
See https://www.php.net/manual/en/ref.pdo-sqlite.connection.php.
```php
use MichaelRushton\DB\Driver;

$connection = Driver::SQLite->connect([
  "database" => $database,
  "options" => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ],
]);
```

### SQLServer
See https://www.php.net/manual/en/ref.pdo-sqlsrv.connection.php.
```php
use MichaelRushton\DB\Driver;

$connection = Driver::SQLServer->connect([
  "username" => $username,
  "password" => $password,
  "Server" => $server,
  "Database" => $database,
  "APP" => $app,
  "ConnectionPooling" => $connection_pooling,
  "Encrypt" => $encrypt,
  "Failover_Partner" => $failover_partner,
  "LoginTimeout" => $login_timeout,
  "MultipleActiveResultSets" => $multiple_active_result_sets,
  "QuotedId" => $quote_id,
  "TraceFile" => $trace_file,
  "TraceOn" => $trace_on,
  "TransactionIsolation" => $transaction_isolation,
  "TrustServerCertificate" => $trust_server_certificate,
  "WSID" => $wsid,
  "options" => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ],
]);
```

### Statements
See https://github.com/MichaelRushton/php-sql.
```php
$stmt = $connection->delete();
$stmt = $connection->insert();
$stmt = $connection->replace(); // MariaDB, MySQL, and SQLite only
$stmt = $connection->select();
$stmt = $connection->update();
```

### query
See https://www.php.net/manual/en/pdo.query.php.
```php
$stmt->query();
$stmt->query($fetchMode);
$stmt->query(PDO::FETCH_COLUMN, $colno);
```

### prepare
See https://www.php.net/manual/en/pdo.prepare.php.
```php
$stmt->prepare();
$stmt->prepare($options);
```

### execute
See https://www.php.net/manual/en/pdostatement.execute.php.
```php
$stmt->execute();
$stmt->execute($params);
```

### fetch
See https://www.php.net/manual/en/pdostatement.fetch.php.
```php
$stmt->fetch();
$stmt->fetch($mode, $cursorOrientation, $cursorOffset);
```

### fetchAll
See https://www.php.net/manual/en/pdostatement.fetchall.php.
```php
$stmt->fetchAll();
$stmt->fetchAll($mode);
$stmt->fetchAll(PDO::FETCH_COLUMN, $column);
$stmt->fetchAll(PDO::FETCH_CLASS, $class, $constructorArgs);
$stmt->fetchAll(PDO::FETCH_FUNC, $callback);
```

### transaction
Begins a transaction, rolls back if an exception is thrown (rethrowing the exception), else commits.
```php
$connection->transaction(function ()
{

  $this->insert()->into("t1")->execute();

  $id = $this->pdo->lastInsertId();

  $this->insert([$id])->into("t2")->execute();

});
```

### cache
Caches and reuses a prepared statement.
```php
foreach ($ids as $id)
{

  $connection->insert([
    "username" => "test$id",
  ])
  ->into("t1")
  ->cache()
  ->execute();

}
```

### Lazy connect
A lazy connection will only open a PDO connection when it is first used.
```php
$connection = Driver::SQLite->lazyConnect($config); // Not connected

$connection->select(); // Connected
```

### ConnectionRepository

The `ConnectionRepository` object can be used to store and retrieve connections.

```php
use MichaelRushton\DB\ConnectionRepository;
use MichaelRushton\DB\Driver;

$repository = new ConnectionRepository;

$repository->add(Driver::SQLite::connect(["database" => "db1.sql"]));
$repository->add(Driver::SQLite::connect(["database" => "db2.sql"]), "mirror");

$connection1 = $repository->get();
$connection2 = $repository->get("mirror");

$connections = $repository->connections();

$repository->remove();
$repository->remove("mirror");
```