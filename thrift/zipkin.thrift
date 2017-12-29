namespace php Xin.Thrift.ZipkinService
namespace go vendor.zipkin

struct Options {
    1: string traceId,
    2: string parentSpanId,
    3: string spanId,
    4: string sampled,
}

exception ThriftException {
  1: i32 code,
  2: string message
}