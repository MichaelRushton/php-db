<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Events;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use Throwable;

readonly class AfterExecuteEvent
{
    public function __construct(
        public ConnectionInterface $connection,
        public string $query,
        public bool $success,
        public int $time,
        public ?Throwable $exception,
        public array $params = []
    ) {
    }
}
