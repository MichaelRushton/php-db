## SELECT

```php
$stmt = $connection->select();
// SELECT * ...
```

<br>

### distinct

```php
$stmt->distinct();
// SELECT DISTINCT ...
```

<br>

### top

`SQLServer` only

```php
$stmt->top(10);
// SELECT TOP (10) ...
```

<br>

```php
$stmt->top(10)->percent();
// SELECT TOP (10) PERCENT ...
```

<br>

```php
$stmt->top(10)->withTies();
// SELECT TOP (10) WITH TIES ...
```

<br>

### columns

```php
$stmt->columns('c1');
// SELECT c1 ...
```

<br>

```php
$stmt->columns('c1', 'c2');
// SELECT c1, c2 ...
```

<br>

```php
$stmt->columns(['a' => 'c1', 'b' => 'c2']);
// SELECT c1 a, c2 b ...
```

<br>

See [Subquery](../components/subquery.md)

```php
$stmt->columns(
    $connection->select()
    ->columns('COUNT(*)')
    ->from('t1')
    ->toSubquery()
    ->as('count')
);
// SELECT (SELECT COUNT(*) FROM t1) count
```

<br>

```php
use MichaelRushton\DB\SQL;

$stmt->columns(SQL::bind($param));
// SELECT ? ...
```

<br>

### from

```php
$stmt->from('t1');
// SELECT ... FROM t1
```

<br>

```php
$stmt->from('t1', 't2');
// SELECT ... FROM t1, t2
```

<br>

```php
$stmt->from(['a' => 't1', 'b' => 't2']);
// SELECT ... FROM t1 a, t2 b
```

<br>

See [Subquery](../components/subquery.md)

```php
$stmt->from(
    $connection->select()
    ->columns('c1')
    ->from('t1')
);
// SELECT ... FROM (SELECT c1 FROM t1)
```

<br>

See [Table](../components/table.md)

```php
use MichaelRushton\DB\SQL\Components\Table;

$stmt->from(new Table('t1'));
// SELECT ... FROM t1
```

<br>

### join

```php
$stmt->join('t2');
// SELECT ... JOIN t2
```

<br>

```php
$stmt->join(['t2', 't3']);
// SELECT ... JOIN t2 JOIN t3
```

<br>

```php
$stmt->join(['b' => 't2', 'c' => 't3']);
// SELECT ... JOIN t2 b JOIN t3 c
```

<br>

```php
$stmt->join('t2', 'c1');
// SELECT ... JOIN t2 USING (c1)
```

<br>

```php
$stmt->join('t2', ['c1', 'c2']);
// SELECT ... JOIN t2 USING (c1, c2)
```

<br>

```php
$stmt->join('t2', 'c1', 'c2');
// SELECT ... JOIN t2 ON c1 = c2
```

<br>

```php
$stmt->join('t2', 'c1', '!=', 'c2');
// SELECT ... JOIN t2 ON c1 != c2
```

<br>

```php
$stmt->join('t2', [
    'c1' => 'c2',
    'c3' => 'c4',
]);
// SELECT ... JOIN t2 ON (c1 = c2 AND c3 = c4)
```

<br>

```php
$stmt->join('t2', 'c1', SQL::bind($param));
// SELECT ... JOIN t2 ON c1 = ?
```

<br>

```php
use MichaelRushton\DB\SQL\Components\On;

$stmt->join('t2', function (On $on)
{
    $on->on('c1', 'c2')
    ->on('c3', 'c4');
});
// SELECT ... JOIN t2 ON (c1 = c2 AND c3 = c4)
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->on('c1', 'c2')
    ->orOn('c3', 'c4');
});
// SELECT ... JOIN t2 ON (c1 = c2 OR c3 = c4)
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onNot('c1', 'c2')
    ->orOnNot('c3', 'c4');
});
// SELECT ... JOIN t2 ON (NOT c1 = c2 OR NOT c3 = c4)
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onIn('c1', ['c2', 'c3'])
    ->onIn('c4', ['c5', 'c6']);
});
// SELECT ... JOIN t2 ON (c1 IN (c2, c3) AND c4 IN (c5, c6))
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onIn('c1', ['c2', 'c3'])
    ->orOnIn('c4', ['c5', 'c6']);
});
// SELECT ... JOIN t2 ON (c1 IN (c2, c3) OR c4 IN (c5, c6))
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onNotIn('c1', ['c2', 'c3'])
    ->orOnNotIn('c4', ['c5', 'c6']);
});
// SELECT ... JOIN t2 ON (NOT c1 IN (c2, c3) OR NOT c4 IN (c5, c6))
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onBetween('c1', 'c2', 'c3')
    ->onBetween('c4', 'c5', 'c6');
});
// SELECT ... JOIN t2 ON (c1 BETWEEN c2 AND c3 AND c4 BETWEEN c5 AND c6)
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onBetween('c1', 'c2', 'c3')
    ->orOnBetween('c4', 'c5', 'c6');
});
// SELECT ... JOIN t2 ON (c1 BETWEEN c2 AND c3 OR c4 BETWEEN c5 AND c6)
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onNotBetween('c1', 'c2', 'c3')
    ->orOnNotBetween('c4', 'c5', 'c6');
});
// SELECT ... JOIN t2 ON (NOT c1 BETWEEN c2 AND c3 OR NOT c4 BETWEEN c5 AND c6)
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onNull('c1')
    ->onNull('c2');
});
// SELECT ... JOIN t2 ON (c1 IS NULL AND c2 IS NULL)
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onNull('c1')
    ->orOnNull('c2');
});
// SELECT ... JOIN t2 ON (c1 IS NULL OR c2 IS NULL)
```

