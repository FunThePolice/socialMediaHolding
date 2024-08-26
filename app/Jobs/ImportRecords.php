<?php

namespace App\Jobs;

use App\Models\ImportableModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportRecords implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $localModel;
    public array $results;

    /**
     * Create a new job instance.
     */
    public function __construct(string $localModel, array $results)
    {
        $this->localModel = $localModel;
        $this->results = $results;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $localModel = app($this->localModel);
        $serialized = $localModel::getSerializer()::collection($this->results[$localModel::getSearchType()]);
        $localModel::upsert($serialized->resolve(), [$localModel::getUniqueId()]);
    }
}
