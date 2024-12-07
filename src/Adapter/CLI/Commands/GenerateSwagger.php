<?php

namespace Src\Adapter\CLI\Commands;

use Illuminate\Console\Command;
use OpenApi\Generator;

class GenerateSwagger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "swagger:generate";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate Swagger documentation";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info("Generating Swagger documentation...");

        $openapi = Generator::scan([
            base_path("app/Http/Controllers"),
            base_path("src/Adapter/Http"),
        ]);

        header("Content-Type: application/x-yaml");
        file_put_contents(base_path("docs/openapi.json"), $openapi?->toJson());

        $this->info("Swagger documentation generated successfully!");

        return self::SUCCESS;
    }
}
