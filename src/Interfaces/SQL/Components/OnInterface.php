<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Components;

use Stringable;

interface OnInterface
{
    public function on(
        string|Stringable|int|float|bool|array|callable $column1,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column12 = null
    ): static;

    public function orOn(
        string|Stringable|int|float|bool|array|callable $column1,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column12 = null
    ): static;

    public function onNot(
        string|Stringable|int|float|bool|array|callable $column1,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column12 = null
    ): static;

    public function orOnNot(
        string|Stringable|int|float|bool|array|callable $column1,
        string|Stringable|int|float|bool|null|array $operator = null,
        string|Stringable|int|float|bool|null|array $column12 = null
    ): static;

    public function onIn(
        string|Stringable|int|float|bool $column1,
        array $values
    ): static;

    public function orOnIn(
        string|Stringable|int|float|bool $column1,
        array $values
    ): static;

    public function onNotIn(
        string|Stringable|int|float|bool $column1,
        array $values
    ): static;

    public function orOnNotIn(
        string|Stringable|int|float|bool $column1,
        array $values
    ): static;

    public function onBetween(
        string|Stringable|int|float $column1,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static;

    public function orOnBetween(
        string|Stringable|int|float $column1,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static;

    public function onNotBetween(
        string|Stringable|int|float $column1,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static;

    public function orOnNotBetween(
        string|Stringable|int|float $column1,
        string|Stringable|int|float $value1,
        string|Stringable|int|float $value2
    ): static;

    public function onNull(string|Stringable $column1): static;

    public function orOnNull(string|Stringable $column1): static;

    public function onNotNull(string|Stringable $column1): static;

    public function orOnNotNull(string|Stringable $column1): static;

    public function when(
        mixed $value,
        ?callable $if_true = null,
        ?callable $if_false = null
    ): static;
}
