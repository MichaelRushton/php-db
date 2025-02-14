<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Traits;

use PDO;
use PDOStatement;

trait UsesPDO
{

  public function __construct(public readonly PDO $pdo) {}

  public function query(
    ?int $fetchMode = null,
    mixed ...$fetch_mode_args
  ): PDOStatement|false
  {
    return $this->pdo->query((string) $this, $fetchMode, ...$fetch_mode_args);
  }

  public function prepare(array $options = []): PDOStatement|false
  {
    return $this->pdo->prepare((string) $this, $options);
  }

  public function execute(?array $params = null): PDOStatement|false
  {

    if (!$stmt = $this->prepare())
    {
      return false;
    }

    if (!$stmt->execute($params ?? $this->bindings()))
    {
      return false;
    }

    return $stmt;

  }

  public function fetch(
    int $mode = PDO::FETCH_DEFAULT,
    int $cursorOrientation = PDO::FETCH_ORI_NEXT,
    int $cursorOffset = 0
  ): mixed
  {

    if (!$stmt = $this->execute())
    {
      return false;
    }

    return $stmt->fetch($mode, $cursorOrientation, $cursorOffset);

  }

  public function fetchAll(
    int $mode = PDO::FETCH_DEFAULT,
    mixed ...$args
  ): array|false
  {

    if (!$stmt = $this->execute())
    {
      return false;
    }

    return $stmt->fetchAll($mode, ...$args);

  }

}