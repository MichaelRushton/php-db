<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\DriverInterface;
use MichaelRushton\DB\Drivers\MySQL;
use MichaelRushton\DB\Drivers\PostgreSQL;
use MichaelRushton\DB\Drivers\SQLite;
use MichaelRushton\DB\Drivers\SQLServer;
use MichaelRushton\DB\Interfaces\LazyConnectionInterface;
use MichaelRushton\SQL\Interfaces\SQLInterface;
use MichaelRushton\SQL\SQL;
use PDO;
use SensitiveParameter;

enum Driver implements DriverInterface
{
    case MariaDB;
    case MySQL;
    case PostgreSQL;
    case SQLite;
    case SQLServer;

    public function connect(
        #[SensitiveParameter] array $config = []
    ): ConnectionInterface {

        return new Connection($this, new PDO(
            $this->dsn($config),
            $config["username"] ?? null,
            $config["password"] ?? null,
            $config["options"] ?? null
        ));

    }

    public function lazyConnect(
        #[SensitiveParameter] array $config = []
    ): LazyConnectionInterface {
        return new LazyConnection($this, $config);
    }

    public function dsn(
        #[SensitiveParameter] array $config = []
    ): string {

        return match ($this) {
            static::MariaDB, static::MySQL => MySQL::dsn($config),
            static::PostgreSQL => PostgreSQL::dsn($config),
            static::SQLite => SQLite::dsn($config),
            static::SQLServer => SQLServer::dsn($config),
        };

    }

    public function sql(): SQLInterface
    {

        return match ($this) {
            static::MariaDB => SQL::MariaDB,
            static::MySQL => SQL::MySQL,
            static::PostgreSQL => SQL::PostgreSQL,
            static::SQLite => SQL::SQLite,
            static::SQLServer => SQL::TransactSQL,
        };

    }

}
