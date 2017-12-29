<?php

namespace App\Console\Commands\Thrift\Test;

use App\Core\Zipkin\ZipkinClient;
use App\Thrift\Clients\AppClient;
use Illuminate\Console\Command;

class Version extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thrift:test@version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        try {
            $client = AppClient::getInstance();
            $this->info($client->version(ZipkinClient::getInstance()->options));
        } catch (\Exception $e) {
            dump($e->getMessage());
        }

    }
}
