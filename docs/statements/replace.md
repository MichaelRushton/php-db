## REPLACE

`MariaDB`, `MySQL`, and `SQLite` only

```php
$stmt = $connection->replace();
// REPLACE ... VALUES () -- MariaDB and MySQL
// REPLACE ... DEFAULT VALUES -- SQLite
```

<br>

### into

```php
$stmt->into('t1');
// REPLACE INTO t1 ...
```

<br>

### columns

```php
$stmt->columns('c1');
// REPLACE ... (c1)
```

<br>

```php
$stmt->columns('c1', 'c2');
// REPLACE ... (c1, c2)
```

<br>

```php
$stmt->columns(['c1', 'c2']);
// REPLACE ... (c1, c2)
```

<br>

### values

```php
$stmt->values([$param1, $param2]);
// REPLACE ... VALUES (?, ?)
```

<br>

```php
use MichaelRushton\DB\SQL\Components\Raw;

$stmt->values([new Raw('DEFAULT')]);
// REPLACE ... VALUES (DEFAULT)
```

<br>

```php
$stmt->values([
    [$param1, $param2],
    [$param3, $param4],
]);
// REPLACE ... VALUES (?, ?), (?, ?)
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
// REPLACE ... (c1, c2) VALUES (?, ?), (?, ?)
```

<br>

### select

See [SELECT](./select.md)

```php
$stmt->select(function ($select)
{

});
// REPLACE ... SELECT * ...
```

<br>

### with

`SQLite` only

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
// WITH cte1 AS (SELECT * FROM t1) REPLACE ...
```

<br>

### lowPriority

`MariaDB` and `MySQL` only

```php
$stmt->lowPriority();
// REPLACE LOW_PRIORITY ...
```

<br>

### delayed

`MariaDB` only

```php
$stmt->delayed();
// REPLACE DELAYED ...
```

<br>

### set

`MariaDB` and `MySQL` only

```php
$stmt->set('c1', $param);
// REPLACE ... SET c1 = ?
```

<br>

```php
$stmt->set([
    'c1' => $param1,
    'c2' => $param2,
]);
// REPLACE ... SET c1 = ?, c2 = ?
```

<br>

### returning

`MariaDB` and `SQLite` only

```php
$stmt->returning();
// REPLACE ... RETURNING *
```

<br>

```php
$stmt->returning('c1', 'c2');
// REPLACE ... RETURNING c1, c2
```

<br>

```php
$stmt->returning(['a' => 'c1', 'b' => 'c2']);
// REPLACE ... RETURNING c1 a, c2 b
```