<br>

```php
$stmt->join('t2', function (On $on)
{
    $on->onNotNull('c1')
    ->orOnNotNull('c2');
});
// SELECT ... JOIN t2 ON (NOT c1 IS NULL OR NOT c2 IS NULL)
```

<br>

See [Subquery](../components/subquery.md)

```php
$stmt->join(
    $connection->select()
    ->columns('c1')
    ->from('t1')
    ->toSubquery()
    ->as('t2')
);
// SELECT ... JOIN (SELECT c1 FROM t1) t2
```

<br>

See [Table](../components/table.md)

```php
$stmt->join(new Table('t2'));
// SELECT ... JOIN t2
```

<br>

### leftJoin

```php
$stmt->leftJoin('t2', ...$on);
// SELECT ... LEFT JOIN t2 ...
```

<br>

### rightJoin

```php
$stmt->rightJoin('t2', ...$on);
// SELECT ... RIGHT JOIN t2 ...
```

<br>

### fullJoin

```php
$stmt->fullJoin('t2', ...$on);
// SELECT ... FULL JOIN t2 ...
```

<br>

### straightJoin

`MariaDB` and `MySQL` only

```php
$stmt->straightJoin('t2', ...$on);
// SELECT ... STRAIGHT_JOIN t2 ...
```

<br>

### crossJoin

```php
$stmt->crossJoin('t2');
// SELECT ... CROSS JOIN t2
```

<br>

### naturalJoin

```php
$stmt->naturalJoin('t2');
// SELECT ... NATURAL JOIN t2
```

<br>

### naturalLeftJoin

```php
$stmt->naturalLeftJoin('t2');
// SELECT ... NATURAL LEFT JOIN t2
```

<br>

### naturalRightJoin

```php
$stmt->naturalRightJoin('t2');
// SELECT ... NATURAL RIGHT JOIN t2
```

<br>

### naturalFullJoin

```php
$stmt->naturalFullJoin('t2');
// SELECT ... NATURAL FULL JOIN t2
```

<br>

### where

```php
$stmt->where('c1', $param);
// SELECT ... WHERE c1 = ?
```

<br>

```php
$stmt->where('c1', '!=', $param);
// SELECT ... WHERE c1 != ?
```

<br>

```php
$stmt->where([
    'c1' => $param1,
    'c2' => $param2,
]);
// SELECT ... WHERE (c1 = ? AND c2 = ?)
```

<br>

```php
$stmt->where('c1', new Raw('c2'));
// SELECT ... WHERE c1 = c2
```

<br>

