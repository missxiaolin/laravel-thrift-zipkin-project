<?php
namespace App\Core\Zipkin;

use Illuminate\Contracts\Queue\ShouldQueue;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;


class AsyncHttpReporter implements ShouldQueue
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
     * @param $uri
     */
    public function __construct(ClientInterface $client, LoggerInterface $logger, array $options = [], $uri = '')
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

    }
}