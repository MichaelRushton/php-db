<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\SQLServerConnection;
use MichaelRushton\DB\Drivers\SQLServerDriver;

test('username', function (): void {

    expect(
        new SQLServerDriver()
        ->username('username')
        ->username
    )
    ->toBe('username');

});

test('password', function (): void {

    expect(
        new SQLServerDriver()
        ->password('password')
        ->password
    )
    ->toBe('password');

});

test('access token', function (): void {

    expect(
        new SQLServerDriver()
        ->accessToken('access_token')
        ->AccessToken
    )
    ->toBe('access_token');

});

test('app', function (): void {

    expect(
        new SQLServerDriver()
        ->app('app')
        ->APP
    )
    ->toBe('app');

});

test('application intent', function (): void {

    expect(
        new SQLServerDriver()
        ->applicationIntent('application_intent')
        ->ApplicationIntent
    )
    ->toBe('application_intent');

});

test('attach db file name', function (): void {

    expect(
        new SQLServerDriver()
        ->attachDBFileName('attach_db_file_name')
        ->AttachDBFileName
    )
    ->toBe('attach_db_file_name');

});

test('authentication', function (): void {

    expect(
        new SQLServerDriver()
        ->authentication('authentication')
        ->Authentication
    )
    ->toBe('authentication');

});

test('column encryption', function (): void {

    expect(
        new SQLServerDriver()
        ->columnEncryption('column_encryption')
        ->ColumnEncryption
    )
    ->toBe('column_encryption');

});

test('connection pooling', function (): void {

    expect(
        new SQLServerDriver()
        ->connectionPooling(1)
        ->ConnectionPooling
    )
    ->toBe(1);

});

test('connect retry count', function (): void {

    expect(
        new SQLServerDriver()
        ->connectRetryCount(1)
        ->ConnectRetryCount
    )
    ->toBe(1);

});

test('connect retry interface', function (): void {

    expect(
        new SQLServerDriver()
        ->ConnectRetryInterval(1)
        ->ConnectRetryInterval
    )
    ->toBe(1);

});

test('database', function (): void {

    expect(
        new SQLServerDriver()
        ->database('database')
        ->Database
    )
    ->toBe('database');

});

test('driver', function (): void {

    expect(
        new SQLServerDriver()
        ->driver('driver')
        ->Driver
    )
    ->toBe('driver');

});

test('encrypt', function (): void {

    expect(
        new SQLServerDriver()
        ->encrypt(1)
        ->Encrypt
    )
    ->toBe(1);

});

test('failover partner', function (): void {

    expect(
        new SQLServerDriver()
        ->failoverPartner('failover_partner')
        ->Failover_Partner
    )
    ->toBe('failover_partner');

});

test('key store authentication', function (): void {

    expect(
        new SQLServerDriver()
        ->keyStoreAuthentication('key_store_authentication')
        ->KeyStoreAuthentication
    )
    ->toBe('key_store_authentication');

});

test('key store principal id', function (): void {

    expect(
        new SQLServerDriver()
        ->keyStorePrincipalId('key_store_principal_id')
        ->KeyStorePrincipalId
    )
    ->toBe('key_store_principal_id');

});

test('key store secret', function (): void {

    expect(
        new SQLServerDriver()
        ->keyStoreSecret('key_store_secret')
        ->KeyStoreSecret
    )
    ->toBe('key_store_secret');

});

test('language', function (): void {

    expect(
        new SQLServerDriver()
        ->language('language')
        ->Language
    )
    ->toBe('language');

});

test('login timeout', function (): void {

    expect(
        new SQLServerDriver()
        ->loginTimeout('login_timeout')
        ->LoginTimeout
    )
    ->toBe('login_timeout');

});

test('multiple active result sets', function (): void {

    expect(
        new SQLServerDriver()
        ->multipleActiveResultSets(1)
        ->MultipleActiveResultSets
    )
    ->toBe(1);

});

test('multi subnet failover', function (): void {

    expect(
        new SQLServerDriver()
        ->multiSubnetFailover('multi_subnet_failover')
        ->MultiSubnetFailover
    )
    ->toBe('multi_subnet_failover');

});

test('quoted id', function (): void {

    expect(
        new SQLServerDriver()
        ->quotedId(1)
        ->QuotedId
    )
    ->toBe(1);

});

test('scrollable', function (): void {

    expect(
        new SQLServerDriver()
        ->scrollable('scrollable')
        ->Scrollable
    )
    ->toBe('scrollable');

});

test('server', function (): void {

    expect(
        new SQLServerDriver()
        ->server('server')
        ->Server
    )
    ->toBe('server');

});

test('trace file', function (): void {

    expect(
        new SQLServerDriver()
        ->traceFile('trace_file')
        ->TraceFile
    )
    ->toBe('trace_file');

});

test('trace on', function (): void {

    expect(
        new SQLServerDriver()
        ->traceOn(1)
        ->TraceOn
    )
    ->toBe(1);

});

test('transaction isolation', function (): void {

    expect(
        new SQLServerDriver()
        ->transactionIsolation('transaction_isolation')
        ->TransactionIsolation
    )
    ->toBe('transaction_isolation');

});

test('transparent network ip resolution', function (): void {

    expect(
        new SQLServerDriver()
        ->transparentNetworkIPResolution('transparent_network_ip_resolution')
        ->TransparentNetworkIPResolution
    )
    ->toBe('transparent_network_ip_resolution');

});

test('trust server certificate', function (): void {

    expect(
        new SQLServerDriver()
        ->trustServerCertificate(1)
        ->TrustServerCertificate
    )
    ->toBe(1);

});

test('wsid', function (): void {

    expect(
        new SQLServerDriver()
        ->wsid('wsid')
        ->WSID
    )
    ->toBe('wsid');

});

test('connection', function (): void {

    expect(new SQLServerDriver()->connection())
    ->toBeInstanceOf(SQLServerConnection::class);

});

test('dsn', function (): void {

    expect(
        new SQLServerDriver()
        ->database('db')
        ->dsn()
    )
    ->toBe('sqlsrv:Database=db;Server=');

});
