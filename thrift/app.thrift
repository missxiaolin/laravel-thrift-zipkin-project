namespace php Xin.Thrift.MicroService
namespace go vendor.service

include 'zipkin.thrift'

exception ThriftException {
  1: i32 code,
  2: string message
}

service App {
    // 返回项目版本号
    string version(1: zipkin.Options options) throws (1:zipkin.ThriftException ex)

    // 欢迎语句
    string welcome (1: zipkin.Options options) throws (1:ThriftException ex)

    // 测试异常抛出
    string testException(1: zipkin.Options options) throws(1:zipkin.ThriftException ex)

    // 返回数组测试
    map<i32,string> arrayTest(1:string username) throws (1:ThriftException ex)
}