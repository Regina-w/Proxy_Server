<?php
function getResponse($data)
{
  $param = explode(" ", $data['Head']);
  $header = "HTTP/1.1 200 OK\r\n";  
  $header.= "Content-Type: text/html;charset=ISO-8859-1\r\n";
  $header.= "\r\n";
  $msg = $header.$post;  
  return $msg;
}

function getRequest($data)
{
  $msg = explode("\r\n", $data);
  $request["Head"] = $msg[0];
  for($i = 1; $i < count($msg); $i++)
  {
    if(empty($msg[$i]))	continue;
    list($key, $value) = explode(':', $msg[$i]);
    $request[$key] = $value;
  }
  var_dump($request);
}
