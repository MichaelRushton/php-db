<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Statements;

use MichaelRushton\DB\Interfaces\SQL\StatementInterface;
use Stringable;

interface InsertInterface extends StatementInterface
{
    public function into(string|Stringable $table): static;

    public function values(array $values): static;
}
