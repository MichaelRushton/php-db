<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL\Components\Window as WindowComponent;

trait Window
{
    protected array $window = [];

    public function window(
        string $name,
        ?callable $callback = null,
    ): static {

        $this->window[] = $window = new WindowComponent($name);

        if ($callback) {
            $callback($window);
        }

        return $this;

    }

    protected function getWindow(): string
    {

        if (empty($this->window)) {
            return '';
        }

        $window = implode(', ', $this->window);

        foreach ($this->window as $w) {

            if ($w instanceof HasBindings) {
                $this->mergeBindings($w);
            }

        }

        return 'WINDOW ' . $window;

    }
}
