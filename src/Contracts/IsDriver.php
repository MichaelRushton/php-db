<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Contracts;

interface IsDriver
{
  public static function dsn(#[\SensitiveParameter] array $config): string;
}