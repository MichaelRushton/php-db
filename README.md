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

$db = Driver::MariaDB->connect([
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

$db = Driver::MySQL->connect([
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

$db = Driver::PostgreSQL->connect([
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

$db = Driver::SQLite->connect([
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

$db = Driver::SQLServer->connect([
  "username" => $username,
  "password" => $password,
  "Server" => $server,
  "Database" => $database,
  "APP" => $app,
  "ConnectionPooling" => $db_pooling,
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
$stmt = $db->delete();
$stmt = $db->insert();
$stmt = $db->replace(); // MariaDB, MySQL, and SQLite only
$stmt = $db->select();
$stmt = $db->update();
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
$db->transaction(function ()
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

  $db->insert([
    "username" => "test$id",
  ])
  ->into("t1")
  ->cache()
  ->execute();

}
```