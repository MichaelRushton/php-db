<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB;
;

use MichaelRushton\DB\Interfaces\SQL\Statements\ReplaceInterface;
use Stringable;

interface MariaDBReplaceInterface extends ReplaceInterface
{
    public function lowPriority(): static;

    public function delayed(): static;

    public function into(string|Stringable $table): static;

    public function columns(
        string|array $column,
        string|array ...$columns
    ): static;

    public function values(array $values): static;

    public function set(
        string|array $column,
        string|Stringable|int|float|bool|null $value = null
    ): static;

    public function select(string|Stringable|callable $stmt): static;

    public function returning(
        string|Stringable|int|float|bool|null|array $column = '*',
        string|Stringable|int|float|bool|null|array ...$columns
    ): static;
}
