<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Contracts;

interface ConnectionRepositoryInterface
{

  public function add(
    ConnectionInterface $connection,
    ?string $key = null
  ): static;

  public function connections(): array;

  public function get(?string $key = null): ?ConnectionInterface;

  public function remove(?string $key = null): static;

}