```php
use MichaelRushtwhere\DB\SQL\Components\Where;

$stmt->where(function (Where $where)
{
    $where->where('c1', $param1)
    ->where('c2', $param2);
});
// SELECT ... WHERE (c1 = ? AND c2 = ?)
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->where('c1', $param1)
    ->orWhere('c2', $param2);
});
// SELECT ... WHERE (c1 = ? OR c2 = ?)
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereNot('c1', $param1)
    ->orWhereNot('c2', $param2);
});
// SELECT ... WHERE (NOT c1 = ? OR NOT c2 = ?)
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereIn('c1', [$param1, $param2])
    ->whereIn('c2', [$param3, $param4]);
});
// SELECT ... WHERE (c1 IN (?, ?) AND c2 IN (?, ?))
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereIn('c1', [$param1, $param2])
    ->orWhereIn('c2', [$param3, $param4]);
});
// SELECT ... WHERE (c1 IN (?, ?) OR c2 IN (?, ?))
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereNotIn('c1', [$param1, $param2])
    ->orWhereNotIn('c2', [$param3, $param4]);
});
// SELECT ... WHERE (NOT c1 IN (?, ?) OR NOT c2 IN (?, ?))
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereBetween('c1', $param1, $param2)
    ->whereBetween('c2', $param3, $param4);
});
// SELECT ... WHERE (c1 BETWEEN ? AND ? AND c2 BETWEEN ? AND ?)
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereBetween('c1', $param1, $param2)
    ->orWhereBetween('c2', $param3, $param4);
});
// SELECT ... WHERE (c1 BETWEEN ? AND ? OR c2 BETWEEN ? AND ?)
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereNotBetween('c1', $param1, $param2)
    ->orWhereNotBetween('c2', $param3, $param4);
});
// SELECT ... WHERE (NOT c1 BETWEEN ? AND ? OR NOT c2 BETWEEN ? AND ?)
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereNull('c1')
    ->whereNull('c2');
});
// SELECT ... WHERE (c1 IS NULL AND c2 IS NULL)
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereNull('c1')
    ->orWhereNull('c2');
});
// SELECT ... WHERE (c1 IS NULL OR c2 IS NULL)
```

<br>

```php
$stmt->where(function (Where $where)
{
    $where->whereNotNull('c1')
    ->orWhereNotNull('c2');
});
// SELECT ... WHERE (NOT c1 IS NULL OR NOT c2 IS NULL)
```

<br>

See [Subquery](../components/subquery.md)

```php
$stmt->where(
    $connection->select()
    ->columns('COUNT(*)')
    ->from('t1'),
    0
);
// SELECT ... WHERE (SELECT COUNT(*) FROM t1) = 0
```

<br>

### orWhere

```php
$stmt->where('c1', $param1)
->orWhere('c2', $param2);
// SELECT ... WHERE c1 = ? OR c2 = ?
```

<br>

### whereNot

```php
$stmt->whereNot('c1', $param);
// SELECT ... WHERE NOT c1 = ?
```

<br>

### orWhereNot

```php
$stmt->where('c1', $param1)
->orWhereNot('c2', $param2);
// SELECT ... WHERE c1 = ? OR NOT c2 = ?
```

<br>

### whereIn

```php
$stmt->whereIn('c1', [$param1, $param2]);
// SELECT ... WHERE c1 IN (?, ?)
```

<br>

### orWhereIn

```php
$stmt->where('c1', $param1)
->orWhereIn('c2', [$param2, $param3]);
// SELECT ... WHERE c1 = ? OR c2 IN (?, ?)
```

<br>

### whereNotIn

```php
$stmt->whereNotIn('c1', [$param1, $param2]);
// SELECT ... WHERE NOT c1 IN (?, ?)
```

<br>

### orWhereNotIn

```php
$stmt->where('c1', $param1)
->orWhereNotIn('c2', [$param2, $param3]);
// SELECT ... WHERE c1 = ? OR NOT c2 IN (?, ?)
```

<br>

### whereBetween

```php
$stmt->whereBetween('c1', $param1, $param2);
// SELECT ... WHERE c1 BETWEEN ? AND ?
```

<br>

### orWhereBetween

```php
$stmt->where('c1', $param1)
->orWhereBetween('c2', $param2, $param3);
// SELECT ... WHERE c1 = ? OR c2 BETWEEN ? AND ?
```

<br>

### whereNotBetween

```php
$stmt->whereNotBetween('c1', $param1, $param2);
// SELECT ... WHERE NOT c1 BETWEEN ? AND ?
```

<br>

### orWhereNotBetween

```php
$stmt->where('c1', $param1)
->orWhereNotBetween('c2', $param2, $param3);
// SELECT ... WHERE c1 = ? OR NOT c2 BETWEEN ? AND ?
```

<br>

### whereNull

```php
$stmt->whereNull('c1');
// SELECT ... WHERE c1 IS NULL
```

<br>

### orWhereNull

```php
$stmt->where('c1', $param)
->orWhereNull('c2');
// SELECT ... WHERE c1 = ? OR c2 IS NULL
```

<br>

### whereNotNull

```php
$stmt->whereNotNull('c1');
// SELECT ... WHERE NOT c1 IS NULL
```

<br>

