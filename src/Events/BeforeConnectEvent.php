<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Events;

use MichaelRushton\DB\Interfaces\ConnectionInterface;

readonly class BeforeConnectEvent
{
    public function __construct(public ConnectionInterface $connection)
    {
    }
}
