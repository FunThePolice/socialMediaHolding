<?php

namespace App\Console\Commands;

use App\Enums\ImportModelEnum;
use App\Jobs\ImportRecords;
use App\Models\ImportableModel;
use App\Services\DummyJsonService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;

class ImportEntity extends Command
{
    use DispatchesJobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-entity {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(DummyJsonService $dummyJsonService): void
    {
        try {
            $model = $this->getModelFromArgument($this->argument('model'));

            if (!class_exists($model) || !is_subclass_of($model, ImportableModel::class)) {
                $this->error("Invalid model specified. Ensure the model exists and implements ImportableModel.");
            }
        } catch (\InvalidArgumentException $e) {
            $this->error($e->getMessage());
            return;
        }

        $modelInstance = app($model);

        $limit = 3;
        $skip = 0;

        DB::transaction(function () use ($dummyJsonService, $modelInstance, $model, $limit, &$skip) {
            $this->importBatch($dummyJsonService, $modelInstance, $model, $limit, $skip);
        });
    }

    protected function importBatch(DummyJsonService $dummyJsonService, ImportableModel $localModel, string $model, int $limit, int &$skip): void
    {
        do {
            $results = $dummyJsonService->search($localModel, $limit, $skip);

            if (is_null($results)) {
                $this->warn("No results found or an error occurred.");
                return;
            }

            ImportRecords::dispatch($model, $results)->onQueue('products');
            $skip += $limit;

        } while ($limit + $skip <= $results['total']);
    }

    protected function getModelFromArgument(string $argument): string
    {
        $modelName = collect(ImportModelEnum::cases())
            ->first(function ($item) use ($argument) {
                return $item->name === $argument;
            });

        if (!$modelName->value) {
            throw new \InvalidArgumentException("Invalid model provided.");
        }

        return $modelName->value;
    }
}
