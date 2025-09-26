<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL\Traits;

interface HasBindings
{
    public function bindings(): array;

    public function mergeBindings(HasBindings $from): void;
}
