<?php

namespace App\Console\Commands;

use App\Builders\PackageBuilder;
use Illuminate\Console\Command;

class ScrapeSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:site {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape a site and return a JSON';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        $packages = PackageBuilder::scrape($name)->packages();

        $bar = $this->output->createProgressBar(count($packages));

        $bar->start();
        $this->newLine();

        $data = collect();
        foreach ($packages as $package) {
            $data->push([
                'title'       => $package->getTitle(),
                'description' => $package->getDescription(),
                'price'       => $package->getPrice(),
                'discount'    => $package->getDiscount(),
            ]);

            $bar->advance();
        }

        $this->newLine();
        $bar->finish();
        $this->newLine();

        $json = $data->sortByDesc('price')->toJson();

        $this->info($json);
    }
}
