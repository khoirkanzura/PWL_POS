<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeScssFile extends Command
{
    protected $signature = 'make:scss {name}';
    protected $description = 'Generate a new SCSS file in resources/sass';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = resource_path("sass/{$name}.scss");

        if (File::exists($path)) {
            $this->error("File {$name}.scss already exists!");
            return;
        }

        File::ensureDirectoryExists(resource_path('sass'));
        File::put($path, '');

        $this->info("SCSS file {$name}.scss created successfully!");
    }
}
