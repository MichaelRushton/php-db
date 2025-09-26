## INSERT

```php
$stmt = $connection->insert();
// INSERT ... VALUES () -- MariaDB and MySQL
// INSERT ... DEFAULT VALUES -- PostgreSQL, SQLite, and SQLServer
```

<br>

### into

```php
$stmt->into('t1');
// INSERT INTO t1 ...
```

<br>

### columns

```php
$stmt->columns('c1');
// INSERT ... (c1)
```

<br>

```php
$stmt->columns('c1', 'c2');
// INSERT ... (c1, c2)
```

<br>

```php
$stmt->columns(['c1', 'c2']);
// INSERT ... (c1, c2)
```

<br>

### values

```php
$stmt->values([$param1, $param2]);
// INSERT ... VALUES (?, ?)
```

<br>

```php
use MichaelRushton\DB\SQL\Components\Raw;

$stmt->values([new Raw('DEFAULT')]);
// INSERT ... VALUES (DEFAULT)
```

<br>

```php
$stmt->values([
    [$param1, $param2],
    [$param3, $param4],
]);
// INSERT ... VALUES (?, ?), (?, ?)
```

<br>

```php
$stmt->values([[
    'c1' => $param1,
    'c2' => $param2,
], [
    'c1' => $param3,
    'c2' => $param4,
]]);
// INSERT ... (c1, c2) VALUES (?, ?), (?, ?)
```

<br>

### select

See [SELECT](./select.md)

```php
$stmt->select(function ($select)
{

});
// INSERT ... SELECT * ...
```

<br>

### with

`PostgreSQL`, `SQLite`, and `SQLServer` only

See [with](./select#with)

```php
use MichaelRushton\DB\SQL\Components\CTE;

$stmt->cte(
    'cte1',
    function ($select)
    {
        $select->from('t1');
    },
    function (CTE $cte)
    {

    }
);
// WITH cte1 AS (SELECT * FROM t1) INSERT ...
```

<br>

### lowPriority

`MariaDB` and `MySQL` only

```php
$stmt->lowPriority();
// INSERT LOW_PRIORITY ...
```

<br>

### delayed

`MariaDB` only

```php
$stmt->delayed();
// INSERT DELAYED ...
```

<br>

### highPriority

`MariaDB` and `MySQL` only

```php
$stmt->highPriority();
// INSERT HIGH_PRIORITY ...
```

<br>

### ignore

`MariaDB` and `MySQL` only

```php
$stmt->ignore();
// INSERT IGNORE ...
```

<br>

### orFail

`SQLite` only

```php
$stmt->orFail();
// INSERT OR FAIL ...
```

<br>

### orIgnore

`SQLite` only

```php
$stmt->orIgnore();
// INSERT OR IGNORE ...
```

<br>

### orReplace

`SQLite` only

```php
$stmt->orReplace();
// INSERT OR REPLACE ...
```

<br>

### orRollBack

`SQLite` only

```php
$stmt->orRollBack();
// INSERT OR ROLLBACK ...
```

<br>

### top

`SQLServer` only

```php
$stmt->top(10);
// INSERT TOP (10) ...
```

<br>

```php
$stmt->top(10)->percent();
// INSERT TOP (10) PERCENT ...
```

<br>

### overridingSystemValue

`PostgreSQL` only

```php
$stmt->overridingSystemValue();
// INSERT ... OVERRIDING SYSTEM VALUE ...
```

<br>

### overridingUserValue

`PostgreSQL` only

```php
$stmt->overridingUserValue();
// INSERT ... OVERRIDING USER VALUE ...
```

<br>

### output

`SQLServer` only

```php
$stmt->output('INSERTED.c1', 'INSERTED.c2');
// INSERT ... OUTPUT INSERTED.c1, INSERTED.c2 ...
```

<br>

```php
$stmt->output(['a' => 'INSERTED.c1', 'b' => 'INSERTED.c2']);
// INSERT ... OUTPUT INSERTED.c1 a, INSERTED.c2 b ...
```

<br>

### set

`MariaDB` and `MySQL` only

See [UPDATE](./update.md#set)

```php
$stmt->set('c1', $param);
// INSERT ... SET c1 = ?
```

<br>

### as

`MySQL` only

```php
$stmt->as('new');
// INSERT ... AS new
```

<br>

```php
$stmt->as('new', 'a');
// INSERT ... AS new (a)
```

<br>

```php
$stmt->as('new', ['a', 'b']);
// INSERT ... AS new (a, b)
```

<br>

### onConflictDoNothing

`PostgreSQL` and `SQLite` only

See [Upsert](../components/upsert.md)

```php
use MichaelRushton\DB\SQL\Components\Upsert;

$stmt->onConflictDoNothing(function (Upsert $upsert)
{

});
// INSERT ... ON CONFLICT DO NOTHING
```

<br>

### onConflictDoUpdateSet

`PostgreSQL` and `SQLite` only

See [Upsert](../components/upsert.md)

```php
use MichaelRushton\DB\SQL\Components\Upsert;

$stmt->onConflictDoUpdateSet('c1', $param, function (Upsert $upsert)
{

});
// INSERT ... ON CONFLICT DO UPDATE SET c1 = ?
```

<br>

### onDuplicateKeyUpdate

`MariaDB` and `MySQL` only

```php
$stmt->onDuplicateKeyUpdate('c1', $param);
// INSERT ... ON DUPLICATE KEY UPDATE c1 = ?
```

<br>

```php
$stmt->onDuplicateKeyUpdate([
    'c1' => $param1,
    'c2' => $param2,
]);
// INSERT ... ON DUPLICATE KEY UPDATE c1 = ?, c2 = ?
```

<br>

### returning

`MariaDB`, `PostgreSQL`, and `SQLite` only

```php
$stmt->returning();
// INSERT ... RETURNING *
```

<br>

```php
$stmt->returning('c1', 'c2');
// INSERT ... RETURNING c1, c2
```

<br>

```php
$stmt->returning(['a' => 'c1', 'b' => 'c2']);
// INSERT ... RETURNING c1 a, c2 b
```
