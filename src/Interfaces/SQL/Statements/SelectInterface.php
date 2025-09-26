<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Statements;

use MichaelRushton\DB\Interfaces\SQL\Components\SubqueryInterface;
use MichaelRushton\DB\Interfaces\SQL\StatementInterface;
use Stringable;

interface SelectInterface extends StatementInterface
{
    public function from(
        string|Stringable|array $table,
        string|Stringable|array ...$tables
    ): static;

    public function where(
        string|Stringable|int|float|bool|array|callable $column,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $value = null
    ): static;

    public function toSubquery(): SubqueryInterface;
}
