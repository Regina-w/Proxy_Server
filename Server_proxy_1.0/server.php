<?php
//确保在连接客户端时不会超时
set_time_limit(0);

$ip = '127.0.0.1';
$port = 80;

/*
 +-------------------------------
 *    @socket通信整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_bind
 *    @socket_listen
 *    @socket_accept
 *    @socket_read
 *    @socket_write
 *    @socket_close
 +--------------------------------
 */

/*----------------    以下操作都是手册上的    -------------------*/
// 产生一个socket，
if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo "socket_create() 失败的原因是:".socket_strerror($sock)."\n";
}else{
    echo 'Socket_create() is success'.'<br>';
}
//把socket绑定到一个IP地址和端口上
if(($ret = socket_bind($sock,$ip,$port)) < 0) {
    echo "socket_bind() 失败的原因是:".socket_strerror($ret)."\n";
}else{
    echo 'Socket_bind() is success'.'<br>';
}
//监听指定socket的所有连接
if(($ret = socket_listen($sock,4)) < 0) {
    echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
}else{
    echo 'Socket_listen() is success'.'<br>';
}

$count = 0;
echo "do will run!!!";
do {
    //监听socket转化为连接socket
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
        break;
    } else {

        //发到客户端
        $msg ="晚上吼哇\n";
        //写数据到socket缓存
        socket_write($msgsock, $msg, strlen($msg));

        echo "测试成功\n";
        //接受到的客户端信息
        $buf = socket_read($msgsock,8192);


        $talkback = "收到的信息:$buf\n";
        echo $talkback;

        if(++$count >= 5){
            break;
        };


    }
    //关闭连接socket
    socket_close($msgsock);

} while (true);
//关闭一个socket资源
socket_close($sock);
