<?php

namespace App\Services;

use App\Contracts\IDummyRequest;
use App\Exceptions\InvalidResponseException;
use App\Models\ImportableModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DummyJsonService
{

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search(ImportableModel $model, int $limit, int $skip): ?array
    {
        $response = Http::timeout(5)->get(sprintf(
            '%s%s/search?q=%s&limit=%s&skip=%s',
            config('api.api_endpoint'),
            $model::getSearchType(),
            $model::getEntityToSearch(),
            $limit,
            $skip
        ));

        if (!$response->ok()) {
            return null;
        }

        return $response->json();
    }

    public function add(ImportableModel $model): ?array
    {
        $response = Http::timeout(5)->post(sprintf(
            '%s/%s/add',
            config('api_endpoint'),
            $model::getSearchType()
        ),
            $model->toJson()
        );

        if (!$response->created()) {
            return null;
        }

        return $response->json();
    }

}