### orWhereNotNull

```php
$stmt->where('c1', $param)
->orWhereNotNull('c2');
// SELECT ... WHERE c1 = ? OR NOT c2 IS NULL
```

<br>

### groupBy

```php
$stmt->groupBy('c1');
// SELECT ... GROUP BY c1
```

<br>

```php
$stmt->groupBy('c1', 'c2');
// SELECT ... GROUP BY c1, c2
```

<br>

```php
$stmt->groupBy(['c1', 'c2']);
// SELECT ... GROUP BY c1, c2
```

<br>

`MariaDB` and `MySQL` only

```php
$stmt->groupBy('c1')->withRollup();
// SELECT ... GROUP BY c1 WITH ROLLUP
```

<br>

### having

```php
$stmt->having('c1', $param);
// SELECT ... HAVING c1 = ?
```

<br>

```php
$stmt->having('c1', '!=', $param);
// SELECT ... HAVING c1 != ?
```

<br>

```php
$stmt->having([
    'c1' => $param1,
    'c2' => $param2,
]);
// SELECT ... HAVING (c1 = ? AND c2 = ?)
```

<br>

```php
$stmt->having('c1', new Raw('c2'));
// SELECT ... HAVING c1 = c2
```

<br>

```php
use MichaelRushthaving\DB\SQL\Components\Having;

$stmt->having(function (Having $having)
{
    $having->having('c1', $param1)
    ->having('c2', $param2);
});
// SELECT ... HAVING (c1 = ? AND c2 = ?)
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->having('c1', $param1)
    ->orHaving('c2', $param2);
});
// SELECT ... HAVING (c1 = ? OR c2 = ?)
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingNot('c1', $param1)
    ->orHavingNot('c2', $param2);
});
// SELECT ... HAVING (NOT c1 = ? OR NOT c2 = ?)
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingIn('c1', [$param1, $param2])
    ->havingIn('c2', [$param3, $param4]);
});
// SELECT ... HAVING (c1 IN (?, ?) AND c2 IN (?, ?))
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingIn('c1', [$param1, $param2])
    ->orHavingIn('c2', [$param3, $param4]);
});
// SELECT ... HAVING (c1 IN (?, ?) OR c2 IN (?, ?))
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingNotIn('c1', [$param1, $param2])
    ->orHavingNotIn('c2', [$param3, $param4]);
});
// SELECT ... HAVING (NOT c1 IN (?, ?) OR NOT c2 IN (?, ?))
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingBetween('c1', $param1, $param2)
    ->havingBetween('c2', $param3, $param4);
});
// SELECT ... HAVING (c1 BETWEEN ? AND ? AND c2 BETWEEN ? AND ?)
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingBetween('c1', $param1, $param2)
    ->orHavingBetween('c2', $param3, $param4);
});
// SELECT ... HAVING (c1 BETWEEN ? AND ? OR c2 BETWEEN ? AND ?)
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingNotBetween('c1', $param1, $param2)
    ->orHavingNotBetween('c2', $param3, $param4);
});
// SELECT ... HAVING (NOT c1 BETWEEN ? AND ? OR NOT c2 BETWEEN ? AND ?)
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingNull('c1')
    ->havingNull('c2');
});
// SELECT ... HAVING (c1 IS NULL AND c2 IS NULL)
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingNull('c1')
    ->orHavingNull('c2');
});
// SELECT ... HAVING (c1 IS NULL OR c2 IS NULL)
```

<br>

```php
$stmt->having(function (Having $having)
{
    $having->havingNotNull('c1')
    ->orHavingNotNull('c2');
});
// SELECT ... HAVING (NOT c1 IS NULL OR NOT c2 IS NULL)
```

<br>

See [Subquery](../components/subquery.md)

```php
$stmt->having(
    $connection->select()
    ->columns('COUNT(*)')
    ->from('t1'),
    0
);
// SELECT ... HAVING (SELECT COUNT(*) FROM t1) = 0
```

<br>

### orHaving

```php
$stmt->having('c1', $param1)
->orHaving('c2', $param2);
// SELECT ... HAVING c1 = ? OR c2 = ?
```

<br>

### havingNot

```php
$stmt->havingNot('c1', $param);
// SELECT ... HAVING NOT c1 = ?
```

<br>

### orHavingNot

```php
$stmt->having('c1', $param1)
->orHavingNot('c2', $param2);
// SELECT ... HAVING c1 = ? OR NOT c2 = ?
```

<br>

### havingIn

