<?php

namespace App\Console\Commands;

use App\Dto\DummyRequest;
use App\Exceptions\InvalidResponseException;
use App\Services\DummyJsonService;
use App\Services\ProductService;
use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws InvalidResponseException
     */
    public function handle()
    {
         /** @var DummyJsonService $service */
        $service = app(DummyJsonService::class);
        $data = ['title' => 'mx'];
        $p = (new ProductService($service))->create($data);
        dd($p);
    }
}
