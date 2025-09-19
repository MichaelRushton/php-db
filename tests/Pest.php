<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\SQLiteConnection;
use MichaelRushton\DB\Drivers\SQLiteDriver;

class Get
{
    public static function connection(): SQLiteConnection
    {
        return new SQLiteConnection(new SQLiteDriver());
    }
}
