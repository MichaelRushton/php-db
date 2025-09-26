<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Outfile;

test('fields terminated by', function ($string, $expected) {

    expect((string) new Outfile('path')->fieldsTerminatedBy($string))
    ->toBe("'path' FIELDS TERMINATED BY '$expected'");

})
->with([
    [",", ","],
    ["','", "'',''"],
]);

test('fields enclosed by', function ($string, $expected) {

    expect((string) new Outfile('path')->fieldsEnclosedBy($string))
    ->toBe("'path' FIELDS ENCLOSED BY '$expected'");

})
->with([
    ['"', '"'],
    ["'", "''"],
]);

test('fields optionally enclosed by', function ($string, $expected) {

    expect((string) new Outfile('path')->fieldsOptionallyEnclosedBy($string))
    ->toBe("'path' FIELDS OPTIONALLY ENCLOSED BY '$expected'");

})
->with([
    ['"', '"'],
    ["'", "''"],
]);

test('fields escaped by', function ($string, $expected) {

    expect((string) new Outfile('path')->fieldsEscapedBy($string))
    ->toBe("'path' FIELDS ESCAPED BY '$expected'");

})
->with([
    ["\\\\", "\\\\"],
    ["'", "''"],
]);

test('fields', function () {

    expect(
        (string) new Outfile('path')
        ->fieldsTerminatedBy(",")
        ->fieldsEnclosedBy('"')
        ->fieldsOptionallyEnclosedBy('"')
        ->fieldsEscapedBy("\\\\")
    )
    ->toBe("'path' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\\\\'");

});
