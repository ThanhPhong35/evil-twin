<?php
include '/opt/lampp/htdocs/eviltwin/command.php';
$act = $_GET["act"];
switch ($act) {
    case 'scanwifi':
        echo scanWifi();
        break;
    case 'getwifilist':
        echo getwifilist();
        break;
    // case 'scandevice':
    //     echo scanDevice();
    //     break;
    // case 'getdevicelist':   
    //     echo getdevicelist();
    //     break;
    case 'attack':
        $index = $_GET["index"];
        $ssid = $_GET["ssid"];
        attack($index, $ssid);
        break;
    case 'getattack':
        $ssid = $_GET["ssid"];
        echo getattackresult($ssid);
        break;
    case 'stop':
        $ssid = $_GET["ssid"];
        echo stop($ssid);
        break;
    case 'connectWifi':
        $ssid = $_GET["ssid"];
        $password = $_GET["password"];
        echo connectWifi($ssid, $password);
        break;
    case 'eternalBlue':
        echo eternalBlue();
        break;
    case 'getToolResult':
        echo getToolResult();
        break;
    case 'scandevice':
        echo scandevice();
        break;
    case 'getdevicelist':
        echo getdevicelist();
        break;
    case 'deviceInfo':
        $hostname = $_GET["hostname"];
        $mac = $_GET["mac"];
        $ip = $_GET["ip"];
        echo deviceInfo($hostname, $mac, $ip);
        break;
    case 'deviceVuln':
        $ip = $_GET["ip"];
        echo deviceVuln($ip);
        break;
    case 'getVuln':
        echo getVuln();
        break;
    case 'getAttackStatus':
        echo getAttackStatus();
        break;
}
