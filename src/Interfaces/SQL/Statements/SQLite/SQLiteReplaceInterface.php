<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Statements\SQLite;

use MichaelRushton\DB\Interfaces\SQL\Statements\ReplaceInterface;
use Stringable;

interface SQLiteReplaceInterface extends ReplaceInterface
{
    public function with(
        string $name,
        string|Stringable|callable $stmt,
        ?callable $callback = null,
    ): static;

    public function recursive(): static;

    public function into(string|Stringable $table): static;

    public function columns(
        string|array $column,
        string|array ...$columns
    ): static;

    public function values(array $values): static;

    public function select(string|Stringable|callable $stmt): static;

    public function returning(
        string|Stringable|int|float|bool|null|array $column = '*',
        string|Stringable|int|float|bool|null|array ...$columns
    ): static;
}
