<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait SQLBufferResult
{
    protected string $sql_buffer_result = '';

    public function sqlBufferResult(): static
    {

        $this->sql_buffer_result = 'SQL_BUFFER_RESULT';

        return $this;

    }
}
