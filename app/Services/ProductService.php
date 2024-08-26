<?php

namespace App\Services;

use App\Contracts\IApiService;
use App\Dto\DummyRequest;
use App\Exceptions\InvalidResponseException;
use App\Http\Controllers\Product;
use Illuminate\Support\Collection;

class ProductService implements IApiService
{

    protected DummyJsonService $dummyJsonService;

    const API_PRODUCT_URI = 'products';

    public function __construct(DummyJsonService $dummyJsonService)
    {
        $this->dummyJsonService = $dummyJsonService;
    }

    /**
     * @throws InvalidResponseException
     */
    public function fetchAll(): ?Collection
    {
        return $this->dummyJsonService->sendRequest(
            new DummyRequest(
                'GET',
                self::API_PRODUCT_URI,
            )
        );
    }

    /**
     * @throws InvalidResponseException
     */
    public function fetchByKeyWord(string $keyword): ?Collection
    {
        return $this->dummyJsonService->sendRequest(
            new DummyRequest(
                'GET',
                self::API_PRODUCT_URI . '/search',
                ['query' => [
                    'q' => $keyword
                ]]
            )
        );
    }

    /**
     * @throws InvalidResponseException
     */
    public function create(array $params): ?Collection
    {
        return $this->dummyJsonService->sendRequest(
            new DummyRequest(
                'POST',
                self::API_PRODUCT_URI . '/add',
                ['form_params' => $params]
            )
        );
    }
}