```php
$stmt->havingIn('c1', [$param1, $param2]);
// SELECT ... HAVING c1 IN (?, ?)
```

<br>

### orHavingIn

```php
$stmt->having('c1', $param1)
->orHavingIn('c2', [$param2, $param3]);
// SELECT ... HAVING c1 = ? OR c2 IN (?, ?)
```

<br>

### havingNotIn

```php
$stmt->havingNotIn('c1', [$param1, $param2]);
// SELECT ... HAVING NOT c1 IN (?, ?)
```

<br>

### orHavingNotIn

```php
$stmt->having('c1', $param1)
->orHavingNotIn('c2', [$param2, $param3]);
// SELECT ... HAVING c1 = ? OR NOT c2 IN (?, ?)
```

<br>

### havingBetween

```php
$stmt->havingBetween('c1', $param1, $param2);
// SELECT ... HAVING c1 BETWEEN ? AND ?
```

<br>

### orHavingBetween

```php
$stmt->having('c1', $param1)
->orHavingBetween('c2', $param2, $param3);
// SELECT ... HAVING c1 = ? OR c2 BETWEEN ? AND ?
```

<br>

### havingNotBetween

```php
$stmt->havingNotBetween('c1', $param1, $param2);
// SELECT ... HAVING NOT c1 BETWEEN ? AND ?
```

<br>

### orHavingNotBetween

```php
$stmt->having('c1', $param1)
->orHavingNotBetween('c2', $param2, $param3);
// SELECT ... HAVING c1 = ? OR NOT c2 BETWEEN ? AND ?
```

<br>

### havingNull

```php
$stmt->havingNull('c1');
// SELECT ... HAVING c1 IS NULL
```

<br>

### orHavingNull

```php
$stmt->having('c1', $param)
->orHavingNull('c2');
// SELECT ... HAVING c1 = ? OR c2 IS NULL
```

<br>

### havingNotNull

```php
$stmt->havingNotNull('c1');
// SELECT ... HAVING NOT c1 IS NULL
```

<br>

### orHavingNotNull

```php
$stmt->having('c1', $param)
->orHavingNotNull('c2');
// SELECT ... HAVING c1 = ? OR NOT c2 IS NULL
```

<br>

### orderBy

```php
$stmt->orderBy('c1');
// SELECT ... ORDER BY c1
```

<br>

```php
$stmt->orderBy('c1', 'c2');
// SELECT ... ORDER BY c1, c2
```

<br>

```php
$stmt->orderBy(['c1', 'c2']);
// SELECT ... ORDER BY c1, c2
```

<br>

### orderByDesc

```php
$stmt->orderByDesc('c1');
// SELECT ... ORDER BY c1 DESC
```

<br>

### orderByNullsFirst

`PostgreSQL` and `SQLite` only

```php
$stmt->orderByNullsFirst('c1');
// SELECT ... ORDER BY c1 ASC NULLS FIRST
```

<br>

### orderByNullsLast

`PostgreSQL` and `SQLite` only

```php
$stmt->orderByNullsLast('c1');
// SELECT ... ORDER BY c1 ASC NULLS LAST
```

<br>

### orderByDescNullsFirst

`PostgreSQL` and `SQLite` only

```php
$stmt->orderByDescNullsFirst('c1');
// SELECT ... ORDER BY c1 DESC NULLS FIRST
```

<br>

### orderByDescNullsLast

`PostgreSQL` and `SQLite` only

```php
$stmt->orderByDescNullsLast('c1');
// SELECT ... ORDER BY c1 DESC NULLS LAST
```

<br>

### limit

`MariaDB`, `MySQL`, `PostgreSQL` and `SQLite` only

```php
$stmt->limit(10);
// SELECT ... LIMIT 10
```

<br>

```php
$stmt->limit(10, 5);
// SELECT ... LIMIT 10 OFFSET 5
```

<br>

`MariaDB` only

```php
$stmt->limit(10)->rowsExamined(100);
// SELECT ... LIMIT 10 ROWS EXAMINED 100
```

<br>

### offsetFetch

`MariaDB`, `PostgreSQL` and `SQLServer` only

```php
$stmt->offsetFetch(5, 10);
// SELECT ... OFFSET 5 ROWS FETCH NEXT 10 ROWS ONLY
```

<br>

```php
$stmt->offsetFetch(5, 10)->withTies();
// SELECT ... OFFSET 5 ROWS FETCH NEXT 10 ROWS WITH TIES
```

<br>

### union

