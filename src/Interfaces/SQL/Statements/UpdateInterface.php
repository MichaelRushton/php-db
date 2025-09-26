<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Statements;

use MichaelRushton\DB\Interfaces\SQL\StatementInterface;
use Stringable;

interface UpdateInterface extends StatementInterface
{
    public function table(
        string|Stringable|array $table,
        string|Stringable|array ...$tables
    ): static;

    public function set(
        string|array $column,
        string|Stringable|int|float|bool|null $value = null
    ): static;

    public function where(
        string|Stringable|int|float|bool|array|callable $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static;
}
