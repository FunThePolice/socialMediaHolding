<?php

namespace App\Http\Controllers;

use App\Enums\ImportModelEnum;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class EntityController extends Controller
{

    public function index(): View
    {
        $availableEntities = ImportModelEnum::cases();
        return view('index', compact('availableEntities'));
    }

    public function import(string $model): RedirectResponse
    {
        Artisan::call('app:import-entity', ['model' => $model]);
        return redirect(route('index'));
    }

    public function create(ProductRequest $request): RedirectResponse
    {
        Product::create($request->validated());
        return redirect(route('index'));
    }

}
