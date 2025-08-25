<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces;

interface LazyConnectionInterface extends ConnectionInterface
{
    public function connection(): ConnectionInterface;
}
