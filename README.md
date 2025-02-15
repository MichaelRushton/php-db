# PHP-DB

A PHP library to extend https://github.com/MichaelRushton/php-sql with a PDO wrapper.

## Installation
```bash
composer require michaelrushton/db
```

## Documentation

### Driver
```php
use MichaelRushton\DB\Driver;

$driver = Driver::MariaDB;
$driver = Driver::MySQL;
$driver = Driver::PostgreSQL;
$driver = Driver::SQLite;
$driver = Driver::SQLServer;
```

### Connect
```php
$connection = $driver->connect([
  "username" => "username",
  "password" => "password",
  "options" => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  ],
  // ... Driver-specific DSN key-value pairs
]);
```

### Statements
See https://github.com/MichaelRushton/php-sql.
```php
$stmt = $connection->delete();
$stmt = $connection->insert();
$stmt = $connection->replace();
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

### beginTransaction
See https://www.php.net/manual/en/pdo.begintransaction.php.
```php
$connection->beginTransaction();
```

### commit
See https://www.php.net/manual/en/pdo.commit.php.
```php
$connection->commit();
```

### rollBack
See https://www.php.net/manual/en/pdo.rollback.php.
```php
$connection->rollBack();
```

### transaction
Begins a transaction, rolls back if an exception is thrown, else commits
```php
$connection->transaction(function ()
{

  $this->insert()->into("t1")->execute();

  $id = $this->pdo->lastInsertId();

  $this->insert([$id])->into("t2")->execute();

});
```