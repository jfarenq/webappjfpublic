<?php

function GetProgCpuUsage($program)
 {
     if(!$program) return -1;

    $c_pid = exec("ps aux | grep ".$program." | grep -v grep | grep -v su | awk {'print $3'}");
     return $c_pid;
 }

function GetProgMemUsage($program)
 {
     if(!$program) return -1;

    $c_pid = exec("ps aux | grep ".$program." | grep -v grep | grep -v su | awk {'print $4'}");
     return $c_pid;
 }

    echo "<body style='background-color:black;color:green'>";
#    echo "<body style='color:white'>";

    echo "<center><h1>SYSTEM INFORMATIONS</h1>";
#    echo nl2br ("\n\n\n");

    echo "<u>CPU Architecture</u>:<br> ".exec('uname -m');
    echo  nl2br ("\n\n");

    echo "<u>Hostname</u>:<br> ".exec('hostname -f');
    echo  nl2br ("\n\n");

    echo "<u>Kernel</u>:<br> ".exec('uname -a');
    echo  nl2br ("\n\n");

    $osrelease = shell_exec('cat /etc/os-release 2>&1');
    echo "<u>Operating System Release</u>:<br>";
    echo "<pre>$osrelease</pre>";
    echo  nl2br ("\n\n");

    $ipinfos = shell_exec('ip a');
    echo "<u>IP adresses informations</u> : ";
    echo "<pre>$ipinfos</pre>";
    echo  nl2br ("\n\n");

#    echo "<u>CPU use of Program</u>:<br>".GetProgCpuUsage($randomprogram)."%";
#    echo  nl2br ("\n\n");

#    echo "<u>Memuse of Program</u>:<br>".GetProgMemUsage($randomprogram)."%";
#    echo nl2br ("\n\n\n");
echo <<<HTML
<h1><a href="index.html">Return to home page</a></h1>
HTML;

?>

