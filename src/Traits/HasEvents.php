<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Traits;

use MichaelRushton\DB\Events\AfterConnectEvent;
use MichaelRushton\DB\Events\AfterExecuteEvent;
use MichaelRushton\DB\Events\AfterPrepareEvent;
use MichaelRushton\DB\Events\BeforeConnectEvent;
use MichaelRushton\DB\Events\BeforePrepareEvent;
use MichaelRushton\DB\Events\BeforeExecuteEvent;
use Throwable;

trait HasEvents
{
    protected array $events = [];

    public function beforeConnect(callable $callback): static
    {

        $this->events[BeforeConnectEvent::class][] = $callback;

        return $this;

    }

    protected function runBeforeConnect(): void
    {

        foreach ($this->events[BeforeConnectEvent::class] ?? [] as $event) {
            $event(new BeforeConnectEvent($this));
        }

    }

    public function afterConnect(callable $callback): static
    {

        $this->events[AfterConnectEvent::class][] = $callback;

        return $this;

    }

    protected function runAfterConnect(
        bool $success,
        int $time,
        ?Throwable $exception
    ): void {

        foreach ($this->events[AfterConnectEvent::class] ?? [] as $event) {
            $event(new AfterConnectEvent($this, $success, $time, $exception));
        }

    }

    public function beforePrepare(callable $callback): static
    {

        $this->events[BeforePrepareEvent::class][] = $callback;

        return $this;

    }

    protected function runBeforePrepare(string $query): void
    {

        foreach ($this->events[BeforePrepareEvent::class] ?? [] as $event) {
            $event(new BeforePrepareEvent($this, $query));
        }

    }

    public function afterPrepare(callable $callback): static
    {

        $this->events[AfterPrepareEvent::class][] = $callback;

        return $this;

    }

    protected function runAfterPrepare(
        string $query,
        bool $success,
        int $time,
        ?Throwable $exception
    ): void {

        foreach ($this->events[AfterPrepareEvent::class] ?? [] as $event) {
            $event(new AfterPrepareEvent($this, $query, $success, $time, $exception));
        }

    }

    public function beforeExecute(callable $callback): static
    {

        $this->events[BeforeExecuteEvent::class][] = $callback;

        return $this;

    }

    protected function runBeforeExecute(
        string $query,
        array $params = []
    ): void {

        foreach ($this->events[BeforeExecuteEvent::class] ?? [] as $event) {
            $event(new BeforeExecuteEvent($this, $query, $params));
        }

    }

    public function afterExecute(callable $callback): static
    {

        $this->events[AfterExecuteEvent::class][] = $callback;

        return $this;

    }

    protected function runAfterExecute(
        string $query,
        bool $success,
        int $time,
        ?Throwable $exception,
        array $params = []
    ): void {

        foreach ($this->events[AfterExecuteEvent::class] ?? [] as $event) {
            $event(new AfterExecuteEvent($this, $query, $success, $time, $exception, $params));
        }

    }
}
