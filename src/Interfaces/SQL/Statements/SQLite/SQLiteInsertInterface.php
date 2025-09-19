<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Statements\SQLite;

use MichaelRushton\DB\Interfaces\SQL\Statements\InsertInterface;
use Stringable;

interface SQLiteInsertInterface extends InsertInterface
{
    public function with(
        string $name,
        string|Stringable|callable $stmt,
        ?callable $callback = null,
    ): static;

    public function recursive(): static;

    public function orFail(): static;

    public function orIgnore(): static;

    public function orReplace(): static;

    public function orRollBack(): static;

    public function into(string|Stringable $table): static;

    public function columns(
        string|array $column,
        string|array ...$columns
    ): static;

    public function values(array $values): static;

    public function select(string|Stringable|callable $stmt): static;

    public function onConflictDoNothing(?callable $callback = null): static;

    public function onConflictDoUpdateSet(
        string|array $column,
        string|Stringable|int|float|bool|null|callable $value = null,
        ?callable $callback = null
    ): static;

    public function returning(
        string|Stringable|int|float|bool|null|array $column = '*',
        string|Stringable|int|float|bool|null|array ...$columns
    ): static;
}
