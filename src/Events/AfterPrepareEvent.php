<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Events;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use Throwable;

readonly class AfterPrepareEvent
{
    public function __construct(
        public ConnectionInterface $connection,
        public string $query,
        public bool $success,
        public int $time,
        public ?Throwable $exception
    ) {}
}