```php
$stmt->union(function ($select)
{
    $select->from('t1');
});
// SELECT ... UNION SELECT * FROM t1
```

<br>

### unionAll

```php
$stmt->unionAll(function ($select)
{
    $select->from('t1');
});
// SELECT ... UNION ALL SELECT * FROM t1
```

<br>

### intersect

```php
$stmt->intersect(function ($select)
{
    $select->from('t1');
});
// SELECT ... INTERSECT SELECT * FROM t1
```

<br>

### intersectAll

`MariaDB`, `MySQL`, and `PostgreSQL` only

```php
$stmt->intersectAll(function ($select)
{
    $select->from('t1');
});
// SELECT ... INTERSECT ALL SELECT * FROM t1
```

<br>

### except

```php
$stmt->except(function ($select)
{
    $select->from('t1');
});
// SELECT ... EXCEPT SELECT * FROM t1
```

<br>

### exceptAll

`MariaDB`, `MySQL`, and `PostgreSQL` only

```php
$stmt->exceptAll(function ($select)
{
    $select->from('t1');
});
// SELECT ... EXCEPT ALL SELECT * FROM t1
```

<br>

### window

`MySQL`, `PostgreSQL`, `SQLite`, and `SQLServer` only

See [Window](../components/window.md)

```php
$stmt->window('w1', function (Window $window)
{

});
// SELECT ... WINDOW w1 AS ()
```

<br>

### with

See [CTE](../components/cte.md)

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
// WITH cte1 AS (SELECT * FROM t1) SELECT
```

<br>

```php
use MichaelRushton\DB\SQL\Components\CTE;

$stmt->cte('cte1', 'SELECT * FROM t1')->recursive();
// WITH RECURSIVE cte1 AS (SELECT * FROM t1) SELECT
```

<br>

### highPriority

`MariaDB` and `MySQL` only

```php
$stmt->highPriority();
// SELECT HIGH_PRIORITY
```

<br>

### straightJoinAll

`MariaDB` and `MySQL` only

```php
$stmt->straightJoinAll();
// SELECT STRAIGHT_JOIN
```

<br>

### sqlSmallResult

`MariaDB` and `MySQL` only

```php
$stmt->sqlSmallResult();
// SELECT SQL_SMALL_RESULT
```

<br>

### sqlBigResult

`MariaDB` and `MySQL` only

```php
$stmt->sqlBigResult();
// SELECT SQL_BIG_RESULT
```

<br>

### sqlBufferResult

`MariaDB` and `MySQL` only

```php
$stmt->sqlBufferResult();
// SELECT SQL_BUFFER_RESULT
```

<br>

### sqlCache

`MariaDB` only

```php
$stmt->sqlCache();
// SELECT SQL_CACHE
```

<br>

### sqlNoCache

`MariaDB` only

```php
$stmt->sqlNoCache();
// SELECT SQL_NO_CACHE
```

<br>

### sqlCalcFoundRows

`MariaDB` and `MySQL` only

```php
$stmt->sqlCalcFoundRows();
// SELECT SQL_CALC_FOUND_ROWS
```

<br>

### intoOutfile

`MariaDB` and `MySQL` only

See [Outfile](../components/outfile.md)

```php
use MichaelRushton\DB\SQL\Components\Outfile;

