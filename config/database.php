<?php

function getDatabaseConfig(): array
{
    return [
        "database" => [
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=php_login_management",
                "username" => "mysql_rifqi",
                "password" => "DBroot123@"
            ]
        ]
    ];
}
