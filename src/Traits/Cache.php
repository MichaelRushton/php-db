<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Traits;

trait Cache
{
    protected bool $use_cache = false;
    protected string|int|null $cache_key = null;

    public function cache(string|int|null $key = null): static
    {

        $this->use_cache = true;

        $this->cache_key = $key;

        return $this;

    }
}
