<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\PostgreSQLConnection;
use MichaelRushton\DB\Connections\SQLiteConnection;
use MichaelRushton\DB\Drivers\PostgreSQLDriver;
use MichaelRushton\DB\Drivers\SQLiteDriver;
use MichaelRushton\DB\Events\AfterConnectEvent;
use MichaelRushton\DB\Events\AfterExecuteEvent;
use MichaelRushton\DB\Events\AfterPrepareEvent;
use MichaelRushton\DB\Events\BeforeConnectEvent;
use MichaelRushton\DB\Events\BeforeExecuteEvent;
use MichaelRushton\DB\Events\BeforePrepareEvent;

beforeEach(function (): void {
    $this->driver = new SQLiteDriver();
});

test('before connect', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (BeforeConnectEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

    };

    $connection->beforeConnect($event)
    ->beforeConnect($event)
    ->pdo();

    expect($events)
    ->toBe(2);

});

test('after connect', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (AfterConnectEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->success)
        ->toBeTrue();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeNull();

    };

    $connection->afterConnect($event)
    ->afterConnect($event)
    ->pdo();

    expect($events)
    ->toBe(2);

});

test('after connect exception', function (): void {

    $connection = new PostgreSQLConnection(new PostgreSQLDriver());

    $events = 0;

    $event = function (AfterConnectEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->success)
        ->toBeFalse();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeInstanceOf(PDOException::class);

    };

    $connection->afterConnect($event)
    ->pdo();

    expect($events)
    ->toBe(1);

})
->throws(PDOException::class);

test('before exec', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (BeforeExecuteEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT 1");

        expect($event->params)
        ->toBe([]);

    };

    $connection->beforeExecute($event)
    ->beforeExecute($event)
    ->exec("SELECT 1");

    expect($events)
    ->toBe(2);

});

test('after exec', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (AfterExecuteEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT 1");

        expect($event->success)
        ->toBeTrue();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeNull();

        expect($event->params)
        ->toBe([]);

    };

    $connection->afterExecute($event)
    ->afterExecute($event)
    ->exec("SELECT 1");

    expect($events)
    ->toBe(2);

});

test('after exec exception', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (AfterExecuteEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT");

        expect($event->success)
        ->toBeFalse();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeInstanceOf(PDOException::class);

        expect($event->params)
        ->toBe([]);

    };

    $connection->afterExecute($event)
    ->exec("SELECT");

    expect($events)
    ->toBe(1);

})
->throws(PDOException::class);

test('before query', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (BeforeExecuteEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT 1");

        expect($event->params)
        ->toBe([]);

    };

    $connection->beforeExecute($event)
    ->beforeExecute($event)
    ->query("SELECT 1");

    expect($events)
    ->toBe(2);

});

test('after query', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (AfterExecuteEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT 1");

        expect($event->success)
        ->toBeTrue();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeNull();

        expect($event->params)
        ->toBe([]);

    };

    $connection->afterExecute($event)
    ->afterExecute($event)
    ->query("SELECT 1");

    expect($events)
    ->toBe(2);

});

test('after query exception', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (AfterExecuteEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT");

        expect($event->success)
        ->toBeFalse();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeInstanceOf(PDOException::class);

        expect($event->params)
        ->toBe([]);

    };

    $connection->afterExecute($event)
    ->query("SELECT");

    expect($events)
    ->toBe(1);

})
->throws(PDOException::class);

test('before prepare', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (BeforePrepareEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT ?");

    };

    $connection->beforePrepare($event)
    ->beforePrepare($event)
    ->prepare("SELECT ?");

    expect($events)
    ->toBe(2);

});

test('after prepare', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (AfterPrepareEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT ?");

        expect($event->success)
        ->toBeTrue();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeNull();

    };

    $connection->afterPrepare($event)
    ->afterPrepare($event)
    ->prepare("SELECT ?");

    expect($events)
    ->toBe(2);

});

test('after prepare exception', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (AfterPrepareEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT");

        expect($event->success)
        ->toBeFalse();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeInstanceOf(PDOException::class);

    };

    $connection->afterPrepare($event)
    ->prepare("SELECT");

    expect($events)
    ->toBe(1);

})
->throws(PDOException::class);

test('before execute', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (BeforeExecuteEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT ?");

        expect($event->params)
        ->toBe([1]);

    };

    $connection->beforeExecute($event)
    ->beforeExecute($event)
    ->execute("SELECT ?", 1);

    expect($events)
    ->toBe(2);

});

test('after execute', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (AfterExecuteEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT ?");

        expect($event->success)
        ->toBeTrue();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeNull();

        expect($event->params)
        ->toBe([1]);

    };

    $connection->afterExecute($event)
    ->afterExecute($event)
    ->execute("SELECT ?", 1);

    expect($events)
    ->toBe(2);

});

test('after execute exception', function (): void {

    $connection = new SQLiteConnection($this->driver);

    $events = 0;

    $event = function (AfterExecuteEvent $event) use ($connection, &$events): void {

        ++$events;

        expect($event->connection)
        ->toBe($connection);

        expect($event->query)
        ->toBe("SELECT 1");

        expect($event->success)
        ->toBeFalse();

        expect($event->time)
        ->toBeInt();

        expect($event->exception)
        ->toBeInstanceOf(PDOException::class);

        expect($event->params)
        ->toBe([1]);

    };

    $connection->afterExecute($event)
    ->execute("SELECT 1", 1);

    expect($events)
    ->toBe(1);

})
->throws(PDOException::class);
