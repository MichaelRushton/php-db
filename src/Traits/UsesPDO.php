<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Traits;

use PDO;
use PDOStatement;

trait UsesPDO
{

  protected static array $cache = [];
  protected ?string $cache_key = null;

  public function __construct(public readonly PDO $pdo) {}

  public function cache(): static
  {

    $called_by = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

    $this->cache_key = $called_by["file"] . $called_by["line"];

    return $this;

  }

  public function query(
    ?int $fetchMode = null,
    mixed ...$fetch_mode_args
  ): PDOStatement|false
  {
    return $this->pdo->query("$this", $fetchMode, ...$fetch_mode_args);
  }

  public function prepare(array $options = []): PDOStatement|false
  {

    $stmt = "$this";

    $prepare = fn () => $this->pdo->prepare($stmt, $options);

    return $this->cache_key ? static::$cache[$this->cache_key] ??= $prepare() : $prepare();

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