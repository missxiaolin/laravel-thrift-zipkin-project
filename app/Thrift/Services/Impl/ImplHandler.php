<?php
namespace App\Thrift\Services\Impl;

use App\Core\InstanceTrait;
use Phalcon\Di\Injectable;

abstract class ImplHandler extends Injectable
{
    use InstanceTrait;
}