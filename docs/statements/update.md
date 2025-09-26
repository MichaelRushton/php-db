## UPDATE

```php
$stmt = $connection->update();
// UPDATE ...
```

<br>

### top

`SQLServer` only

```php
$stmt->top(10);
// UPDATE TOP (10) ...
```

<br>

```php
$stmt->top(10)->percent();
// UPDATE TOP (10) PERCENT ...
```

<br>

### table

```php
$stmt->table('t1');
// UPDATE t1
```

<br>

```php
$stmt->table('t1', 't2');
// UPDATE t1, t2
```

<br>

```php
$stmt->table(['a' => 't1', 'b' => 't2']);
// UPDATE t1 a, t2 b
```

<br>

See [Subquery](../components/subquery.md)

```php
$stmt->table(
    $connection->select()
    ->columns('c1')
    ->from('t1')
);
// UPDATE (SELECT c1 FROM t1)
```

<br>

See [Table](../components/table.md)

```php
use MichaelRushton\DB\SQL\Components\Table;

$stmt->table(new Table('t1'));
// UPDATE t1
```

<br>

### set

```php
$stmt->set('c1', $param);
// UPDATE ... SET c1 = ?
```

<br>

```php
$stmt->set([
    'c1' => $param1,
    'c2' => $param2,
]);
// UPDATE ... SET c1 = ?, c2 = ?
```

<br>

### join

See [join](./select.md#join)

```php
$stmt->join('t2');
// UPDATE ... JOIN t2
```

<br>

### where

See [where](./select.md#where)

```php
$stmt->where('c1', $param);
// UPDATE ... WHERE c1 = ?
```

<br>

### whereCurrentOf

`PostgreSQL` and `SQLServer` only

```php
$stmt->whereCurrentOf('cursor');
// UPDATE ... WHERE CURRENT OF cursor
```

<br>

### orderBy

`MariaDB`, `MySQL` and `SQLite` only

See [order by](./select.md#orderby)

```php
$stmt->orderBy('c1');
// UPDATE ... ORDER BY c1
```

<br>

### limit

`MariaDB`, `MySQL`, and `SQLite` only

See [limit](./select.md#limit)

```php
$stmt->limit(10);
// UPDATE ... LIMIT 10
```

<br>

### with

`MySQL`, `PostgreSQL`, `SQLite`, and `SQLServer` only

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
// WITH cte1 AS (SELECT * t1) UPDATE ...
```

<br>

### lowPriority

`MariaDB` and `MySQL` only

```php
$stmt->lowPriority();
// UPDATE LOW_PRIORITY ...
```

<br>

### ignore

`MariaDB` and `MySQL` only

```php
$stmt->ignore();
// UPDATE IGNORE ...
```

<br>

### orFail

`SQLite` only

```php
$stmt->orFail();
// UPDATE OR FAIL ...
```

<br>

### orIgnore

`SQLite` only

```php
$stmt->orIgnore();
// UPDATE OR IGNORE ...
```

<br>

### orReplace

`SQLite` only

```php
$stmt->orReplace();
// UPDATE OR REPLACE ...
```

<br>

### orRollBack

`SQLite` only

```php
$stmt->orRollBack();
// UPDATE OR ROLLBACK ...
```

<br>

### from

`PostgreSQL`, `SQLite`, and `SQLServer` only

See [from](./select.md#from)

```php
$stmt->from('t1');
// UPDATE ... FROM t1
```

<br>

### returning

See [returning](./insert.md#returning)

`PostgreSQL` and `SQLite` only

```php
$stmt->returning();
// UPDATE ... RETURNING *
```

<br>

### output

`SQLServer` only

```php
$stmt->output('INSERTED.c1', 'DELETED.c1');
// UPDATE ... OUTPUT INSERTED.c1, DELETED.c1 ...
```

<br>

```php
$stmt->output(['a' => 'INSERTED.c1', 'b' => 'DELETED.c1']);
// UPDATE ... OUTPUT INSERTED.c1 a, DELETED.c1 b ...
```
