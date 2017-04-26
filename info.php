<?php
echo '<br><h1>PHP Info of this Machine</h1><br><br>';
echo phpinfo();
/*
* Md. Nazmul Basher


ob_start(); // Turn on output buffering
system(‘ipconfig /all’); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer

$findme = “Physical”;
$pmac = strpos($mycom, $findme); // Find the position of Physical text
$mac=substr($mycom,($pmac+36),17); // Get Physical Address



echo "MAC ID: ";
echo $pmac;
echo $mac;

function getMacLinux() {
  exec('netstat -ie', $result);
  if(is_array($result)) {
    $iface = array();
    foreach($result as $key => $line) {
      if($key > 0) {
        $tmp = str_replace(" ", "", substr($line, 0, 10));
        if($tmp <> "") {
          $macpos = strpos($line, "HWaddr");
          if($macpos !== false) {
            $iface[] = array('iface' => $tmp, 'mac' => strtolower(substr($line, $macpos+7, 17)));
          }
        }
      }
    }
    return $iface[0]['mac'];
  } else {
    return "notfound";
  }
}

echo 'Linux Mac ID : '.getMaclinux();


$ip=$_SERVER['SERVER_ADDR'];
echo "Server IP: {$ip}<br />
Server Mac: ";
$conf=exec('netstat -ie');
$prots=explode("\n\n",$conf);
if($ip=='127.0.0.1')$ip='192.168.';
foreach($prots as $prot){
    if(strpos($prot,' addr:'.$ip) && preg_match('/(?:\s+)HWaddr(?:\s+)(?P<mac>[a-f0-9\:]+)/',$prot,$match)){
    echo $match['mac'];
    }
}


$ipAddress=$_SERVER['REMOTE_ADDR'];
$macAddr=false;

#run the external command, break output into lines
$arp=`arp -a $ipAddress`;
$lines=explode("\n", $arp);

#look for the output line describing our IP address
foreach($lines as $line)
{
   $cols=preg_split('/\s+/', trim($line));
   if ($cols[0]==$ipAddress)
   {
       $macAddr=$cols[1];
   }
}
echo $lines[1];
echo $cols[1];
echo $macAddr;
*/
//===========================================
ob_start();
$cmd = system("getmac"); 
ob_end_clean();
echo 'Your MAC ID : '. substr($cmd,0,17);
/*
echo '<br><br><br>';
echo '<br>New Get Mac: '.substr($cmd,0,17).'<br>';
echo 'Location: '.strstr($cmd, '{');
$cmd = system("nbtstat -a ip.of.remote.machine");
echo '<br>Another ID New Get Mac: '.$cmd; */
?>