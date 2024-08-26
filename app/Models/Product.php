<?php

namespace App\Models;

use App\Http\Resources\ProductResource;

class Product extends ImportableModel
{

    protected $guarded = ['id'];
    protected $table = 'products';

    public static function getEntityToSearch(): string
    {
        return 'iPhone';
    }

    public static function getSearchType(): string
    {
        return 'products';
    }

    public static function getSerializer():string
    {
        return ProductResource::class;
    }

    public static function getUniqueId(): string
    {
        return 'sku';
    }

}
