namespace php Xin.Thrift.MicroService
namespace go vendor.service

exception ThriftException {
  1: i32 code,
  2: string message
}

service App {
    // 返回项目版本号
    string version() throws (1:ThriftException ex)

    // 测试异常抛出
    string testException() throws(1:ThriftException ex)

    // 返回数组测试
    map<i32,string> arrayTest(1:string username) throws (1:ThriftException ex)
}