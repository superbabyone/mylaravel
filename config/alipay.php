<?php
return [
    //应用ID,您的APPID。
    'app_id' => "2016100100638349",

    //商户私钥
    'merchant_private_key' => "MIIEpAIBAAKCAQEA0/9V9tXN1IQHZ+/IFiQuSluG81kIdDCpbHvU4dKwlodOU5KTDpUPcVSTVj7cffY60kkHYz4WID6y4hFirMAsgudBjjD7P3vxX1vp2p5FuPen6P6Fwlp/xCtA3+qP5AzIhf670jxKlheIyO2a/niHAJRg57bJrStTaUYJRth6Kj4/TdwLaeDWlDkOJ5pb7Z0ClwnVULgJKMRGLi2+eWAV9Dqaz4L6+/RqdkdiBwZlmkzuOfL55Ro9QeWhSMLmjiUOZ6XPYbihGYKUo1k8WumGD6SKwEe8RrRK+d889YejJAUtPhT+onhjgZZZ28ObDPqEQKnhkjPfEeLR2j/5um2PxwIDAQABAoIBAHa51gvx+18cPgWQfS8hPid4kOByKVDg+9F8nGGIHEuBJXWabe9JvadLpWQ0ukl0/8ZLDe8fk0altorzD58N1R/OoaEff2YzZJ9yG0rLPuLzF79d481P36QeUSvV8pXWLusUGV4JVAAw1/MnVplTKNBDSO4cKWBpFkKr7YAWtnw28OGTSS0kJMV5ZxpH2SMDt2T6hPB7M/R7j66ieiBFJ4mxBfLBgyBk7q4A8ooc8CrOdkkDIt1mdi4bAcABeFqwdkCEZhV6aciyMf3LAOng6tvD+IZmYlSYrlyWpNcwHoD5PlhhdxfWaGVKovch7OE7qkRWL0ZVksK6qkldy6a0MJECgYEA9q6uo5nsL2AWyfhvKxH+l3xjZdxMYkrgOT6jQFlGOgS9Ob9nTeyMFdKfi+Qb90osgsu7kctC/gCbdz1CPwTqKiJzUCEn3RrACkKSnSvmwRrclYBLgdHmSYAM6jNv1r956Elk7n7YhHTQ+ZU8c0Dfy73bHE7RZ+jWKBQcCopDDokCgYEA3AFDqgdz6TIm2hAxiPyePbwFraSduoY0psJJY/w2kbWp84mZzdfIQYkTq/Vt1hEG+Xwyu/wBwU4hE3lbFcfC6OUST4ffm63vUlWxWbNP4Pg4jUlPtLZq5ky8WW1nZ7koi1ebcSFOKmUZ2rbxexj1AsswrE2qrQ9xDYr29cMSl88CgYEArRxi8+5ln8130J6mLPyAxIAHJQlXFTdkaOe7GsJLlRWUUT0v2rBgkkPvsPUQZxbHa7ZbV/HjfmqgrynvHlhtl8n7UEUkO3a1Q736M5AGbIdUOxoAYwcQ642QAp68ImDWxRsUWIXtne54ZF3FQUBKjSkb5Z6uN5RfDVsnXoIukrkCgYEAvwcWAqfv/FcApy2SZVi76ey9nXWnQxNO2lEuunN/ymtLw1wCQVqQ1l64xwIXOd2VCcHOp618tKUrUSZ5cWL/mYt1p7rZ7OpNOFeR48ovnK7LI9q5K7eNAKU2kgvN0qFSVBNgtA1wOp2IooFhEjqsW52kiKfzf8s9pb25C9Iy7b8CgYAxIzniT0PQQtDPzFedvNUS0sKmR8Zs+A0lLwvMJBTGSJDh+BFgw/8oP/xNz70GXoO1kEBUjOO8UohRHvhpyNcKOj9Ea2ZC6++MWkw8jwUEAM77TwlODJbDWpIEiEqy0BCAxRPi4A8aBXM7o+znWRmZjr/Fz8EOOZBl6s0O02prVA==",

    //异步通知地址
    'notify_url' => "http://39.106.95.78",

    //同步跳转
    'return_url' => "http://w3.shop.com/index/order/address",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0/9V9tXN1IQHZ+/IFiQuSluG81kIdDCpbHvU4dKwlodOU5KTDpUPcVSTVj7cffY60kkHYz4WID6y4hFirMAsgudBjjD7P3vxX1vp2p5FuPen6P6Fwlp/xCtA3+qP5AzIhf670jxKlheIyO2a/niHAJRg57bJrStTaUYJRth6Kj4/TdwLaeDWlDkOJ5pb7Z0ClwnVULgJKMRGLi2+eWAV9Dqaz4L6+/RqdkdiBwZlmkzuOfL55Ro9QeWhSMLmjiUOZ6XPYbihGYKUo1k8WumGD6SKwEe8RrRK+d889YejJAUtPhT+onhjgZZZ28ObDPqEQKnhkjPfEeLR2j/5um2PxwIDAQAB",
]
?>