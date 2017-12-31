<?php
namespace App\Core\Zipkin;

use App\Jobs\Zipkin\ZipkinSend;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;
use Zipkin\Recording\Span;
use Zipkin\Reporter;


class AsyncHttpReporter implements Reporter
{

    const DEFAULT_OPTIONS = [
        'baseUrl' => 'http://localhost:9411',
        'endpoint' => '/api/v2/spans',
    ];

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var array
     */
    private $options;

    /**
     * ZipkinJob constructor.
     * @param ClientInterface $client
     * @param LoggerInterface $logger
     * @param array $options
     */
    public function __construct(ClientInterface $client, LoggerInterface $logger, array $options = [])
    {
        $this->client = $client;
        $this->logger = $logger;
        $this->options = array_merge(self::DEFAULT_OPTIONS, $options);
    }


    /**
     * @param Span[] $spans
     * @return void
     */
    public function report(array $spans)
    {
        $zipkin_job = new ZipkinSend($spans, $this->options);
        dispatch($zipkin_job);
    }
}