## Window

```php
use MichaelRushton\DB\SQL\Components\Window;

$stmt->window('w1', function (Window $window)
{

});
// SELECT ... WINDOW w1 AS ()
```

<br>

### specName

```php
$window->specName('w2');
// w1 AS (w2)
```

<br>

### partitionBy

```php
$window->partitionBy('c1');
// w1 AS (PARTITION BY c1)
```

<br>

```php
$window->partitionBy('c1', 'c2');
// w1 AS (PARTITION BY c1, c2)
```

<br>

```php
$window->partitionBy(['c1', 'c2']);
// w1 AS (PARTITION BY c1, c2)
```

<br>

### orderBy

```php
$window->orderBy('c1');
// w1 AS (ORDER BY c1)
```

<br>

```php
$window->orderBy('c1', 'c2');
// w1 AS (ORDER BY c1, c2)
```

<br>

```php
$window->orderBy(['c1', 'c2']);
// w1 AS (ORDER BY c1, c2)
```

<br>

### orderByDesc

```php
$window->orderByDesc('c1');
// w1 AS (ORDER BY c1 DESC)
```

<br>

### orderByNullsFirst

```php
$window->orderByNullsFirst('c1');
// w1 AS (ORDER BY c1 ASC NULLS FIRST)
```

<br>

### orderByNullsLast

```php
$window->orderByNullsLast('c1');
// w1 AS (ORDER BY c1 ASC NULLS LAST)
```

<br>

### orderByDescNullsFirst

```php
$window->orderByDescNullsFirst('c1');
// w1 AS (ORDER BY c1 DESC NULLS FIRST)
```

<br>

### orderByDescNullsLast

```php
$window->orderByDescNullsLast('c1');
// w1 AS (ORDER BY c1 DESC NULLS LAST)
```

<br>

### range

```php
$window->range();
// w1 AS (... RANGE ...)
```

<br>

### rows

```php
$window->rows();
// w1 AS (... ROWS ...)
```

<br>

### groups

```php
$window->groups();
// w1 AS (... GROUPS ...)
```

<br>

### currentRow

```php
$window->currentRow();
// w1 AS (... CURRENT ROW)
```

<br>

### unboundedPreceding

```php
$window->unboundedPreceding();
// w1 AS (... UNBOUNDED PRECEDING)
```

<br>

### unboundedFollowing

```php
$window->unboundedFollowing();
// w1 AS (... UNBOUNDED FOLLOWING)
```

<br>

### preceding

```php
$window->preceding(10);
// w1 AS (... 10 PRECEDING)
```

<br>

### following

```php
$window->following(10);
// w1 AS (... 10 FOLLOWING)
```

<br>

### betweenCurrentRow

```php
$window->betweenCurrentRow();
// w1 AS (... BETWEEN CURRENT ROW ...)
```

<br>

### betweenUnboundedPreceding

```php
$window->betweenUnboundedPreceding();
// w1 AS (... BETWEEN UNBOUNDED PRECEDING ...)
```

<br>

### betweenUnboundedFollowing

```php
$window->betweenUnboundedFollowing();
// w1 AS (... BETWEEN UNBOUNDED FOLLOWING ...)
```

<br>

### betweenPreceding

```php
$window->betweenPreceding(10);
// w1 AS (... BETWEEN 10 PRECEDING ...)
```

<br>

### betweenFollowing

```php
$window->betweenFollowing(10);
// w1 AS (... BETWEEN 10 FOLLOWING ...)
```

<br>

### andCurrentRow

```php
$window->andCurrentRow();
// w1 AS (... AND CURRENT ROW)
```

<br>

### andUnboundedPreceding

```php
$window->andUnboundedPreceding();
// w1 AS (... AND UNBOUNDED PRECEDING)
```

<br>

### andUnboundedFollowing

```php
$window->andUnboundedFollowing();
// w1 AS (... AND UNBOUNDED FOLLOWING)
```

<br>

### andPreceding

```php
$window->andPreceding(10);
// w1 AS (... AND 10 PRECEDING)
```

<br>

### andFollowing

```php
$window->andFollowing(10);
// w1 AS (... AND 10 FOLLOWING)
```

<br>

### excludeCurrentRow

```php
$window->excludeCurrentRow();
// w1 AS (... EXCLUDE CURRENT ROW)
```

<br>

### excludeGroup

```php
$window->excludeGroup();
// w1 AS (... EXCLUDE GROUP)
```

<br>

### excludeNoOthers

```php
$window->excludeNoOthers();
// w1 AS (... EXCLUDE NO OTHERS)
```

<br>

### excludeTies

```php
$window->excludeTies();
// w1 AS (... EXCLUDE TIES)
```
