# PHP-DB

A PHP library to extend https://github.com/MichaelRushton/php-sql with a PDO wrapper.

## Installation

```bash
composer require michaelrushton/db
```

## Documentation

### Connecting to a database

#### The configuration

```php
$config = [
  "username" => $username,
  "password" => $password,
  "options" => [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ],
  // ... Driver-specific DSN options
]);
```

#### MariaDB

See https://www.php.net/manual/en/ref.pdo-mysql.connection.php

```php
use MichaelRushton\DB\Driver;

$connection = Driver::MariaDB->connect($config);
```

#### MySQL

See https://www.php.net/manual/en/ref.pdo-mysql.connection.php

```php
use MichaelRushton\DB\Driver;

$connection = Driver::MySQL->connect($config);
```

#### PostgreSQL

https://www.php.net/manual/en/ref.pdo-pgsql.connection.php

```php
use MichaelRushton\DB\Driver;

$connection = Driver::PostgreSQL->connect($config);
```

#### SQLite

https://www.php.net/manual/en/ref.pdo-sqlite.connection.php

```php
use MichaelRushton\DB\Driver;

$connection = Driver::SQLite->connect($config);
```

#### SQLServer

https://www.php.net/manual/en/ref.pdo-sqlsrv.connection.php

```php
use MichaelRushton\DB\Driver;

$connection = Driver::SQLServer->connect($config);
```

#### Lazily connect to a database

A lazy connection will only connect to the database when first needed

```php
$connection = Driver::SQLite->lazyConnect($config); // Not connected

$connection->query("SELECT * FROM users"); // Connected
```

### Querying the database

#### exec

See https://www.php.net/manual/en/pdo.exec.php.

```php
$count = $connection->exec("UPDATE users SET active = 1");
```

#### query

See https://www.php.net/manual/en/pdo.query.php.

```php
$pdo_stmt = $connection->query("SELECT * FROM users");
$pdo_stmt = $connection->query("SELECT * FROM users", $fetchMode, ...$args);
```

#### prepare

See https://www.php.net/manual/en/pdo.prepare.php.

```php
$pdo_stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
```

#### execute

See https://www.php.net/manual/en/pdostatement.execute.php.

```php
$pdo_stmt = $connection->execute("SELECT * FROM users WHERE id = ?", [1]);
```

#### fetch

See https://www.php.net/manual/en/pdostatement.fetch.php.

```php
$user = $connection->fetch("SELECT * FROM users WHERE id = ?", [1]);
$user = $connection->fetch("SELECT * FROM users WHERE id = ?", [1], $mode);
```

#### fetchAll

See https://www.php.net/manual/en/pdostatement.fetchall.php.

```php
$users = $connection->fetchAll("SELECT * FROM users WHERE active = ?", [1]);
$users = $connection->fetchAll("SELECT * FROM users WHERE active = ?", [1], $mode, ...$args);
```

#### fetchColumn

See https://www.php.net/manual/en/pdostatement.fetchcolumn.php

```php
$id = $connection->fetchColumn("SELECT * FROM users WHERE active = ?", [1]);
$id = $connection->fetchColumn("SELECT * FROM users WHERE active = ?", [1], $column);
```

#### fetchObject

See https://www.php.net/manual/en/pdostatement.fetchobject.php

```php
$user = $connection->fetchObject("SELECT * FROM users WHERE active = ?", [1]);
$user = $connection->fetchObject("SELECT * FROM users WHERE active = ?", [1], $class, $constructorArgs);
```

#### transaction

Begins a transaction, rolls back if an exception is thrown (rethrowing the exception), else commits.

```php
use MichaelRushton\DB\Connection;

$connection->transaction(function (Connection $connection)
{
  $connection->query("INSERT INTO users (id) VALUES (1)");
  $connection->query("INSERT INTO users (id) VALUES (2)");
});
```

#### Caching prepared statements

To cache and/or re-use a prepared statement, call the `cache` method passing an optional string or integer key (if no key is provided then a hash of the query will be used as the key). This will only apply to the next `prepare`/`execute`/`fetch*` call.

```php
$connection->cache()->fetchAll("SELECT * FROM users"); // Prepares and caches the statement
$connection->cache()->fetchAll("SELECT * FROM users"); // Re-uses the cached statement
$connection->cache()->fetchAll("SELECT * FROM users"); // Re-uses the cached statement
$connection->fetchAll("SELECT * FROM users"); // Prepares the statement
```

A `cached` method is also provided as a shorthand for `->cache($key)->prepare($stmt)`.

```php
$connection->cache($key)->prepare($stmt);
$connection->cached($stmt, $key); // Equivalent to the above
```

### Using the query builder

See https://github.com/MichaelRushton/php-sql for documentation on the query builder APIs.

```php
$delete = $connection->delete();
$insert = $connection->insert();
$select = $connection->select();
$update = $connection->update();

// MariaDB, MySQL, and SQLite only
$replace = $connection->replace();
```

#### exec

```php
$count = $connection->insert()
->into("users")
->exec();
```

#### query

```php
$pdo_stmt = $connection->select()
->from("users")
->query();
```

#### prepare

```php
$pdo_stmt = $connection->select()
->from("users")
->where("id = ?")
->prepare();
```

#### execute

```php
$pdo_stmt = $connection->select()
->from("users")
->where("id", 1)
->execute();
```

#### fetch

```php
$user = $connection->select()
->from("users")
->where("id", 1)
->fetch();
```

#### fetchAll

```php
$users = $connection->select()
->from("users")
->fetchAll();
```

#### fetchColumn

```php
$id = $connection->select()
->from("users")
->where("id", 1)
->fetchColumn();
```

#### fetchObject

```php
$user = $connection->select()
->from("users")
->where("id", 1)
->fetchObject();
```

#### Caching prepared statements

To cache and/or re-use a prepared statement, call the `cache` method passing an optional string or integer key (if no key is provided then a hash of the query will be used as the key). Note that unlike `Connection::cache` above, this will persist for all subsequent `prepare`/`execute`/`fetch*` calls.

```php
foreach ($users as $user)
{

  $connection->delete()
  ->from("users")
  ->where("id", $user->id)
  ->cache() // Ensures that the statement is only prepared once
  ->execute();

}
```
