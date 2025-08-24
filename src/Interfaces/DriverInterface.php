<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces;

use MichaelRushton\SQL\Interfaces\SQLInterface;

interface DriverInterface
{
    public function connect(array $config = []): ConnectionInterface;

    public function sql(): SQLInterface;

}
