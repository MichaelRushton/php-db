<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer;

use MichaelRushton\DB\Interfaces\SQL\Statements\InsertInterface;
use Stringable;

interface SQLServerInsertInterface extends InsertInterface
{
    public function with(
        string $name,
        string|Stringable|callable $stmt,
        ?callable $callback = null,
    ): static;

    public function recursive(): static;

    public function top(int|float|string|Stringable $row_count): static;

    public function percent(): static;

    public function withTies(): static;

    public function into(string|Stringable $table): static;

    public function columns(
        string|array $column,
        string|array ...$columns
    ): static;

    public function output(
        string|Stringable|int|float|bool|null|array $column,
        string|Stringable|int|float|bool|null|array ...$columns
    ): static;

    public function values(array $values): static;

    public function select(string|Stringable|callable $stmt): static;
}
