<?php

declare(strict_types=1);

class Test
{

  public $id;
  public $c1;

  public function __construct($num = 0)
  {
    $this->id += $num;
  }

}

function createTestTable(PDO $pdo): void
{

  $pdo->query("DROP TABLE IF EXISTS test");

  $pdo->query("CREATE TABLE test (id INTEGER PRIMARY KEY, c1 TEXT DEFAULT '')");

}