## MariaDB Driver

#### Lazily connect to a MariaDB database

```php
use MichaelRushton\DB\Drivers\MariaDBDriver;

$driver = new MariaDBDriver([
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$connection = $driver->connection();
```

#### Settings

```php
$driver->username($username);
$driver->password($password);
$driver->database($database);
$driver->host($host);
$driver->port($port);
$driver->unixSocket($unix_socket);
$driver->charset($charset);
```
