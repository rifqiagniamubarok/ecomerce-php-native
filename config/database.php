<?php

function getDatabaseConfig(): array
{
    return [
        "database" => [
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=bobakuy_db",
                "username" => "mysql_rifqi",
                "password" => "DBroot123@"
            ]
            // "prod" => [
            //     "url" => "mysql:host=localhost:3306;dbname=bobakuy_db",
            //     "username" => "root",
            //     "password" => "@"
            // ]
        ]
    ];
}
