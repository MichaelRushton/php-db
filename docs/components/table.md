## Table

```php
use MichaelRushton\DB\SQL\Components\Table;

$table = new Table('t1');
// t1
```

<br>

### only

```php
$table->only();
// ONLY t1
```

<br>

### partition

```php
$table->partition('p1');
// t1 PARTITION (p1)
```

<br>

```php
$table->partition('p1', 'p2');
// t1 PARTITION (p1, p2)
```

<br>

```php
$table->partition(['p1', 'p2']);
// t1 PARTITION (p1, p2)
```

<br>

### forPortionOf

```php
$table->forPortionOf('date_period', '2025-01-01', '2025-01-31');
// t1 FOR PORTION OF date_period FROM '2025-01-01' TO '2025-01-31'
```

<br>

```php
$table->forPortionOf('date_period', new \DateTime('2025-01-01'), new \DateTime('2025-01-31'));
// t1 FOR PORTION OF date_period FROM '2025-01-01 00:00:00' TO '2025-01-31 00:00:00'
```

<br>

### as

```php
$table->as('t2');
// t1 t2
```

<br>

### useIndex

```php
$table->useIndex();
// t1 USE INDEX ()
```

<br>

```php
$table->useIndex('i1');
// t1 USE INDEX (i1)
```

<br>

```php
$table->useIndex('i1', 'i2');
// t1 USE INDEX (i1, i2)
```

<br>

```php
$table->useIndex(['i1', 'i2']);
// t1 USE INDEX (i1, i2)
```

<br>

### useIndexForOrderBy

```php
$table->useIndexForOrderBy();
// t1 USE INDEX FOR ORDER BY ()
```

<br>

```php
$table->useIndexForOrderBy('i1');
// t1 USE INDEX FOR ORDER BY (i1)
```

<br>

```php
$table->useIndexForOrderBy('i1', 'i2');
// t1 USE INDEX FOR ORDER BY (i1, i2)
```

<br>

```php
$table->useIndexForOrderBy(['i1', 'i2']);
// t1 USE INDEX FOR ORDER BY (i1, i2)
```

<br>

### useIndexForGroupBy

```php
$table->useIndexForGroupBy();
// t1 USE INDEX FOR GROUP BY ()
```

<br>

```php
$table->useIndexForGroupBy('i1');
// t1 USE INDEX FOR GROUP BY (i1)
```

<br>

```php
$table->useIndexForGroupBy('i1', 'i2');
// t1 USE INDEX FOR GROUP BY (i1, i2)
```

<br>

```php
$table->useIndexForGroupBy(['i1', 'i2']);
// t1 USE INDEX FOR GROUP BY (i1, i2)
```

<br>

### ignoreIndex

```php
$table->ignoreIndex('i1');
// t1 IGNORE INDEX (i1)
```

<br>

```php
$table->ignoreIndex('i1', 'i2');
// t1 IGNORE INDEX (i1, i2)
```

<br>

```php
$table->ignoreIndex(['i1', 'i2']);
// t1 IGNORE INDEX (i1, i2)
```

<br>

### ignoreIndexForOrderBy

```php
$table->ignoreIndexForOrderBy('i1');
// t1 IGNORE INDEX FOR ORDER BY (i1)
```

<br>

```php
$table->ignoreIndexForOrderBy('i1', 'i2');
// t1 IGNORE INDEX FOR ORDER BY (i1, i2)
```

<br>

```php
$table->ignoreIndexForOrderBy(['i1', 'i2']);
// t1 IGNORE INDEX FOR ORDER BY (i1, i2)
```

<br>

### ignoreIndexForGroupBy

```php
$table->ignoreIndexForGroupBy('i1');
// t1 IGNORE INDEX FOR GROUP BY (i1)
```

<br>

```php
$table->ignoreIndexForGroupBy('i1', 'i2');
// t1 IGNORE INDEX FOR GROUP BY (i1, i2)
```

<br>

```php
$table->ignoreIndexForGroupBy(['i1', 'i2']);
// t1 IGNORE INDEX FOR GROUP BY (i1, i2)
```

<br>

### forceIndex

```php
$table->forceIndex('i1');
// t1 FORCE INDEX (i1)
```

<br>

```php
$table->forceIndex('i1', 'i2');
// t1 FORCE INDEX (i1, i2)
```

<br>

```php
$table->forceIndex(['i1', 'i2']);
// t1 FORCE INDEX (i1, i2)
```

<br>

### forceIndexForOrderBy

```php
$table->forceIndexForOrderBy('i1');
// t1 FORCE INDEX FOR ORDER BY (i1)
```

<br>

```php
$table->forceIndexForOrderBy('i1', 'i2');
// t1 FORCE INDEX FOR ORDER BY (i1, i2)
```

<br>

```php
$table->forceIndexForOrderBy(['i1', 'i2']);
// t1 FORCE INDEX FOR ORDER BY (i1, i2)
```

<br>

### forceIndexForGroupBy

```php
$table->forceIndexForGroupBy('i1');
// t1 FORCE INDEX FOR GROUP BY (i1)
```

<br>

```php
$table->forceIndexForGroupBy('i1', 'i2');
// t1 FORCE INDEX FOR GROUP BY (i1, i2)
```

<br>

```php
$table->forceIndexForGroupBy(['i1', 'i2']);
// t1 FORCE INDEX FOR GROUP BY (i1, i2)
```
