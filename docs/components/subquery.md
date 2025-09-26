## Subquery

```php
$subquery = $connection->select()->from('t1')->toSubquery();
// (SELECT * FROM t1)
```

<br>

### all

```php
$subquery->all();
// ALL (SELECT * FROM t1)
```

<br>

### any

```php
$subquery->any();
// ANY (SELECT * FROM t1)
```

<br>

### exists

```php
$subquery->exists();
// EXISTS (SELECT * FROM t1)
```

<br>

### in

```php
$subquery->in();
// IN (SELECT * FROM t1)
```

<br>

### lateral

```php
$subquery->lateral();
// LATERAL (SELECT * FROM t1)
```

<br>

### as

```php
$subquery->as('s1');
// (SELECT * FROM t1) s1
```

<br>

### columns

```php
$subquery->columns('c1');
// (SELECT * FROM t1) (c1)
```

<br>

```php
$subquery->columns('c1', 'c2');
// (SELECT * FROM t1) (c1, c2)
```

<br>

```php
$subquery->columns(['c1', 'c2']);
// (SELECT * FROM t1) (c1, c2)
```
