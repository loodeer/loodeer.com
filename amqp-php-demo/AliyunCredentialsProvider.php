<?php
/**
 * Created by PhpStorm.
 * User: luzuheng
 * Date: 26/3/2020
 * Time: 10:25
 */

use PhpAmqpLib\Connection\AMQPStreamConnection;

Class ConnectionUtil {
    private $host;
    private $port;
    private $virtualHost;
    private $accessKey;
    private $accessSecret;
    private $instanceId;

    function __construct($host, $port, $virtualHost, $accessKey, $accessSecret, $instanceId) {
        $this->host = $host;
        $this->port = $port;
        $this->virtualHost = $virtualHost;
        $this->accessKey = $accessKey;
        $this->accessSecret = $accessSecret;
        $this->instanceId = $instanceId;
    }

    private function getUser() {
        $t = '0:' . $this->instanceId . ':' . $this->accessKey;
        return base64_encode($t);
    }

    private function getPassword() {
        $ts = (int)(microtime(true)*1000);
        $value = utf8_encode($this->accessSecret);
        $key = utf8_encode((string)$ts);
        $sig = strtoupper(hash_hmac('sha1', $value, $key, FALSE));
        return base64_encode(utf8_encode($sig . ':' . $ts));
    }

    public function getConnection() {
        $username = $this->getUser();
        $password = $this->getPassword();

        return new AMQPStreamConnection($this->host, $this->port, $username, $password, $this->virtualHost, false);
    }
}