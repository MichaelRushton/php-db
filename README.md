# PHP DB

A PHP library to query a database.

## Installation

```bash
composer require michaelrushton/php-db
```

## Documentation

### Drivers

- [MariaDB](docs/drivers/mariadb.md)
- [MySQL](docs/drivers/mysql.md)
- [PostgreSQL](docs/drivers/postgresql.md)
- [SQLite](docs/drivers/sqlite.md)
- [SQL Server](docs/drivers/sqlserver.md)

### Connection

#### exec

See https://www.php.net/manual/en/pdo.exec.php.

```php
$count = $connection->exec("DELETE FROM users");
```

#### query

See https://www.php.net/manual/en/pdo.query.php.

```php
$pdo_stmt = $connection->query("SELECT * FROM users");
$pdo_stmt = $connection->query("SELECT * FROM users", $fetchMode, ...$fetchModeArgs);
```

#### prepare

See https://www.php.net/manual/en/pdo.prepare.php.

```php
$pdo_stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
$pdo_stmt = $connection->prepare("SELECT * FROM users WHERE id = ?", $options);
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
$user = $connection->fetch("SELECT * FROM users WHERE id = ?", [1], $mode, $cursorOrientation, $cursorOffset);
```

#### fetchAll

See https://www.php.net/manual/en/pdostatement.fetchall.php.

```php
$users = $connection->fetchAll("SELECT * FROM users WHERE status = ?", [1]);
$users = $connection->fetchAll("SELECT * FROM users WHERE status = ?", [1], $mode, ...$args);
```

#### fetchColumn

See https://www.php.net/manual/en/pdostatement.fetchcolumn.php

```php
$id = $connection->fetchColumn("SELECT * FROM users WHERE id = ?", [1]);
$id = $connection->fetchColumn("SELECT * FROM users WHERE id = ?", [1], $column);
```

#### fetchObject

See https://www.php.net/manual/en/pdostatement.fetchobject.php

```php
$user = $connection->fetchObject("SELECT * FROM users WHERE id = ?", [1]);
$user = $connection->fetchObject("SELECT * FROM users WHERE id = ?", [1], $class, $constructorArgs);
```

#### yield

See https://www.php.net/manual/en/pdostatement.fetch.php.

```php
$generator = $connection->yield("SELECT * FROM users WHERE status = ?", [1]);
$generator = $connection->yield("SELECT * FROM users WHERE status = ?", [1], $mode, $cursorOrientation, $cursorOffset);
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

### Query builders

- [INSERT](docs/statements/insert.md)
- [SELECT](docs/statements/select.md)
- [UPDATE](docs/statements/update.md)
- [DELETE](docs/statements/delete.md)
- [REPLACE](docs/statements/replace.md)

#### exec

```php
$count = $connection->delete()->from('users')->exec();
```

#### query

```php
$pdo_stmt = $connection->select()->from('users')->query();
$pdo_stmt = $connection->select()->from('users')->query($fetchMode, ...$fetchModeArgs);
```

#### prepare

```php
$pdo_stmt = $connection->select()->from('users')->where('id = ?')->prepare();
$pdo_stmt = $connection->select()->from('users')->where('id = ?')->prepare($options);
```

#### execute

```php
$pdo_stmt = $connection->select()->from('users')->where('id', 1)->execute();
```

#### fetch

```php
$user = $connection->select()->from('users')->where('id', 1)->fetch();
$user = $connection->select()->from('users')->where('id', 1)->fetch($mode, $cursorOrientation, $cursorOffset);
```

#### fetchAll

```php
$users = $connection->select()->from('users')->where('status', 1)->fetchAll();
$users = $connection->select()->from('users')->where('status', 1)->fetchAll($mode, ...$args);
```

#### fetchColumn

```php
$id = $connection->select()->from('users')->where('id', 1)->fetchColumn();
$id = $connection->select()->from('users')->where('id', 1)->fetchColumn($column);
```

#### fetchObject

```php
$user = $connection->select()->from('users')->where('id', 1)->fetchObject();
$user = $connection->select()->from('users')->where('id', 1)->fetchObject($class, $constructorArgs);
```

#### yield

```php
$generator = $connection->select()->from('users')->where('status', 1)->yield();
$generator = $connection->select()->from('users')->where('status', 1)->yield($mode, $cursorOrientation, $cursorOffset);
```
