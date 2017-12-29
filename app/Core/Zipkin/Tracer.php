<?php

namespace App\Core\Zipkin;

use App\Core\InstanceTrait;
use Xin\Thrift\ZipkinService\Options;
use Zipkin\Propagation\TraceContext;
use Zipkin\Tracer as ZipkinTracer;

class Tracer
{
    use InstanceTrait;

    /**
     * @desc
     * @param ZipkinTracer $tracer
     * @param              $spanName
     * @return array
     */
    public function newTrace(ZipkinTracer $tracer, $spanName)
    {
        $trace = $tracer->newTrace();
        $trace->setName($spanName);
        $trace->start();

        $context = $trace->getContext();
        $options = new Options();
        $options->traceId = $context->getTraceId();
        $options->parentSpanId = $context->getParentId();
        $options->spanId = $context->getSpanId();
        $options->sampled = $context->isSampled();

        return [$trace, $options];
    }

    /**
     * @param ZipkinTracer $tracer
     * @param $spanName
     * @param Options $options
     * @return array
     */
    public function newChild(ZipkinTracer $tracer, $spanName, Options $options)
    {
        $context = TraceContext::create(
            $options->traceId,
            $options->spanId,
            $options->parentSpanId,
            $options->sampled
        );
        $trace = $tracer->newChild($context);
        $trace->setName($spanName);
        $trace->start();
        $context = $trace->getContext();
        $options = new Options();
        $options->traceId = $context->getTraceId();
        $options->parentSpanId = $context->getParentId();
        $options->spanId = $context->getSpanId();
        $options->sampled = $context->isSampled();
        return [$trace, $options];
    }
}