<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Traits;

use WeakMap;

trait Cache
{

  protected static WeakMap $cache;
  protected bool $use_cache = false;

  public function cache(): static
  {

    static::$cache ??= new WeakMap;

    static::$cache[$this->pdo] ??= [];

    $this->use_cache = true;

    return $this;

  }

}