$stmt->intoOutfile('/path/to/file', function (Outfile $outfile)
{

});
// SELECT ... INTO OUTFILE '/path/to/file'
```

<br>

### intoDumpfile

`MariaDB` and `MySQL` only

```php
$stmt->intoDumpfile('/path/to/file');
// SELECT ... INTO DUMPFILE '/path/to/file'
```

<br>

### intoVar

`MariaDB` and `MySQL` only

```php
$stmt->intoVar('v1');
// SELECT ... INTO @v1
```

<br>

```php
$stmt->intoVar('v1', 'v2');
// SELECT ... INTO @v1, @v2
```

<br>

```php
$stmt->intoVar(['v1', 'v2']);
// SELECT ... INTO @v1, @v2
```

<br>

### into

`SQLServer` only

```php
$stmt->into('t2');
// SELECT ... INTO t2
```

<br>

### forUpdate

`MariaDB`, `MySQL`, and `PostgreSQL` only

```php
$stmt->forUpdate();
// SELECT ... FOR UPDATE
```

<br>

`MySQL` and `PostgreSQL` only

```php
$stmt->forUpdate('t1');
// SELECT ... FOR UPDATE OF t1
```

<br>

`MySQL` and `PostgreSQL` only

```php
$stmt->forUpdate('t1', 't2');
// SELECT ... FOR UPDATE OF t1, t2
```

<br>

`MySQL` and `PostgreSQL` only

```php
$stmt->forUpdate(['t1', 't2']);
// SELECT ... FOR UPDATE OF t1, t2
```

<br>

### forUpdateWait

`MariaDB` only

```php
$stmt->forUpdateWait(5);
// SELECT ... FOR UPDATE WAIT 5
```

<br>

### forUpdateNoWait

`MariaDB`, `MySQL` and `PostgreSQL` only

```php
$stmt->forUpdateNoWait();
// SELECT ... FOR UPDATE NOWAIT
```

<br>

`MySQL` and `PostgreSQL` only

```php
$stmt->forUpdateNoWait('t1');
// SELECT ... FOR UPDATE OF t1 NOWAIT
```

<br>

`MySQL` and `PostgreSQL` only

```php
$stmt->forUpdateNoWait('t1', 't2');
// SELECT ... FOR UPDATE OF t1, t2 NOWAIT
```

<br>

`MySQL` and `PostgreSQL` only

```php
$stmt->forUpdateNoWait(['t1', 't2']);
// SELECT ... FOR UPDATE OF t1, t2 NOWAIT
```

<br>

### forUpdateSkipLocked

`MariaDB`, `MySQL` and `PostgreSQL` only

```php
$stmt->forUpdateSkipLocked();
// SELECT ... FOR UPDATE SKIP LOCKED
```

<br>

`MySQL` and `PostgreSQL` only

```php
$stmt->forUpdateSkipLocked('t1');
// SELECT ... FOR UPDATE OF t1 SKIP LOCKED
```

<br>

`MySQL` and `PostgreSQL` only

```php
$stmt->forUpdateSkipLocked('t1', 't2');
// SELECT ... FOR UPDATE OF t1, t2 SKIP LOCKED
```

<br>

`MySQL` and `PostgreSQL` only

```php
$stmt->forUpdateSkipLocked(['t1', 't2']);
// SELECT ... FOR UPDATE OF t1, t2 SKIP LOCKED
```

<br>

### forNoKeyUpdate

`PostgreSQL` only

```php
$stmt->forNoKeyUpdate();
// SELECT ... FOR NO KEY UPDATE
```

<br>

```php
$stmt->forNoKeyUpdate('t1');
// SELECT ... FOR NO KEY UPDATE OF t1
```

<br>

```php
$stmt->forNoKeyUpdate('t1', 't2');
// SELECT ... FOR NO KEY UPDATE OF t1, t2
```

<br>

```php
$stmt->forNoKeyUpdate(['t1', 't2']);
// SELECT ... FOR NO KEY UPDATE OF t1, t2
```

<br>

### forNoKeyUpdateNoWait

`PostgreSQL` only

```php
$stmt->forNoKeyUpdateNoWait();
// SELECT ... FOR NO KEY UPDATE NOWAIT
```

<br>

```php
$stmt->forNoKeyUpdateNoWait('t1');
// SELECT ... FOR NO KEY UPDATE OF t1 NOWAIT
```

<br>

```php
$stmt->forNoKeyUpdateNoWait('t1', 't2');
// SELECT ... FOR NO KEY UPDATE OF t1, t2 NOWAIT
```

<br>

```php
$stmt->forNoKeyUpdateNoWait(['t1', 't2']);
// SELECT ... FOR NO KEY UPDATE OF t1, t2 NOWAIT
```

<br>

### forNoKeyUpdateSkipLocked

`PostgreSQL` only

```php
$stmt->forNoKeyUpdateSkipLocked();
// SELECT ... FOR NO KEY UPDATE SKIP LOCKED
```

<br>

```php
$stmt->forNoKeyUpdateSkipLocked('t1');
// SELECT ... FOR NO KEY UPDATE OF t1 SKIP LOCKED
```

<br>

```php
$stmt->forNoKeyUpdateSkipLocked('t1', 't2');
// SELECT ... FOR NO KEY UPDATE OF t1, t2 SKIP LOCKED
```

<br>

```php
$stmt->forNoKeyUpdateSkipLocked(['t1', 't2']);
// SELECT ... FOR NO KEY UPDATE OF t1, t2 SKIP LOCKED
```

<br>

### forShare

`MySQL` and `PostgreSQL` only

```php
$stmt->forShare();
// SELECT ... FOR SHARE
```

<br>

```php
$stmt->forShare('t1');
// SELECT ... FOR SHARE OF t1
```

<br>

```php
$stmt->forShare('t1', 't2');
// SELECT ... FOR SHARE OF t1, t2
```

<br>

```php
$stmt->forShare(['t1', 't2']);
// SELECT ... FOR SHARE OF t1, t2
```

<br>

### forShareNoWait

`MySQL` and `PostgreSQL` only

```php
$stmt->forShareNoWait();
// SELECT ... FOR SHARE NOWAIT
```

<br>

```php
$stmt->forShareNoWait('t1');
// SELECT ... FOR SHARE OF t1 NOWAIT
```

<br>

```php
$stmt->forShareNoWait('t1', 't2');
// SELECT ... FOR SHARE OF t1, t2 NOWAIT
```

<br>

```php
$stmt->forShareNoWait(['t1', 't2']);
// SELECT ... FOR SHARE OF t1, t2 NOWAIT
```

<br>

### forShareSkipLocked

`MySQL` and `PostgreSQL` only

```php
$stmt->forShareSkipLocked();
// SELECT ... FOR SHARE SKIP LOCKED
```

<br>

```php
$stmt->forShareSkipLocked('t1');
// SELECT ... FOR SHARE OF t1 SKIP LOCKED
```

<br>

```php
$stmt->forShareSkipLocked('t1', 't2');
// SELECT ... FOR SHARE OF t1, t2 SKIP LOCKED
```

<br>

```php
$stmt->forShareSkipLocked(['t1', 't2']);
// SELECT ... FOR SHARE OF t1, t2 SKIP LOCKED
```

<br>

### forKeyShare

`PostgreSQL` only

```php
$stmt->forKeyShare();
// SELECT ... FOR KEY SHARE
```

<br>

```php
$stmt->forKeyShare('t1');
// SELECT ... FOR KEY SHARE OF t1
```

<br>

```php
$stmt->forKeyShare('t1', 't2');
// SELECT ... FOR KEY SHARE OF t1, t2
```

<br>

```php
$stmt->forKeyShare(['t1', 't2']);
// SELECT ... FOR KEY SHARE OF t1, t2
```

<br>

### forKeyShareNoWait

`PostgreSQL` only

```php
$stmt->forKeyShareNoWait();
// SELECT ... FOR KEY SHARE NOWAIT
```

<br>

```php
$stmt->forKeyShareNoWait('t1');
// SELECT ... FOR KEY SHARE OF t1 NOWAIT
```

<br>

```php
$stmt->forKeyShareNoWait('t1', 't2');
// SELECT ... FOR KEY SHARE OF t1, t2 NOWAIT
```

<br>

```php
$stmt->forKeyShareNoWait(['t1', 't2']);
// SELECT ... FOR KEY SHARE OF t1, t2 NOWAIT
```

<br>

### forKeyShareSkipLocked

`PostgreSQL` only

```php
$stmt->forKeyShareSkipLocked();
// SELECT ... FOR KEY SHARE SKIP LOCKED
```

<br>

```php
$stmt->forKeyShareSkipLocked('t1');
// SELECT ... FOR KEY SHARE OF t1 SKIP LOCKED
```

<br>

```php
$stmt->forKeyShareSkipLocked('t1', 't2');
// SELECT ... FOR KEY SHARE OF t1, t2 SKIP LOCKED
```

<br>

```php
$stmt->forKeyShareSkipLocked(['t1', 't2']);
// SELECT ... FOR KEY SHARE OF t1, t2 SKIP LOCKED
```

<br>

### lockInShareMode

`MariaDB` and `MySQL` only

```php
$stmt->lockInShareMode();
// SELECT ... LOCK IN SHARE MODE
```

<br>

### lockInShareModeWait

`MariaDB` only

```php
$stmt->lockInShareModeWait(5);
// SELECT ... LOCK IN SHARE MODE WAIT 5
```

<br>

### lockInShareModeNoWait

`MariaDB` only

```php
$stmt->lockInShareModeNoWait();
// SELECT ... LOCK IN SHARE MODE NOWAIT
```

<br>

### lockInShareModeSkipLocked

`MariaDB` only

```php
$stmt->lockInShareModeSkipLocked();
// SELECT ... LOCK IN SHARE MODE SKIP LOCKED
```

### when

```php
$stmt->when($var, if_true: function ($stmt, $var)
{
    $stmt->where('c1', $var);
});
```

```php
$stmt->when($var, if_false: function ($stmt, $var)
{
    $stmt->whereNull('c1');
});
```
