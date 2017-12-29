<?php
namespace App\Thrift\Services;

use App\Thrift\Services\Impl\AppHandlerImpl;
use Xin\Thrift\MicroService\AppIf;
use Xin\Thrift\MicroService\ThriftException;
use Xin\Thrift\ZipkinService\Options;

class AppHandler extends Handler implements AppIf
{
    protected $impl = AppHandlerImpl::class;

    /**
     * 返回项目版本号
     * @param Options $options
     * @return \Illuminate\Config\Repository|mixed
     */
    public function version(Options $options)
    {
        return parent::version($options);
    }

    public function arrayTest($username, Options $options)
    {
        return parent::arrayTest($username, $options);
    }

    /**
     * 测试异常抛出
     * @param Options $options
     * @throws ThriftException
     */
    public function testException(Options $options)
    {
        return parent::testException($options);
    }

    /**
     * @param Options $options
     * @return mixed
     */
    public function welcome(Options $options)
    {
        return parent::welcome($options);
    }
}