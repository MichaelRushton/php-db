## DELETE

```php
$stmt = $connection->delete();
// DELETE ...
```

<br>

### top

`SQLServer` only

```php
$stmt->top(10);
// DELETE TOP (10) ...
```

<br>

```php
$stmt->top(10)->percent();
// DELETE TOP (10) PERCENT ...
```

<br>

### from

See [from](./select.md#from)

```php
$stmt->from('t1');
// DELETE ... FROM t1
```

<br>

### using

```php
$stmt->using('t1');
// DELETE ... USING t1
```

<br>

```php
$stmt->using('t1', 't2');
// DELETE ... USING t1, t2
```

<br>

```php
$stmt->using(['a' => 't1', 'b' => 't2']);
// DELETE ... USING t1 a, t2 b
```

<br>

See [Subquery](../components/subquery.md)

```php
$stmt->using(
    $connection->select()
    ->columns('c1')
    ->from('t1')
);
// DELETE ... USING (SELECT c1 FROM t1)
```

<br>

See [Table](../components/table.md)

```php
use MichaelRushton\DB\SQL\Components\Table;

$stmt->using(new Table('t1'));
// DELETE ... USING t1
```

<br>

### join

See [join](./select.md#join)

```php
$stmt->join('t2');
// DELETE ... JOIN t2
```

<br>

### where

See [where](./select.md#where)

```php
$stmt->where('c1', $param);
// DELETE ... WHERE c1 = ?
```

<br>

### whereCurrentOf

`PostgreSQL` and `SQLServer` only

```php
$stmt->whereCurrentOf('cursor');
// DELETE ... WHERE CURRENT OF cursor
```

<br>

### orderBy

`MariaDB`, `MySQL` and `SQLite` only

See [order by](./select.md#orderby)

```php
$stmt->orderBy('c1');
// DELETE ... ORDER BY c1
```

<br>

### limit

`MariaDB`, `MySQL`, and `SQLite` only

See [limit](./select.md#limit)

```php
$stmt->limit(10);
// DELETE ... LIMIT 10
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
// WITH cte1 AS (SELECT * t1) DELETE ...
```

<br>

### lowPriority

`MariaDB` and `MySQL` only

```php
$stmt->lowPriority();
// DELETE LOW_PRIORITY ...
```

<br>

### quick

`MariaDB` and `MySQL` only

```php
$stmt->quick();
// DELETE QUICK ...
```

<br>

### ignore

`MariaDB` and `MySQL` only

```php
$stmt->ignore();
// DELETE IGNORE ...
```

<br>

### table

`MariaDB`, `MySQL`, and `SQLServer` only

See [table](./update.md#table)

```php
$stmt->table('t1');
// DELETE t1
```

<br>

### returning

See [returning](./insert.md#returning)

`MariaDB`, `PostgreSQL` and `SQLite` only

```php
$stmt->returning();
// DELETE ... RETURNING *
```

<br>

### output

`SQLServer` only

```php
$stmt->output('DELETED.c1', 'DELETED.c2');
// DELETE ... OUTPUT DELETED.c1, DELETED.c2 ...
```

<br>

```php
$stmt->output(['a' => 'DELETED.c2', 'b' => 'DELETED.c2']);
// DELETE ... OUTPUT DELETED.c2 a, DELETED.c2 b ...
```
