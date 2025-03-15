<?php

declare(strict_types=1);

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\ConnectionRepository;
use MichaelRushton\DB\Driver;

$pdo = new PDO("sqlite:");

test("add and get", function () use ($pdo)
{

  $connection1 = new Connection(Driver::SQLite, $pdo);
  $connection2 = new Connection(Driver::SQLite, $pdo);

  $repository = new ConnectionRepository;

  expect($repository->add($connection1))
  ->toBe($repository);

  $repository->add($connection2, "mirror");

  expect($repository->get())
  ->toBe($connection1);

  expect($repository->get("mirror"))
  ->toBe($connection2);

});

test("connections", function () use ($pdo)
{

  $connection1 = new Connection(Driver::SQLite, $pdo);
  $connection2 = new Connection(Driver::SQLite, $pdo);

  $repository = new ConnectionRepository;

  $repository->add($connection1);
  $repository->add($connection2, "mirror");

  expect($repository->connections())
  ->toBe([
    "" => $connection1,
    "mirror" => $connection2,
  ]);

});

test("remove", function () use ($pdo)
{

  $connection = new Connection(Driver::SQLite, $pdo);

  $repository = new ConnectionRepository;

  $repository->add($connection);
  $repository->add($connection, "mirror");

  expect($repository->remove())
  ->toBe($repository);

  expect($repository->get())
  ->toBeNull();

  expect($repository->get("mirror"))
  ->toBe($connection);

  $repository->remove("mirror");

  expect($repository->get("mirror"))
  ->toBeNull();

});