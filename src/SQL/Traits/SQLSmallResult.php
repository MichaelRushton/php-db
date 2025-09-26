<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait SQLSmallResult
{
    protected string $sql_small_result = '';

    public function sqlSmallResult(): static
    {

        $this->sql_small_result = 'SQL_SMALL_RESULT';

        return $this;

    }
}
