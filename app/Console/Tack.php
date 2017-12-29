<?php

namespace App\Console;

use App\Core\Zipkin\Tracer;
use App\Thrift\Clients\AppClient;
use Illuminate\Console\Command;

abstract class Tack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature;

    protected $newTracer;

    protected $tracer;

    protected $options;

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
        $this->init();
        $this->onConstruct();
//        $this->end();
    }

    /**
     * 初始化
     */
    protected function init()
    {
        $tracer = tracer();
        $this->tracer = $tracer;

        list($new_tracer, $options) = Tracer::getInstance()->newTrace($tracer, self::class);
        $this->newTracer = $new_tracer;
        $this->options = $options;
    }

    /**
     * 业务逻辑
     * @return mixed
     */
    abstract protected function onConstruct();

    /**
     * 执行结束
     */
    protected function end()
    {
        $this->newTracer->finish();
        $this->tracer->flush();
    }

}
