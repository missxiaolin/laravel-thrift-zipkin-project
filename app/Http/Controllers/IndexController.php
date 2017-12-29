<?php

namespace App\Http\Controllers;

use App\Core\Zipkin\Tracer;
use App\Core\Zipkin\ZipkinClient;
use App\Thrift\Clients\AppClient;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $tracer = tracer();
        $uri = $request->url();
        list($new_tracer, $options) = Tracer::getInstance()->newTrace($tracer, $uri);
        ZipkinClient::getInstance()->setOptions($options);
        $version = AppClient::getInstance()->welcome(ZipkinClient::getInstance()->options);
        $new_tracer->finish();
        $tracer->flush();
    }
}