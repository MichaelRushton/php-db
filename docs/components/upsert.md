## Upsert

```php
use MichaelRushton\DB\SQL\Components\Upsert;

$stmt->onConflictDoUpdateSet('c1', $param, function (Upsert $upsert)
{

});
// INSERT ... ON CONFLICT DO UPDATE SET c1 = ?
```

<br>

### columns

```php
$upsert->columns('c1');
// ON CONFLICT (c1) DO UPDATE SET c1 = ?
```

<br>

```php
$upsert->columns('c1', 'c2');
// ON CONFLICT (c1, c2) DO UPDATE SET c1 = ?
```

<br>

```php
$upsert->columns(['c1', 'c2']);
// ON CONFLICT (c1, c2) DO UPDATE SET c1 = ?
```

<br>

### whereIndex

See [where](../statements/select.md#where)

```php
$upsert->whereIndex('c1', $param);
// ON CONFLICT (c1) WHERE c1 = ? DO UPDATE SET c1 = ?
```

<br>

### onConstraint

```php
$upsert->onConstraint('constraint');
// ON CONFLICT ON CONSTRAINT constraint DO UPDATE SET c1 = ?
```

<br>

### where

See [where](../statements/select.md#where)

```php
$upsert->where('c1', $param);
// ON CONFLICT (c1) DO UPDATE SET c1 = ? WHERE c1 = ?
```
