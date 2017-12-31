<?php

namespace App\Jobs\Zipkin;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Exception\GuzzleException;
use Zipkin\Recording\Span;
use GuzzleHttp\Client;
use Monolog\Logger;

class ZipkinSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $spans;

    public $options;

    /**
     * Zipkin constructor.
     * @param array $spans
     * @param array $options
     */
    public function __construct(array $spans, array $options)
    {
        $this->spans = $spans;
        $this->options = $options;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $spans = $this->spans;
        $body = json_encode(array_map(function (Span $span) {
            return $span->toArray();
        }, $spans));

        $client = new Client();
        $logger = new Logger('debug');

        try {
            $client->request(
                'POST',
                $this->options['baseUrl'] . $this->options['endpoint'],
                ['body' => $body]
            );
        } catch (GuzzleException $e) {
            $logger->error(sprintf('traces were lost: %s', $e->getMessage()));
        }
    }
}
