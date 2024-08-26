<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class ImportableModel extends Model
{

    abstract public static function getEntityToSearch(): string;

    abstract public static function getSearchType(): string;

    abstract public static function getSerializer():string;

    abstract public static function getUniqueId(): string;

}
