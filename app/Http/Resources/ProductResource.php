<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => Arr::get($this, 'title'),
            'description' => Arr::get($this, 'description'),
            'sku' => Arr::get($this, 'sku'),
        ];
    }
}
