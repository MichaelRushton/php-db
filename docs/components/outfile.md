## Outfile

```php
use MichaelRushton\DB\SQL\Components\Outfile;

$stmt->intoOutfile('/path/to/file', function (Outfile $outfile)
{

});
// SELECT ... INTO OUTFILE '/path/to/file'
```

<br>

### characterSet

```php
$outfile->characterSet('utf8mb4');
// SELECT ... INTO OUTFILE '/path/to/file' CHARACTER SET utf8mb4
```

<br>

### fieldsTerminatedBy

```php
$outfile->fieldsTerminatedBy(',');
// SELECT ... INTO OUTFILE '/path/to/file' FIELDS TERMINATED BY ','
```

<br>

### fieldsEnclosedBy

```php
$outfile->fieldsEnclosedBy('"');
// SELECT ... INTO OUTFILE '/path/to/file' FIELDS ENCLOSED BY '"'
```

<br>

### fieldsOptionallyEnclosedBy

```php
$outfile->fieldsOptionallyEnclosedBy('"');
// SELECT ... INTO OUTFILE '/path/to/file' FIELDS OPTIONALLY ENCLOSED BY '"'
```

<br>

### fieldsEscapedBy

```php
$outfile->fieldsEscapedBy('\\');
// SELECT ... INTO OUTFILE '/path/to/file' FIELDS ESCAPED BY '\'
```

<br>

### linesStartingBy

```php
$outfile->linesStartingBy('');
// SELECT ... INTO OUTFILE '/path/to/file' LINES STARTING BY ''
```

<br>

### linesTerminatedBy

```php
$outfile->linesTerminatedBy('\n');
// SELECT ... INTO OUTFILE '/path/to/file' LINES TERMINATED BY '\n'
```
