<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\CTE;
use MichaelRushton\DB\SQL\Components\Raw;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('with', function ($stmt, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->with('cte', $stmt, fn (CTE $cte) => $cte->materialized())
    )
    ->toBe("WITH cte AS MATERIALIZED (SELECT * WHERE c1 = ?) SELECT *");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['SELECT * WHERE c1 = ?'],
    [new Raw("SELECT * WHERE c1 = ?", 1), [1]],
    [fn (SQLiteSelect $stmt) => $stmt->where('c1', 1), [1]],
]);

test('recursive', function () {

    expect(
        (string) new SQLiteSelect(Get::connection())
        ->with('cte', 'SELECT')
        ->recursive()
    )
    ->toBe("WITH RECURSIVE cte AS (SELECT) SELECT *");

});

test('with multiple', function () {

    expect(
        (string) new SQLiteSelect(Get::connection())
        ->with('cte1', 'SELECT 1')
        ->with('cte2', 'SELECT 2')
    )
    ->toBe("WITH cte1 AS (SELECT 1), cte2 AS (SELECT 2) SELECT *");

});
