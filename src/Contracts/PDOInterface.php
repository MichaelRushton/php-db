<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Contracts;

use PDO;
use PDOStatement;

interface PDOInterface
{

  public function query(
    ?int $fetchMode = null,
    mixed ...$fetch_mode_args
  ): PDOStatement|false;

  public function prepare(array $options = []): PDOStatement|false;

  public function execute(?array $params = null): PDOStatement|false;

  public function fetch(
    int $mode = PDO::FETCH_DEFAULT,
    int $cursorOrientation = PDO::FETCH_ORI_NEXT,
    int $cursorOffset = 0
  ): mixed;

  public function fetchAll(
    int $mode = PDO::FETCH_DEFAULT,
    mixed ...$args
  ): array|false;

}