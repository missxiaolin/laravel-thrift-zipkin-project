<?php

namespace App\Console\Commands\Thrift\Test;

use App\Thrift\Clients\AppClient;
use Illuminate\Console\Command;

class ArrayTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thrift:test@array';

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
            dump($client->arrayTest('小林'));
        } catch (\Exception $e) {
            dump($e->getMessage());
        }

    }
}
