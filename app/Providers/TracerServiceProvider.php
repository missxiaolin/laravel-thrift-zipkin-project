<?php

namespace App\Providers;

use App\Core\Zipkin\AsyncHttpReporter;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use Monolog\Logger;
use Zipkin\Endpoint;
use Zipkin\Reporters\HttpLogging;
use Zipkin\Samplers\BinarySampler;
use Zipkin\TracingBuilder;

class TracerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('tracer', function () {
            $endpoint = Endpoint::create(config('app.name'));
            $client = new Client();
//            // Logger to stdout
            $logger = new Logger('debug');
//
//            $reporter = new HttpLogging($client, $logger);
            $reporter = new AsyncHttpReporter($client, $logger);
            $sampler = BinarySampler::createAsAlwaysSample();
            $tracing = TracingBuilder::create()
                ->havingLocalEndpoint($endpoint)
                ->havingSampler($sampler)
                ->havingReporter($reporter)
                ->build();

            return $tracing->getTracer();
        });
    }
}
