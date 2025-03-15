<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use MichaelRushton\DB\Contracts\ConnectionInterface;
use MichaelRushton\DB\Contracts\ConnectionRepositoryInterface;

class ConnectionRepository implements ConnectionRepositoryInterface
{

  protected array $connections = [];

  public function add(
    ConnectionInterface $connection,
    ?string $key = null
  ): static
  {

    $this->connections["$key"] = $connection;

    return $this;

  }

  public function connections(): array
  {
    return $this->connections;
  }

  public function get(?string $key = null): ?ConnectionInterface
  {
    return $this->connections["$key"] ?? null;
  }

  public function remove(?string $key = null): static
  {

    unset($this->connections["$key"]);

    return $this;

  }

}