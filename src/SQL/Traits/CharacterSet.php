<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait CharacterSet
{
    protected string $character_set = '';

    public function characterSet(string $name): static
    {

        $this->character_set = 'CHARACTER SET ' . $name;

        return $this;

    }
}
