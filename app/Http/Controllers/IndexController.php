<?php

namespace App\Http\Controllers;

use App\Core\Zipkin\ZipkinClient;
use App\Thrift\Clients\AppClient;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $request->all();
        ZipkinClient::getInstance()->setOptions($data['options']);
        $welcome = AppClient::getInstance()->welcome(ZipkinClient::getInstance()->options);
        return api_response($welcome);

    }
}