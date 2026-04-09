<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Events;

use MichaelRushton\DB\Interfaces\ConnectionInterface;

readonly class BeforeExecuteEvent
{
    public function __construct(
        public ConnectionInterface $connection,
        public string $query,
        public array $params = []
    ) {
    }

}
