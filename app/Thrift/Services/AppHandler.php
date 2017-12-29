<?php
// +----------------------------------------------------------------------
// | AppHandler.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Thrift\Services;

use Xin\Thrift\MicroService\AppIf;
use Xin\Thrift\MicroService\ThriftException;
use Xin\Thrift\ZipkinService\Options;

class AppHandler extends Handler implements AppIf
{
    /**
     * @desc   返回项目版本号
     * @author limx
     * @return mixed
     * @throws ThriftException
     */
    public function version()
    {
        return config('app.version');
    }

    public function arrayTest($username)
    {
        return [
            $username
        ];
    }

    /**
     * 测试异常抛出
     * @param Options $options
     * @throws ThriftException
     */
    public function testException(Options $options)
    {
        throw new ThriftException([
            'code' => '400',
            'message' => '异常测试',
        ]);
    }

    public function welcome(Options $options)
    {
        $version = $this->test1();
        return "You're xiaolin laravel-project {$version}";

    }

    public function test1()
    {
        return config('app.version');
    }
}