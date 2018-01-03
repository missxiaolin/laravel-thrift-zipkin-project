<?php
namespace App\Core\Zipkin;

use App\Core\InstanceTrait;
use Xin\Thrift\ZipkinService\Options;
use Exception;
use Zipkin\Propagation\TraceContext;

class ZipkinClient
{
    use InstanceTrait;

    public $context;

    public $options;

    public function __construct()
    {
//        if (defined('IS_MEMORY_RESIDENT') && IS_MEMORY_RESIDENT === true) {
//            throw new Exception('CLI模式下，不允许使用单例对象作为调用链存储方式');
//        }
    }

    public function setOptions(Options $options)
    {
        $context = TraceContext::create(
            $options->traceId,
            $options->spanId,
            $options->parentSpanId,
            $options->sampled
        );

        $this->context = $context;
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getContext()
    {
        return $this->context;
    }
}