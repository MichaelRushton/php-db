<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Contracts;

use MichaelRushton\SQL\Contracts\SQLInterface;

interface DriverInterface
{

  public function connect(array $config = []): ConnectionInterface;

  public function sql(): SQLInterface;

}