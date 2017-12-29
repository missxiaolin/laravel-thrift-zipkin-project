<?php

namespace App\Console\Commands\Thrift\Zipkin;


use App\Console\Tack;
use App\Core\Zipkin\ZipkinClient;
use App\Thrift\Clients\AppClient;

class ArrayTest extends Tack
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
     * 业务逻辑
     */
    protected function onConstruct()
    {
        // TODO: Implement onConstruct() method.
        try {
            ZipkinClient::getInstance()->setOptions($this->options);
            $welcome = AppClient::getInstance()->welcome(ZipkinClient::getInstance()->options);
            dump($welcome);
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }

}
