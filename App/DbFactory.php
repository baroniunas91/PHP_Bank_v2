<?php
namespace App\DB;

use App\DB\JsonDb as Db;
use App\DB\MariaDb;

class DbFactory {
    public static function makeDatabase($db) {
        if($db == 'JsonDb') {
            return new Db;
        }
        return new MariaDb;
    }
}