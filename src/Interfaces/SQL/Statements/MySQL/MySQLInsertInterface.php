<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Statements\MySQL;

use MichaelRushton\DB\Interfaces\SQL\Statements\InsertInterface;
use Stringable;

interface MySQLInsertInterface extends InsertInterface
{
    public function lowPriority(): static;

    public function highPriority(): static;

    public function ignore(): static;

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

    public function as(
        string $row_alias,
        string|array|null $column_aliases = null
    ): static;

    public function onDuplicateKeyUpdate(
        string|array $column,
        string|Stringable|int|float|bool|null $value = null
    ): static;
}
